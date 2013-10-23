<?php
require_once dirname(__FILE__) . '../../../config.php';
require_once ROOT . 'models/init.inc.php';

class Item extends DatabaseObject {
	
	const DB_TABLE = 'item';
	
	public $id;
	public $user_id;
	public $budget_id;
	public $name;
	public $category;
	public $tag;
	public $note;
	public $created;
	
	/**
	 * Creates a new item record.  
	 * @param int $user_id
	 * @param int $budget_id
	 * @param string $name
	 * @param int $category
	 * @param int $tag
	 * @param float $amount
	 * @param string $note
	 * @return int $result 
	 */
	public function addItem($user_id, $budget_id, $name, $category, $tag, $amount, $note) {
		$dbh = Database::getPdo();
		try {
			$sql = "INSERT INTO " . self::DB_TABLE . "(";
			$sql .= "user_id, budget_id, name, ";
			if (!empty($category)) {
				$sql .= "category, ";
			}
			if (!empty($tag)) {
				$sql .= "tag, ";
			}
			if (!empty($note)){
				$sql .= "note, ";
			}
			$sql .= "amount) VALUES (";
			$sql .= ":user_id, :budget_id, :name, ";
			if (!empty($category)) {
				$sql .= ":category, ";
			}
			if (!empty($tag)) {
				$sql .= ":tag, ";
			}
			if (!empty($note)) {
				$sql .= ":note, ";
			}
			$sql .= ":amount)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR, 45);
			// category not required
			if (!empty($category)) {
				$stmt->bindParam(':category', $category, PDO::PARAM_INT);
			}
			// tag not required
			if (!empty($tag)) {
			$stmt->bindParam(':tag', $tag, PDO::PARAM_INT);
			}
			$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
			if (!empty($note)) {
			$stmt->bindParam(':note', $note, PDO::PARAM_STR, 300);
			}
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}
		catch (PDOException $e) {
			echo 'Cannot add item ' . $e->getMessage();
		}
	}
}