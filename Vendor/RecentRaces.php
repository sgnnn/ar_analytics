<?php

class RecentRaces{
	function __construct(){

	}

	function period($seStartYmd, $seDays){
		$seEndYmd = date("Ymd", strtotime(sprintf("%s -%d day", $seStartYmd, $seDays)));

		return sprintf("%s 〜 %s（%d日間）",
								$this->convertDateString($seStartYmd), $this->convertDateString($seEndYmd), $seDays);
	}

	function convertDateString($dateString){
		if($dateString === ""){
			return "";
		}

		$m = ltrim(substr($dateString, 4, 2), "0");
		$d = ltrim(substr($dateString, 6, 2), "0");
		return $m . "月 " . $d. "日";
	}

}
?>