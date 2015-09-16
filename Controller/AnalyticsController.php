<?php

App::uses('AppController', 'Controller');

class AnalyticsController extends AppController {

	public $uses = array();

	public function analytics() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "analytics";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function information() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "information";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function recent() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "recent";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function current() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "current";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function holding() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "holding";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function season() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "season";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function before() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "before";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function grade() {
		$this->layout = "Normal";
		$this->display = "Analytics";
		$this->action = "grade";

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

}
