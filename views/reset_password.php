<form action="user.php" method="post">
	<input type="hidden" name="action" value="reset_password" />
	<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
	<input type="hidden" name="temp_hash" value="<?php echo $_GET['temp_hash']; ?>" />
	<label>New Password:</label><input type="password" name="password" required />
	<label>New Password Again:</label><input type="password" name="password_again" required />
	<input type="submit" name="submit" value="Submit" />
</form>