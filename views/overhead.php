<?php
require_once('../controllers/init.inc.php');

if(isset($_POST['submit'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'create_item':
			//$user_id = $_SESSION['user_id'];
			$user_id = 1; // TESTING ONLY
			$name = $_POST['name'];
			$category = $_POST['category'];
			$tag = $_POST['tag'];
			$note = $_POST['note'];
			$total = $_POST['total'];
			$overhead_item = new OverheadItem();
			$result = $overhead_item->createOverheadItem($user_id, $name, $category, $tag, $note, $total);
// 			if ($result == 1) {
// 				$message = 'Item successfully created.';
// 			} else {
// 				$message = 'Could not create item.';
// 			}
			break;
			
		case 'edit_item':
			$id = $_POST['id'];
			$name = $_POST['name'];
			$category = $_POST['category'];
			$tag = $_POST['tag'];
			$note = $_POST['note'];
			$total = $_POST['total'];
			
			$dbh = Database::getPdo();
			try {
				$sql = "UPDATE overhead_item SET total = :total, name = :name, category = :category, tag = :tag, note = :note WHERE id = :id";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':id', $id);
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':category', $category);
				$stmt->bindParam(':tag', $tag);
				$stmt->bindParam(':note', $note);
				$stmt->bindParam(':total', $total);
				$stmt->execute();
				$result = $stmt->rowCount();
			} catch (PDOException $e) {
				echo 'Unable to edit overhead item ';
			}
			if ($result == 1) {
				$message = 'Overhead item updated.';
			} else {
				$message = 'could not edit item';
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

if(isset($_GET)) {
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
// 			echo '<table class="table_main">';
// 			echo '<tbody>';
// 			echo '<th>Budget</th><th>Percent</th>';
//			$overhead_split = new OverheadSplit();
// 			$result = $overhead_split->getByOverheadItem($overhead_item_id);
// 			foreach ($result as $row) {
// 				echo '<tr>';
// 				echo '<td>Percent: ' . $row['percent_of_total'] . '</td>';
// 				echo '<td width="20%"><a class="name" data-type="text" data-url="../controllers/itemProcessor.php"
// 		      data-pk="' . $row['id'] . '">' . $row['name'] . '</a></td>';
// 				echo '<td width="15%"><a class="category" data-type="select" data-url="../controllers/itemProcessor.php"
// 				data-pk="' . $row['id'] . '" data-value="' . $row['category'] . '" data-source="category.php?action=list&user_id=' . $user_id . '"></a></td>';
// 				echo '<td width="15%"><a class="tag" data-type="select" data-url="../controllers/itemProcessor.php"
// 				data-pk="' . $row['id'] . '" data-value="' . $row['tag'] . '" data-source="tag.php?action=list&user_id=' . $user_id . '"></a></td>';
// 				echo '<td width="15%"><a class="amount" data-type="number" data-url="../controllers/itemProcessor.php"
// 			  data-pk="' . $row['id'] . '">' . $row['amount'] . '</a></td>';
// 				echo '<td width="25%"><a class="note" data-type="textarea" data-url="../controllers/itemProcessor.php"
// 			  data-pk="' . $row['id'] . '">' . $row['note'] . '</a></td>';
// 				echo '<td width=10%><a onclick="confirm(\'Delete item?\')" href="item.php?action=delete&budget_id=' . $id . '&id=
// 				' . $row['id'] . '">Delete</a></td>';
// 				echo '<tr/>';
// 			}
// 			echo '</tbody>';
// 			echo '</table>';
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
