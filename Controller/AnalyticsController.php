<?php

App::uses('AppController', 'Controller');

class AnalyticsController extends AppController {

	public $uses = array();

	public function analytics() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function information() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function recent() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function current() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function holding() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function season() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function before() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

	public function grade() {
		$this->layout = "Normal";
		$this->display = "Analytics";

		$this->set("display",$this->display);
	}

}
