<?php include('analytics_header.php'); ?>

<div class="analytics_recodes">
<?php
	foreach($RRecodes as $RRecodeRow){
		$RRecode = $RRecodeRow["R_RECODE"];
		$RRacer = $RRecodeRow["R_RACER"];
?>
		<div>
			<p class="waku_color_<?php echo $RRecode["WAKU_NUM"]; ?>"><?php echo $RRecode["WAKU_NUM"]; ?></p>
			<p><span class="comment">ハンデ</span><?php echo $RRecode["HANDE"]; ?></p>
			<p class="<?php echo substr($RRacer["RANK_NEW"], 0, 1); ?>_class"><?php echo $RRacer["RANK_NEW"]; ?></p>
			<p><?php echo $RRacer["RR_NM"]; ?></p>
		</div>

		<?php
			$recentRecodesName = "recentRecodes_" . $RRecode["WAKU_NUM"];
			if(isset(${$recentRecodesName})){
				$recentSeriesRecodes = ${$recentRecodesName}["recentSeriesRecodes"];

				foreach($recentSeriesRecodes as $recentRecodes){
					if(count($recentRecodes) > 0){
		?>
						<div>
							<?php echo $recentRecodes[0]["R_RECODE"]["SE_CD"]; ?>
						</div>
		<?php
					}

					foreach($recentRecodes as $recentRecodeRow){
						$recentRecode = $recentRecodeRow["R_RECODE"];
						$recentRace = $recentRecodeRow["R_RACE"];
		?>
						<div class="recentRecodes">
							<p><?php echo $recentRace["RCDT_YMD"]; ?></p>
						</div>
		<?php
					}
				}
			}
		 ?>

	<?php } ?>
</div>
