<h2>Edit Category: <?php echo $category_result['name']; ?></h2>
<form action="category.php" method="post">
<ul>
	<input type="hidden" name="action" value="edit" />
	<input type="hidden" name="id" value="<?php echo $category_result['id']; ?>" /></li>
	<li><label>Category Name: </label><input type="text" name="name" value="<?php echo $category_result['name']; ?>" /></li>
	<li>
		<input type="submit" name="submit" value="Edit Category" />
		<a onclick="confirm(\'Delete item?\')" href="category.php?action=delete&id=<?php echo $id; ?>">Delete Category</a>
	</li>
</ul>
</form>