<?php include('analytics_header.php'); ?>

<div class="analytics_frame">
<?php
	foreach($RRecodes as $RRecodeRow){
		$RRecode = $RRecodeRow["R_RECODE"];
		$RRacer = $RRecodeRow["R_RACER"];
?>
		<div class="analytics_recodes recent_version">
			<p class="waku_color_<?php echo $RRecode["WAKU_NUM"]; ?>"><?php echo $RRecode["WAKU_NUM"]; ?></p>
			<p><span class="comment">ハンデ</span><?php echo $RRecode["HANDE"]; ?></p>
			<p class="<?php echo substr($RRacer["RANK_NEW"], 0, 1); ?>_class"><?php echo $RRacer["RANK_NEW"]; ?></p>
			<p><?php echo $RRacer["RR_NM"]; ?></p>
			<p class="lg_color_<?php echo $RRacer["LG_CD"]; ?>"><?php echo $codeConvert->convertLgName($RRacer["LG_CD"]); ?></p>
			<p><?php echo $RRacer["KI"]; ?>期</p>
		</div>

		<div class="win_counts">
		<?php
			$currentCountsName = "currentCounts_" . $RRecode["WAKU_NUM"];
			if(isset(${$currentCountsName})){
				$victoryCount = ${$currentCountsName}["victoryCount"];
				$allCount = ${$currentCountsName}["allCount"];
				$normalCount = ${$currentCountsName}["normalCount"];
				$wetCount = ${$currentCountsName}["wetCount"];

				$allRank1Rate = $analytics->calcRate($allCount["recode_count"], $allCount["rank1_count"]);
				$allRank2Rate = $analytics->calcRate($allCount["recode_count"], $allCount["rank2_count"]);

				$normalRank1Rate = $analytics->calcRate($normalCount["recode_count"], $normalCount["rank1_count"]);
				$normalRank2Rate = $analytics->calcRate($normalCount["recode_count"], $normalCount["rank2_count"]);

				$wetRank1Rate = $analytics->calcRate($wetCount["recode_count"], $wetCount["rank1_count"]);
				$wetRank2Rate = $analytics->calcRate($wetCount["recode_count"], $wetCount["rank2_count"]);
		?>

			<table class="win_count">
				<tr>
					<td class="victory" rowspan=2>
						<span>優勝</span>
						<?php echo $victoryCount; ?>
						<span>回</span>
					</td>
					<td class="count">
						<p>単勝</p>
						<p><?php echo $allCount["rank1_count"]; ?></p>
						<p>(<?php echo $allRank1Rate . "%"; ?>)</p>
					</td>
					<td class="count">
						<p>単勝(良)</p>
						<p><?php echo $normalCount["rank1_count"]; ?></p>
						<p>(<?php echo $normalRank1Rate . "%"; ?>)</p>
					</td>
					<td class="count">
						<p>単勝(湿)</p>
						<p><?php echo $wetCount["rank1_count"]; ?></p>
						<p>(<?php echo $wetRank1Rate . "%"; ?>)</p>
					</td>
				</tr>
				<tr>
					<td class="count">
						<p>２連対</p>
						<p><?php echo $allCount["rank2_count"]; ?></p>
						<p>(<?php echo $allRank2Rate . "%"; ?>)</p>
					</td>
					<td class="count">
						<p>２連対(良)</p>
						<p><?php echo $normalCount["rank2_count"]; ?></p>
						<p>(<?php echo $normalRank2Rate . "%"; ?>)</p>
					</td>
					<td class="count">
						<p>２連対(湿)</p>
						<p><?php echo $wetCount["rank2_count"]; ?></p>
						<p>(<?php echo $wetRank2Rate . "%"; ?>)</p>
					</td>
				</tr>
			</table>
		<?php } ?>
		</div>
	<?php } ?>
</div>