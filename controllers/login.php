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

require_once('../views/header.inc.php');
?>

<?php include '../views/login_form.php'; ?>

<?php require_once('../views/footer.inc.php'); ?>


