<?php

require_once('init.inc.php');

class User extends DatabaseObject {
	
	const DB_TABLE = 'user';
	
	public $id;
	public $email;
	public $username;
	public $password;
	public $temp_hash;
	
	
	/**
	 * Creates a new user in db
	 * @param string email
	 * @param string $username
	 * @param hashed string $password
	 * @return user instance
	 */
	public function createUser($email, $username, $password) {
			$dbh = Database::getPdo();
			try {
				$sql = "INSERT INTO user (email, username, password) VALUES 
						(:email, :username, :password)";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':password', $password);
				$stmt->execute();
				$result = $stmt->rowCount();
				return $result;
			} catch (PDOException $e) {
				echo 'Unable to create user' . $e->message;
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
				echo 'Unable to authenticate user' . $e->message;
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
				$result = $stmt->fetch();
				return $result;
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
		
		public function resetPassword($email, $temp_hash, $password) {
			$dbh = Database::getPdo();
			try {
				$hashed_pass = sha1($password);
				$sql = "UPDATE " . self::DB_TABLE . " SET password = :hashed_pass WHERE email = :email AND temp_hash = :temp_hash";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':hashed_pass', $hashed_pass);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':temp_hash', $temp_hash);
				$stmt->execute();
				$result = $stmt->rowCount();
					// remove temporary hash that was sent to the user so that it can't be re-used
					try {
						$sql = "UPDATE " . self::DB_TABLE . " SET temp_hash=''";
						$dbh->query($sql);
					} catch (PDOException $e) {
						echo 'Unable to delete temp hash ' . $e->getMessage();
					}
				return $result;
			} catch (PDOException $e) {
				echo 'Could not reset password: ' . $e->getMessage();
			}
		}
}