<?php

class Security {
	

	public function load($arg){
		$file = $arg.'.php';
		if(file_exists($file)){
			require_once CONTROLLERS.DS.$arg.'.php';
		}else{
			echo 'Error 404';
			//require_once CONTROLLERS.DS.$arg.'.php';
		}
	    
	}

	public function get($tab){
		foreach ($tab as $key => $value) {
		    $tab[$key]=htmlentities($value, ENT_QUOTES);
		}
	}

	public function post($tab){
		foreach ($tab as $key => $value) {
		    $tab[$key]=htmlentities($value, ENT_QUOTES);
		}
	}

	public function session($session){
		foreach ($session as $key => $value) {
		    $session[$key]=htmlentities($value, ENT_QUOTES);
		}
	}

}



?>