<?php require_once '../controllers/init.inc.php';
require_once 'header.inc.php';
?>
<form action="report.php" method="post">
	<ul>
		<li>
			<label>Budget Name(s):</label>
			<select id="budget" name="budget" multiple="multiple">
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
			<select id="category" name="category" multiple="multiple">
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
			<select id="tag" name="tag" multiple="multiple">
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
		</li>
		<li>
			<input type="submit" name="submit" value="Create Report" />
		</li>
	</ul>
</form>

<?php require_once 'footer.inc.php';?>

