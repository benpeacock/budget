<div class="clearfix">
	<div class="container">
		<div class="col-lg-4">
			<h2>Edit Category: <?php echo $category_result['name']; ?></h2>
			<form action="category.php" method="post" class="form-horizontal">
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="id" value="<?php echo $category_result['id']; ?>" />
				<label class="sr-only" for="name">Category Name</label>
				<input type="text" pattern="^[a-zA-Z0-9]+$" maxlength="45" class="form-control input-lg" name="name" placeholder="<?php echo $category_result['name']; ?>" />
				<span class="help-block">a-Z, 0-9 only, 45 characters max length</span>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Edit Category</button>
				<div class="row">
				<div class="col-md-4">
					<a href="dashboard.php">Cancel</a>
				</div>
					<div class="col-md-4 pull-right">
						<a onclick="confirm(\'Delete category?\')" href="category.php?action=delete&id=<?php echo $category_result['id']; ?>">Delete Category</a>
					</div>
				</div>
			
			
			</form>
		</div>
	</div>
</div>