<?php

App::uses('AppController', 'Controller');
App::uses('LatestAcquisition', 'Vendor');
App::uses('CodeConvert', 'Vendor');

class AnalyticsController extends AppController {

	public $uses = array("RRace", "RRecode", "RRacedate", "LatestRace", "LatestTryrun");

	public $seCd;
	public $seDay;
	public $rcNum;
	public $exec = true;

	public function analytics() {
		$this->execShare("analytics");

		if(!$this->exec)
			return;

		$this->updateLatests();

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

		if(!is_numeric($this->seDay))
			$this->exec = false;

		if(!is_numeric($this->rcNum))
			$this->exec = false;

		$RRace = $this->RRace->findFirstRace($this->seCd, $this->seDay, $this->rcNum);
		if($RRace == null)
			$this->exec = false;

		$this->set("seCd",  $this->seCd);
		$this->set("seDay",  $this->seDay);
		$this->set("rcNum",  $this->rcNum);
	}

	function updateLatests(){
		$latestAcquisition = new LatestAcquisition();
		$codeConvert = new CodeConvert();

		$conditions = array(
			"series_code" => $this->seCd,
			"series_day" => $this->seDay,
			"race_number" => $this->rcNum
		);

		if($this->rcNum >= 1){
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

						$this->LatestTryrun->save(array(
							'series_code' => $this->seCd,
							'series_day' => $this->seDay,
							'race_number' => $this->rcNum,
							'recode_number' => $i+1,
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
}
