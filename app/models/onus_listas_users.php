<?php
/**
 * Modelo de onus_listas_users
 * La tabla en la base de datos es vicidial_list
 * Es necesario especificar la tabla directamente para que esté en sigular hay que colocar:
 * static $table_name = 'vicidial_list';      
 * http://www.phpactiverecord.org/boards/4/topics/741
 * 
 * @access public
 * @author Ivan R. Chenoweth
 * @param  
 * @return mixed
 */
class onus_listas_users extends ActiveRecord\Model {
    static $table_name = 'onus_listas_users';        
} 
?>