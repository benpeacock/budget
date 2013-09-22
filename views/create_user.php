<div class="clearfix">
	<form action="user.php" method="post" class="form-signin">
	<h2 class="form-signin-heading">Create Account</h2>
		<input type="hidden" name="action" value="create" />
		<input type="email" class="form-control" name="email" placeholder="email" />
		<input type="text" name="username" class="form-control" id="username" placeholder="username" />
		<input type="password" name="password" class="form-control" id="password" placeholder="password" />
		<input type="password" name="password_twice" class="form-control" id="password_twice" placeholder="password again" />
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create Account</button>
	</form>
</div>