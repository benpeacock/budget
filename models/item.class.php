<?php

require_once('init.inc.php');

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
	
	public function addItem() {
		$user_id = $_POST['user_id'];
		$budget_id = $_POST['budget_id'];
		$name = $_POST['name'];
		$category = $_POST['category'];
		$tag = $_POST['tag'];
		$amount = $_POST['amount'];
		$note = $_POST['note'];
		
		
		// Is this function being used?
		
		/**
		* Creates new item record in database
		* @param int $user_id, string $name, int $category, int $tag, string $note, int $amount
		* return ?
		*/
		public function createItem($user_id, $name, $category, $tag, $note, $amount) {
		$dbh = Database::getPdo();
		try {
			$sql = "INSERT INTO " . self::DB_TABLE . "(
			user_id, budget_id, name, category, tag, note, amount
			) VALUES (
			:user_id, :budget_id, :name, :category, :tag, :note, :amount
			)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR, 45);
			$stmt->bindParam(':category', $category, PDO::PARAM_INT);
			$stmt->bindParam(':tag', $tag, PDO::PARAM_INT);
			$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
			// look up field length for note and add after PARAM_STR
			$stmt->bindParam(':note', $note, PDO::PARAM_STR);
			$stmt->execute();
			
		} catch (PDOException $e) {
			$message = 'Unable to add item';
		}
	}
}