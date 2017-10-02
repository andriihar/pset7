<div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Symbol</th>
				<th>Name</th>
				<th>Shares</th>
				<th>Price</th>
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($positions as $position): ?>
			<tr>
				<td><?=$position["symbol"]?></td>
				<td><?=$position["name"]?></td>
				<td><?=$position["stocks"]?></td>
				<td>$<?=number_format($position["price"], 2)?></td>
				<td>$<?=number_format($position["total"], 2)?></td>
			</tr>
		<?php endforeach?>

		<tr>
			<td>CASH</td>
			<td></td>
			<td></td>
			<td></td>
			<td>$<?=number_format($cash, 2,'.', ',')?></td>
		</tr>
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

