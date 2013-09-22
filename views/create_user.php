<div class="clearfix">
	<form action="user.php" method="post" class="form-signin">
	<h2 class="form-signin-heading">Sign up.  It's free.</h2>
		<input type="hidden" name="action" value="create" />
		<input type="email" class="form-control" name="email" placeholder="email" maxlength="45" required />  <span style="float:right;">No spam.  We promise.</span>
		<input type="text" pattern="^[a-zA-Z0-9]+$" name="username" class="form-control" id="username" placeholder="username" maxlength="45" required /> A-Z, 0-9 only, 45 characters max length
		<input type="password" pattern = ".{8,}" name="password" class="form-control" id="password" placeholder="password" required /> Min 8 characters
		<input type="password" pattern = ".{8,}" name="password_twice" class="form-control" id="password_twice" placeholder="password again" required />
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create Account</button>
	</form>
</div>