<?php
/**
 * Clase Auth(entication) 
 * Autentica por medio de Sesion
 */
class Auth {       
    /**
     * Realiza un logueo en sesion con los parametros de usuario y password.
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  user
     * @param  pass
     */
    static function login($userAuth, $pass)
    {
        if (!@$_SESSION['userRow']) {
        	$params["conditions"] = array('user = ? AND pass = ?' , $userAuth, $pass);
        	$params["joins"] = "JOIN `vicidial_user_groups` ON `vicidial_user_groups`.`user_group` = `vicidial_users`.`user_group`";
        	$params["select"] = "
        		vicidial_users.user,
        		vicidial_users.full_name,
        		vicidial_users.user_level, 
        		vicidial_user_groups.group_name,        		
        		vicidial_user_groups.allowed_campaigns
        		";
			$row =  user::all($params);
			// echo user::table()->last_sql; echo "<hr>";			
			//var_dump($row);
			if (!$row)
				 return;
			$row = $row[0]->attributes();			// attributes fields of the first register
			$row["rol"]=@$row["user_level"];		
	        // if (Registry::get("defaultconnection")=="asterisk") {
				// $row['nombre'] = $row['full_name'];			// Fix the schema to the view
			// }
			//var_dump($row);
			$campaigns_allowed = explode(" ", $row["allowed_campaigns"]);
			$wherecond = "";
			unset($params);
			// obtain list invloved in that user.
			foreach ($campaigns_allowed as $key => $value) {
				if (strlen($value)<2)
					continue;
				if (strlen($wherecond)>1)
					$wherecond .= " OR "; 
				$wherecond .= "`vicidial_lists`.`campaign_id` = '".trim($value)."'";							
			}						
			$params["select"] = "list_id";			
			$params["conditions"] = $wherecond; 
			$row_lists =  vicidial_lists::find('all',$params);
			// echo $sql2 = vicidial_lists::table()->last_sql; echo "<hr>";
			//var_dump($sql2);
			//$row_lists2 = vicidial_lists::find_by_sql($sql2);				
			//var_dump($row_lists); 			var_dump($row_lists2); 	 var_dump($wherecond);
			$wherecond="";
			$displaylistas="";
			foreach($row_lists as $key => $value) {				
				if (strlen($wherecond)>1) {
					$wherecond .= " OR ";
					$displaylistas.=",";
				}
				$displaylistas .=  trim($value->list_id);
				$wherecond.= "list_id = '".$value->list_id."'";
				$listas_asignadas[]=$value->list_id;				
			}
			// var_dump($wherecond);
			$row["listas_asignadas"]=@$listas_asignadas;
			$row["query_listas"]=$wherecond;
			$row["displaylistas"]=$displaylistas;
			unset($params);
//			$params["conditions"] = $wherecond;
//			$row_list =  vicidial_list::find('all',$params);
//			var_dump($row_list);
			// SELECT * FROM `vicidial_list` WHERE list_id = ? OR list_id = ?			
			$_SESSION['userRow'] = $row;						// Register the session			
        }    	     
    }
        
    /**
     * Retorna el campo del registro del usuario logueado @$_SESSION["userRow"][$field]
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    static public function getRow($field)
    {
        // section -64--88-0-100--b2dec8:13357253886:-8000:000000000000188C begin
		return (@$_SESSION["userRow"][$field]);
        // section -64--88-0-100--b2dec8:13357253886:-8000:000000000000188C end
    }
    //
    
    /**
     * Retorna true, si el usuario está logueado (en sesion), de lo contrario
     * false.
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    static public function isLogged()
    {
        if (@$_SESSION["userRow"] == null)
        	return false;
        else
        	return true;     
    }
     
    /**
     * Retorna verdadero si el rol 
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    static public function isRol($rol)
    {
        // section -64--88-0-100--b2dec8:13357253886:-8000:000000000000188C begin
        // if (@$_SESSION["userRow"]["user_level"] == $rol) {
        //var_dump(@$_SESSION["userRow"]); 
		if (@$_SESSION["userRow"]["rol"] == $rol) {			
        	return true;
        }
        else {
        	return false;
        }  
        // section -64--88-0-100--b2dec8:13357253886:-8000:000000000000188C end
    }
    
    /**
     * Realiza un fin de la sesion y redirecciona hacia
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    static public function logout()
    {
        // section -64--88-0-100--b2dec8:13357253886:-8000:000000000000181F begin
        $_SESSION["userRow"] = "";
        session_unset();     
        @session_destroy();
        header( 'Location: /' );			// go to index or somewhere logout custom else
		exit();        
        // section -64--88-0-100--b2dec8:13357253886:-8000:000000000000181F end
    }

}
?>
