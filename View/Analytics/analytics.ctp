<?php include('analytics_header.php'); ?>

<div class="analytics_recodes">
<?php
	foreach($RRecodes as $RRecodeRow){
		$RRecode = $RRecodeRow["R_RECODE"];
		$RRacer = $RRecodeRow["R_RACER"];

		$tryrunTime = "";
		$agariTime = "";

		if(count($latestTryruns) > 0){
			$latestTryrun = $latestTryruns[$RRecode["WAKU_NUM"]-1]["LatestTryrun"];
			$tryrunTime = $latestTryrun["tryrun_time"];
		}

		if(count($latestAnalyticsCalcs) > 0){
			$latestAnalyticsCalc = $latestAnalyticsCalcs[$RRecode["WAKU_NUM"]-1]["LatestCalc"];
			$agariTime = $latestAnalyticsCalc["agari_time"];
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


