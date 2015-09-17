<div class="top_note">
	開催されたレースの優勝者が確認できます。
</div>

<div class="category_select">
	<a href="./Victorys">すべて</a>
	<a href="./Victorys?gradeOnly=true">Gレースのみ</a>
</div>

<div class="victory_datas">
	<?php foreach($victorys as $victory): ?>
		<table>
			<tr>
				<td rowspan=2><?php echo $victory["racerName"] ?></td>
				<td><?php echo $victory["racerLgName"] ?></td>
				<td rowspan=2><?php echo $victory["lgName"] ?></td>
				<td rowspan=2><?php echo $victory["seRankName"] ?></td>
				<td><?php echo $victory["rcTypeName"] ?></td>
				<td><?php echo $victory["runwayName"] ?></td>
				<td><?php echo $victory["runwayHeat"] . "℃" ?></td>
				<td><?php echo $victory["rankNew"] ?></td>
			</tr>
			<tr>
				<td><?php echo $victory["ki"] ?>期</td>
				<td colspan=4>
					<div>
						<p><?php echo $victory["seTitle"] ?></p>
						<p><?php echo $victory["nightK"] ?></p>
					</div>
				</td>
			</tr>
		</table>

		<div class="victory_data">
			<div class="victory_top">
				<p><?php echo $victory["racerName"] ?></p>
				<p><?php echo $victory["racerLgName"] ?></p>
				<p><?php echo $victory["ki"] ?>期</p>
				<p><?php echo $victory["lgName"] ?></p>
				<p><?php echo $victory["seRankName"] ?></p>
				<p><?php echo $victory["rcTypeName"] ?></p>
				<p><?php echo $victory["runwayName"] . "(" . $victory["runwayHeat"] . "℃)" ?></p>
				<p><?php echo $victory["rankNew"] ?></p>
			</div>
			<div>
				<p><?php echo $victory["seTitle"] ?></p>
				<p><?php echo $victory["nightK"] ?></p>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<div>
	<p>もっと見る</p>
</div>