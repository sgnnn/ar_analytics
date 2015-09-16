<?php

App::uses('AppController', 'Controller');

class LoginsController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "Logins";

		$this->set("display",$this->display);
	}
}
