<?php

/**
 * Modelo de Productos
 * La tabla en la base de datos es productos
 * Si se quiere especificar la tabla directamente para que esté en sigular hay que colocar:
 * static $table_name = 'producto';      
 * http://www.phpactiverecord.org/boards/4/topics/741
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class producto extends ActiveRecord\Model {
    static $connection = 'development';    
} /* end of class ModeloProductos */

// class Person extends ActiveRecord\Model {
//   static $alias_attribute = array(
//     'alias_first_name' => 'first_name',
//     'alias_last_name' => 'last_name');
// }
//
// $person = Person::first();
// $person->alias_first_name = 'Tito';
// echo $person->alias_first_name;
?>

