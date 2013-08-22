<?php
require_once('init.inc.php');

class Budget extends DatabaseObject {
	
	const DB_TABLE = 'budget';
	
	public $id;
	public $user_id;
	public $name;
	public $created;
	public $last_updated;
	
	/**
	 * Creates new budget record
	 * @return redirect to dashboard.php if successful, or error message if not
	 */
	public function createBudget() {
		$user_id = $_SESSION['user_id'];
		$name = $_POST['name'];
		$budget = new Budget();
		$dbh = Database::getPdo();
			try {
				$created = date("Y-m-d H:i:s");
				$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, name, created) VALUES (:user_id, :name, :created)";
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$stmt->bindParam(':name', $name, PDO::PARAM_STR,45);
				$stmt->bindParam(':created', $created);
				$stmt->execute();
				$return = $stmt->rowCount();
				if ($return == 1) {
					header('Location:dashboard.php');
				} elseif ($return != 1) {
					$message = 'Could not create budget.';
				}
			}
			catch (PDOException $e) {
				$message =  'Unable to create record: ' . $e->getMessage();
			}
		}
	
		/**
		 * Displays all items in a single budget
		 * @param int $budget_id
		 * @return budget as array
		 */
	public function displayBudget($budget_id) {
		$dbh = Database::getPdo();
		try {
			$budget_id = $_GET['id'];
			$sql = "SELECT * FROM item WHERE budget_id = :budget_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch (PDOException $e) {
			$message = 'Unable to retrieve budget: ' . $e->getMessage();
		}
	}
	
	/**
	 * Updates name and last_updated values of a budget.
	 * @param unknown $id
	 * @return number of rows updated (1)
	 */
	public function updateBudget($user_id, $name) {
		$dbh = Database::getPdo();
		try {
			$last_updated = date("Y-m-d H:i:s");
			$query = new Budget();
			$row = $query->getByName($user_id, $name);
			// Is there a beter way to get the id property out of the $row array than foreach?
			foreach ($row as $item) {
				$id = $item['id'];
			}
			$sql = "UPDATE INTO " . self::DB_TABLE . " (name, last_updated) VALUES (:name, :last_updated) WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR,45);
			$stmt->bindParam(':last_updated', $last_updated);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}
		catch (PDOException $e) {
			$message = 'Could not update record: ' . $e->getMessage();
		}
	}
	/**
	 * Deletes budget record from db
	 * 
	 */
	public function deleteBudget() {
		$id = $_GET['id'];
		$budget = new Budget();
		$result = $budget->deleteRecord($id);
		if ($result == 1) {
			header('Location:dashboard.php');
		} elseif ($result != 1) {
			$message = 'Unable to delete budget. <a href="dashboard.php"><<Back to Dashboard</a>';
		}
	}
} // end Budget class