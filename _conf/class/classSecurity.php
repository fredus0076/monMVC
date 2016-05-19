<?php

class Security {
	public function chargerClasse ($classname) {
	    require CLASSDIR.DS.'class'.$classname.'.php';
	}

	public function load($arg){
	    require_once CONTROLLERS.DS.$arg.'.php';
	    require_once MODELS.DS.$arg.'.php';
	    require_once VIEWS.DS.$arg.'.php';
	}

}



?>