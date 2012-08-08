<?php
/**
 * 
 * User
 * Modelo de User
 * The table in the database is users
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class user extends ActiveRecord\Model {
	//  static $connection = 'development';
	// static $table_name = 'users';
	// static $connection = 'asterisk';	
    static $table_name = 'vicidial_users';      
} /* end of class ModeloProductos */
?>