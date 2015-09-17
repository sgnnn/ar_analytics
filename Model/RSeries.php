<?php

class RSeries extends AppModel {
    public $useTable = false;

	public function findFirstSeries($seCd){
        $sql = "select * from R_SERIES where SE_CD = ?";
        $params = array($seCd);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0]["R_SERIES"];
		else
			return array();
    }

	public function findRecentSeries($fromSeStartYmd, $gradeOnly){
		$toSeStartYmd = "";
		$whereGrade = "";

		if($gradeOnly)
			$whereGrade = " and SE_RANK_CD in ('2', '3', '4') ";

		if(empty($fromSeStartYmd)){
			$sql = "select min(SE_START_YMD) as TO_SE_START_YMD, max(SE_START_YMD) as FROM_SE_START_YMD from (select SE_START_YMD  from R_SERIES where END_DAYS > 0" . $whereGrade . " order by SE_START_YMD desc limit 20) T";
			$result = $this->query($sql);
		} else{
			$sql = "select min(SE_START_YMD) as TO_SE_START_YMD from (select SE_START_YMD  from R_SERIES where END_DAYS > 0 and SE_START_YMD < ?" . $whereGrade . "order by SE_START_YMD desc limit 20) T";
			$params = array($fromSeStartYmd);
			$result = $this->query($sql, $params);
		}

		if(count($result) > 0){
			$toSeStartYmd =$result[0][0]["TO_SE_START_YMD"];

			if(empty($fromSeStartYmd))
				$fromSeStartYmd =$result[0][0]["FROM_SE_START_YMD"];
		} else
			return array();


		$sql = "select * from R_SERIES where END_DAYS > 0 and SE_START_YMD between ? and ?" . $whereGrade . "order by SE_START_YMD desc";
		$params = array($toSeStartYmd, $fromSeStartYmd);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result;
		else
			return array();
    }


    public function findRangeSeries($fromSeStartYmd, $gradeOnly){
    	$toSeStartYmd = "";
    	$whereGrade = "";

    	if($gradeOnly)
			$whereGrade = " and SE_RANK_CD in ('2', '3', '4') ";

    	if(empty($fromSeStartYmd)){
    		$sql = "select min(SE_START_YMD) as TO_SE_START_YMD, max(SE_START_YMD) as FROM_SE_START_YMD from (select SE_START_YMD  from R_SERIES where SE_DAYS = END_DAYS" . $whereGrade . " order by SE_START_YMD desc limit 20) T";
    		$result = $this->query($sql);
    	} else{
    		$sql = "select min(SE_START_YMD) as TO_SE_START_YMD from (select SE_START_YMD  from R_SERIES where SE_DAYS = END_DAYS and SE_START_YMD < ?" . $whereGrade . "order by SE_START_YMD desc limit 20) T";
    		$params = array($fromSeStartYmd);
    		$result = $this->query($sql, $params);
    	}

    	if(count($result) > 0){
    		$toSeStartYmd =$result[0][0]["TO_SE_START_YMD"];

    		if(empty($fromSeStartYmd))
    			$fromSeStartYmd =$result[0][0]["FROM_SE_START_YMD"];
    	} else
			return array();


    	$sql = "select * from R_SERIES where SE_DAYS = END_DAYS and SE_START_YMD between ? and ?" . $whereGrade . "order by SE_START_YMD desc";
    	$params = array($toSeStartYmd, $fromSeStartYmd);
    	$result = $this->query($sql, $params);

    	if(count($result) > 0)
    		return $result;
    	else
    		return array();
    }

}