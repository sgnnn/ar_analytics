<?php

class RRacedate extends AppModel {
	public $useTable = false;

	public function findToday(){
        $sql = "select * from R_RACEDATE where RCDT_CD = '01'";
		$result = $this->query($sql);

		if(count($result) > 0)
			return $result[0]["R_RACEDATE"]["RCDT_YMD"];
		else
			return "";
    }

    public function findCurrentFrom(){
    	$sql = "select * from R_RACEDATE where RCDT_CD = '03'";
    	$result = $this->query($sql);

    	if(count($result) > 0)
    		return $result[0]["R_RACEDATE"]["RCDT_YMD"];
    	else
    		return "";
    }

    public function findCurrentTo(){
    	$sql = "select * from R_RACEDATE where RCDT_CD = '04'";
    	$result = $this->query($sql);

    	if(count($result) > 0)
    		return $result[0]["R_RACEDATE"]["RCDT_YMD"];
    	else
    		return "";
    }
}