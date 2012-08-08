<?php
/**
 * Controlador Consultar a titulares 
 * Realiza un despliegado de el status y el historial de gestiiones del titular
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class consultar_ctrl {
  public static function index()
  {

        echo 'Class consultar_ctrl, index()';        
        $route = route::getRoutes();
		var_dump($route);		
		
  }

}
?>