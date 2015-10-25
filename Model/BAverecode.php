<?php

class BAverecode extends AppModel {
	public $useTable = false;

	public function findAveTypeCd03($racerCode){
        $sql = "select * from B_AVERECODE where RR_CD = ? and AVE_TYPE_CD = '03'";
        $params = array($racerCode);
		$result = $this->query($sql, $params);

		if(count($result) > 0)
			return $result[0]["B_AVERECODE"];
		else
			return array();
    }

}