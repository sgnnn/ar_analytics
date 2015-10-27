<?php

App::import('Model','RRacedate');

class RRecode extends AppModel {
	public $useTable = false;

	public function findFirstRecode($seCd, $seDay, $rcNum, $wakuNum){
        $sql = "select * from R_RECODE where SE_CD = ? and SE_DAY = ? and RC_NUM = ? and WAKU_NUM = ?";
        $params = array($seCd, $seDay, $rcNum, $wakuNum);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0]["R_RECODE"];
		else
			return array();
    }

	public function findOneRaceRecodes($seCd, $seDay, $rcNum){
        $sql = "select * from R_RECODE where SE_CD = ? and SE_DAY = ? and RC_NUM = ? order by WAKU_NUM";
        $params = array($seCd, $seDay, $rcNum);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result;
		else
			return array();
    }

	public function findOneRaceRecodesAndRacer($seCd, $seDay, $rcNum){
        $sql = "select R_RECODE.*, R_RACER.* ";
        $sql = $sql . "from R_RECODE, R_RACER ";
        $sql = $sql . "where R_RECODE.SE_CD = ? and R_RECODE.SE_DAY = ? and R_RECODE.RC_NUM = ? ";
        $sql = $sql . "and R_RECODE.RR_CD = R_RACER.RR_CD ";
        $sql = $sql . "order by R_RECODE.WAKU_NUM";
        $params = array($seCd, $seDay, $rcNum);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result;
		else
			return array();
    }

    public function findTryrunCalc($rrCd, $TryrunTime, $date){
    	$sql = "select round(avg(R_RECODE.AGARI_TIME), 3) avg_agari_time, count(1) as recode_count ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and R_RECODE.SISOU_TIME >= ? ";
    	$sql = $sql. "and R_RECODE.SISOU_TIME <= ? ";
    	$sql = $sql. "and R_RECODE.NO_RECODE_K = '0' ";
    	$sql = $sql. "and R_RECODE.RUNWAY_K in ('1', '2') ";
    	$sql = $sql. "and R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and R_RACE.RCDT_YMD >= date_format(DATE_SUB(?,INTERVAL 6 MONTH),'%Y%m%d')";

    	$params = array(
    						$rrCd,
    						str_pad($TryrunTime - 0.01, 4, "0"),
    						str_pad($TryrunTime + 0.01, 4, "0"),
    						$date
    					);

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0][0];
		else
			return array();
    }

    public function findHeatCalc($rrCd, $TryrunTime, $heat, $date){
    	$heatClac = $this->findHeatCalcPeriod($rrCd, $TryrunTime, $heat, $date, 5);

		if(count($heatClac) > 0)
			return $heatClac[0][0];
		else
			return array();
    }

    public function findRecentCalc($rrCd, $date){
    	$sql = "select round(avg(AGARI_TIME), 3) avg_agari_time, count(1) as recode_count ";
    	$sql = $sql. "from ( ";
    	$sql = $sql. "select R_RECODE.AGARI_TIME ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and R_RECODE.NO_RECODE_K = '0' ";
    	$sql = $sql. "and R_RECODE.RUNWAY_K in ('1', '2') ";
    	$sql = $sql. "and R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and R_RACE.RCDT_YMD >= date_format(DATE_SUB(?,INTERVAL 6 MONTH),'%Y%m%d')";
    	$sql = $sql. "order by R_RACE.RCDT_YMD desc limit 5) A";

    	$params = array(
    						$rrCd,
    						$date
    					);

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0][0];
		else
			return array();
    }

    public function findHandeTypeRecode($rrCd, $handeType, $date){
    	$sql = "select ";
    	$sql = $sql. "  count(1) as recode_count ";
    	$sql = $sql. ", sum(if(R_RECODE.RC_RANK = 1, 1, 0)) as rank1_count ";
    	$sql = $sql. ", sum(if(R_RECODE.RC_RANK = 2, 1, 0)) as rank2_count ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and R_RACE.HANDE_TYPE_K = ? ";
    	$sql = $sql. "and R_RECODE.NO_RECODE_K = '0' ";
    	$sql = $sql. "and R_RECODE.RUNWAY_K in ('1', '2') ";
    	$sql = $sql. "and R_RACE.RCDT_YMD >= date_format(DATE_SUB(?,INTERVAL 6 MONTH),'%Y%m%d')";

    	$params = array(
    						$rrCd,
    						$handeType,
    						$date
    					);

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0][0];
		else
			return array();
    }

    public function findRecentSeriesCode($seriesCode, $rrCd){
    	$sql = "select R_RECODE.SE_CD ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and   R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and   R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and   R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and   R_RECODE.SE_CD <> ? ";
    	$sql = $sql. "order by R_RACE.RCDT_YMD desc limit 1";

    	$params = array(
    						$rrCd,
    						$seriesCode
    					);

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0]["R_RECODE"];
		else
			return array();
    }

    public function findRecentRecodes($seriesCode, $rrCd){
    	$sql = "select R_RECODE.*, R_RACE.* ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and   R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and   R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and   R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and   R_RECODE.SE_CD = ? ";
    	$sql = $sql. "and   R_RACE.RESULT_K = '1' ";
    	$sql = $sql. "order by R_RACE.RCDT_YMD desc";

    	$params = array(
    						$rrCd,
    						$seriesCode
    					);

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result;
		else
			return array();
    }

    public function findWinCount($racerCode, $seasonYear, $runway){
    	$sql = "select ";
    	$sql = $sql. "  count(1) as recode_count ";
    	$sql = $sql. ", sum(if(R_RECODE.RC_RANK = 1,  1, 0)) as rank1_count ";
    	$sql = $sql. ", sum(if(R_RECODE.RC_RANK <= 2, 1, 0)) as rank2_count ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and   R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and   R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and   R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and   R_RACE.RCDT_YMD like ? ";

    	if($runway === "normal")
    		$sql = $sql. "and   R_RACE.RUNWAY_K in ('1', '2') ";
    	elseif ($runway === "wet")
    		$sql = $sql. "and   R_RACE.RUNWAY_K = '4' ";

    	$params = array(
    						$racerCode,
    						$seasonYear . "%"
    					);

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0][0];
		else
			return array();
    }

    public function findCurrentWinCount($racerCode, $currentFrom, $currentTo, $runway){
    	$sql = "select ";
    	$sql = $sql. "  count(1) as recode_count ";
    	$sql = $sql. ", sum(if(R_RECODE.RC_RANK = 1,  1, 0)) as rank1_count ";
    	$sql = $sql. ", sum(if(R_RECODE.RC_RANK <= 2, 1, 0)) as rank2_count ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and   R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and   R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and   R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and   R_RACE.RCDT_YMD between ? and ? ";

    	if($runway === "normal")
    		$sql = $sql. "and   R_RACE.RUNWAY_K in ('1', '2') ";
    	elseif ($runway === "wet")
    	$sql = $sql. "and   R_RACE.RUNWAY_K = '4' ";

    	$params = array(
    			$racerCode,
    			$currentFrom,
    			$currentTo
    	);

    	$result = $this->query($sql, $params);

    	if(count($result) > 0)
    		return $result[0][0];
    	else
    		return array();
    }

    public function findRankings($category, $racerRank, $period){
    	$rRacedate = new RRacedate;

    	$params = array();

    	$sql  = "select * from (";
		$sql .= "select ";
		$sql .= "  racer.* ";
		$sql .= " ,count(1) as race_count ";
		$sql .= " ,sum(if(recode.RC_RANK = 1, 1, 0)) as win_count ";
		$sql .= " ,round(sum(if(recode.RC_RANK = 1, 1, 0)) / count(1) * 100, 1) as win_rate ";
		$sql .= " ,sum(if(race.RC_TYPE_K = '08', if(recode.RC_RANK = 1, 1, 0), 0)) as victory_count ";
		$sql .= "from  R_RECODE recode, R_RACE race, R_RACER racer ";
		$sql .= "where recode.SE_CD = race.SE_CD ";
		$sql .= "and   recode.SE_DAY = race.SE_DAY ";
		$sql .= "and   recode.RC_NUM = race.RC_NUM ";
		$sql .= "and   recode.RR_CD = racer.RR_CD ";
		$sql .= "and   racer.RETREAT_K = '0' ";
		$sql .= "and   race.FAILURE_K = '0' ";

		if($racerRank === 's')
			$sql .= "and racer.RANK_NEW like 'S%' ";
		elseif ($racerRank === 'a')
			$sql .= "and racer.RANK_NEW like 'A%' ";
		elseif ($racerRank === 'b')
			$sql .= "and racer.RANK_NEW like 'B%' ";

		if($period === 'season'){
			$sql .= "and race.RCDT_YMD >= ? and race.RCDT_YMD <= ? ";
			array_push($params, date('Y') . '0101');
			array_push($params, date('Y') . '1231');
		} elseif ($period === 'current'){
			$sql .= "and race.RCDT_YMD >= ? and race.RCDT_YMD <= ? ";
			array_push($params, $rRacedate->findCurrentFrom());
			array_push($params, $rRacedate->findCurrentTo());
		} elseif ($period === 'before'){
			$sql .= "and race.RCDT_YMD >= ? and race.RCDT_YMD <= ? ";
			array_push($params, $rRacedate->findBeforeFrom());
			array_push($params, $rRacedate->findBeforeTo());
		}

		$sql .= "group by recode.RR_CD";
		$sql .= ") Ranking ";

		if($category === 'count'){
			$sql .= "where win_count > 0 ";
			$sql .= "order by win_count desc ";
		} elseif ($category === 'rate'){
			$sql .= "where win_rate > 0 ";
			$sql .= "order by win_rate desc ";
		} elseif ($category === 'victory'){
			$sql .= "where victory_count > 0 ";
			$sql .= "order by victory_count desc ";
		}

		$sql .= "limit 30";

		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result;
		else
			return array();
    }

    function findHeatCalcPeriod($rrCd, $TryrunTime, $heat, $date, $heatPeriod){
    	$sql = "select round(avg(R_RECODE.AGARI_TIME), 3) avg_agari_time, count(1) as recode_count ";
    	$sql = $sql. "from R_RECODE, R_RACE ";
    	$sql = $sql. "where R_RECODE.RR_CD = ? ";
    	$sql = $sql. "and R_RECODE.SISOU_TIME >= ? ";
    	$sql = $sql. "and R_RECODE.SISOU_TIME <= ? ";
    	$sql = $sql. "and R_RECODE.NO_RECODE_K = '0' ";
    	$sql = $sql. "and R_RECODE.RUNWAY_K in ('1', '2') ";
    	$sql = $sql. "and R_RECODE.SE_CD = R_RACE.SE_CD ";
    	$sql = $sql. "and R_RECODE.SE_DAY = R_RACE.SE_DAY ";
    	$sql = $sql. "and R_RECODE.RC_NUM = R_RACE.RC_NUM ";
    	$sql = $sql. "and R_RACE.RUNWAY_HEAT >= ? ";
    	$sql = $sql. "and R_RACE.RUNWAY_HEAT <= ? ";
    	$sql = $sql. "and R_RACE.RCDT_YMD >= date_format(DATE_SUB(?,INTERVAL 6 MONTH),'%Y%m%d')";

    	$params = array(
    						$rrCd,
    						str_pad($TryrunTime - 0.02, 4, "0"),
    						str_pad($TryrunTime + 0.02, 4, "0"),
    						$heat - $heatPeriod,
    						$heat + $heatPeriod,
    						$date
    					);

		return $this->query($sql, $params);
    }

}