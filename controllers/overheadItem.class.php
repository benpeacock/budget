<?php
require_once('init.inc.php');

class OverheadItem extends DatabaseObject {
	
	const DB_TABLE = 'overhead_item';
	
	public $id;
	public $user_id;
	public $name;
	public $category;
	public $tag;
	public $note;
	// I've got a total field in the db.  Get rid of it?
	
	public function createOverheadItem($user_id, $name, $category, $tag, $note ='', $total) {
		$dbh = Database::getPdo();
		try {
			$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, name, category, tag, note, total) VALUES ";
			$sql .= "(:user_id, :name, :category, :tag, :note, :total)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
 			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':category', $category);
			$stmt->bindParam(':tag', $tag);
			$stmt->bindParam(':note', $note);
			$stmt->bindParam(':total', $total);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		} catch (PDOException $e) {
			'Could not create overhead item ' . $e->getMessage();
		}
	}
	
	public function displayOverheadItem($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM overhead_item WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch();
			return $result;
		} catch (PDOException $e) {
			echo 'error';
		}
	}
	
	public function updateOverheadItem($id, $name, $category, $tag, $note = '', $total) {
		$dbh = Database::getPdo();
		try {
			$sql = "UPDATE overhead_item SET total = :total, name = :name, category = :category, tag = :tag, note = :note WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':category', $category);
			$stmt->bindParam(':tag', $tag);
			$stmt->bindParam(':note', $note);
			$stmt->bindParam(':total', $total);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		} catch (PDOException $e) {
			echo 'Unable to edit overhead item ';
		}
	}

} // ends OverheadItem class