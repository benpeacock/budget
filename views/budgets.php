<div class="container">
<div class="row">
<?php
foreach ($query as $row) {
	echo '<div class="col-md-2"><h2>' . $budget_title = $row['name'] . '</h2></div>';
}
echo '<div class="col-md-1"><a href="../controllers/budget.php?action=edit&id=' . $id . '">Edit</a></div>';
// echo '<br />';
echo '<div class="col-md-1"><a onclick="confirm(\'Delete budget?\')" href=budget.php?action=delete&id=' . $id. '>Delete</a></div>';
$query = $budget->displayBudget($id);
echo '</div>';
echo '<table class="table_main">';
echo '<tbody>';
echo '<th>Name</th><th>Category</th><th>Tag</th><th>Amount</th><th>Notes</th>';
foreach ($query as $row) {
	echo '<tr>';
	echo '<td width="20%"><a class="name" data-type="text" data-url="../models/itemProcessor.php"
		      data-pk="' . $row['id'] . '">' . $row['name'] . '</a></td>';
	echo '<td width="15%"><a class="category" data-type="select" data-url="../models/itemProcessor.php"
				data-pk="' . $row['id'] . '" data-value="' . $row['category'] . '" data-source="category.php?action=list&user_id=' . $user_id . '"></a></td>';
	echo '<td width="15%"><a class="tag" data-type="select" data-url="../models/itemProcessor.php"
				data-pk="' . $row['id'] . '" data-value="' . $row['tag'] . '" data-source="tag.php?action=list&user_id=' . $user_id . '"></a></td>';
	echo '<td width="15%"><a class="amount" data-type="number" data-url="../models/itemProcessor.php"
			  data-pk="' . $row['id'] . '">' . $row['amount'] . '</a></td>';
	echo '<td width="25%"><a class="note" data-type="textarea" data-url="../models/itemProcessor.php"
			  data-pk="' . $row['id'] . '">' . $row['note'] . '</a></td>';
	echo '<td width=10%><a onclick="confirm(\'Delete item?\')" href="item.php?action=delete&budget_id=' . $id . '&id=
				' . $row['id'] . '">Delete</a></td>';
	echo '<tr/>';
}
?>
				<form method="post" action="item.php">
					<tr>
						<input type="hidden" name="action" value="add" />
						<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />
						<input type="hidden" name="budget_id" value="<?php echo $id; ?>" />
						<td><input type="text" name="name" required /></td>
						<td><select name="category">
						<?php
						$category = new Category();
						$result = $category->getByUser($user_id);
						foreach ($result as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
						?>
						</select></td>
						<td><select name="tag">
						<?php
						$tag = new Tag();
						$result = $tag->getByUser($user_id);
						foreach ($result as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
						?>
						</select></td>
						<td><input type="text" name="amount" required /></td>
						<td><input type="textfield" name="note" /></td>
						<td><input type="submit" name="submit" value="Add Item" /></td>
					</tr>
				</form>
				</tbody>
				</table>
				</div>
			<hr />
			<!-- <h3>Overhead Items</h3> -->
			<?php
// 			$overhead_item = new Overheaditem();
// 			$budget_id = $_GET['id'];
// 			$result = $overhead_item->displayOverheadByBudget($budget_id);
// 			if (!empty($result)) {
// 				echo '<table>';
// 				foreach ($result as $row) {
// 					echo '<tr>';
// 						echo '<td width="20%">' . $row['name'] . '</td>';
// 						echo '<td width="15%">' . $row['category'] . '</td>';
// 						echo '<td width="15%">' . $row['tag'] . '</td>';
// 						echo '<td width="15%">' . $row['split_total'] . '</td>';
// 						echo '<td width="25%">' . $row['note'] . '</td>';
// 						echo '<td width="10%">edit button goes here</td>';
// 					echo '</tr>';
// 				}	
// 				echo '</table>';
// 			}
?>
</div>
