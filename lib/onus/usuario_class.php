<?php
/**
* Clase Usuario
* Para operar un usuario
*/
class usuario {
	var $row;
	var $detail;
	/**
	 * Regresa los registros encontrados por un nombre determinado
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	function getByName($name) {
		$datos =  user::find('all',array('conditions' => 
        		"nombre LIKE '%".$name."%'"));  
		return $datos;
	}
	
	function getById($id){		
		$params["conditions"] = array("onus_listas_users.onus_user_id  = ?" , @$id);     
 		$params["joins"] = "JOIN vicidial_lists ON `vicidial_lists`.`list_id` = `onus_listas_users`.`vicidial_list_id`";
 		$params["select"] = "onus_listas_users.*, vicidial_lists.*"; 		
 		$this->row = user::find($id);								// master row
       	$this->detail = onus_listas_users::all($params);			// detail
       	echo onus_listas_users::table()->last_sql;
		return $this; 		
	}
	/**
	 * Esta en sesion el usuario 
	 *
	 * @return unknown
	 */
    public function isOnSesion()
    {
        // section 10-25-2--51--73201f22:133a52aa412:-8000:0000000000001171 begin
    	 if (@$_SESSION['usuario']) {
    	 	return true;
    	 } else {
    	 	return false;
    	 }
        // section 10-25-2--51--73201f22:133a52aa412:-8000:0000000000001171 end
    }
    
    /**
     * Activa la sesión del usuario, retorna el objeto $_SESSION[usuario]
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function getSesion()
    {
        // section 10-25-2--51--73201f22:133a52aa412:-8000:0000000000001173 begin
        return $_SESSION['usuario'];        
        // section 10-25-2--51--73201f22:133a52aa412:-8000:0000000000001173 end
    }
	
	/**
	 * Devuelve todas los registros de usuarios
	 *
	 * @return unknown
	 */
	function getAllRows() {
		return user::find('all');
	}
	function setSession() {
		$_SESSION["usuario"] = $this;
	}
	function resetSession() {
		unset($_SESSION["usuario"]);
	}
}
?>