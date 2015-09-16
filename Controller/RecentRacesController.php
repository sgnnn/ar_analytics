<?php

App::uses('AppController', 'Controller');

class RecentRacesController extends AppController {

	public $uses = array("RSeries", "RRace");

	public function index() {
		$this->layout = "Normal";
		$this->display = "RecentRaces";

		$RSerieses = $this->RSeries->findRecentSeries();

		$this->set("RSerieses", $RSerieses);

		$this->set("display",$this->display);
	}

	/****************************************************
     * Ajax用api
     ***************************************************/
	public function findRacesAnd3rdRacers() {
		$this->autoRender = FALSE;
        if($this->request->is('ajax')) {
			$RRaces = $this->RRace->findRacesAnd3rdRacers(
            										$this->params['url']["seCd"],
            										$this->params['url']["seDay"]
            									);

            $status = !empty($RRaces);
	        if(!$status) {
	      		$error = array(
	        		'message' => 'データがありません（R_RACE）',
	        		'code' => 404
	      		);
    		}

            return json_encode(compact('status', 'RRaces', 'error'));
        }
    }

}
