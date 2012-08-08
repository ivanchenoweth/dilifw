<?php
/**
 * 
 *  Ivan R. Chenoweth
 *  Based in:
 *  http://cj-jackson.com/2011/06/19/simple-effective-url-routing-system/
 */
class route {
  private static $ROUTES;

  public static function init()
  {
    // Bouml preserved body begin 0001F982     	
        $path = @$_SERVER['PATH_INFO'];
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        } else {									
            $path = $_SERVER['REQUEST_URI'];		// The server doesnt show path_info
            $self = $_SERVER['PHP_SELF'];
            $self = dirname($self);
            $self = str_replace('\\', '/', $self); // for Windows Compatibility.
            $self = strlen($self);
            $path = substr($path, $self);
            if ($path != '') {
                $thehash = strpos($path, '#');
                if ($thehash) {
                    $path = substr($path, 0, $thehash);
                }
                $question = strpos($path, '?');
                if ($question) {
                    $path = substr($path, 0, $question);
                }
            } else {
                $path = false;
            }
        }        
        if (!$path) {	
        	//echo "no hay path controller";
            $routes = array('index', 'index');				// Si no hay path controller index, metodo index.
        } else {
            $path = trim($path);							// Extrae espacios
            $path = trim($path, "/");						// extrae / en los extremos
            $routes = strtolower($path);					// convierte minúsculas
            $routes = explode('/', $routes);				// Convierte a arreglos
        }
  		// var_dump($routes);
        if (class_exists($routes[0] . '_ctrl')) {				// URL tiene un controlador				
            if (!isset($routes[1])) {									// Si esta vacio el metodo en el controlador $routes[0]
                $routes[1] = 'index';									// Asigna index como metodo default
            }
            if (method_exists($routes[0] . '_ctrl', $routes[1])) {	// Existe un metodo y tambien controlador especifico
                self::$ROUTES = $routes;								// Retorna singleton
            } else {
				// echo "No existe Metodo, enruta al index()";			//                 
				 $altRoutes = array($routes[0], 'index');				// Asigna index default	controlador				
                $count = 1;												// Agrega variables de ruta restantes
                while (isset($routes[$count])) {
                    $altRoutes[] = $routes[$count];
                    $count++;
                }
                self::$ROUTES = $altRoutes;				
            }
            call_user_func(array(self::$ROUTES[0] . '_ctrl', self::$ROUTES[1]));	// Ejecuta el metodo estatico de la clase
            return;
        } elseif (class_exists('index_ctrl')) {						// existe definido la clase index_ctrl?			
            if (method_exists('index_ctrl', $routes[0])) {			// Esta definido  metodo index?
                $altRoutes = array('index', $routes[0]);               		// asigna: metodo alterno = index								
				$count=1;	
            } else {            	    
				 die ("<h2>Error 404 - Not Found</h2>"); 					// echo "No existe URL de controlador /xxxx ";        
                //$altRoutes = array('index', 'index');                		//Enviar al controlador index y metodo index				
				//$count=0;	
            }									
			while (isset($routes[$count])) {								// Asigna las variables restantes				
				
				$altRoutes[] = $routes[$count];
				$count++;
			}
            self::$ROUTES = $altRoutes;
            call_user_func(array(self::$ROUTES[0] . '_ctrl', self::$ROUTES[1]));
            return;
        } 
		// echo "controlador no definido";
        die ("<h2>Error 404 - Not Found</h2>");
    // Bouml preserved body end 0001F982
  }
   /**
   * return self::$ROUTES;
   */
  public static function getRoutes()
  {
    // Bouml preserved body begin 0001FA02

        return self::$ROUTES;
    // Bouml preserved body end 0001FA02
  }
   /**
   * return self::$ROUTES[0];
   */
  public static function getController()
  {
    // Bouml preserved body begin 0001FA02

        return self::$ROUTES[0];
    // Bouml preserved body end 0001FA02
  }
   /**
   * return self::$ROUTES[2];
   */
  public static function getMethod()
  {
    // Bouml preserved body begin 0001FA02

        return self::$ROUTES[1];
    // Bouml preserved body end 0001FA02
  }
   /**
   * return self::$ROUTES[2];
   */
  public static function getAction()
  {
    // Bouml preserved body begin 0001FA02

        return self::$ROUTES[2];
    // Bouml preserved body end 0001FA02
  }

}
?>