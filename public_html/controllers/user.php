<?php
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';
require_once ROOT . 'views/header.inc.php';

if (!isset($session->user_id) && $_GET['action'] != 'create_user') {
	include 'views/login_alert.php';
	exit();
}

if(isset($_POST['submit'])) {
	
	$action = $_POST['action'];
	
	switch ($action) {
		
		case 'create':
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				exit('Invalid e-mail address. <a href="user.php?action=create_user">Try Again</a>');
			}
			$username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
			if (!ctype_alnum($username)) {
				exit('Invalid username.  Letters and numbers only.  <a href="user.php?action=create_user">Try Again</a>');
			}
			if (strlen($username) > 45) {
				exit('Username max length is 45 characters.');
			}
			if (strlen($_POST['password']) < 8) {
				exit('Password not long enough.');
			}
			$password = trim(SHA1($_POST['password']));
			$user = new User();
			$result = $user->createUser($email, $username, $password);
			echo 'Result: ' . $result;
			echo '<br />';
			if ($result == 1) {
				$found_user = $user->authenticate($username, $password);
				if ($found_user) {
					$session->login($found_user);
					header('Location:dashboard.php');
				}
			}
			break;
		
		// Sends user a link they can use to reset their password.
		case 'reset_mail':
			if(!empty($_POST['email'])) {
				try {
					$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
					if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
						exit('Invalid e-mail address. <a href="user.php?action=reset_password">Try Again</a>');
					}
					$user = new User();
					$user = $user->findByEmail($email);
					$temp_hash = $user->makeHash($user->id);
					$email = new Email();
					$email = $email->passwordReset($user->username, $user->email, $temp_hash);
					header('Location: login.php');
				} catch (PDOException $e) {
					echo 'Error sending password reset email ' . $e->getMessage();
				}
			}
			break;
			
			// Accepts POSTed form data from user.php?action=reset_password link that's sent by e-mail to user
			case 'reset_password':
				if ($_POST['password'] != $_POST['password_again']) {
					exit('Passwords do not match.');
				} else {
					try {
						$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
						if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
							exit('Invalid e-mail address. <a href="user.php?action=reset_password">Try Again</a>');
						}
						$temp_hash = filter_input(INPUT_POST, 'temp_hash', FILTER_SANITIZE_STRING);
						if (filter_var($temp_hash, FILTER_VALIDATE_REGEXP, '^[a-zA-Z0-9]+$') == false) {
							exit ('Invalid temporary hash.  <a href="user.php?action=reset_password">Try Again</a>');
						}
						if (strlen($_POST['password']) < 8) {
							exit ('Password minimum length eight characters.');
						}
						$password = trim(SHA1($_POST['password']));
						$user = new User();
						$result = $user->resetPassword($email, $temp_hash, $password);
						// eventually replace following with JQUery in reset_password form
						if ($result == 1) {
							echo 'Password successfully reset.  Go to <a href="login.php">Login</a>.';
						} else {
							echo 'Password could not be reset.';
						}
					} catch (PDOException $e) {
						'Unable to reset password: ' . $e->getMessage();
					}
				}
				break;
	}
}


if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	// Displays field to input e-mail address for password reset
	switch ($action) {
		case 'forgot_password':
			include '../views/forgot_password.php';
			break;
			
	// Displays password reset fields 'password' and 'password again' where users input new password.
		case 'reset_password':
			include '../views/reset_password.php';
			break;
		
	// Displays user creation form
		case 'create_user':
			include '../views/create_user.php';
			break;
	}
}

require_once '../views/footer.inc.php';