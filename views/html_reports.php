<div class="container">
	<table>
		<tbody>
			<tr><th>Budget</th><th>Name</th><th>Category</th><th>Tag</th><th>Amount</th></tr>
			<?php
			foreach ($report_result as $row) {
				echo '<tr>';
					echo '<td class="report-cell">' . $row['budget'] . '</td>';
					echo '<td class="report-cell">' . $row['name'] . '</td>';
					echo '<td class="report-cell">' . $row['category'] . '</td>';
					echo '<td class="report-cell">' . $row['tag'] . '</td>';
					echo '<td class="report-cell">' . $row['amount'] . '</td>';
				echo '</tr>';
			}
			?>
			<tr><td>Total</td><td></td><td></td><td></td><td>Goes here</td>
		</tbody>
	</table>
</div>