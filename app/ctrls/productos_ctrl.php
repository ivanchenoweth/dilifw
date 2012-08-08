<?php
/**
 * Controlador de Productos y todas sus acciones
 * Representa el CRUD de productos 
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class productos_ctrl {
	public $productoModel = null;
   /**
   * Inicializa nicalizar el controlador
   * Valida ACL e inicializa propiedades, 
   * Usado para invocar methodos internos
   *  
   * @access public
   * @author Ivan R. Chenoweth
   * @param  
   * @return mixed
   */
	private function productos_ctrl() {	
	  	if (@$_REQUEST["Cancelar"]) {		
        	header('Location: /productos');
        }
	    if (!Auth::isRol("Vendedor")) {      	// ACL      	
            	Auth::logout();
        }               
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
        $tc = new productos_ctrl();		// handle this controller             
        if (@$_REQUEST["Buscar"] && strlen($_REQUEST["buscadescripcion"])>0) {
		//  # http://www.phpactiverecord.org/projects/main/wiki/Finders
        	$datos =  producto::find('all',array('conditions' => 
        		"descripcion LIKE '%".$_REQUEST["buscadescripcion"]."%'"));
        }        
        else {
			$datos = producto::find('all');			      
        }           
        require_once (DIRVIEWS. 'ProductosList.php');
  }
  /**
   * Nuevo 
   */
  public static function nuevo()			
  {
        $tc = new productos_ctrl();		// handle this controller                       
        if (@$_REQUEST["Aceptar"]) {
	        $post = new producto();
			$post->cveprod = $_REQUEST["cveprod"];
			$post->descripcion = $_REQUEST["descripcion"];
			$post->precio = $_REQUEST["precio"];
			$post->save(); 
        	header('Location: /productos'); 
        }
        else {
	        $msg = "Agregando Registro";
	        $form_action = "nuevo";
	        require_once (DIRVIEWS. 'ProductosForm.php');
        }
  }
  /**
   * Editar 
   */
  public static function editar()			
  {
        $tc = new productos_ctrl();		// handle this controller                       
        if (@$_REQUEST["Aceptar"]) {
        	$post = producto::find($_REQUEST["id"]);
        	$post->cveprod = $_REQUEST["cveprod"];
			$post->descripcion = $_REQUEST["descripcion"];
			$post->precio = $_REQUEST["precio"];
			$post->save(); 
        	header('Location: /productos'); 
        }
        else {
	        if (@route::getAction()) 	        	 
	        	$row = producto::find(@route::getAction());
	        $msg = "Editando Registro";
	        $form_action = "editar";
	        require_once (DIRVIEWS. 'ProductosForm.php');
        }
  }
  
  /**
   * Metodo borrar
   * 
   */
  public static function borrar()
  {       	             		        
        $tc = new productos_ctrl();					// ACL ts = this controller                               
        if (@$_REQUEST["Aceptar"]) {        	
        	$post = producto::find(@$_REQUEST[id]);
			$post->delete();
        	header('Location: /productos'); 
        }
        else {
	        if (@route::getAction()) 
	        $row =  producto::find('all',@route::getAction());
	        // var_dump($datos);
	        $msg = "¿Esta seguro de Borrar el Registro?";
	        $form_action = "borrar";
	        require_once (DIRVIEWS. 'ProductosForm.php');
        }
  }  
}


?>