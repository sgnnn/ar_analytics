<?php

App::uses('AppController', 'Controller');

class AnalyticsHomesController extends AppController {

	public $uses = array();

	public function index() {
		$this->layout = "Normal";
		$this->display = "AnalyticsHomes";

		$this->set("display",$this->display);
	}
}
