<?php

class LatestAcquisition{

	function __construct(){

	}

	function getHtml($url){
		require_once('simple_html_dom.php');
		return file_get_html($url);
	}

	function getLgname($lgcd){
		switch ($lgcd) {
			case '1':
				return "isesaki";
			case '2':
				return "kawaguchi";
			case '3':
				return "funabashi";
			case '4':
				return "hamamatsu";
			case '5':
				return "sanyou";
			case '6':
				return "iizuka";
		}

		return "";
	}

	function getRaceAndTryruns($lgCd, $date, $rcNum){
		$url = "http://autorace.jp/netstadium/Program/%s/%s-%s-%s_%s";

		$url = sprintf(
			$url,
			$this->{"getLgname"}($lgCd),
			substr($date, 0, 4),
			substr($date, 4, 2),
			substr($date, 6, 4),
			$rcNum
		);

		$html = $this->getHtml($url);

		if($html == null)
			return null;

		$raceTds = $html->find('td[class="updatedArea"]');

		if(count($raceTds) != 10)
			return null;

		$heat = str_replace("℃", "", $raceTds[8]->plaintext);

		$raceDatas = array(
			"runwayHeat" => mb_substr($heat, 0, mb_strpos($heat, ".")),
			"runway" => str_replace("走路", "", $raceTds[9]->plaintext)
		);

		$tryruns = array();
		$isBreak = false;
		foreach($html->find('tr[class="tr_sec"]') as $tr) {
			if($isBreak)
				break;

			$tds = $tr->find('td');

			if(count($tds) <= 0)
				continue;

			if($tds[0]->plaintext !== "試走T")
				continue;

			for($i=1; $i<count($tds); $i++){
				$tryrun = trim($tds[$i]->plaintext);
				if(!empty($tryrun))
					array_push($tryruns, $tryrun);
			}
			$isBreak = true;
		}

		return array(
			"raceDatas" => $raceDatas,
			"tryruns" => $tryruns
		);
	}

}
?>