<div class="clearfix">
<form action="../controllers/login.php" method="post" class="form-signin">
	<h2 class="form-signin-heading">Please sign in</h2>
	<input type="text" class="form-control" placeholder="username" name="username" autofocus>
	<input type="password" class="form-control" placeholder="password" name="password">
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Log in</button>
	<button onclick="window.location='user.php?action=forgot_password'" type="button" style="margin: 20px 0 0 0;" class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Forgot Password?</button>
</form>
</div>