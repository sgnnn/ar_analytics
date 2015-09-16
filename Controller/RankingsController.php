<?php

App::uses('AppController', 'Controller');

class RankingsController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "Rankings";

		$this->set("display",$this->display);
	}

	/****************************************************
     * Ajax用api
     ***************************************************/

}
