<?php
class ControllerPage extends Controller {
	private $listePage = ['acceuil', 'login', 'forum', 'contact'];
	private $view;
	private $destination;
	private $action;

	public function __construct($get) {
        $this->setView($get);
        $this->setDestination($get);
    }

    // SETTER
    public function setDestination($get){
    	$this->destination = $get;
    }

    public function setAction($action){
    	$this->action = $action;
    }

    public function setView($get){
    	$this->view = $get;
    }

    //GETTER
    public function getDestination(){
    	return $this->destination;
    }

    public function getListePage(){
    	return $this->listePage;
    }

    public function getAction(){
    	return $this->action;
    }

    public function getView(){
    	return $this->view;
    }

	public function affichePage(){	
		$file = $this->getView().'.php';
		if(in_array($this->getDestination(), $this->getListePage()) && file_exists($file)){
			// ici je doit appeler le controlleur
			$page = ucfirst($this->getView());			
			parent::$page($page);			
			require VIEWS.DS.$this->vu;
			
			
		}		
	}

	public function affichePageAction($action){	

		if(in_array($this->getDestination(), $this->getListePage()) && file_exists($this->getView())){
				
			return parent::$this->getView().ucfirst($action);
		}		
	}
}