<?php
require_once('init.inc.php');

class Database {

	private static $_pdo;

	const DB_USER = 'root';

	const DB_PASS = 'password';

	/**
	 * Get PDO connection by calling Database::getPdo()
	 * @return db connection
	 */
	public static function getPdo() {
		if (!self::$_pdo) {
			try {
				self::$_pdo = new PDO('mysql:host=localhost;dbname=budget', self::DB_USER, self::DB_PASS);
			} catch (PDOException $e) {
				echo 'Connection to database failed: ' . $e->getMessage();
			}
		}
		return self::$_pdo;
	}
	
	public static function databaseTest() {
		$dbh = Database::getPdo();
		if(isset($dbh)) {
			echo 'database is working';
		} else {
			echo 'database NOT working';
		}
	}
	
} //end Database class
