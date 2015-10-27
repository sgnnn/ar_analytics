<?php

App::uses('AppController', 'Controller');

class RankingsController extends AppController {

	public $uses = array("RRecode");

	public function index() {
		$this->layout = "Normal";
		$this->display = "Rankings";

		if(isset($this->params['url']["category"]))
			$category = $this->params['url']["category"];
		else
			$category = "count";

		if(isset($this->params['url']["racerRank"]))
			$racerRank = $this->params['url']["racerRank"];
		else
			$racerRank = "all";

		if(isset($this->params['url']["period"]))
			$period = $this->params['url']["period"];
		else
			$period = "season";

		parent::authCheck();

		$rankings = $this->findRankings($category, $racerRank, $period);

		$this->set("display",$this->display);
		$this->set("category", $category);
		$this->set("racerRank", $racerRank);
		$this->set("period", $period);
		$this->set("rankings", $rankings);
	}

	private function findRankings($category, $racerRank, $period){
		return $this->RRecode->findRankings($category, $racerRank, $period);
	}

	/****************************************************
     * Ajax用api
     ***************************************************/

}
