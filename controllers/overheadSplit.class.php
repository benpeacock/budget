<?php
require_once('init.inc.php');

class OverheadSplit extends DatabaseObject {
	
	const DB_TABLE = 'overhead_split';
	
	public $id;
	public $user_id;
	public $budget_id;
	public $overhead_item_id;
	public $percent_of_total;
	
	public function createOverheadSplit($budget_id, $overhead_item_id, $percent_of_total) {
		$user_id = $_SESSION['user_id'];
		$dbh = Database::getPDO();
		try {
			$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, budget_id, overhead_item_id, percent_of_total) VALUES ";
			$sql .= "(:user_id, :budget_id, :overhead_item_id, :percent_of_total)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':budget_id', $budget_id);
			$stmt->bindParam(':overhead_item_id', $overhead_item_id);
			$stmt->bindParam(':percent_of_total', $percent_of_total);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		} catch (PDOException $e) {
			'Could not create overhead split ' . $e->getMessage();
		}
		
	}
	
}