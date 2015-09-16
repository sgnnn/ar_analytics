<?php

App::uses('AppController', 'Controller');

class EntrysController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "Entrys";

		$this->set("display",$this->display);
	}
}
