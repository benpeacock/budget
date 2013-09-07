<?php
require_once('init.inc.php');

class Report extends DatabaseObject {
	
	const DB_TABLE = 'report';
	
	public $user_id;
	public $budget_id;
	
	public function getReport($user_id, $budget, $category, $tag, $include_overhead) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM item WHERE user_id = {$user_id}";
			
			if(!empty($budget)) { 
				$budget_string = implode(", ", $budget);
				$sql .= " AND budget_id IN ($budget_string)";
			}
			
			if(!empty($category)) { 
				$category_string = implode(", ", $category); 
				$sql .= " AND category IN ($category_string)";
			}
	
			if(!empty($tag)) { 
				$tag_string = implode(", ", $tag); 
				$sql .= " AND tag IN ($tag_string)";
			}
	
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		} catch (PDOException $e) {
			echo 'Unable to complete report query';
		}
	}
	
} // end report class

