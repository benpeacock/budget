<?php require_once('../models/init.inc.php'); ?>
<h2>Categories</h2>
<p><a href="category.php?action=create">+ Create new category</a></p>
<h3>My Categories</h3>
<ul>
<?php 
	foreach ($result as $row) {
		echo '<li><a href="category.php?action=edit&id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
		}
?>
</ul>