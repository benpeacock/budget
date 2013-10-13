<form action="/user" method="post">
	<input type="hidden" name="action" value="reset_password" />
	<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
	<input type="hidden" name="temp_hash" value="<?php echo $_GET['temp_hash']; ?>" />
	<label class="sr-only" for="password">New Password:</label>
	<input type="password" name="password" placeholder="new password" required />
	<label class="sr-only" for="password-again">New Password Again:</label>
	<input type="password" name="password-again" placeholder="new password again" required />
	<input type="submit" name="submit" value="Submit" />
</form>