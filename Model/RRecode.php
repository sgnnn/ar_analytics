<?php

class RRecode extends AppModel {
	public $useTable = false;

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

}