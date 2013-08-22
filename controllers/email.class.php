<?php

class Email extends DatabaseObject {
	
	public $address;
	public $message;
	
	public function passwordReset($address, $temp_hash) {
		$message = 'You\'re receiving this e-mail because a user requested a password reset for the account associated with this e-mail address.';
		$message .= 'If you didn\'t request a password resent, simply ignore this e-mail.';
		$message .= 'To reset your password, click the following link, or copy it and paste it into the address bar of your web browser: ';
		$message .= '<a href="http://localhost:8888/budget_new/views/user.php?email=' . $address . '&temp_hash=' . $temp_hash . '">Link</a>';
		
		$subject = 'Password Reset for your [app name] account';
		$headers = 'From: admin@appname.com' . "\r\n" .
				'Reply-To: admin@appname.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		
		mail($address, $subject, $message, $headers);
	}
} // ends Email class