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
	
	/**
	* Returns a single overhead item record form the database
	* @param int $id
	* @return
	*/
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
	
	/**
	 * Gets budget-specific amounts from overhead costs
	 * @param int $budget_id
	 * @return multitype: overhead item name, category, tag and note.  Also looks in overhead_split table for splits assigned
	 * to item, and multiplies the split by the item total (returns as split_total) if there are any splits assigned to the
	 * budget being used.
	 */
	public function displayOverheadByBudget($budget_id) {
		$dbh = Database::getPDO();
		try {
			$sql = "SELECT overhead_item.name as name, category.name as category, tag.name as tag, percent_of_total*total as split_total, note FROM overhead_split 
INNER JOIN overhead_item ON overhead_split.overhead_item_id=overhead_item.id 
INNER JOIN category ON overhead_item.category = category.id 
INNER JOIN tag ON overhead_item.tag = tag.id 
WHERE overhead_split.budget_id=:budget_id;";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}	catch (PDOException $e) {
			echo 'Unable to get overhead splits by budget ' . $e->getMessage();
		}
	}

} // ends OverheadItem class