<?php include('analytics_header.php'); ?>

<div class="analytics_recodes">
<?php
	foreach($RRecodes as $RRecodeRow){
		$RRecode = $RRecodeRow["R_RECODE"];
		$RRacer = $RRecodeRow["R_RACER"];

		$tryrunTime = "";
		$agariTime = "";

		foreach($latestTryruns as $latestTryrunRow){
			$latestTryrun = $latestTryrunRow["LatestTryrun"];
			if($latestTryrun["recode_number"] == $RRecode["WAKU_NUM"]){
				$tryrunTime = $latestTryrun["tryrun_time"];
				break;
			}
		}

		foreach($latestAnalyticsCalcs as $latestAnalyticsCalcRow){
			$latestAnalyticsCalc = $latestAnalyticsCalcRow["LatestCalc"];
			if($latestAnalyticsCalc["recode_number"] == $RRecode["WAKU_NUM"]){
				$agariTime = $latestAnalyticsCalc["agari_time"];
				break;
			}
		}
?>
		<div>
			<p><?php echo $RRecode["WAKU_NUM"]; ?></p>
			<p><?php echo $RRecode["HANDE"]; ?></p>
			<p><?php echo $RRacer["RR_NM"]; ?></p>
			<p><?php echo $RRacer["RANK_NEW"]; ?></p>
			<p><?php echo $tryrunTime; ?></p>
			<p><?php echo $agariTime; ?></p>
		</div>
	<?php } ?>
</div>


