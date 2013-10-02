<div class="container">
	<h2>Results</h2>
	<table class="table table-striped">
		<tbody>
			<tr><th>Budget</th><th>Name</th><th>Category</th><th>Tag</th><th>Amount</th></tr>
			<?php
			$addup = array();
			foreach ($report_result as $row) {
				$addup[] = $row['amount'];
				echo '<tr>';
					echo '<td class="report-cell">' . $row['item'] . '</td>';
					echo '<td class="report-cell">' . $row['budget'] . '</td>';
					echo '<td class="report-cell">' . $row['category'] . '</td>';
					echo '<td class="report-cell">' . $row['tag'] . '</td>';
					echo '<td class="report-cell">' . $row['amount'] . '</td>';
				echo '</tr>';
			$total= array_sum($addup);
			}
			?>
			<tr><td></td><td></td><td></td><td><strong><em>Total</em></strong></td><td><strong><em><?php echo $total; ?></em></strong></td>
		</tbody>
	</table>
</div>