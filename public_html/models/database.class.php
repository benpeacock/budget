<?php
require_once dirname(__FILE__) . '../../../config.php';
require_once('init.inc.php');

class Database {

	private static $_pdo;

	/**
	 * Get PDO connection by calling Database::getPdo()
	 * @return db connection
	 */
	public static function getPdo() {
		if (!self::$_pdo) {
			try {
				self::$_pdo = new PDO('mysql:host=localhost;dbname=budget', DB_USER, DB_PASS);
			} catch (PDOException $e) {
				echo 'Connection to database failed: ' . $e->getMessage();
			}
		}
		return self::$_pdo;
	}
	
	/**
	* Tests whether application is able to access database
	* @return string
	*/
	public static function databaseTest() {
		$dbh = Database::getPdo();
		if(isset($dbh)) {
			echo 'database is working';
		} else {
			echo 'database NOT working';
		}
	}
	
} //end Database class
