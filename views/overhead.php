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
			$overhead_item = new OverheadItem();
			$result = $overhead_item->createOverheadItem($user_id, $name, $category, $tag, $note);
			if ($result == 1) {
				$message = 'Item successfully created.';
			} else {
				$message = 'Could not create item.';
			}
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
			$id = $_GET['id'] = $overhead_item_id;
			$user_id = 1;
			$overhead_item = new OverheadItem();
			$result = $overhead_item->getById($id);
			foreach ($result as $row) {
				echo '<h2>' . $row['name'] . '</h2>';
			}
			$result = $overhead_item->displayOverheadItem($overhead_item_id);
			//need to create form element here that will display existing splits and 
			//submit revised ones upon ediitng.  Use x-editable? 
			
		
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
	}
} 
require_once('header.inc.php');

// displys a single overhead item for editing.

require_once('footer.inc.php');
?>
