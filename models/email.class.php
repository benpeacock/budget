<?php
require_once('init.inc.php');
require '../vendor/autoload.php';
use Mailgun\Mailgun;

class Email extends DatabaseObject {
	
	public $address;
	public $temp_hash;
	
	public function passwordReset($username, $address, $temp_hash) {
		$mgClient = new Mailgun('key-6pfc3ghhk9rk4dtl4ws9a4b9fp2nwl12');
		$domain = "budget.mailgun.org";
		
		$msg = 'Hi, you\'re receiving this because a password reset was requested for your account. ';
		$msg .= 'To reset your password, click (or copy and paste into your browser) the following link: ';
		$msg .= 'http://192.241.227.8/budget/controllers/user.php?action=reset_password&email=' . $address . '&temp_hash=' . $temp_hash;
		
		$result = $mgClient->sendMessage("$domain",
		                  array('from'    => 'Admin <me@budget.mailgun.org>',
		                  		'to' => $username . ' <' . $address . '>',
		                        'subject' => 'Hello',
		                        'text'    => $msg
		                  		));
	}
} // ends Email class