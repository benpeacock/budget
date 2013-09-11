<?php
require_once('../models/init.inc.php');

$session = new Session();

if (isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$hash_me = trim($_POST['password']);
	$password = sha1($hash_me);
	$user = new User();
	$found_user = $user->authenticate($username, $password);
	if ($found_user) {
		$session->login($found_user);
		header('Location:dashboard.php');
	} else {
		$message = 'Could not log in.';
	}
}

require_once('header.inc.php');
?>
<form action="login.php" method="post">
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
<input type="submit" name="submit" value="login" />
</form>
<a href="user.php?action=forgot_password">Forgot password?</a>

<?php require_once('footer.inc.php'); ?>


