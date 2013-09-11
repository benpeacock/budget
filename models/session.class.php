<?php
require_once('init.inc.php');

class Session {
	
	/**
	 * Records whether or not a user is currently logged in.  Used on by Session class.
	 * @var bool
	 */
	private $logged_in = false;
	
	/**
	 * User id passed to other parts of application through $_SESSION['used_id']
	 * @var int
	 */
	public $user_id;
	
	/**
	 * Automatically begins or continues session. Checks on each page whether user is logged in.
	 */
	public function __construct() {
	session_start();
	$this->_checkLogin();
	}
	
	/**
	 * Checks if user is logged in.  Private so that $logged_in can't be directly manipulated.
	 */
	private function _checkLogin() {
		if (isset($_SESSION['user_id'])) {
			$this->user_id = $_SESSION['user_id'];
			$this->logged_in = true;
		} else {
			unset ($this->user_id);
			$this->logged_in = false;
		}
	}
	
	/**
	 * Returns value of checkLogin(), but in public format.
	 * Allows rest of app to see logged in status without affecting it through checkLogin()
	 * @return boolean
	 */
	public function isLoggedIn() {
		return $this->logged_in;
	}
	
	/**
	 * Logs user in.  User::authenticate() passes user record as object to this function.
	 * @param object $user
	 */
	public function login($user) {
		if ($user) {
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->logged_in = true;
		}
	}
	
	/**
	 * Unsets session id and user id.
	 */
	public function logout() {
		unset ($_SESSION['user_id']);
		unset ($this->user_id);
		$this->logged_in = false;
	}

}  // end Session class