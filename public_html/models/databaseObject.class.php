<?php
require_once('init.inc.php');

abstract class DatabaseObject {
	
	const DB_TABLE = 'abstract';
	
	/**
	 * Common method for all classes to get an object by id
	 * @param int $id
	 * @return multitype: row from db
	 */
	public function getById($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . static::DB_TABLE . " WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch (PDOException $e) {
			$message =  'Unable to locate record: ' . $e->getMessage();
		}
	}
	
	/**
	* Returns record from database by id
	* @param int ($id)
	* @return database object as an array
	*/
	public function getOneById($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . static::DB_TABLE . " WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch();
			return $result;
		}
		catch (PDOException $e) {
			$message =  'Unable to locate record: ' . $e->getMessage();
		}
	}

	/**
	 * Looks up record by name
	 * @param string $name
	 * @return multitype: returns empty if no record is located or returns the row from database if name is found.
	 */
	public function getByName($user_id, $name) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . static::DB_TABLE . " WHERE user_id = :user_id AND name = :name";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch (PDOException $e) {
			$message =  'Unable to locate record: ' . $e->getMessage();
		}
	}
	
	/**
	 * Returns all records from a table by user id
	 * @param int $user_id
	 * @return array of records
	 */
	public function getByUser($user_id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . static::DB_TABLE . " WHERE user_id = :user_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch (PDOException $e) {
			$message = 'Unable to retrieve records: ' . $e->getMessage();
		}
	}
	
	/**
	 * Gets list of tags or categories (depending on class it's being called through) by user id.
	 * Used to populate x-editable values 'name' and 'value'
	 * @param int $user_id
	 * @return array of id =>name for each tag or category as value=>text
	 */
	public function getTagCatByUser($user_id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT id as value, name as text FROM " . static::DB_TABLE . " WHERE user_id = :user_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$cast_array = array();
			foreach ($result as $row) {
				$cast_array[] = array('value' => (int) $row['value'], 'text' => $row['text']);
			}
			return $cast_array;
		}
		catch (PDOException $e) {
			$message = 'Unable to retrieve records: ' . $e->getMessage();
		}
	}
	
	/**
	 * Common method to delete a single record from the database by id
	 * @param int $id
	 * @return number of affected rows
	 */
	public function deleteRecord($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "DELETE FROM " . static::DB_TABLE . " WHERE id = :id LIMIT 1";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}
		catch (PDOException $e) {
			$message =  'Unable to locate record: ' . $e->getMessage();
		}
	}
	
	/**
	* Finds records by id, then updates the name field of the record in database
	* @param int $id
	* @return int affected rows
	*/
	public function updateById($id, $name) {
		$dbh = Database::getPdo();
		try {
			$sql = "UPDATE " . static::DB_TABLE . " SET name = :name WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		} catch (PDOException $e) {
			'Unable to update ' . static::DB_TABLE . ': ' . $e->getMessage();
		}
	}
	
} //end DatabaseObject class