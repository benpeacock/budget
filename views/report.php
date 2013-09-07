<?php require_once '../controllers/init.inc.php';
require_once 'header.inc.php';

if(isset($_POST['submit'])) {
	$user_id = 1;
	// $user_id = $_SESSION['user_id'];
	$budget = array();
	$category= array();
	$tag = array();
	
	if(isset($_POST['budget'])) { $budget = $_POST['budget']; }
	if(isset($_POST['category'])) { $category = $_POST['category']; }
	if(isset($_POST['tag'])) { $tag = $_POST['tag']; }
	if(isset($_POST['include_overhead'])) { $include_overhead=$_POST['include_overhead']; }
	
	echo '<pre><tt>';
	var_dump($budget);
	var_dump($category);
	if(empty($category)) { echo 'empty'; }
	var_dump($tag);
	var_dump($include_overhead);
	echo '</pre></tt>';
	
	$report = new Report();
	$result = $report->getReport($user_id, $budget, $category, $tag, $include_overhead);
	echo '<pre><tt>';
	var_dump($result);
	echo '</pre></tt>';
	echo '<table>';
	foreach ($result as $row) {
		$budget = new Budget();
		$budget_name = $budget->getById($row['budget_id']);
		echo '<tr>';
			echo '<td>' . $row['budget_id'] . '</td>';
			echo '<td>' . $row['name'] . '</td>';
			echo '<td>' . $row['category'] . '</td>';
		echo '</tr>';
	}
	echo '</table>';
}

?>
<form action="report.php" method="post">
	<ul>
		<li>
			<label>Budget Name(s):</label>
			<select id="budget" name="budget[]" multiple="multiple">
			<?php
			$user_id = 1;
			$budget = new Budget();
			$result = $budget->getByUser($user_id);
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
			</select>
		</li>
		<li>
			<label>Category Name(s):</label>
			<select id="category" name="category[]" multiple="multiple">
			<?php 
			$category = new Category();
			$result = $category->getByUser($user_id);
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
			?>
			</select>
		</li>
		<li>
			<label>Tag Name(s):</label>
			<select id="tag" name="tag[]" multiple="multiple">
			<?php 
			$tag = new Tag();
			$result = $tag->getByUser($user_id);
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
			?>
			</select>
		</li>
		<li>
			Include Overhead Items?
			Yes: <input type="radio" name="include_overhead" value="yes" />
			No: <input type="radio" name="include_overhead" value="no" checked="checked"/>
		</li>
		<li>
			<input type="submit" name="submit" value="Create Report" />
		</li>
	</ul>
</form>

<?php require_once 'footer.inc.php';?>

