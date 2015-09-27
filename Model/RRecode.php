<?php

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