<?php

class RRacer extends AppModel {
    public $useTable = false;

	public function findFirstRacer($rrCd){
        $sql = "select * from R_RACER where RR_CD = ?";
        $params = array($rrCd);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0]["R_RACER"];
		else
			return array();
    }

}