<?php
/**
 * Modelo de onus_titular
 * La tabla en la base de datos es onus_titular
 * Es necesario especificar la tabla directamente para que esté en sigular      
 * http://www.phpactiverecord.org/boards/4/topics/741
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class onus_titular extends ActiveRecord\Model {
    // static $connection = 'development';
    static $table_name = 'onus_titular';        
} 
?>