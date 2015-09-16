<?php

App::uses('AppController', 'Controller');

class HomesController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "Homes";

		$this->set("display",$this->display);
	}
}
