<?php
/**
 * Modelo de vicidial_list
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
class vicidial_list extends ActiveRecord\Model {
    static $table_name = 'vicidial_list';        
} 
?>