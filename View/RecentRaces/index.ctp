<?php App::uses('CodeConvert', 'Vendor'); ?>
<?php App::uses('RecentRaces', 'Vendor'); ?>
<?php $codeConvert = new CodeConvert(); ?>
<?php $recentRaces = new RecentRaces(); ?>

<div class="top_note">
	過去2ヶ月間に開催されたレースの結果が確認できます。
</div>

<div class="category_select">
	<a <?php if(!$gradeOnly){ ?> class="select" <?php } ?> href="<?php echo $this->Html->url('/', true);?>RecentRaces">すべて</a>
	<a <?php if($gradeOnly){ ?> class="select" <?php } ?>  href="<?php echo $this->Html->url('/', true);?>RecentRaces?gradeOnly=true">Gレースのみ</a>
</div>

<div class="race_selects">
<?php foreach($RSerieses as $RSeriesRow):
  $RSeries = $RSeriesRow["R_SERIES"];
?>
	<div class="race_area">
		<div id="<?php echo $RSeries["SE_CD"]; ?>" class="race_select race_select_<?php echo $RSeries["LG_CD"]; ?>">
			<div><?php echo $codeConvert->convertLgName($RSeries["LG_CD"]); ?></div>
			<div><?php echo $codeConvert->convertSeRankName($RSeries["SE_RANK_CD"]); ?></div>
			<div><?php echo $RSeries["SE_TITLE"]; ?></div>
			<div><?php echo $recentRaces->period($RSeries["SE_START_YMD"], $RSeries["SE_DAYS"]); ?></div>
		</div>
		<div class="day_selects"></div>
		<div class="select_days_please">日付を選択してください</div>
		<div class="race_datas"></div>
	</div>
<?php endforeach; ?>
</div>

<div id="more">
	もっと見る
</div>

<input type="hidden" id="gradeOnly" value="<?php echo $gradeOnly; ?>" >
<input type="hidden" id="moreStart" value="<?php echo $moreStart; ?>" >