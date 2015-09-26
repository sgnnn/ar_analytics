<?php

App::uses('AppController', 'Controller');
App::uses('LatestAcquisition', 'Vendor');
App::uses('CodeConvert', 'Vendor');
App::uses('Analytics', 'Vendor');

class AnalyticsController extends AppController {

	public $uses = array("RSeries", "RRace", "RRecode", "RRacedate", "RRacer", "LatestRace", "LatestTryrun", "LatestCalc");

	public $seCd;
	public $seDay;
	public $rcNum;
	public $exec = true;

	public function analytics() {
		$this->execShare("analytics");

		if(!$this->exec)
			return;

		$this->updateLatests();

		$today = $this->RRacedate->findToday();

		$conditions = array(
			"series_code" => $this->seCd,
			"series_day" => $this->seDay,
			"race_number" => $this->rcNum
		);

		$latestRace = $this->LatestRace->find('first', array("conditions" => $conditions));
		$latestTryruns = $this->LatestTryrun->find('all', array("conditions" => $conditions, "order" => array("recode_number")));

		$this->LatestCalc->deleteAll($conditions, false);

		$this->saveLatestCalc("tryrun", $latestRace, $latestTryruns, $today);
		$this->saveLatestCalc("heat", $latestRace, $latestTryruns, $today);
		$this->saveLatestCalc("recent", $latestRace, $latestTryruns, $today);
		$this->saveLatestAnalyticsCalc($latestRace, $latestTryruns, $today);

		$calcConditions = array(
			"series_code" => $this->seCd,
			"series_day" => $this->seDay,
			"race_number" => $this->rcNum,
			"calc_type" => 'analytics',
		);
		$orders = array("recode_number");
		$latestAnalyticsCalcs = $this->LatestCalc->find('all', array("conditions" => $calcConditions, "order" => $orders));

		$RRecodes = $this->RRecode->findOneRaceRecodesAndRacer($this->seCd, $this->seDay, $this->rcNum);

		$this->set("RRecodes", $RRecodes);
		$this->set("latestAnalyticsCalcs", $latestAnalyticsCalcs);
		$this->set("latestRace", $latestRace);
		$this->set("latestTryruns", $latestTryruns);
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

		if(!is_numeric($this->seDay))
			$this->exec = false;

		if(!is_numeric($this->rcNum))
			$this->exec = false;

		$RSeries = $this->RSeries->findFirstSeries($this->seCd);
		if(empty($RSeries))
			$this->exec = false;

		$RRace = $this->RRace->findFirstRace($this->seCd, $this->seDay, $this->rcNum);
		if(empty($RRace))
			$this->exec = false;

		$rcCount = $this->RRace->findRaceCount($this->seCd, $this->seDay);

		$this->set("seCd",  $this->seCd);
		$this->set("seDay",  $this->seDay);
		$this->set("rcNum",  $this->rcNum);
		$this->set("rcCount",  $rcCount);
		$this->set("RSeries",  $RSeries);
		$this->set("RRace",  $RRace);
	}

	function updateLatests(){
		$latestAcquisition = new LatestAcquisition();
		$codeConvert = new CodeConvert();

		$conditions = array(
			"series_code" => $this->seCd,
			"series_day" => $this->seDay,
			"race_number" => $this->rcNum
		);

		if($this->rcNum > 1){
			$nextConditions = array(
				"series_code" => $this->seCd,
				"series_day" => $this->seDay,
				"race_number" => $this->rcNum-1
			);
			$latestRace = $this->LatestRace->find('first', array("conditions" => $nextConditions));
			if($latestRace == null)
				return;

			if(!$latestRace["LatestRace"]["tryrun_end"])
				return;
		}

		$latestRace = $this->LatestRace->find('first', array("conditions" => $conditions));

		if($latestRace == null)
			$this->LatestRace->save(array(
				'series_code' => $this->seCd,
				'series_day' => $this->seDay,
				'race_number' => $this->rcNum
			));
		else
			if($latestRace["LatestRace"]["tryrun_end"])
				return;

		$today = $this->RRacedate->findToday();

		$datas = $latestAcquisition->getRaceAndTryruns(substr($this->seCd, 0, 1), $today, $this->rcNum);

		if($datas != null){
			if(isset($datas["tryruns"])){
				if(count($datas["tryruns"]) > 0){
					for($i=0; $i<count($datas["tryruns"]); $i++){
						$trurunConditions = array(
							"series_code" => $this->seCd,
							"series_day" => $this->seDay,
							"race_number" => $this->rcNum,
							'recode_number' => $i+1,
						);

						$latestTryrun = $this->LatestTryrun->find('first', array("conditions" => $trurunConditions));

						if($latestTryrun != null)
							continue;

						$RRecode = $this->RRecode->findFirstRecode($this->seCd, $this->seDay, $this->rcNum, $i+1);

						if(count($RRecode) <= 0)
							continue;

						$this->LatestTryrun->save(array(
							'series_code' => $this->seCd,
							'series_day' => $this->seDay,
							'race_number' => $this->rcNum,
							'recode_number' => $i+1,
							'racer_code' => $RRecode["RR_CD"],
							'tryrun_time' => $datas["tryruns"][$i],
							'participation' => empty($datas["tryruns"][$i]) ? false : true
						));
					}
				}
			}

			if(isset($datas["raceDatas"])){
				$count = $this->LatestTryrun->find('count', array("conditions" => $conditions));

				$data = array(
					"runway_code" => $codeConvert->convertRunwayCode($datas["raceDatas"]["runway"]),
					"runway_heat" => $datas["raceDatas"]["runwayHeat"],
					"tryrun_end" => $count > 0 ? true : false
				);
				$this->LatestRace->updateAll($data, $conditions);
			}
		}
	}

	function saveLatestCalc($calcType, $latestRace, $latestTryruns, $today){
		if(count($latestRace) <= 0)
			return;

		if(count($latestTryruns) <= 0)
			return;

		foreach($latestTryruns as $latestTryrunRow){
			$latestTryrun = $latestTryrunRow["LatestTryrun"];

			if(!$latestTryrun["participation"])
				continue;

			$RRecode = $this->RRecode->findFirstRecode($this->seCd, $this->seDay, $this->rcNum, $latestTryrun["recode_number"]);
			if($RRecode == null)
				continue;

			$calcConditions = array(
				"series_code" => $this->seCd,
				"series_day" => $this->seDay,
				"race_number" => $this->rcNum,
				"recode_number" => $latestTryrun["recode_number"],
				"calc_type" => $calcType
			);

			$count = $this->LatestCalc->find('count', array("conditions" => $calcConditions));

			if($count > 0)
				continue;

			if($calcType === "tryrun")
				$RRecodeCalc = $this->RRecode->findTryrunCalc($RRecode["RR_CD"], $latestTryrun["tryrun_time"], $today);
			elseif ($calcType === "heat")
				$RRecodeCalc = $this->RRecode->findHeatCalc($RRecode["RR_CD"], $latestTryrun["tryrun_time"], $latestRace["LatestRace"]["runway_heat"], $today);
			elseif ($calcType === "recent")
				$RRecodeCalc = $this->RRecode->findRecentCalc($RRecode["RR_CD"], $today);

			if($RRecodeCalc["recode_count"] <= 0)
				continue;

			$this->LatestCalc->save(array(
				"series_code" => $this->seCd,
				"series_day" => $this->seDay,
				"race_number" => $this->rcNum,
				"recode_number" => $latestTryrun["recode_number"],
				"calc_type" => $calcType,
				"recode_count" => $RRecodeCalc["recode_count"],
				"agari_time" => $RRecodeCalc["avg_agari_time"]
			));
		}
	}

	function saveLatestAnalyticsCalc($latestRace, $latestTryruns, $today){
		$analytics = new Analytics();

		if(count($latestRace) <= 0)
			return;

		if(count($latestTryruns) <= 0)
			return;

		foreach($latestTryruns as $latestTryrunRow){
			$latestTryrun = $latestTryrunRow["LatestTryrun"];

			$calcConditions = array(
					"series_code" => $this->seCd,
					"series_day" => $this->seDay,
					"race_number" => $this->rcNum,
					"recode_number" => $latestTryrun["recode_number"]
			);

			$latestCalcs = $this->LatestCalc->find('all', array("conditions" => $calcConditions));

			if(count($latestCalcs) <= 0)
				continue;

			$latestCalcHeat = null;
			$latestCalcTryrun = null;

			$isContinue = false;

			$RRace = $this->RRace->findFirstRace($this->seCd, $this->seDay, $this->rcNum);

			if(count($RRace) <= 0)
				continue;

			foreach($latestCalcs as $latestCalcRow){
				$latestCalc = $latestCalcRow["LatestCalc"];
				if($latestCalc["calc_type"] === 'heat' and $latestCalc["recode_count"] >= 3)
					$latestCalcHeat = $latestCalc;

				if($latestCalc["calc_type"] === 'tryrun')
					$latestCalcTryrun = $latestCalc;

				if($latestCalc["calc_type"] === 'analytics')
					$isContinue = true;
			}

			if($isContinue)
				continue;

			if($latestCalcTryrun == null)
				continue;

			$fields = array('round(avg(agari_time), 3) avg_agari_time');
			$groups = array("series_code", "series_day", "race_number", "recode_number");
			$agariConditions = array(
					"series_code" => $this->seCd,
					"series_day" => $this->seDay,
					"race_number" => $this->rcNum,
					"recode_number" => $latestTryrun["recode_number"],
					"recode_count >=" => '3'
			);

			$latestCalcAgariTime = $this->LatestCalc->find('first', array("fields" => $fields, "conditions" => $agariConditions, "group" => $groups));

			if(count($latestCalcAgariTime) <= 0)
				continue;

			$RRacer = $this->RRacer->findFirstRacer($latestTryrun["racer_code"]);

			if(count($RRacer) <= 0)
				continue;

			$supplementHandeType = 0;
			if($RRace["HANDE_TYPE_K"] === "1" or $RRace["HANDE_TYPE_K"] === "2"){
				$supplementHandeType = 0;
				$RRecodeHandeType = $this->RRecode->findHandeTypeRecode($latestTryrun["racer_code"], $RRace["HANDE_TYPE_K"], $today);
				//$this->log($RRecodeHandeType);
				//ハンデタイプでの補足を追加予定
			}

			//$supplementRank = $analytics->supplementRank($RRacer["RANK_NEW"]);
			$supplementHande = $analytics->supplementHande($RRace["HANDE_TYPE_K"], $latestTryrun["recode_number"]);

			$saveAgariTime = str_pad($latestCalcAgariTime[0]["avg_agari_time"]
								//+ $supplementRank
								+ $supplementHande
								+ $supplementHandeType
								, 5, 0);

			$this->LatestCalc->save(array(
				"series_code" => $this->seCd,
				"series_day" => $this->seDay,
				"race_number" => $this->rcNum,
				"recode_number" => $latestTryrun["recode_number"],
				"calc_type" => 'analytics',
				"recode_count" => '1',
				"agari_time" => $saveAgariTime
			));
		}
	}
}
