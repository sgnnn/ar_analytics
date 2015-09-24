<div class="top_note">
	開催されたレースの優勝者が確認できます。
</div>

<div class="category_select">
	<a <?php if(!$gradeOnly){ ?> class="select" <?php } ?> href="./Victorys">すべて</a>
	<a <?php if($gradeOnly){ ?> class="select" <?php } ?>  href="./Victorys?gradeOnly=true">Gレースのみ</a>
</div>

<div class="victory_datas">
	<?php foreach($victorys as $victory): ?>
		<div class="victory_data">
			<div class="victory_racer">
				<p><?php echo $victory["racerName"] ?></p>
				<p><?php echo $victory["rankNew"] ?></p>
				<p><?php echo $victory["racerLgName"] ?></p>
				<p><?php echo $victory["ki"] ?>期</p>
			</div>
			<div class="victory_series">
				<p><?php echo $victory["lgName"] ?></p>
				<p><?php echo $victory["seRankName"] ?></p>
				<p><?php echo $victory["seTitle"] ?></p>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<div id="more">
	もっと見る
</div>

<input type="hidden" id="gradeOnly" value="<?php echo $gradeOnly; ?>" >
<input type="hidden" id="moreStart" value="<?php echo $moreStart; ?>" >
