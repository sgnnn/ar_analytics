<?php include('analytics_header.php'); ?>

<div class="analytics_recodes information_version">
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
			<p class="lg_color_<?php echo $RRacer["LG_CD"]; ?>"><?php echo $codeConvert->convertLgName($RRacer["LG_CD"]); ?></p>
			<p><?php echo $RRacer["KI"]; ?>期</p>
			<p><?php if($RRacer["BIRTH_MD"] === date("md")){echo "誕生日";} ?></p>
			<p><?php if($RRecode["ADD_ENTRY_K"] === "1"){echo "途中参加";} ?></p>
		</div>
	<?php } ?>
</div>
