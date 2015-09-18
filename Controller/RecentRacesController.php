<?php

App::uses('AppController', 'Controller');

class RecentRacesController extends AppController {

	public $uses = array("RSeries", "RRace");

	public function index() {
		$this->layout = "Normal";
		$this->display = "RecentRaces";

		if(isset($this->params['url']["gradeOnly"]))
			$gradeOnly = $this->params['url']["gradeOnly"];
		else
			$gradeOnly = false;

		$RSerieses = $this->RSeries->findRecentSeries("", $gradeOnly);

		$moreStart = "";
		if(count($RSerieses) > 0)
			$moreStart = $RSerieses[count($RSerieses)-1]["R_SERIES"]["SE_START_YMD"];

		$this->set("RSerieses", $RSerieses);
		$this->set("gradeOnly", $gradeOnly);
		$this->set("moreStart", $moreStart);
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

    public function findRacesMore() {
    	$this->autoRender = FALSE;
    	if($this->request->is('ajax')){
    		if(isset($this->params['url']["gradeOnly"]))
    			$gradeOnly = $this->params['url']["gradeOnly"];
    		else
    			$gradeOnly = false;

    		if(isset($this->params['url']["moreStart"]))
    			$moreStart = $this->params['url']["moreStart"];
    		else
    			$moreStart = "";

    		$RSerieses = $this->RSeries->findRecentSeries($moreStart, $gradeOnly);

    		$status = true;

    		return json_encode(compact('status', 'RSerieses', 'error'));
    	}
    }

}
