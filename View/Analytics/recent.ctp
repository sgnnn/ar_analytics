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
	<?php } ?>
</div>
