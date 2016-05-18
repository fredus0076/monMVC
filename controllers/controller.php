<?php
class Controller{
	protected $model;
	protected $vu;

	public function Acceuil($arg){
		$this->vu = strtolower($arg).'.php';
	}
}