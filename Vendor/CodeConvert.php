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

	public $runways = array(
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

	function convertRunwayName($runwayCode){
		return $this->runways[$runwayCode];
	}

	function convertRunwayCode($runwayName){
		switch($runwayName){
			case "良":
				return "1";
			case "風":
				return "2";
			case "斑":
				return "3";
			case "湿":
				return "4";
			default:
				return "1";
		}
	}
}
?>