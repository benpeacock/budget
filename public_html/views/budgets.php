<div class="container">
	<div class="row">
	<?php
	foreach ($query as $row) {
		echo '<div class="col-md-2"><h2>' . $budget_title = $row['name'] . '</h2></div>';
	}
	?>
		<div class="col-md-1" style="margin-top: 30px"><a href="/budget/edit/<?php echo $id; ?>">Edit</a></div>
		<div class="col-md-1" style="margin-top: 30px"><a onclick="return confirm('Delete budget?')" href="/budget/delete/<?php echo $id; ?>">Delete</a></div>
		<div class="col-md-1 pull-right"><button onclick="location.reload()" type="button" class="btn" style="margin-top:15px;"><span class="glyphicon glyphicon-refresh"></span></button></div>
		<div class="col-md-3 pull-right"><h3 class="text-right">Total: $<?php echo Budget::sumBudget($id); ?></h3></div>
	<?php $query = $budget->displayBudget($id, $session->user_id); ?>
	</div>
	<div>
		<table class="table table-bordered table-striped">
			<th>Name<span class="help-block"><small>a-Z, 0-9 only</small></span></th><th>Category</th><th>Tag</th><th>Amount<span class="help-block"><small>0.00 format</small></th><th>Notes<span class="help-block"><small>max 300 characters</small></th><th>Options</th>
			<tbody>
				<?php foreach ($query as $row) { ?>
					<tr>
					<td id="item-name"><a class="name" pattern="^[a-zA-Z0-9]+$" maxlength="45" data-type="text" data-url="/models/itemProcessor.php"
						      data-pk="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
					<td id="item-category"><a class="category" data-type="select" data-url="/models/itemProcessor.php"
								data-pk="<? echo $row['id'] ?>" data-value="<?php echo $row['category'] ?>" data-source="/category/list/<?php echo $row['user_id'] ?>"></a></td>
					<td id="item-tag"><a class="tag" data-type="select" data-url="/models/itemProcessor.php"
								data-pk="<? echo $row['id'] ?>" data-value="<?php echo $row['tag'] ?>" data-source="/tag/list/<?php echo $row['user_id'] ?>"></a></td>
					<td id="item-amount"><a class="amount" data-type="number" data-url="/models/itemProcessor.php"
							  data-pk="<? echo $row['id'] ?>"><?php echo $row['amount'] ?></a></td>
					<td id="item-note"><a class="note" pattern="^[a-zA-Z0-9]+$" maxlength="45" data-type="textarea" data-url="/models/itemProcessor.php"
							  data-pk="<? echo $row['id'] ?>"><?php echo $row['note'] ?></a></td>
					<!-- <td id="item-delete"><a onclick="if(confirm('Delete item?')) window.location='/item/delete/<? echo $row['budget_id'] . '/' .$row['id'] ?>';">Delete</a></td> -->
					<td id="item-delete"><a onclick="window.location='/item/delete/<? echo $row['budget_id'] . '/' .$row['id'] ?>';">Delete</a></td>
					</tr>
				<?php } ?>
				<form method="post" action="/item" class="form-inline">
					<tr>
						<input type="hidden" name="action" value="add" />
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

