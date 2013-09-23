<div class="clearfix">
	<form action="user.php" method="post" class="form-signin">
		<h2 class="form-signin-heading">Email Address</h2>
		<input type="hidden" class="form-control" name="action" value="reset_mail" />
		<label class="sr-only" for="email">Email</label>
		<input type="email" class="form-control" name="email" placeholder="email address" maxlength="45" />
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Send Reset Email</button>
	</form>
</div>