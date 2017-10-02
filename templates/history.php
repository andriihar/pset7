
<div>
	<!--    <img alt="Under Construction" src="/img/construction.gif"/>-->
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Symbol</th>
			<th>Action</th>
			<th>Shares</th>
			<th>Price</th>
			<th>Transacted</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($history as $item): ?>
			<tr>
				<td><?=$item["symbol"]?></td>
				<td><?=ucfirst($item["action"])?></td>
				<td><?=$item["stocks"]?></td>
				<td>$<?=number_format($item["price"], 2)?></td>
				<td><?=$item["time"]?></td>
			</tr>
		<?php endforeach?>
		</tbody>
		<!--		<tfoot>-->
		<!--		<tr>-->
		<!--			<td>TOTAL</td>-->
		<!--			<td colspan="3"></td>-->
		<!--			<td>$--><?//=number_format($position["total"] + $cash , 2)?><!--</td>-->
		<!--		</tr>-->
		<!--		</tfoot>-->
	</table>
</div>

