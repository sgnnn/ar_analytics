<?php

App::uses('AppController', 'Controller');
App::uses('CodeConvert', 'Vendor');

class VictorysController extends AppController {

	public $uses = array("RSeries", "RRace", "RRacer");

	public function index() {
		$this->layout = "Normal";
		$this->display = "Victorys";

		if(isset($this->params['url']["gradeOnly"]))
			$gradeOnly = $this->params['url']["gradeOnly"];
		else
			$gradeOnly = false;

		$victorys = $this->findVictorys("", $gradeOnly);

		$moreStart = "";
		if(count($victorys) > 0)
			$moreStart = $victorys[count($victorys)-1]["seStartYmd"];

		$this->set("victorys", $victorys);
		$this->set("gradeOnly", $gradeOnly);
		$this->set("moreStart", $moreStart);
		$this->set("display", $this->display);
	}

	function findVictorys($fromSeStartYmd, $gradeOnly){
		$codeConvert = new CodeConvert();

		$victorys = array();

		$RSerieses = $this->RSeries->findRangeSeries($fromSeStartYmd, $gradeOnly);

		foreach($RSerieses as $RSerieRow){
			$RSeries = $RSerieRow["R_SERIES"];
			$Races = $this->RRace->findRaceVictorys($RSeries["SE_CD"]);
$this->log($RSeries);
			foreach($Races as $RaceRow){
				$Race = $RaceRow["R_RACE"];

				for($i=1; $i<=8; $i++)
					if($Race["WAKU_NUM" . $i . "_RANK"] == 1)
						$Racer = $this->RRacer->findFirstRacer($Race["WAKU_NUM" . $i . "_RR_CD"]);

				if(!empty($Race) and !empty($Racer)){
					$victory = array(
						"seCd" => $RSeries["SE_CD"],
						"lgCd" => $RSeries["LG_CD"],
						"lgName" => $codeConvert->convertLgName($RSeries["LG_CD"]),
						"seRankCd" => $RSeries["SE_RANK_CD"],
						"seRankName" => $codeConvert->convertSeRankName($RSeries["SE_RANK_CD"]),
						"seTitle" => $RSeries["SE_TITLE"],
						"nightK" => $RSeries["NIGHT_K"],
						"seStartYmd" => $RSeries["SE_START_YMD"],
						"seDay" => $Race["SE_DAY"],
						"rcTypeName" => $Race["RC_TYPE_NM"],
						"distance" => $Race["DISTANCE"],
						"runwayName" => $codeConvert->convertRunwayName($Race["RUNWAY_K"]),
						"runwayHeat" => $Race["RUNWAY_HEAT"],
						"racerName" => $Racer["RR_NM"],
						"racerLgCd" => $Racer["LG_CD"],
						"racerLgName" => $codeConvert->convertLgName($Racer["LG_CD"]),
						"ki" => $Racer["KI"],
						"rankNew" => $Racer["RANK_NEW"]
					);

					array_push($victorys, $victory);
				}
			}
		}

		return $victorys;
	}

	/****************************************************
	 * Ajax用api
	***************************************************/
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

			$victorys = $this->findVictorys($moreStart, $gradeOnly);

			$status = true;

			return json_encode(compact('status', 'victorys', 'error'));
		}
	}

}
