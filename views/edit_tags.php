<h2>Edit Tag: <?php echo $result['name']; ?></h2>
<form action="tag.php" method="post">
<ul>
	<input type="hidden" name="action" value="edit" />
	<input type="hidden" name="id" value="<?php echo $result['id']; ?>" /></li>
	<li><label>Tag Name: </label><input type="text" name="name" value="<?php echo $result['name']; ?>" /></li>
	<li>
		<input type="submit" name="submit" value="Edit Tag" />
		<a onclick="confirm(\'Delete item?\')" href="tag.php?action=delete&id=<?php echo $id; ?>">Delete Tag</a>
	</li>
</ul>
</form>