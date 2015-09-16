<?php

class RRace extends AppModel {
	public $useTable = false;

	public function findRaceCount($seCd, $seDay){
        $sql = "select count(1) as COUNT from R_RACE where SE_CD = ? and SE_DAY = ?";
        $params = array($seCd, $seDay);
		$result = $this->query($sql, $params);
        return $result[0][0]["COUNT"];
    }

	public function findFirstRace($seCd, $seDay, $rcNum){
        $sql = "select * from R_RACE where SE_CD = ? and SE_DAY = ? and RC_NUM = ?";
        $params = array($seCd, $seDay, $rcNum);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0]["R_RACE"];
		else
			return array();
    }

	public function findRacesAnd3rdRacers($seCd, $seDay){
		App::uses('RRacer','Model');
		$rRacer = new RRacer;

		$sql = "select * from R_RACE where SE_CD = ? and SE_DAY = ? order by RC_NUM";
        $params = array($seCd, $seDay);
		$RRaces = $this->query($sql, $params);

		if(count($RRaces) <= 0)
			return array();

		$results = array();

		foreach($RRaces as $RRacesRow){
			$RRace = $RRacesRow["R_RACE"];

			$rank1Waku = 0;
			$rank2Waku = 0;
			$rank3Waku = 0;

			for($i=1; $i<=8; $i++){
				$wakuNumRank = $RRace["WAKU_NUM" . $i . "_RANK"];
				switch($wakuNumRank){
					case 1:
						$rank1Waku = $i;
						$RRacer1 = $rRacer->findFirstRacer($RRace["WAKU_NUM" . $i . "_RR_CD"]);
						break;
					case 2:
						$rank2Waku = $i;
						$RRacer2 = $rRacer->findFirstRacer($RRace["WAKU_NUM" . $i . "_RR_CD"]);
						break;
					case 3:
						$rank3Waku = $i;
						$RRacer3 = $rRacer->findFirstRacer($RRace["WAKU_NUM" . $i . "_RR_CD"]);
						break;
				}
			}

			$result = array(
				"SE_CD" => $RRace["SE_CD"],
				"SE_DAY" => $RRace["SE_DAY"],
				"RC_NUM" => $RRace["RC_NUM"],
				"RUNWAY_K" => $RRace["RUNWAY_K"],
				"RUNWAY_HEAT" => $RRace["RUNWAY_HEAT"],
				"FAILURE_K" => $RRace["FAILURE_K"],
				"MANKEN_K" => $RRace["MANKEN_K"],
				"RANK1_WAKU_NUM" => $rank1Waku,
				"RANK1_RR_NM" => $RRacer1["RR_NM"],
				"RANK2_WAKU_NUM" => $rank2Waku,
				"RANK2_RR_NM" => $RRacer2["RR_NM"],
				"RANK3_WAKU_NUM" => $rank3Waku,
				"RANK3_RR_NM" => $RRacer3["RR_NM"]
			);

			array_push($results, $result);
		}

		return $results;
    }

    public function findRaceVictorys($seCd){
    	$sql = "select * from R_RACE where SE_CD = ? and RC_TYPE_K = '08' order by SE_DAY desc, RC_NUM desc";
    	$params = array($seCd);
    	$result = $this->query($sql, $params);

    	if(count($result) > 0)
    		return $result;
    	else
    		return array();
    }

}