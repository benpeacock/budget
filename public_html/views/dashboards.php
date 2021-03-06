<div class="container">
	<div id="budget_list" class="col-md-4">
		<h2>My Budgets</h2>
		<button type="button" class="btn btn-md" onclick="location.href='/budget/create'">Create New Budget</button>
		<ul>
		<?php 
		$budget = new Budget;
		$records = $budget->getByUser($session->user_id);
		foreach ($records as $row) {
			echo '<li><a href="/budget/display/' . $row['id'] . '">' . $row['name'] . '</a></li>';
		}
		?>
		</ul>
	</div>
		
		<!-- <div id="overhead_item_list"> -->
		<!-- <h2>My Overhead Items</h2> -->
		<!-- <ul> -->
		<?php
		// $overhead_item = new OverheadItem();
		// $records = $overhead_item->getByUser($user_id);
		// foreach ($records as $row) {
		// 	echo '<li><a href="overhead.php?action=display&id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
		// }
		// ?>
		<!-- <a href="overhead.php?action=create_item">+ Create New Overhead Item</a> -->
		<!-- </ul> -->
		<!-- </div> -->
		
	<div id="tag_list" class="col-md-4">
		<h2>My Tags</h2>
		<button type="button" class="btn btn-md" onclick="location.href='/tag/create'">Create New Tag</button>
		<ul>
		<?php
		$tag = new Tag;
		$records = $tag->getByUser($session->user_id);
		foreach ($records as $row) {
			echo '<li><a href="tag/edit/' . $row['id'] . '">' . $row['name'] . '</a></li>';
		}
		?>
		</ul>
	</div>
	<div id="category_list" class="col-md-4">
		<h2>My Categories</h2>
		<button type="button" class="btn btn-md" onclick="location.href='/category/create'">Create New Category</button>
		<ul>
		<?php
		$user_id = $session->user_id;
		$category = new Category;
		$records = $category->getByUser($session->user_id);
		foreach ($records as $row) {
			echo '<li><a href="category/edit/' . $row['id'] . '">' . $row['name'] . '</a></li>';
		}
		?>
		</ul>
	</div>
</div>