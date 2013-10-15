<div class="clearfix">
	<div class="container">
		<div class="col-lg-4">
			<h2>Edit Budget: <?php echo $result['name']; ?></h2>
			<form action="/budget" method="post" class="form-horizontal">
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="id" value="<?php echo $result['id']; ?>" />
				<label class="sf-only" for="name">Budget Name</label>
				<input type="text" name="name" pattern="^[a-zA-Z0-9]+$" maxlength="45" class="form-control input-lg" placeholder="<?php echo $result['name']; ?>" required />
				<span class="help-block">a-Z, 0-9 only, 45 characters max length</span>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Edit Budget</button>
				<div class="row">
				<div class="col-md-4">
					<a href="/dashboard">Cancel</a>
				</div>
				<div class="col-md-4 pull-right">
					<a onclick="confirm(\'Delete item?\')" href="/budget/delete/<?php echo $id; ?>">Delete Budget</a>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>