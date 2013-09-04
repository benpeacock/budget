<?php
require_once('../controllers/init.inc.php');

if(isset($_POST['submit'])) {
	if(!empty($_SESSION['user_id'])) {$user_id = $_SESSION['user_id']; }
	if(!empty($_POST['user_id'])) {$user_id = $_POST['user_id']; }
	if(!empty($_POST['id'])) { $id = $_POST['id']; }
	if(!empty($_POST['name'])) { $name = $_POST['name']; }
	if(!empty($_POST['category'])) { $category = $_POST['category']; }
	if(!empty($_POST['tag'])) { $tag = $_POST['tag']; }
	if(!empty($_POST['note'])) { $note = $_POST['note']; }
	if(!empty($_POST['total'])) { $total = $_POST['total']; }
	if(!empty($_POST['budget_id'])) { $budget_id = $_POST['budget_id']; }
	if(!empty($_POST['overhead_item_id'])) { $overhead_item_id = $_POST['overhead_item_id']; }
	if(!empty($_POST['percent_of_total'])) { $percent_of_total = $_POST['percent_of_total']; }
	
	$action = $_POST['action'];
	
	switch ($action) {
		case 'create_item':
			$overhead_item = new OverheadItem();
			$result = $overhead_item->createOverheadItem($user_id, $name, $category, $tag, $note, $total);
// 			if ($result == 1) {
// 				$message = 'Item successfully created.';
// 			} else {
// 				$message = 'Could not create item.';
// 			}
			break;
			
		case 'edit_item':
			$foo = new OverheadItem();
			$result = $foo->updateOverheadItem($id, $name, $category, $tag, $note, $total);
			if ($result == 1) {
				$message = 'Overhead item updated.';
			} else {
				$message = 'could not edit item';
			}
			break;
			
		case 'add_split':
			$overhead_split = new OverheadSplit();
			$result = $overhead_split->createOverheadSplit($user_id, $budget_id, $overhead_item_id, $percent_of_total);
			if ($result == 1) {
				header('Location:overhead.php?action=display&id=' . $overhead_item_id . '');
			} else {
				$message = 'Could not add split to overhead item';
			}
			break;
	}
}
	
	//need to return overhead_item_id and then pass it into next block of code.
	
// 	$splits = array();
// 	$budget1 = $_POST['budget1'] = $splits[];
// 	$percent1 = $_POST['percent1'] = $splits[];
// 	//push data from form into an array of all the splits for a singel overhead item.
	
// 	//loop through the array and call the following for each budget/percent pair.
// 	$overhead_split = new OverheadSplit();
// 	$split_result = $overhead_split->createOverheadSplit($budget1, $overhead_item_id, $percent1);

if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	switch ($action) {
		
		case 'display':
			$id = $_GET['id'];
			$user_id = 1;
			$overhead_item = new OverheadItem();
			$result = $overhead_item->getById($id);
			foreach ($result as $row) {
				echo '<h2>' . $row['name'] . '</h2>';
			}
			$result = $overhead_item->displayOverheadItem($id);
			echo '<form action="overhead.php" method="post">';
			echo '<input type="hidden" name="action" value="edit_item" />';
			echo '<input type="hidden" name="id" value = "' . $result['id'] . '">';
			echo '<input type="name" name="name" value="' . $result['name'] . '" />';
			echo '<select name="category">';
			$category = new Category();
			$cat = $category->getByUser($user_id);
			foreach ($cat as $row) {
			?>
			<option value="<?php echo $row['id'] ?>"<?php if ($row['id'] == $result['category']) { echo 'selected'; } ?>>
			<?php echo $row['name']; ?></option>
			<?php
			}
			echo '</select>';
			echo '<select name="tag">';
			$tag = new Tag();
			$tag_record = $tag->getByUser($user_id);
			foreach ($tag_record as $row) {
				?>
						<option value="<?php echo $row['id'] ?>"<?php if ($row['id'] == $result['tag']) { echo 'selected'; } ?>>
						<?php echo $row['name']; ?></option>
						<?php
						}
			echo '</select>';
			echo '<input type="note" name="note" value="' . $result['note'] . '" />';
			echo '<input type="number" name="total" value="' . $result['total'] . '" />';
			echo '<input type="submit" name="submit" value="Edit Item" />';
			echo '</form>';
			echo '<hr />';
			$overhead_item_id = $overhead_item->id;
			$overhead_split = new OverheadSplit();
			$result = $overhead_split->getByOverheadItem($overhead_item_id);
// 			echo '<pre><tt>';
// 			var_dump($result);
// 			echo '</pre></tt>';
			//echo '<form action="overhead.php" method="post">';
			// echo '<input type="hidden" name="action" value="edit_split">';
			echo '<table class="table_main">';
			echo '<tbody>';
			echo '<tr><th>Budget</th><th>Percent</th></tr>';
//		 	this will display data from the db:
// 			foreach ($result as $row) {
// 				echo '<tr><td><input type="number" name="budget' . $num . '" value="' . $row['budget_id'] . '" /></td><td><input type="number" name="percent" value="' . $row['percent_of_total'] . '"</td></tr>';
// 			}
			foreach ($result as $row) {
				echo '<tr>';
				echo '<td width="15%"><a class="budget_id" data-type="select" data-url="../controllers/splitProcessor.php"
				data-pk="' . $row['id'] . '" data-value="' . $row['budget_id'] . '" data-source="budget.php?action=list&user_id=' . $user_id . '"></a></td>';
				echo '<td width="20%"><a class="percent_of_total" data-type="text" data-url="../controllers/splitProcessor.php"
		      data-pk="' . $row['id'] . '">' . $row['percent_of_total'] . '</a></td>';
				echo '<td width=10%><a onclick="confirm(\'Delete item?\')" href="item.php?action=delete&budget_id=' . $id . '&id=
				' . $row['id'] . '">Delete</a></td>';
				echo '<tr/>';
			}
			?>
			<form method="post" action="overhead.php">
				<tr>
					<td><input type="hidden" name="action" value="add_split" /></td>
					<?php echo '<input type="hidden" name="user_id" value="1" />'; ?>
					<?php echo '<input type="hidden" name="budget_id" value="1" />'; ?>
					<!-- CHECK THIS -->
					<?php echo '<td><input type="hidden" name="overhead_item_id" value="1" /></td>'; ?>
					<td><select name="budget">
					<?php 
					$budget = new Budget();
					$result = $budget->getByUser($user_id);
					foreach ($result as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}
					?>
					</select></td>
					<td><input type="number" name="percent_of_total" required /></td>
					<td><input type="submit" name="submit" value="Add Split" /></td>
				</tr>
			</tbody>
			</table>
			</form>
			<?php
			break;
		
		case 'create_item':
			?>
			<form action="overhead.php" method="post">
			<input type="hidden" name="action" value="create_item"/>
			<ul>
			<li>Name: <input type="text" name="name" /></li>
			<?php
			$user_id = 1; // TESTING ONLY
			$category = new Category();
			$result = $category->getByUser($user_id);
			echo '<li>Category:<select name="category">';
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
			echo '</select></li>';
			$tag = new Tag();
			$result = $tag->getByUser($user_id);
			echo '<li>Tag:<select name="tag">';
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
			?>
			</select></li>
			<li>Note:<textarea name="note"></textarea></li>
			<li><input type="submit" name="submit" value="submit" /></li>
			</ul>
			</form>
			<?php
			break;
	}
} 
require_once('header.inc.php');

if (!empty($message)) { echo $message; }

require_once('footer.inc.php');
?>
