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
	
	public function getBudgetObjectById($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . self::DB_TABLE . " WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$budget = new Budget();
			$stmt->setFetchMode(PDO::FETCH_INTO, $budget);
			$result = $stmt->fetch();
			return $result;
		} catch (PDOException $e) {
			'Unable to retrieve record ' . $e->getMessage();
		}
	}
	
	/**
	 * Updates name and last_updated values of a budget.
	 * @param unknown $id
	 * @return number of rows updated (1)
	 */
	public function editBudget($id, $name) {
		$dbh = Database::getPdo();
		try {
			$sql = "UPDATE " . self::DB_TABLE . " SET name = :name WHERE id = :id LIMIT 1";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR,45);
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
	 * @return redirects to dashboard if successful returns $message otherwise
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