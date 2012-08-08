<?php
/**
 * Controlador Gestionar a Titulares.
 * Realiza la gestión de un titular con los resultados deseados
 *
 * @access public
 * @author Ivan R. Chenoweth
 * @param
 * @return mixed
 */
class gestionar_ctrl {
	/**
	 * Metodo inicial del controlador
	 *
	 */	
	public static function index()
	{
	// El titular debe venir en var_dump($route);
	// var_dump($_SESSION);
	 if (!Auth::isRol("1")) {
		Auth::logout();
	 }
	 
	//	echo '<hr>INFO<hr> ';
	//	echo 'Class gestionar_ctrl, index()';
	//	$route = route::getRoutes();
	//	var_dump($route);
	//	exit();
	 
	 $lead_id = @route::getAction();	// lead_id ej: '47922'
	  
	 if (@$_REQUEST["Aceptar"]) {
	 	// Inserting titular_log 
	 	// var_dump($_REQUEST);	
	 	if (strlen($_REQUEST["telefonopersonacontactada"]!=10)) {
	 		echo "El teléfono no es de 10 caracteres";
	 	}
	 	else {
		 	$post = new onus_titular_log();	
	 		$post->lead_id = $lead_id; 	
	 		$post->user_id = @$_SESSION["userRow"]["user"];
	 		$post->estadoactual = $_REQUEST["resultado"];
	 		$post->resultado2 = $_REQUEST["resultado2"]; 	
	 		$post->resultado3 = $_REQUEST["resultado3"];
	 		$post->fechahorasigtarea = $_REQUEST["fechahorasigtarea"];
	 		$post->nombrepersonacontactada 	= $_REQUEST["nombrepersonacontactada"];
	 		$post->tipopersonacontactada = $_REQUEST["tipopersonacontactada"];
	 		$post->nombrepersonacontactada = $_REQUEST["nombrepersonacontactada"];
	 		$post->telefonopersonacontactada = $_REQUEST["telefonopersonacontactada"];
	 		$post->fechalog = date("Y-m-d h:i:s");
 		
	 		// $post->fecha_recall = $_REQUEST["fechacompromiso"];
			// $post->fechacompromiso = $_REQUEST["fechacompromiso"];
			// $post->lastdialednumber = $_REQUEST["newtel"]; 
	 		// lookup the resultado //		
	 		$params["conditions"] = array('onus_resultado.resultado  = ? ' , $_REQUEST["resultado2"]);
		 	$resultado3 = onus_resultado::all($params);	 		 		 
		 	$post->prioridadorden = $resultado3[0]->prioridadorden;
	 		$post->resumen = $_REQUEST["observaciones"];
			$post->save();
	 	}	 	
	 }	 
	 // $params["limit"] = 1;
	 
	 $params["conditions"] = array('vicidial_list.lead_id  = ?' , $lead_id);
	 $params["joins"] = "JOIN vicidial_list ON `vicidial_list`.`lead_id` = `onus_titular`.`lead_id`";
	 $params["select"] = "onus_titular.*, vicidial_list.*";
	 $datos = onus_titular::all($params);
	 // echo onus_titular::table()->last_sql;
	 unset($params);
	 $params["conditions"] = array('onus_resultado.novisible  = ? ' , 2);
	 $resultado = onus_resultado::all($params);
	 unset($params);
	 $params["conditions"] = array('onus_resultado.novisible  = ? ' , 3);
	 $resultado2 = onus_resultado::all($params);
	 unset($params);
	 $params["conditions"] = array('onus_resultado.novisible  = ? ' , 4);
	 $resultado3 = onus_resultado::all($params);	 
	 require_once (DIRLIB . DS . 'onus' . DS . "titular_class.php");
	 $miTitular = new titular($lead_id);	// construye objeto para detalles
	 $miTitular->load_phones_logs();		// carga historial de teléfonos
	 $miTitular->load_titular_logs();		// carga historial de titulares
	 // $miTitular->var_dump_all("cartera phones_log");
	 $tit_row = $miTitular->data["perfil"];	 	 
	 // Render	 
	 $titulo="Gestionar Titulares";									// Titulo principal de la pagina y subtitulo de opción
	 $opcionactiva="Gestionar Titulares";							// Opción activa
	 // $panel1 = THEME . DS . "panel1RegistredUser.php";			// filename require_once del panel1
	 //var_dump($miTitular->data);
	 $panel2 = THEME . DS . "panel2GestionarRegistredUser.php";		// require_once del panel2	(Tabla resultados)
	 require_once(THEME . DS . "DashBoardRegistredUser.php");		// 
	}
	

}
?>