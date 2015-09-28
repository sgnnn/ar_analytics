<?php

class Analytics{

	function __construct(){

	}

	public function calcRate($recodeCount, $winCount){
		if($recodeCount <= 0)
			return 0;

		if($winCount <= 0)
			return 0;

		return round($winCount / $recodeCount * 100, 1);
	}

	public function supplementRank($rank){
		$rankCategory = substr($rank, 0, 1);
		$rankNumber = substr($rank, 1);

		if($rankCategory === 'S'){
			if($rankNumber <= 10)
				return -0.005;

			if($rankNumber > 10 and $rankNumber <= 30)
				return -0.003;

			return -0.002;

		} elseif($rankCategory === 'A'){
			if($rankNumber <= 10)
				return -0.002;

			if($rankNumber > 10 and $rankNumber <= 50)
				return -0.001;

			if($rankNumber > 50 and $rankNumber <= 150)
				return 0;

			return 0.001;

		} elseif($rankCategory === 'B'){
			if($rankNumber <= 10)
				return 0.001;

			if($rankNumber > 10 and $rankNumber <= 100)
				return 0.003;

			return 0.005;
		}

		return 0;
	}

	public function supplementHande($handeType, $recodeNumber){
		if($handeType === '1'){
			if(	$recodeNumber == 2 or
				$recodeNumber == 3 or
				$recodeNumber == 4){
					return -0.003;
				}

			if(	$recodeNumber == 1 or
				$recodeNumber == 5 or
				$recodeNumber == 6){
					return -0.001;
				}

			return 0.001;
		} elseif($handeType === '2'){
			if(	$recodeNumber == 1 or
				$recodeNumber == 2){
					return -0.003;
				}

			if(	$recodeNumber == 3 or
				$recodeNumber == 4){
					return -0.002;
				}

			if(	$recodeNumber == 5 or
				$recodeNumber == 6){
					return 0;
				}

			return 0.003;
		}

		return 0;
	}
}
?>