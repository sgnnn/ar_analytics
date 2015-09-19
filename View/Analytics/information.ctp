<?php include('analytics_header.php'); ?>

<div class="informationRecodes">
	<?php foreach($RRecodes as $RRecodeRow):
		$RRecode = $RRecodeRow["R_RECODE"];
		$RRacer = $RRecodeRow["R_RACER"];
	?>
		<div>
			<p><?php echo $RRecode["WAKU_NUM"]; ?></p>
			<p><?php echo $RRecode["HANDE"]; ?></p>
			<p><?php echo $RRacer["RR_NM"]; ?></p>
			<p><?php echo $RRecode["ADD_ENTRY_K"]; ?></p>
			<p><?php echo $RRacer["LG_CD"]; ?></p>
			<p><?php echo $RRacer["KI"]; ?></p>
			<p><?php echo $RRacer["RANK_NEW"]; ?></p>

		</div>
	<?php endforeach; ?>
</div>
