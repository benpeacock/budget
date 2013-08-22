<?php 
require_once('../controllers/init.inc.php');
require_once('header.inc.php');
?>

<div id="budget_list">
<h2>My Budgets</h2>
<?php
$user_id = $_SESSION['user_id'];
$budget = new Budget;
$records = $budget->getByUser($user_id);
echo '<ul>';
foreach ($records as $row) {
	echo '<li><a href="budget.php?id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
}
?>
</ul>
<a href="budget.php?action=create">+ Create new budget</a>
</div>

<div id="tag_list">
<h2>My Tags</h2>
<?php
$user_id = $_SESSION['user_id'];
$tag = new Tag;
$records = $tag->getByUser($user_id);
echo '<ul>';
foreach ($records as $row) {
	echo '<li><a href="tag.php?id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
}
?>
<a href="tag.php?action=create">+ Create new tag</a>
</div>

<div id="tag_list">
<h2>My Categories</h2>
<?php
$user_id = $_SESSION['user_id'];
$category = new Category;
$records = $category->getByUser($user_id);
echo '<ul>';
foreach ($records as $row) {
	echo '<li><a href="category.php?id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
}
?>
<a href="category.php?action=create">+ Create new category</a>
</div>



