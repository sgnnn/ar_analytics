<?php

App::uses('AppController', 'Controller');

class TodaysController extends AppController {

	public $uses = array("RRacedate", "BNextday", "RSeries", "RRace", "RRecode");

	public function index() {
		$this->layout = "Normal";
		$this->display = "Todays";

		$selectLgs = array("0", "0", "0", "0", "0", "0");
		$seCds = array("", "", "", "", "", "");

		$today = $this->RRacedate->findToday();

		$BNextdays = $this->BNextday->findAll();

		foreach($BNextdays as $BNextday){
			$selectLgs[$BNextday["B_NEXTDAY"]["LG_CD"] -1] = $BNextday["B_NEXTDAY"]["LG_CD"];
			$seCds[$BNextday["B_NEXTDAY"]["LG_CD"] -1] = $BNextday["B_NEXTDAY"]["SE_CD"];
		}

		$this->set("today", $today);
		$this->set("lgs", array("伊勢崎","川口","船橋","浜松","山陽","飯塚"));
		$this->set("selectLgs", $selectLgs);
		$this->set("seCds", $seCds);
		$this->set("seCount", count($BNextdays));

		$this->set("display", $this->display);
	}

	/****************************************************
     * Ajax用api
     ***************************************************/
	public function selectSeries() {
		$this->autoRender = FALSE;
        if($this->request->is('ajax')) {
        	$RSeries = $this->RSeries->findFirstSeries($this->params['url']["seCd"]);

            $rcCount = 0;
            $status = !empty($RSeries);
	        if(!$status) {
	      		$error = array(
	        		'message' => 'データがありません（R_SERIES）',
	        		'code' => 404
	      		);
    		} else{
    			$rcCount = $this->RRace->findRaceCount($this->params['url']["seCd"], $RSeries["END_DAYS"]+1);
    		}

            return json_encode(compact('status', 'RSeries', 'rcCount', 'error'));
        }
    }

	public function selectRaceAndRecodes() {
		$this->autoRender = FALSE;
        if($this->request->is('ajax')) {
            $RRace = $this->RRace->findFirstRace(
            										$this->params['url']["seCd"],
            										$this->params['url']["seDay"],
            										$this->params['url']["rcNum"]
            									);

			$RRecodes = $this->RRecode->findOneRaceRecodesAndRacer(
            										$this->params['url']["seCd"],
            										$this->params['url']["seDay"],
            										$this->params['url']["rcNum"]
            									);

            $status = !empty($RRace) and !empty($RRecodes);
	        if(!$status) {
	      		$error = array(
	        		'message' => 'データがありません（R_RACE）',
	        		'code' => 404
	      		);
    		}

            return json_encode(compact('status', 'RRace', 'RRecodes', 'error'));
        }
    }

}
