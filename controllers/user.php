<?php
require_once('../models/init.inc.php');
require_once '../views/header.inc.php';

if (!empty($message)) {
	echo $message;
}

if(isset($_POST['submit'])) {
	
	$action = $_POST['action'];
	
	switch ($action) {
		
		case 'create':
			$email = trim($_POST['email']);
			echo $email;
			echo '<br />';
			$username = trim($_POST['username']);
			echo $username;
			echo '<br />';
			$password = trim(SHA1($_POST['password']));
			echo $password;
			echo '<br />';
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
				
			} else {
				echo 'Couldn\'t retrieve user id.';
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
					header('Location: login.php');
				} catch (PDOException $e) {
					echo 'Error sending password reset email ' . $e->getMessage();
				}
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
		
	// Displays user creation form
		case 'create_user':
			include '../views/create_user.php';
			break;
	}
}

require_once '../views/footer.inc.php';