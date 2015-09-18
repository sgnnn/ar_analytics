<?php

App::uses('AppController', 'Controller');

class AnalyticsController extends AppController {

	public $uses = array("RRecode");

	public $seCd;
	public $seDay;
	public $rcNum;
	public $exec = true;

	public function analytics() {
		$this->execShare("analytics");

		if(!$this->exec)
			return;

		$RRecodes = $this->RRecode->findOneRaceRecodesAndRacer($this->seCd, $this->seDay, $this->rcNum);

	}

	public function information() {
		$this->execShare("information");

		if(!$this->exec)
			return;

		$RRecodes = $this->RRecode->findOneRaceRecodesAndRacer($this->seCd, $this->seDay, $this->rcNum);

		$this->set("RRecodes", $RRecodes);

	}

	public function recent() {
		$this->execShare("recent");

		if(!$this->exec)
			return;

	}

	public function current() {
		$this->execShare("current");

		if(!$this->exec)
			return;

	}

	public function holding() {
		$this->execShare("holding");

		if(!$this->exec)
			return;

	}

	public function season() {
		$this->execShare("season");

		if(!$this->exec)
			return;

	}

	public function before() {
		$this->execShare("before");

		if(!$this->exec)
			return;

	}

	public function grade() {
		$this->execShare("grade");

		if(!$this->exec)
			return;

	}

	function execShare($action){
		$this->layout = "Normal";
		$this->set("display", "Analytics");
		$this->set("action",  $action);

		$this->seCd = isset($this->params['url']["seCd"]) ? $this->params['url']["seCd"] : "";
		$this->seDay = isset($this->params['url']["seDay"]) ? $this->params['url']["seDay"] : "";
		$this->rcNum = isset($this->params['url']["rcNum"]) ? $this->params['url']["rcNum"] : "";

		if(empty($this->seCd) or empty($this->seDay) or empty($this->rcNum))
			$this->exec = false;
	}

}
