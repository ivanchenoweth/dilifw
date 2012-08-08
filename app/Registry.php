<?php
/**
 * Clase de Registry) ................
 */
class Registry {
  private $vars =   array();

  public function __set($index, $value)
  {
    // Bouml preserved body begin 0001F802
		$this->vars[$index] = $value;
    // Bouml preserved body end 0001F802
  }

  public function __get($index)
  {
    // Bouml preserved body begin 0001F882

		return $this->vars[$index];
    // Bouml preserved body end 0001F882
  }
  
  public static function render($template) {
  	require_once(THEME . DS . $template);
  }
  
  public static function getCartera($cartera) {
  	if ($cartera=="Telmex")
  		return "Telcel";
  	else
  		return $cartera;
  }
  
  public static function get_arr_sample_ini()
  {
    // Bouml preserved body begin 0001F902

		$ini_array = parse_ini_file(DIRCONF. "sample.ini");
		var_dump($ini_array);
		return $ini_array;
    // Bouml preserved body end 0001F902
  }
  
  public static function get_arr_config_ini()
  {
    // Bouml preserved body begin 0001F902

		$ini_array = parse_ini_file(DIRCONF. "config.ini");
		return $ini_array;
    // Bouml preserved body end 0001F902
  }
  
  public static function get($elem)
  {
    // Bouml preserved body begin 0001F902

		$ini_array = parse_ini_file(DIRCONF. "config.ini");
		return $ini_array[$elem];
    // Bouml preserved body end 0001F902
  }

}
?>
