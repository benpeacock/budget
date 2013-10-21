<?php
require_once('init.inc.php');

class Category extends DatabaseObject {
	
	const DB_TABLE = 'category';
	
	public $id;
	public $user_id;
	public $name;
	
	/**
	* Creates a new categroy record in database
	* @param int $user_id, string $name
	* @return bool
	*/
	public function createCategory($user_id, $name) {
		$dbh = Database::getPdo();
		try {
			$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, name) VALUES (:user_id, :name)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR,45);
			$stmt->execute();
			$return = $stmt->rowCount();
			if ($return == 1) {
					header('Location:/dashboard');
				} elseif ($return != 1) {
					$message = 'Could not create category.';
				}
		}
		catch (PDOException $e) {
			echo 'Unable to create record: ' . $e->getMessage();
		}	
	}
	
	/**
	* Retrieves all fields for all category records by user
	* @param int $user_id
	* @return categories as array
	*/
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
	
	/**
	* Returns one category record from database as an object
	* @param int $id
	* @return category as object
	*/
	public function getCategoryObjectById($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . self::DB_TABLE . " WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$category = new Category();
			$stmt->setFetchMode(PDO::FETCH_INTO, $category);
			$result = $stmt->fetch();
			return $result;
		} catch (PDOException $e) {
			echo 'Unable to retrieve record ' . $e->getMessage();
		}
	}
	
} // ends category class