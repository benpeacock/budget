<?php

require_once('init.inc.php');

class User extends DatabaseObject {
	
	public $id;
	public $first_name;
	public $last_name;
	public $username;
	public $password;
	/**
	 * A hash of current timestamp that's re-written everytime User::makeHash() is called.
	 * @var string - VARCHAR(40)
	 */
	public $temp_hash;
	
	
	/**
	 * Creates a new user in db
	 * @param string $username
	 * @param hashed string $password
	 * @param string $first_name
	 * @param string $last_name
	 */
	public function createUser($username, $password, $first_name, $last_name) {
		
		if(empty($first_name) || empty($last_name) || empty($username) || empty($password)) {
			$message = 'Must complete all required fields.';
			break;
		} else {
			$dbh = Database::getPdo();
			try {
				$sql = "INSERT INTO user (username, password, first_name, last_name) VALUES 
						(:username, :password, :first_name, :last_name)";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':first_name', $first_name);
				$stmt->bindParam(':last_name', $last_name);
				$stmt->execute();
				$result = $stmt->rowCount();
				if ($result == 1) {
					$message = 'User succesfully created.';
					return $message;
				}
			}
				catch (PDOException $e) {
					$message = 'Unable to create user' . $e->message;
				}
		}
	}
	
	/**
	 * Checks input of login.php against existing db records
	 * @param string $username
	 * @param string $password
	 * @return instance of User object from db
	 */
	public function authenticate($username='', $password='') {
		$dbh = Database::getPdo();
		try {
				$sql = "SELECT * FROM user WHERE username = :username and password = :password LIMIT 1";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':username', $username, PDO::PARAM_STR);
				$stmt->bindParam(':password', $password);
				$stmt->execute();
				$user = new User();
				$stmt->setFetchMode(PDO::FETCH_INTO, $user);
				$result = $stmt->fetch();
				return $result;
 			} 
			catch (PDOException $e) {
				$message = 'Unable to authenticate user' . $e->message;
			}
		}
		
		/**
		 * Look up user by e-mail address
		 * @param string $email
		 * @return User object - e-mail addresses not stored in the db generate an empty object.
		 */
		public function findByEmail($email) {
			$dbh = Database::getPdo();
			try {
				$sql = "SELECT * FROM user WHERE email = :email";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':email', $email);
				$stmt->execute();
				$user = new User();
				$stmt->setFetchMode(PDO::FETCH_INTO, $user);
				$stmt->fetch();
				return $user;
			}
			catch (PDOException $e) {
				echo 'Unable to locate record ' . $e->message();
			}
		}
		
		/**
		 * Hashes current timestamp and writes it to the temp_hash field for a user in db.
		 * @param int $id
		 * @return string
		 */
		public function makeHash($id) {
			$dbh = Database::getPdo();
			try {
				$hash = sha1(time());
				$sql = "UPDATE user SET temp_hash = :hash WHERE id = :id";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':hash', $hash);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				return $hash;
			}
			catch (PDOException $e) {
				echo 'Unable to create hash ' . $e->message();
			}
		}
}