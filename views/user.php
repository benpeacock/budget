<?php
require_once('../controllers/init.inc.php');

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
		
		case 'reset_mail':
			if(!empty($_POST['email'])) {
				$email = $_POST['email'];
				$user = new User();
				$user = $user->findByEmail($email);
				echo '<pre><tt>';
				var_dump($user);
				$temp_hash = $user->makeHash($user->id);
				var_dump($temp_hash);
				echo '</pre></tt>';
				$email = new Email();
				$email = $email->passwordReset($user->email, $temp_hash);
				$message = 'Password reset e-mail sent.';
			} else {
				$message = 'You must enter an e-mail address.';
			}
	}
}


if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	switch ($action) {
		case 'forgot_password':
			$message = '<form action="user.php" method="post">
				<input type="hidden" name="action" value="reset_mail" />
				<input type="text" name="email" />
				<input type="submit" name="submit" value="submit" />
				</form>';
			
// 		case 'reset_password':
// 			$message = '<form action="user.php" method="post">
// 				<input type="hidden" name="action" value="reset_mail" />
// 				<input type="text" name="email" />
// 				<input type="submit" name="submit" value="submit" />
// 				</form>';
	}
}

require_once 'header.inc.php';
if (!empty($message)) {
	echo $message;
}

require_once 'footer.inc.php';