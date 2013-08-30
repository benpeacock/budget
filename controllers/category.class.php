<?php
require_once('init.inc.php');

class Category extends DatabaseObject {
	
	const DB_TABLE = 'category';
	
	public $id;
	public $user_id;
	public $name;
	
	public function createCategory($user_id, $name) {
		$dbh = Database::getPdo();
		try {
			$created = date("Y-m-d H:i:s");
			$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, name) VALUES (:user_id, :name)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR,45);
			$stmt->execute();
			$return = $stmt->rowCount();
			if ($return == 1) {
					header('Location:dashboard.php');
				} elseif ($return != 1) {
					$message = 'Could not create category.';
				}
		}
		catch (PDOException $e) {
			echo 'Unable to create record: ' . $e->getMessage();
		}	
	}
	
	public function getCategories($user_id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . self::DB_TABLE . " WHERE user_id = :user_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->execute();
			$return = $stmt->fetchAll();
		}
		catch (PDOException $e) {
			echo 'Unable to create record: ' . $e->getMessage();
		}
	}
}