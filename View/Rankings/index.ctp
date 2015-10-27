<?php App::uses('CodeConvert', 'Vendor'); ?>
<?php $codeConvert = new CodeConvert(); ?>

<input type="hidden" id="category" value="<?php echo $category; ?>" >
<input type="hidden" id="racerRank" value="<?php echo $racerRank; ?>" >
<input type="hidden" id="period" value="<?php echo $period; ?>" >

<div class="category_select">
	<a <?php if($category === "count")  { ?> class="select" <?php } ?> href="javascript:setCategory('count')">勝利数</a>
	<a <?php if($category === "rate")   { ?> class="select" <?php } ?> href="javascript:setCategory('rate')">勝率</a>
	<a <?php if($category === "victory"){ ?> class="select" <?php } ?> href="javascript:setCategory('victory')">優勝回数</a>
</div>

<div class="racer_rank_select">
	<a <?php if($racerRank === "all"){ ?> class="select" <?php } ?> href="javascript:setRacerRank('all')">すべて</a>
	<a <?php if($racerRank === "s")  { ?> class="select" <?php } ?> href="javascript:setRacerRank('s')">S級</a>
	<a <?php if($racerRank === "a")  { ?> class="select" <?php } ?> href="javascript:setRacerRank('a')">A級</a>
	<a <?php if($racerRank === "b")  { ?> class="select" <?php } ?> href="javascript:setRacerRank('b')">B級</a>
</div>

<div class="period_select">
	<a <?php if($period === "season") { ?> class="select" <?php } ?> href="javascript:setPeriod('season')">今シーズン</a>
	<a <?php if($period === "current"){ ?> class="select" <?php } ?> href="javascript:setPeriod('current')">今期</a>
	<a <?php if($period === "before") { ?> class="select" <?php } ?> href="javascript:setPeriod('before')">前期</a>
</div>

<div class="rankings">
	<?php
		$beforeRankValue = 0;
		$rank = 0;
		$index = 1;
		foreach($rankings as $rankingRow){
			$ranking = $rankingRow['Ranking'];

			if($category === "count")
				$currentRankValue = $ranking['win_count'];
			elseif($category === "rate")
				$currentRankValue = $ranking['win_rate'];
			elseif($category === "victory")
				$currentRankValue = $ranking['victory_count'];

			if($beforeRankValue != $currentRankValue)
				$rank = $index;

			$beforeRankValue = $currentRankValue;
			$index ++;
	?>
		<div>
			<p><span>rank</span><?php echo $rank; ?></p>
			<p><?php echo $ranking['RR_NM']; ?></p>
			<p><?php echo $ranking['RANK_NEW']; ?></p>
			<p><?php echo  $codeConvert->convertLgName($ranking['LG_CD']); ?></p>
			<p><?php echo $ranking['KI']; ?><span>期</span></p>
			<p><?php echo $ranking['win_count']; ?><span>勝</span></p>
			<p><?php echo $ranking['win_rate']; ?><span>％</span></p>
			<p><?php echo $ranking['victory_count']; ?><span>回</span></p>
		</div>

	<?php } ?>
</div>
