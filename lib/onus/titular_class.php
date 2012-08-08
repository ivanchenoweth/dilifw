<?php

/**
* Clase titular
* Para operar un titular
* Las propiedades de esta clase operan con data sobre el esquema de mysql.
* Construye el objeto para el tiular, con el esquema:
* data[perfil]
* data[vicidial_list] 
* data[phones]
* data[phones_log]
* data[titular_log] *  
*/
class titular {	
	var $dbg;			// debug
	var $data;			// arreglo de todos los datos titular y relacionados
	/**
	* Constructor 
	* Carga los datos de conexión y construye un titular desde un parametro 'lead_id'
	*/
	public function titular($lead_id) {
		$params["conditions"] = array('onus_titular.lead_id = ?' , $lead_id);		
		@$arr1 = onus_titular::all($params);
		@$this->data["perfil"] = $arr1[0];						
		// Obten datos de vicidial_list
//		$sql = "SELECT
//			*			
//			FROM
//			vicidial_list
//			WHERE lead_id = '".$lead_id."'
//			LIMIT 1";								
//		$arr1 = onus_titular::find_by_sql($sql);
//		@$this->data[vicidial_list] = $arr1[0]; 
		$params["conditions"] = array('vicidial_list.lead_id = ?' , $lead_id);		
		@$arr1 = vicidial_list::all($params);
		@$this->data[vicidial_list] = $arr1[0];			
		// Obten datos de phones
		$sql = "SELECT
			*			
			FROM
			onus_phones
			WHERE lead_id = '".$lead_id."'
			";		
		@$this->data["phones"] = onus_titular::find_by_sql($sql);
		// echo "CARTERA:";  		echo $this->data["perfil"]->cartera;
												
		if (@$this->data["perfil"]->cartera == 'Fonacot') {
			// Obten datos de Fonacot
			$sql = "SELECT
				*			
				FROM
				onus_fonacot
				WHERE lead_id = '".$lead_id."'				
				";			
			@$this->data["data_cartera"] = onus_titular::find_by_sql($sql);			
			$total_cartera=0;
			// barrer cartera
			$this->data["total_cartera"]=$total_cartera;									
		}
		if (@$this->data["perfil"]->cartera  == 'Convenios') {
			// Obten datos de Convenios
			$sql = "SELECT
				*			
				FROM
				onus_hhconvenios
				WHERE lead_id = '".$lead_id."'				
				";
			@$this->data["data_cartera"] = onus_titular::find_by_sql($sql);		
			$total_cartera=0;
			// barrer cartera
			@$this->data["total_cartera"]=$total_cartera;				
		}
		//
		if (@$this->data["perfil"]->cartera == 'SLRC') {
			// Obten datos de Convenios de SLRC
			$sql = "SELECT
				*			
				FROM
				onus_slrc
				WHERE lead_id = '".$lead_id."'				
				";
			@$this->data["data_cartera"] = onus_titular::find_by_sql($sql);			
			$total_cartera=0;
		}
		//		
		if (@$this->data["perfil"]->cartera == 'Mexicali') {
			// 
			$sql = "SELECT
				*			
				FROM
				onus_mexicali
				WHERE lead_id = '".$lead_id."'				
				";
			
			@$this->data["data_cartera"] = onus_titular::find_by_sql($sql);			
			$total_cartera=0;
			// barrer cartera
			// $this->data[total_cartera]=$total_cartera;	
		}	
			
		if (@$this->data["perfil"]->cartera == 'Telmex') {
			// Obten datos de Fonacot			
			$sql = "SELECT
				*			
				FROM
				onus_telcel
				WHERE lead_id = '".$lead_id."'				
				";
			@$this->data["data_cartera"] = onus_titular::find_by_sql($sql);		
			$total_cartera=0;			
			// barrer cartera
			//$this->data[total_cartera]=$total_cartera;				
		}
		//var_dump($this->data);
	}	// End constructor
	
	
	function var_dump_all($p) {
		if (strstr($p,"perfil")) {
			echo "<hr> PEFIL";		
			var_dump($this->data["perfil"]);
		}
		if (strstr($p,"vicidial_list")) {
			echo "<hr> VICIDIAL LIST";		
			var_dump($this->data["vicidial_list"]);
		}
		if (strstr($p,"phones")) {
			echo "<hr> PHONES"; 
			var_dump(@$this->data["phones"]);		
		}
		if (strstr($p,"phones_log")) {
			echo "<hr> PHONES_LOG";
			var_dump($this->data["phones_log"]);
		}
		if (strstr($p,"titular_log")) {
			echo "<hr> TITULAR_LOG";
			var_dump($this->data["titular_log"]);
		}
		if (strstr($p,"cartera")) {
			echo "<hr> CARTERA"; 
			var_dump(@$this->data["data_cartera"]); 
		}
	}
	
	/**
	* Carga al titular los logs de los teléfonos
	*/
	function load_phones_logs($limite = null,$dbg = null) {
		if ($limite) $filtro = "LIMIT ".$limite;		
		//var_dump(@$this->data[perfil]);		
		$sql = "SELECT
			*
			FROM
			onus_phones_log
			WHERE lead_id = '".@$this->data[perfil]->lead_id."'
			ORDER BY fecha_recall DESC
			".@$filtro."
			";
		//var_dump($sql);	
		@$this->data["phones_log"] = onus_titular::find_by_sql($sql);
	}
	
	/**
	* Carga al titular los logs de las gestiones del ese titular
	*/
	function load_titular_logs($limite = null) {
		if ($limite) 
			@$filtro = "LIMIT ".$limite;
		 $sql = "SELECT
			*			
			FROM
			onus_titular_log
			WHERE lead_id = '".$this->data["perfil"]->lead_id."'
			ORDER BY fechalog DESC			
			".@$filtro."
			";
		@$this->data["titular_log"] = onus_titular::find_by_sql($sql); 							
	}
	/**
	* 
	* Retorna un arreglo de teléfonos con un resultado de un teléfono en phones_log
	* Si se especifica el tel retorna un arreglo de un elemento SI es que existe ese teléfono y tiene $ocurrencia_mayor_a
	* Con la ocurrencia_mayor_a un numero determinado
	* Cada teléfono retornado contiene el numero de ocurrencias encontradas con ese resultado
	* Si no se dá ocurrencia retorna todos los teléfonos con ese resultado, ordenados por numero de teléfono
	*/
	function phones_logs_count_result($resultado, $tel = null, $ocurrencia_mayor_a=null){
		$c=1;
		$arr = $this->data["phones_log"];
		//Fb::info($arr, "phones_log , telefonos desordenados");			
		$arr = $this->sortmulti($arr,"phone","asc");
		//Fb::info($arr, "phones_log , telefonos ordenados");
		if ($this->data["phones_log"])
		foreach ($arr as $key => $value) {
			if ($tel) {
				if ($value[phone] != $tel) {
					Fb::log("El telefono no concuerda con el del parámetro ... skipped");
					continue;
				}
			}
			if ($value[resultado]==$resultado) {
				$arrret[$value[phone]] = $value;					
				if ($valueant_phone==$value[phone]) 
					$c++;
				else 
					$c=1;								
				if ($c >= $ocurrencia_mayor_a) {
					$arrret[$value[phone]][occurs] = $c;
				}
				else {
					unset($arrret[$value[phone]]);
				}
				
			 $valueant_phone=$value[phone];
			}
		}
		return $arrret;
	}		
	function export_to_txt($filecontent,$pantalla=false) {
		 // $pantalla = true;												
		if ($pantalla==false) {
			ob_end_clean();	
			$downloadfile="TELCEL_SMS_".date("Y-m-d_h_ms").".txt";		
			header("Content-disposition: attachment; filename=$downloadfile");
			header("Content-Type: application/force-download");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".strlen($filecontent));
			header("Pragma: no-cache");
			header("Expires: 0");
			echo $filecontent;
		}
		else var_dump($filecontent);
	}
	
	function export_to_excel($filecontent,$pantalla=false) {
			//$pantalla = true;												
			if ($pantalla==false) {
				ob_end_clean();		
				$fileexport = date("Y-m-d_h_ms").".xls";	
				header ("Expires: Mon, 26 Jul 2012 05:00:00 GMT");  
				header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
				header ("Cache-Control: no-cache, must-revalidate");  
				header ("Pragma: no-cache");  
				header ("Content-type: application/x-msexcel");  
				header ("Content-Disposition: attachment; filename=\"exporta_".$fileexport."\"" );
				echo $filecontent;
			}
			else {
				var_dump($filecontent);
			}
			// echo "uno\tdos\ttres\tcuatro\tcinco\tseis\t\n";
			//	echo "siete\tocho\tnueve\tdiez\tonce\t4\t\n";
			//	echo "doce\ttrece\tcatorce\tquince\t46\tah\t\n";
	}			
	function content_to_csvgen_header() {
		  //'NUM_TRABAJADOR' => string '590205' (length=6)
		  // 'NUM_CREDITO' => string '39294' (length=5)		 
		  /* 
		  if ($this->data["perfil"]["cartera"]=="Fonacot") {
			$ret = "Num.Trabajador\tTitular\tDomicilio\tColonia\tCiudad\tAdeudo\tStatus\r\n";
		  }
		  if ($this->data["perfil"]["cartera"]=="Telmex") {
			$ret ="Celular\tCuenta\tTitular\tDomicilio\tColonia\tCiudad\tAdeudo\tStatus\r\n";
		  }
		  if ($this->data["perfil"]["cartera"]=="SLRC") {
			$ret = "Clave_Catastrl\tTitular\tDomicilio\tColonia\tCiudad\tAdeudo\tStatus\r\n";
		  }
		  if ($this->data["perfil"]["cartera"]=="HHCONVENIOS") {
			$ret = "Folio\tRefAnterior\tTitular\tDomicilio\tColonia\tCiudad\tAdeudo\tStatus\r\n";
		  }	
		  */
		  $ret = "Cuenta\tTitular\tDomicilio\tColonia\tCiudad\tAdeudo\tStatus\r\n";
		  return $ret;	  
		  		  
	}
	//////// Obtiene el contenido de un renglon CSV
	function content_to_csvgen() {
		// [Cuenta]	[Titular] [Domicilio]	[Colonia]	[Ciudad]	[Adeudo]	[Status]
		echo "<hr>";		echo "PERFIL";				echo "<br>";			var_dump($this->data["perfil"]);
		echo "<hr>";		echo "CARTERA";				echo "<br>";			var_dump($this->data["data_cartera"][0]);

		// $arr["Cuenta"] = $this->data["data_cartera"][0]["CUENTA"]);	
		// $filecontent = $this->cvsfilecontent;
		 if ($this->data["perfil"]["cartera"]=="Telmex") {
			$filecontent .= $this->data["data_cartera"][0]["CELULAR"];
			$filecontent .=  ",";						 
			$filecontent .= $this->data["data_cartera"][0]["CUENTA"];
			$filecontent .=  "\t";								
		 }
		 if ($this->data["perfil"]["cartera"]=="Fonacot") {
 			$filecontent .= $this->data["data_cartera"][0]["NUM_TRABAJADOR"];
			$filecontent .=  "\t";			  
		 }
		 
		 if ($this->data["perfil"]["cartera"]=="Convenios") {
  			$filecontent .= $this->data["data_cartera"][0]["Folio"];
			$filecontent .=  ",";			  
 			$filecontent .= $this->data["data_cartera"][0]["RefAnterior"];
			$filecontent .=  "\t";
		  }
		  if ($this->data["perfil"]["cartera"]=="SLRC") {
 			$filecontent .= $this->data["data_cartera"][0]["Clave_Catastrl"];
			$filecontent .=  "\t";			  
		  }		   
		$filecontent .=  $this->data["perfil"]["nombre"];
		$filecontent .=  "\t";
		$filecontent .=  $this->data["perfil"]["calle"]." No.".$this->data["perfil"]["num"];
		$filecontent .=  "\t";		
		$filecontent .=  $this->data["perfil"]["colonia"];
		$filecontent .=  "\t";
		$filecontent .=  $this->data["perfil"]["ciudad"];
		$filecontent .=  "\t";		
		$filecontent .=  $this->data[total_cartera];
		$filecontent .=  "\t";				
		$filecontent .=  $this->data["perfil"]["estadoactual"];
		$filecontent .=  "\t";						
		// 
		$filecontent .= "\r\n";
		// echo "<hr>";				var_dump($filecontent);		echo "<hr>";		
		return $filecontent;			
	}
	
	function content_to_txt_sms($msg) {
		
		//echo "<hr>";		echo "PERFIL";				echo "<br>";			var_dump($this->data["perfil"]);
		//echo "<hr>";		echo "CARTERA";				echo "<br>";			var_dump($this->data["data_cartera"][0]);
		//
		//// Produce: You should eat pizza, beer, and ice cream every day
		//$phrase  = "You should eat fruits, vegetables, and fiber every day.";
		//$healthy = array("fruits", "vegetables", "fiber");
		//$yummy   = array("pizza", "beer", "ice cream");
		// $newphrase = str_replace($healthy, $yummy, $phrase);
		
		$newphrase = str_replace($healthy, $yummy, $phrase);
		$filecontent = "";
		//$rest = substr("abcdef", -2);    // devuelve "ef"
		$filecontent .= substr($this->data["data_cartera"][0]["CELULAR"],-10);
		$filecontent .= ";";
		// MENSAJE 
		$phrase = $msg;
		//$phrase  = "You should eat fruits, vegetables, and fiber every day.";		
		$healthy = array("[factura]", "[adeudo]");
		$yummy = array($this->data["data_cartera"][0]["CUENTA"], "$".number_format($this->data["data_cartera"][0]["SALDO"],2));
		$newphrase = str_replace($healthy, $yummy, $phrase);
		$filecontent .= $newphrase;
		// 
		// $filecontent .= $msg;
		$filecontent .= "\r\n";
		// var_dump($filecontent);
		return $filecontent;					
	}


	function content_to_cvs_sms($msg) {
		
		//echo "<hr>";		echo "PERFIL";				echo "<br>";			var_dump($this->data["perfil"]);
		//echo "<hr>";		echo "CARTERA";				echo "<br>";			var_dump($this->data["data_cartera"][0]);
		$filecontent = "";
		$filecontent .= substr($this->data["data_cartera"][0]["CELULAR"],-10);
		$filecontent .= "\t";
		// MENSAJE:
		$healthy = array("[factura]", "[adeudo]");
		$yummy = array($this->data["data_cartera"][0]["CUENTA"], "");
		$newphrase = str_replace($healthy, $yummy, $msg);
		$filecontent .= $newphrase;
		//
		$filecontent .= "\t ";
		$filecontent .= "$".number_format($this->data["data_cartera"][0]["SALDO"],2);
		$filecontent .= "\r\n";
		//var_dump($filecontent);
		return $filecontent;					
	}
	
	
	/**
	* Realiza una busqueda de la última gestión de un teléfono(onus_phone_log) 
	* Retorna nulo si no se hizo una gestión anterior
	*/
	
	function ultimo_log($tel){
		foreach ($this->data[phones_log] as $key => $value) {
			if ($value[phone]==$tel) {
				return $value[resultado];
			}
		}
		return false;
	}
	
	
	//-//
	function sortmulti ($array, $index, $order, $natsort=FALSE, $case_sensitive=FALSE) {
			if(is_array($array) && count($array)>0) {
				foreach(array_keys($array) as $key)
				$temp[$key]=$array[$key][$index];
				if(!$natsort) {
					if ($order=='asc')
						asort($temp);
					else   
						arsort($temp);
				}
				else
				{
					if ($case_sensitive===true)
						natsort($temp);
					else
						natcasesort($temp);
				if($order!='asc')
					$temp=array_reverse($temp,TRUE);
				}
				foreach(array_keys($temp) as $key)
					if (is_numeric($key))
						$sorted[]=$array[$key];
					else   
						$sorted[$key]=$array[$key];
				return $sorted;
			}
		return $sorted;
	}		
}	// end of class