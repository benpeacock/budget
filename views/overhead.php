<?php
require_once('../controllers/init.inc.php');

if(isset($_POST['submit']) && $_POST['action'] == 'create') {
	//$user_id = $_SESSION['user_id'];
	$user_id = 1; // TESTING ONLY
	$name = $_POST['name'];
	$category = $_POST['category'];
	$tag = $_POST['tag'];
	$note = $_POST['note'];
	//make $total equal to sum of all the splits together.  Or do I even need it?
	$overhead_item = new OverheadItem();
	$result = $overhead_item->createOverheadItem($user_id, $name, $category, $tag, $note);
	if ($result == 1) {
		$message = 'Item successfully created.';
	} else {
		$message = 'Could not create item.';
	}
	
	//need to return overhead_item_id and then pass it into next block of code.
	
// 	$splits = array();
// 	$budget1 = $_POST['budget1'] = $splits[];
// 	$percent1 = $_POST['percent1'] = $splits[];
// 	//push data from form into an array of all the splits for a singel overhead item.
	
// 	//loop through the array and call the following for each budget/percent pair.
// 	$overhead_split = new OverheadSplit();
// 	$split_result = $overhead_split->createOverheadSplit($budget1, $overhead_item_id, $percent1);
	
}


?>
<form action="overhead.php" method="post">
<input type="hidden" name="action" value="create"/>
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
echo '</select></li>';
?>
<li>Note:<textarea name="note"></textarea></li>
<li>Split 1:
	<select name="budget1"><option value="1">Val1</option><option value="2">Val2</option></select>
	<input type="number" name="percent1" />
</li>
<li><input type="submit" name="submit" value="submit" /></li>
</ul>
</form>
