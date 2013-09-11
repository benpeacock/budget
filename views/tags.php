<?php require_once('../models/init.inc.php'); ?>
<h2>Tags</h2>
<p><a href="../controllers/tag.php?action=create">+ Create new tag</a></p>
<h3>My Tags</h3>
<ul>
<?php 
	foreach ($result as $row) {
		echo '<li><a href="tag.php?action=edit&id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
		}
?>
</ul>
