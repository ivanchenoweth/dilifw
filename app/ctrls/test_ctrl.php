<?php
/**
 * Controlador de Prueba 
 * Representa las pruebas para el uso que pueda tener el Framework
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class test_controlador {
  public static function index()
  {

        echo 'Class test_controlador, index()';
        $route = route::getRoutes();
		var_dump($route);
  }

  public static function registry()
  {

        echo 'Class test_controlador,registry()';
        // http://achmedia.com/test/registry
        Registry::get_vardump_sample_ini();
        $registry = new Registry();
        $registry->__set("a",1);		// Registring private vars		
        var_dump($registry);
        $route = route::getRoutes();
		var_dump($route);
  }

  public static function usermodelo()
  {
        echo 'Class test_controlador, usermodelo()';
        // http://achmedia.com/test/usermodelo		
        $route = route::getRoutes();
		var_dump($route);
  }

}


 
?>