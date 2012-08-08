<?php
/**
 * Controlador  Inicial
 * Representa el flujo de arranque del sistema
 * Es ejecutado cuando se desonoce el URI dentro de los controladores.
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class index_ctrl {
	var $total_registros;
   /**
   * Constructor index_ctrl
   * 
   * @access public
   * @author Ivan R. Chenoweth
   * @param  
   * @return mixed
   */
	private function index_ctrl() {	
	  	if (@$_REQUEST["Cancelar"]) {		
        	header('Location: /');
        }
	}			
  /**
   * Metodo Index
   * Es ejecutado cuando no se muestra nada en la URI   
   * Representa la ejecución de cada petición hacia algun dashbord inicial
   * class index_controlador, index()
   * Controlador default (home)
   * NOTA: Se ejecuta cuando no exista un controlador definidio en la URI 
   * 
   * @access public
   * @author Ivan R. Chenoweth
   * @param  
   * @return mixed
   */
  public static function index()
  {  		
        if (@$_REQUEST[username] && @$_REQUEST[password]) { 					// Valida request
        	Auth::login(@$_REQUEST[username],  @$_REQUEST[password]);        	
        	if (!Auth::isLogged()) {        		
        		$msg = "Usuario/Password incorrecto";        		
        		require_once(THEME . DS . "DashboardGuestLogin.php");    		
        	} 
        }
        else
        {        		        
            if (!Auth::isLogged()) {
            	Registry::render("DashboardGuestLogin.php");		// Render no msg            	
        	}
        }        
		//var_dump($_SESSION);		        
		//       if (Auth::isRol("9")) {
		//       	 	require_once(THEME . DS . 'DashBoardAdmin.php');
		//       	 	Registry::render("DashboardGuestLogin.php");		// Render no msg
		//       }
		 
        // var_dump($_SESSION);
        if (Auth::isRol("1") || Auth::isRol("8") ) {                        
	       //if (@$_REQUEST["nombre"] || @$_REQUEST["tel"]) {
	     		$tc = new index_ctrl();		// handle this controller
	     		$offsetrepag = 0;
	     		if (@$_REQUEST["repag"]) {
	     			$regpag = @$_REQUEST["repag"] - 1;     			
	     			$offsetrepag = @$regpag * Registry::get("recordperpage");
	     			if ($offsetrepag<0) $offsetrepag = 0; 			
	     		}
	     		$datos = $tc->buscar($offsetrepag);				//
	     		$tot_row = $tc->total_registros;
	     		$tot_pages = ceil($tot_row / Registry::get("recordperpage"));          				    
	       //}        	        
        	//if ((@$_REQUEST["tel"] || @$_REQUEST[nombre]) and $datos) {       
        			$panel2 = THEME . DS . "panel2BuscarRegistredUser.php";	// require_once del panel2	(Tabla resultados)
        	//}
        	$titulo="Buscar Titulares";									// Titulo principal de la pagina y subtitulo de opción
        	$opcionactiva="Buscar Titulares";							// Opción activa 
        	$panel1 = THEME . DS . "panel1BuscarRegistredUser.php";		// filename require_once del panel1 	         		  
        	require_once(THEME . DS . "DashBoardRegistredUser.php");	//
 
//	        echo 'Class gestionar_ctrl, index()';        
//	        $route = route::getRoutes();
//			var_dump($route);
//			exit();
        } else {
        	@$this->logout();
        	// Registry::render("DashboardGuestLogin.php");		// Render no msg
        }
  }

  /*
   * Metodo buscar
   */
  public function buscar($offset) {  		  
  		//var_dump($_SESSION);
  		if (strstr(@$_SESSION["userRow"]["allowed_campaigns"], "-ALL-CAMPAIGNS-")) {
  			$filtro = " AND 1 ";
  		}
  		else {
  			$filtro = " AND (" . @$_SESSION["userRow"]["query_listas"].")";
  		}
	    if (@$_REQUEST["nombre"]) {		
			$nom = trim(@$_REQUEST["nombre"]);
			$filtro = "
				AND ( 0
				OR onus_titular.`nombre` LIKE '%$nom%'
				OR onus_titular.`ref1_nom` LIKE '%$nom%'
				OR onus_titular.`ref2_nom` LIKE '%$nom%'
				)
			";
		}
		if (@$_REQUEST["tel"]) {
			$tel = @$_REQUEST["tel"];			
			if (!ereg("(^[0-9]{7}$|^044[0-9]{10}$|^045[0-9]{10}$)", $tel)) {
					$msg = "Error: El formato del teléfono no es correcto.";
				}			
				@$filtro .="
					AND onus_phones.phone LIKE '%$tel%'
				";
		}	
		// JOIN onus_phones ON onus_phones.lead_id = onus_titular.lead_id	
		$sql = "
			SELECT DISTINCT * 
			FROM onus_titular								
			JOIN `vicidial_list` ON onus_titular.lead_id = vicidial_list.lead_id			
			WHERE 1
			$filtro
			LIMIT  ".$offset.",".Registry::get("recordperpage")."
		";		
			
		$sql2 = "
			SELECT DISTINCT COUNT(*) AS total
			FROM onus_titular						
			JOIN `vicidial_list` ON onus_titular.lead_id = vicidial_list.lead_id					
			WHERE 1
			$filtro			
		";
		
		// var_dump($sql);
        // DIRECT SQL     
         $datos = vicidial_list::find_by_sql($sql);         
         $regtot = vicidial_list::find_by_sql($sql2);
         $this->total_registros = $regtot[0]->total;
//         foreach ($datos as $key => $row) {
//         	var_dump($key);	
//         	var_dump($row->attributes());
//         }
//        $route = route::getRoutes();
//		var_dump($route);
  	return $datos;
  }
  
  /**
   * Método de pruebas del controlador principal
   */
  public static function testing()
  {
        echo 'class index_controlador, testing()';
        $route = route::getRoutes();
		var_dump($route);
  }
  
  /**
   * Logout
   */
  public static function logout()
  {     
        Auth::logout();		
  }

}


?>