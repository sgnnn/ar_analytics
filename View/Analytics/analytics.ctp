<?php include('analytics_header.php'); ?>

<?php if(!empty($latestRace)){ ?>
	<div class="latest_race_data">
		<p><?php echo $codeConvert->convertRunwayName($latestRace["LatestRace"]["runway_code"]). "走路"; ?></p>
		<p><?php echo $latestRace["LatestRace"]["runway_heat"] . "℃"; ?></p>
	</div>
<?php } ?>

<div class="analytics_frame">
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

		$isLevel = false;
		foreach($performanceLevels as $performanceLevelRow){
			$performanceLevel = $performanceLevelRow["PerformanceLevel"];
			if($performanceLevel["racer_code"] == $RRecode["RR_CD"]){
				$isLevel = true;
				break;
			}
		}
?>
		<div class="analytics_recodes analytics_version">
			<p class="waku_color_<?php echo $RRecode["WAKU_NUM"]; ?>"><?php echo $RRecode["WAKU_NUM"]; ?></p>
			<p><span class="comment">ハンデ</span><?php echo $RRecode["HANDE"]; ?></p>
			<p class="<?php echo substr($RRacer["RANK_NEW"], 0, 1); ?>_class"><?php echo $RRacer["RANK_NEW"]; ?></p>
			<p><?php echo $RRacer["RR_NM"]; ?></p>
			<p><?php echo "<span class='comment'>試走</span>" . $tryrunTime; ?></p>
			<p><?php echo "<span class='comment'>想定タイム</span>" . $agariTime; ?></p>
		</div>

		<?php if($isLevel){ ?>
		<table class="level_count">
			<tr>
				<td class="race_count" rowspan=3>
					<p>同レベルレース</p>
					<?php echo $performanceLevel["race_count"]; ?>
					<span>走</span>
				</td>
				<td class="count">
					<p>単勝</p>
					<p><?php echo $performanceLevel["rank1_count"]; ?></p>
					<p>(<?php echo $performanceLevel["rank1_rate"] . "%"; ?>)</p>
				</td>
			</tr>
			<tr>
				<td class="count">
					<p>2連対</p>
					<p><?php echo $performanceLevel["rank2_count"]; ?></p>
					<p>(<?php echo $performanceLevel["rank2_rate"] . "%"; ?>)</p>
				</td>
			</tr>
			<tr>
				<td class="count">
					<p>3連対</p>
					<p><?php echo $performanceLevel["rank3_count"]; ?></p>
					<p>(<?php echo $performanceLevel["rank3_rate"] . "%"; ?>)</p>
				</td>
			</tr>
		</table>
		<?php } ?>
	<?php } ?>
</div>


