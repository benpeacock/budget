<div class="clearfix">
<form action="/user" method="post" class="form-signin">
	<h2 class="form-signin-heading">Select Password</h2>
	<input type="hidden" name="action" value="reset_password" />
	<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
	<input type="hidden" name="temp_hash" value="<?php echo $_GET['temp_hash']; ?>" />
	<label class="sr-only" for="password">New Password:</label>
	<input type="password" name="password" pattern = ".{8,}" placeholder="new password" class="form-control" required />
	<span class="help-block">Min 8 characters</span>
	<label class="sr-only" for="password_again">New Password Again:</label>
	<input type="password" name="password_again" pattern = ".{8,}" placeholder="new password again" class="form-control" required />
	<span class="help-block">Passwords must match</span>
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Reset Password</button>
</form>
</div>