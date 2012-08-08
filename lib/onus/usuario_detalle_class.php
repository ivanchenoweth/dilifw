<?php
/**
* Clase Detalle del Usuario
* Para operar un usuario
*/
class usuario_detalle {
	/**
	 * Regresa los registros encontrados por un nombre determinado
	 *
	 * @param unknown_type $name
	 * @return unknown
	 */
	function getByName($name) {
		$datos =  onus_listas_users::find('all',array('conditions' => 
        		"nombre LIKE '%".$name."%'"));  
		return $datos;
	}
}
?>