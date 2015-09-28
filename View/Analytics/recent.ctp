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

		<div>
		<?php
			$recentRecodesName = "recentRecodes_" . $RRecode["WAKU_NUM"];
			if(isset(${$recentRecodesName})){
				$recentSeriesRecodes = ${$recentRecodesName}["recentSeriesRecodes"];

				foreach($recentSeriesRecodes as $recentRecodes){
					$series = $recentRecodes["series"];
					$recodes = $recentRecodes["recodes"];

					if(count($series) > 0){
		?>
						<div class="recent_series">
							<p><?php echo $codeConvert->convertLgName($series["LG_CD"]); ?></p>
							<p><?php echo $codeConvert->convertSeRankName($series["SE_RANK_CD"]); ?></p>
							<p><?php echo $codeConvert->convertDateMdString($series["SE_START_YMD"]); ?></p>
							<p><?php echo $series["SE_TITLE"]; ?></p>
						</div>
		<?php
					}

					foreach($recodes as $recodeRow){
						$recode = $recodeRow["R_RECODE"];
						$race = $recodeRow["R_RACE"];
		?>
						<div class="recent_recodes">
							<p><?php echo $codeConvert->convertDateMdString($race["RCDT_YMD"]); ?></p>
							<p><?php echo $codeConvert->convertRunwayName($race["RUNWAY_K"]) . " (" . $race["RUNWAY_HEAT"] . "℃)"; ?></p>
							<p class="waku_color_<?php echo $recode["WAKU_NUM"]; ?>"><?php echo $recode["WAKU_NUM"]; ?></p>
							<p><?php echo $recode["HANDE"] . " (" . $recode["SAME_HANDE_CNT"]. ")"; ?></p>
							<p <?php if(!empty($recode["RC_RANK"]) and $recode["RC_RANK"] <= 3){echo "class='rc_rank_" . $recode['RC_RANK'] . "'";} else{echo "class='rc_rank_0'";} ?> >
								<?php if($recode["RC_RANK"] != null){echo $recode["RC_RANK"];} else{echo "-";} ?>
							</p>
							<p><?php if($recode["SISOU_TIME"] != null){echo $recode["SISOU_TIME"];} else{echo "-.--";} ?></p>
							<p><?php if($recode["AGARI_TIME"] != null){echo $recode["AGARI_TIME"];} else{echo "-.---";} ?></p>
							<p><span class="comment2">ST</span><?php echo $recode["ST"]; if($recode["F_CNT"] >= 1){echo "<span class='flying'>(F)</span>";} ?></p>
							<p><?php echo $race["RC_TYPE_NM"]; ?></p>
						</div>
		<?php
					}
				}
			}
		 ?>
		</div>
	<?php } ?>
</div>
