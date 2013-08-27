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
	
	public function createOverheadItem($user_id, $name, $category, $tag, $note ='') {
		$dbh = Database::getPdo();
		try {
			$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, name, category, tag, note) VALUES ";
			$sql .= "(:user_id, :name, :category, :tag, :note)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
 			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':category', $category);
			$stmt->bindParam(':tag', $tag);
			$stmt->bindParam(':note', $note);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		} catch (PDOException $e) {
			'Could not create overhead item ' . $e->getMessage();
		}
		
		
	}
} // ends OverheadItem class