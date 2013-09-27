<div class="container">
	<div class="row bg-lgray">
	<?php
	foreach ($query as $row) {
		echo '<div class="col-md-2"><h2>' . $budget_title = $row['name'] . '</h2></div>';
	}
	?>
		<div class="col-md-1 mv-dn-30"><a href="../controllers/budget.php?action=edit&id=<?php echo $id; ?>">Edit</a></div>
		<div class="col-md-1 mv-dn-30"><a onclick="return confirm('Delete budget?')" href=budget.php?action=delete&id=<?php echo $id; ?>">Delete</a></div>
	<?php $query = $budget->displayBudget($id); ?>
	</div>
	<div>
		<table class="table_main">
			<tbody>
				<th>Name</th><th>Category</th><th>Tag</th><th>Amount</th><th>Notes</th>
				<?php 
				foreach ($query as $row) {
					echo '<tr>';
					echo '<td id="item-name"><a class="name" pattern="^[a-zA-Z0-9]+$" maxlength="45" data-type="text" data-url="../models/itemProcessor.php"
						      data-pk="' . $row['id'] . '">' . $row['name'] . '</a></td>';
					echo '<td id="item-category"><a class="category" data-type="select" data-url="../models/itemProcessor.php"
								data-pk="' . $row['id'] . '" data-value="' . $row['category'] . '" data-source="category.php?action=list&user_id=' . $row['user_id'] . '"></a></td>';
					echo '<td id="item-tag"><a class="tag" data-type="select" data-url="../models/itemProcessor.php"
								data-pk="' . $row['id'] . '" data-value="' . $row['tag'] . '" data-source="tag.php?action=list&user_id=' . $row['user_id'] . '"></a></td>';
					echo '<td id="item-amount"><a class="amount" data-type="number" data-url="../models/itemProcessor.php"
							  data-pk="' . $row['id'] . '">' . $row['amount'] . '</a></td>';
					echo '<td id="item-note"><a class="note" pattern="^[a-zA-Z0-9]+$" maxlength="45" data-type="textarea" data-url="../models/itemProcessor.php"
							  data-pk="' . $row['id'] . '">' . $row['note'] . '</a></td>';
					echo '<td id="item-delete"><a onclick="return confirm(\'Delete item?\')" href="item.php?action=delete&budget_id=' . $id . '&id=
								' . $row['id'] . '">Delete</a></td>';
					echo '<tr/>';
				}
				?>
				<form method="post" action="item.php" class="form-inline">
					<tr>
						<input type="hidden" name="action" value="add" />
						<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />
						<input type="hidden" name="budget_id" value="<?php echo $id; ?>" />
						<td>
							<label class="sr-only" for="name">Name</label>
							<input class="form-control" type="text" pattern="^[a-zA-Z0-9]+$" maxlength="45" name="name" placeholder="name (required)" required />
						</td>
						<td>
							<label class="sr-only" for="category">Category</label>
							<select name="category">
							<option value=""></option>
							<?php
							$category = new Category();
							$result = $category->getByUser($session->user_id);
							foreach ($result as $row) {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
							}
							?>
							</select>
						</td>
						<td>
							<label class="sr-only" for="tag">Tag</label>
							<select name="tag">
							<option value=""></option>
							<?php
							$tag = new Tag();
							$result = $tag->getByUser($session->user_id);
							foreach ($result as $row) {
							echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
							}
							?>
							</select>
						</td>
						<td>
							<label class="sr-only" for="amount">Amount</label>
							<input class="form-control" type="number" name="amount" placeholder="amount (required)" required />
						</td>
						<td>
							<label class="sr-only" for="note">Note</label>
							<textarea rows="1" class="form-control" name="note" placeholder="notes" /></textarea>
						</td>
						<td>
							<button class="btn btn-small" type="submit" name="submit">Add Item</button>
						</td>
					</tr>
					<tr>
						<td>
							<span style="help-block">a-Z, 0-9 only</span>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
							<span style="help-block">0.00 format</span>
						</td>
						<td>
							<span style="help-block">max 300 characters</span>
						</td>
				</form>
			</tbody>
		</table>
	</div>
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
	<div class="container pull-right"><h3>Total: $<?php echo Budget::sumBudget($id); ?></h3></div>
</div>

