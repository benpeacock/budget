<div class="clearfix">
	<div class="container">
		<div class="col-lg-4">
			<h2>Create Tag</h2>
			<form action="tag.php" method="post" class="form-horizontal">
				<div class="control-group">
					<input type="hidden" name="action" value="create" />
					<label class="sf-only" for="name">Tag Name</label>
					<input type="text" name="name" pattern="^[a-zA-Z0-9]+$" maxlength="45" class="form-control input-lg" placeholder="tag name" required />
					<span class="help-block">a-Z, 0-9 only, 45 characters max length</span>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create Tag</button>
				</div>
			</form>
		</div>
	</div>
</div>