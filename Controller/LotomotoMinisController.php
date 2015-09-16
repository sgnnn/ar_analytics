<?php

App::uses('AppController', 'Controller');

class LotomotoMinisController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "LotomotoMinis";

		$this->set("display",$this->display);
	}
}
