<?php

App::uses('AppController', 'Controller');

class RankingsController extends AppController {

	public $uses = array();

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

		$this->set("display",$this->display);
		$this->set("category", $category);
		$this->set("racerRank", $racerRank);
	}

	/****************************************************
     * Ajax用api
     ***************************************************/

}
