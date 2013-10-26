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
				<button onclick="window.location='/dashboard'" type="button" style="margin: 20px 0 0 0;" class="btn btn-sm btn-default btn-block" >Cancel</button>
				<button onclick="if(confirm('Delete this tag?')) window.location='/tag/delete/<?php echo $tag_result['id']; ?>';" type="button" style="margin: 20px 0 0 0;" class="btn btn-sm btn-default btn-block">Delete</button>
			
			
			</form>
		</div>
	</div>
</div>