<?php
/**
 * Controlador de Usuarios
 * Representa el CRUD de productos 
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class users_ctrl {	
   /**
   * Inicializa  el controlador
   * Valida ACL e inicializa propiedades, 
   * Usado para invocar methodos internos
   *  
   * @access public
   * @author Ivan R. Chenoweth
   * @param  
   * @return mixed
   */
	private function users_ctrl() {	
	  	if (@$_REQUEST["Cancelar"]) {				// Any cancel button go to list
        	header('Location: /users');
        }
//        if (Auth::isRol("Administrador")) {			// ACL      	
//            	Auth::logout();
//        }                        
	}		
  /**
   * Metodo Index
   * Es ejecutado cuando no se muestra nada en la URI mas que XXX_controlador
   * 
   * @access public
   * @author Ivan R. Chenoweth
   * @param  
   * @return mixed
   */		
  public static function index()
  {       	             		        
  	    // echo "Crud de productos index()";
        $tc = new users_ctrl();		// handle this controller
        require_once (DIRLIB .  DS . 'onus' . DS . "usuario_class.php");		//  Bussines user class MD 
        $usuario = new usuario();												// Usuario 
        if (@$_REQUEST["Buscar"] && strlen($_REQUEST["nombrebuscar"])>0) {
        	$datos = $usuario->searchByName($_REQUEST["nombrebuscar"]);        	
        }        
        else {
			$datos = $usuario->getAllRows();		      
        }        
        require_once(THEME . DS . 'UsersList.php');
  }
  /**
   * Nuevo 
   */
  public static function nuevo()			
  {
        $tc = new users_ctrl();		// handle this controller                       
        if (@$_REQUEST["Aceptar"]) {
	        $post = new user();
			$tc->populate($post);
			$post->save(); 
        	header('Location: /users'); 
        }
        else {
	        $msg = "Agregando Registro";
	        $form_action = "nuevo";
	        require_once(THEME . DS . 'usersForm.php');
        }
  }
  /**
   * Editar 
   */
  public static function editar()				// Editando MD			
  {
        $tc = new users_ctrl();					// handle this controller ACL
        $id = @route::getAction();              // ID SELECTED               
        
//        if (@$_REQUEST["Aceptar"]) {
//        	$post = user::find($_REQUEST["id"]);
//			$tc->populate($post);
//			$post->save(); 
//        	header('Location: /users'); 
//        }        
//		if (@$_REQUEST["Borrar"]) {		// Borrando un detalle   			
//			$row = new user();			// user model to the master
//			$tc->populate($row);		// fill with request			
//		}
//		if (@$_REQUEST["Agregar"]) {   	// Agregando un detalle
//			$row = new user();			// user model to populate the master data
//			$tc->populate($row);		// fill with request to the master data
//		}
        //$usuario->resetSession();												// Clear Session	
        // if (!@$_REQUEST["Borrar"] && !@$_REQUEST["Agregar") {
        if (@$id) {	
        	require_once (DIRONUS.  DS .'usuario_class.php');
        	// die("test");
        	
        	$usuario = new usuario();    					// New usuario
        	
        	// Obtiene la venta de la sesion si es que existe la sesión.		
			if ($this->usuario->isOnSesion()) {
				$this->usuario = $this->usuario->getSesion();
			}        	
        	$usuario->resetSession();  						// Reset session
        	$usuario->getById($id);	             	        //
        	$datos = $usuario->row;
        	$row = $usuario->row;
        	$detail = $usuario->detail;
        }
        	                

       	// echo onus_listas_users::table()->last_sql;
       	$this->usuario->setSesion();		
        $msg = "Editando Registro";
        $form_action = "editar";	        
        require_once(THEME . DS . 'UsersForm.php');     
        $route = route::getRoutes();
		var_dump($route);
        
  }
  
  function populate(&$post) {
  		$post->id = $_REQUEST["id"];
		$post->username = $_REQUEST["username"];
		$post->password = $_REQUEST["password"];
		$post->nombre = $_REQUEST["nombre"];
		$post->rol = $_REQUEST["rol"];
		$post->email = $_REQUEST["email"];
  }
  
  /**
   * Metodo borrar
   * 
   */
  public static function borrar()
  {       	             		        
        $tc = new users_ctrl();					// ACL ts = this controller                               
        if (@$_REQUEST["Aceptar"]) {        	
        	$post = user::find(@$_REQUEST[id]);
			$post->delete();
        	header('Location: /users'); 
        }
        else {
	        if (@route::getAction()) 
	        $row =  user::find('all',@route::getAction());		// populate
	        // var_dump($datos);
	        $msg = "¿Esta seguro de Borrar el Registro?";
	        $form_action = "borrar";
			require_once(THEME . DS . 'UsersForm.php');
        }
	}  
}
?>