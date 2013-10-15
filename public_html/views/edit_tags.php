<div class="clearfix">
	<div class="container">
		<div class="col-lg-4">
			<h2>Edit Tag: <?php echo $tag_result['name']; ?></h2>
			<form action="/tag" method="post" class="form-horizontal">
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="id" value="<?php echo $tag_result['id']; ?>" />
				<label class="sr-only" for="name">Tag Name</label>
				<input type="text" pattern="^[a-zA-Z0-9]+$" maxlength="45" class="form-control input-lg" name="name" placeholder="<?php echo $tag_result['name']; ?>" />
				<span class="help-block">a-Z, 0-9 only, 45 characters max length</span>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Edit Tag</button>
				<div class="row">
				<div class="col-md-4">
					<a href="/dashboard">Cancel</a>
				</div>
					<div class="col-md-4 pull-right">
						<a onclick="return confirm('Delete tag?')" href="/tag/delete/<?php echo $tag_result['id']; ?>">Delete Tag</a>
					</div>
				</div>
			
			
			</form>
		</div>
	</div>
</div>