<?php
// first and foremost, start our sessions
// could be replaced by a config in the registry.php with a ini file
ob_start();   
session_start();
// Define all directory constants
define( 'DIRAPPS', 	ROOT . DS . 'app' . DS);					// Directory apps "DIRAPPS"  
define( 'DIRCTRLS', ROOT . DS . 'app' . DS . 'ctrls'. DS );		// Directory controller 'DIRCTRLS'
define( 'DIRVIEWS', ROOT . DS . 'app' . DS . 'views'. DS);		// Directory views 'DIRVIEWS'
define( 'DIRMODELS',ROOT . DS . 'app' . DS . 'models'. DS);		// Directory views 'DIRMODELS'
define( 'DIRCONF',	ROOT . DS . "app" . DS . "conf" . DS);		// Directory config 'DIRCONFIG'
define( 'DIRLIB',	ROOT . DS . "lib" . DS);					// Directory config 'DIRLIB'
define( 'DIRONUS',	DIRLIB . DS . "onus" . DS);					// Directory config 'DIRONUS'
// Basic require_once
require_once (DIRLIB . 'php-activerecord/ActiveRecord.php');
require_once (DIRAPPS . 'Registry.php');
require_once (DIRAPPS . 'router.php');
require_once (DIRAPPS . 'Auth.php');
$connections = Registry::get("connections"); 
define( 'THEME', ROOT . DS . 'app' . DS . 'views'. DS . Registry::get("themedefault"));
ActiveRecord\Config::initialize(function($cfg)use ($connections) {
	$cfg->set_model_directory(DIRMODELS); 
	$cfg->set_connections($connections);	
	$defacon = Registry::get("defaultconnection");
	$cfg->set_default_connection($defacon);
});
 //
//// Testing Active Record
//print_r(Book::first()->attributes());			// test connection
// print_r(Cd::first()->attributes());
//print_r(producto::first()->attributes());		// developing connection
// $datos =  producto::find('all',array('conditions' =>  "descripcion LIKE '%CH%'")); var_dump($datos);
// $datos = producto::all(array('conditions' => array('descripcion  = ?' , 'Chiltepineros')));  var_dump($datos); 
//
// $datos = users::first()->attributes();
// $datos =  users::find('all',array('conditions' => "nombre LIKE '%dany%'"));
// $datos =  users::all(array('conditions' => array('username = ? AND password = ?' , 'ivan','123')));
//var_dump($datos); exit();
 
// $options = array('limit' => 2);
// Book::all($options);

// $option = Book::all(array('select' => 'DISTINCT *', 'joins' => $join));

//# fetch all books joining their corresponding authors
//$join = 'LEFT JOIN authors a ON(books.author_id = a.author_id)';
//$book = Book::all(array('joins' => $join));
//# sql => SELECT `books`.* FROM `books`
//#      LEFT JOIN authors a ON(books.author_id = a.author_id)


// $datos = vicidial_list::first(); var_dump($datos); exit();

spl_autoload_register('miautoupload');
function miautoupload($name) {    
	// Autoload all controllers
    $includefile =  DIRCTRLS . $name.".php";
    if (file_exists($includefile))
    	require_once ($includefile);
    // Autoload all models
    $includefile2 =  DIRMODELS . $name.".php";
    if (file_exists($includefile2)) {
    	require_once ($includefile2);    	
    }
}
// Run the App in the URI controller
route::init();
?>