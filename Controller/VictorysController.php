<?php

App::uses('AppController', 'Controller');
App::uses('CodeConvert', 'Vendor');

class VictorysController extends AppController {

	public $uses = array("RSeries", "RRace", "RRacer");

	public function index() {
		$this->layout = "Normal";
		$this->display = "Victorys";

		$victorys = $this->findVictorys("", false);

		$this->set("victorys", $victorys);
		$this->set("display", $this->display);
	}

	function findVictorys($seCd, $grade){
		$codeConvert = new CodeConvert();

		$victorys = array();

		$RSerieses = $this->RSeries->findRangeSeries($seCd, $grade);

		foreach($RSerieses as $RSerieRow){
			$RSeries = $RSerieRow["R_SERIES"];
			$Races = $this->RRace->findRaceVictorys($RSeries["SE_CD"]);
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

}
