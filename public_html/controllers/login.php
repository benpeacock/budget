<?php
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';

if (isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$hash_me = trim($_POST['password']);
	$password = sha1($hash_me);
	$user = new User();
	$found_user = $user->authenticate($username, $password);
	if ($found_user) {
		$session->login($found_user);
		header('Location:/dashboard');
	} else {
		echo 'Could not log in.';
	}
}

require_once ROOT . 'views/header.inc.php';
include ROOT . 'views/login_form.php';
require_once ROOT . 'views/footer.inc.php';
?>


