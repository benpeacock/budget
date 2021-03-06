<?php
require_once dirname(__FILE__) . '../../../config.php';
require_once ROOT . 'models/init.inc.php';
require dirname(__FILE__) . '../../../vendor/autoload.php';
use Mailgun\Mailgun;

class Email extends DatabaseObject {
	
	public $username;
	public $address;
	public $temp_hash;
	
	public function passwordReset($username, $address, $temp_hash) {
		$mgClient = new Mailgun(MG_KEY);
		$domain = "accountabroad.com";
		
		$msg = 'Hi,' . PHP_EOL;
		$msg .= "\r\n";
		$msg .= 'You\'re receiving this because a password reset was requested for your account.' . PHP_EOL;
		$msg .= 'To reset your password, click (or copy and paste into your browser) the following link:' . PHP_EOL;
		$msg .= 'https://accountabroad.com/user/reset_password/' . $address . '/' . $temp_hash . PHP_EOL;
		$msg .= "\r\n";
		$msg .= 'Sincerely,' . PHP_EOL;
		$msg .= 'The Account Abroad Team' . PHP_EOL;
		$msg .= 'admin@accountabroad.com';
		
		$result = $mgClient->sendMessage("$domain",
		                  array('from'    => 'Account Abroad <admin@accountabroad.com>',
		                  		'to' => $username . ' <' . $address . '>',
		                        'subject' => 'Account Abroad Password Reset',
		                        'text'    => $msg
		                  		));
	}
} // ends Email class