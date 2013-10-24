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
	public function createBudget($user_id, $name) {
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
					header('Location:/dashboard');
				} elseif ($return != 1) {
					echo 'Could not create budget.';
				}
			}
			catch (PDOException $e) {
				echo 'Unable to create budget: ' . $e->getMessage();
			}
		}
	
		/**
		 * Displays all items in a single budget
		 * @param int $budget_id
		 * @return budget as array
		 */
	public function displayBudget($budget_id, $user_id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM item WHERE budget_id = :budget_id AND user_id = :user_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch (PDOException $e) {
			echo 'Unable to retrieve budget: ' . $e->getMessage();
		}
	}
	
	/**
	* Retrieves one budget record from database as an object
	* @param int $id
	* @return budget as an object
	*/
	public function getBudgetObjectById($id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT * FROM " . self::DB_TABLE . " WHERE id = :id LIMIT 1";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$budget = new Budget();
			$stmt->setFetchMode(PDO::FETCH_INTO, $budget);
			$result = $stmt->fetch();
			return $result;
		} catch (PDOException $e) {
			echo 'Unable to retrieve record ' . $e->getMessage();
		}
	}
	
	/**
	 * Updates name and last_updated values of a budget.
	 * @param unknown $id
	 * @return number of rows updated (1)
	 */
	public function editBudget($id, $name, $user_id) {
		$dbh = Database::getPdo();
		try {
			$sql = "UPDATE " . self::DB_TABLE . " SET name = :name WHERE id = :id AND user_id = :user_id LIMIT 1";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR,45);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
		}
		catch (PDOException $e) {
			echo 'Could not update record: ' . $e->getMessage();
		}
	}
	
	/**
	 * Deletes budget record from db
	 * @return redirects to dashboard if successful returns $message otherwise
	 */
	public function deleteBudget($id, $user_id) {
		try {
			$budget = new Budget();
			$result = $budget->deleteRecord($id, $user_id);
			if ($result == 1) {
				header('Location:/dashboard');
			} elseif ($result != 1) {
				exit('Unable to delete budget. <a href="/dashboard">Back</a>');
			}
		} catch (PDOException $e) {
			echo 'Unable to delete budget:' . $e->getMessage();
		}
	}
	
	/**
	 * Sums the amount for each item included in a given budget.  Current() fetches the first and only value in the array before returning it.
	 * @param int $id
	 * $return float $result or int 0 if value is null
	 */
	public static function sumBudget($budget_id) {
		$dbh = Database::getPdo();
		try {
			$sql = "SELECT SUM(amount) FROM item WHERE budget_id = :budget_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
			$stmt->execute();
			$result = current($stmt->fetch());
			if ($result == NULL) {
				return 0;
			} else {
			return $result;
			}
		} catch (PDOException $e) {
			echo 'Unable to locate budget' . $e->getMessage();
		}
	}
} // end Budget class