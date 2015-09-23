<input type="hidden" id="selectAction" value="<?php echo $action; ?>">
<input type="hidden" id="seCd" value="<?php echo $seCd; ?>">
<input type="hidden" id="seDay" value="<?php echo $seDay; ?>">
<input type="hidden" id="rcNum" value="<?php echo $rcNum; ?>">
<table class="analytics_select">
	<tr>
		<td rowspan=3><p id="analytics" class="full">分析</p></td>
		<td rowspan=3><p id="information" class="full">基本情報</p></td>
		<td><p id="recent" class="divide">直近</p></td>
		<td><p id="current" class="divide">今期</p></td>
	</tr>
	<tr>
		<td><p id="holding" class="divide">今節</p></td>
		<td><p id="season" class="divide">今シーズン</p></td>
	</tr>
	<tr>
		<td><p id="before" class="divide">前節</p></td>
		<td><p id="grade" class="divide">グレード比較</p></td>
	</tr>
</table>

<div class="race_numbers">
	<?php for($i=1; $i<=$rcCount; $i++){ ?>
		<p id="<?php echo $i; ?>" <?php if($i == $rcNum) echo "class='select'"; ?>><?php echo $i . "R"; ?></p>
		<?php if($i == 6){ ?>
			<div></div>
		<?php } ?>
	<?php } ?>
</div>