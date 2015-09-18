<div class="my_format">
	<div class="select_day"><?php echo $today; ?></div>

	<div class="select_lg">
		<?php for($i=0; $i<count($selectLgs); $i++): ?>
			<p id="<?php echo $seCds[$i] ?>" class="lg_color_<?php echo $selectLgs[$i];?>"><?php echo $lgs[$i]; ?></p>
		<?php endfor; ?>
	</div>

	<div class="select_please">
		<?php if($seCount > 0){ ?>
			レース場を選んでください
		<?php } else{ ?>
			本日は開催はありません
		<?php } ?>
	</div>

	<div class="series_data">
		<div class="series_lg"></div>
		<div class="series_rank"></div>
		<div class="series_name"></div>
		<div class="series_days"></div>
		<div class="race_numbers"></div>

		<div class="select_race_please">
			レースを選んでください
		</div>

		<div class="race_data">
			<span class="race_type"></span>
			<span class="distance"></span>

			<div class="recers"></div>

			<div class="analytics">
				<a id="analytics_start" href="#">分析開始</a>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="seCd" value="">
<input type="hidden" id="seDay" value="">
<input type="hidden" id="rcNum" value="">