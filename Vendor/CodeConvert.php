<?php

class CodeConvert{
	public $lgs = array(
			"1" => "伊勢崎",
			"2" => "川口",
			"3" => "船橋",
			"4" => "浜松",
			"5" => "山陽",
			"6" => "飯塚"
		);

	public $seRanks = array(
				"1" => "普通",
				"2" => "GⅡ",
				"3" => "GⅠ",
				"4" => "SG",
				"5" => "普通"
			);

	public $runwayK = array(
				"1" => "良",
				"2" => "風",
				"3" => "斑",
				"4" => "湿"
			);

	function __construct(){

	}

	function convertLgName($lgCd){
		return $this->lgs[$lgCd];
	}

	function convertSeRankName($seRankCd){
		return $this->seRanks[$seRankCd];
	}

	function convertRunwayName($runwayK){
		return $this->runwayK[$runwayK];
	}

}
?>