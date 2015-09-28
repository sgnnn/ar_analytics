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

	public $distances = array(
				"3100" => "3100M (6周)",
				"4100" => "4100M (8周)",
				"5100" => "5100M (10周)",
				"3600" => "3600M (7周)"
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

	function convertDistanceName($distance){
		return $this->distances[$distance];
	}

	function convertDateMdString($dateString){
		if(empty($dateString))
			return "";

		$month = ltrim(substr($dateString, 4, 2), "0");
		$day = ltrim(substr($dateString, 6, 2), "0");
		return $month . "月 " . $day . "日";
	}

}
?>