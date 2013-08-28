<?php 
require_once('../controllers/init.inc.php');
require_once('header.inc.php');
$user_id = $_SESSION['user_id'];
?>

<div id="budget_list">
<h2>My Budgets</h2>
<ul>
<?php
$budget = new Budget;
$records = $budget->getByUser($user_id);
foreach ($records as $row) {
	echo '<li><a href="budget.php?action=display&id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
}
?>
<a href="budget.php?action=create">+ Create new budget</a>
</ul>
</div>

<div id="overhead_item_list">
<h2>My Overhead Items</h2>
<ul>
<?php
$overhead_item = new OverheadItem();
$records = $overhead_item->getByUser($user_id);
foreach ($records as $row) {
	echo '<li><a href="overhead.php?id = ' . $row['id'] . '">' . $row['name'] . '</a></li>';
}
?>
<a href="overhead.php?action=create_item">+ Create New Overhead Item</a>
</ul>
</div>

<div id="tag_list">
<h2>My Tags</h2>
<?php

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



