<div class="clearfix">
	<div class="container">
		<div class="col-lg-4">
			<h2>Create Category</h2>
			<form action="category.php" method="post" class="form-horizontal">
				<div class="control-group">
					<input type="hidden" name="action" value="create" />
					<label class="sf-only" for="name">Category Name</label>
					<input type="text" name="name" pattern="^[a-zA-Z0-9]+$" maxlength="45" class="form-control input-lg" placeholder="category name" required />
					<span class="help-block">a-Z, 0-9 only, 45 characters max length</span>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create Category</button>
				</div>
			</form>
</div>
</div>
</div>