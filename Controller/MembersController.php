<?php

App::uses('AppController', 'Controller');

class MembersController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "Members";

		$this->set("display",$this->display);
	}
}
