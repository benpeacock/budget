<?php
require_once('../models/init.inc.php');
require_once '../views/header.inc.php';

if(isset($_POST['submit'])) {
	
	$action = $_POST['action'];
	
	switch ($action) {
		
		case 'create':
		if ($_POST['password'] != $_POST['password_twice']) {
			$message = 'Passwords do not match';
		} elseif ($_POST['password'] == $_POST['password_twice']) {
			$username = trim($_POST['username']);
			$password = trim(SHA1($_POST['password']));
			$first_name = trim($_POST['first_name']);
			$last_name = trim($_POST['last_name']);
			$user = new User();
			$user->createUser($username, $password, $first_name, $last_name);
		}
			break;
		
		// Sends user a link they can use to reset their password.
		case 'reset_mail':
			if(!empty($_POST['email'])) {
				try {
					$email = $_POST['email'];
					$user = new User();
					$user = $user->findByEmail($email);
					$temp_hash = $user->makeHash($user->id);
					$email = new Email();
					$email = $email->passwordReset($user->username, $user->email, $temp_hash);
					$message = 'Password reset e-mail sent.';
				} catch (PDOException $e) {
					echo 'Error sending password reset email ' . $e->getMessage();
				}
			} else {
				$message = 'You must enter an e-mail address.';
			}
			break;
			
			// Accepts POSTed form data from user.php?action=reset_password link that's sent by e-mail to user
			case 'reset_password':
				if ($_POST['password'] != $_POST['password_again']) {
					echo 'Passwords do not match.';
				} else {
					try {
						$email = $_POST['email'];
						$temp_hash = $_POST['temp_hash'];
						$password = $_POST['password'];
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
	}
}

require_once '../views/footer.inc.php';