<h2>Edit Budget: <?php echo $result['name']; ?></h2>
<form action="budget.php" method="post">
<ul>
	<input type="hidden" name="action" value="edit" />
	<input type="hidden" name="id" value="<?php echo $result['id']; ?>" /></li>
	<li><label>Budget Name: </label><input type="text" name="name" value="<?php echo $result['name']; ?>" /></li>
	<li>
		<input type="submit" name="submit" value="Edit Budget" />
		<a onclick="confirm(\'Delete item?\')" href="budget.php?action=delete&id=<?php echo $id; ?>">Delete Budget</a>
	</li>
</ul>
</form>