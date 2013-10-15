<?php

class Tag extends DatabaseObject {
	
	const DB_TABLE = 'tag';
	
	public $id;
	public $user_id;
	public $name;
	
	/**
	 * Creates tag record in db
	 * @param int $user_id
	 * @param string $name
	 */
	public function createTag($user_id, $name) {
			$tag = new Tag();
			$dbh = Database::getPdo();
				try {
					$sql = "INSERT INTO " . self::DB_TABLE . " (user_id, name) VALUES (:user_id, :name)";
					$stmt = $dbh->prepare($sql);
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$stmt->bindParam(':name', $name, PDO::PARAM_STR,25);
					$stmt->execute();
					$return = $stmt->rowCount();
					if ($return == 1) {
						header('Location:/dashboard');
					} elseif ($return != 1) {
						$message = 'Could not create tag.';
					}
				}
				catch (PDOException $e) {
					$message =  'Unable to create record: ' . $e->getMessage();
				}
			}
			
			public function getTagObjectById($id) {
				$dbh = Database::getPdo();
				try {
					$sql = "SELECT * FROM " . self::DB_TABLE . " WHERE id = :id";
					$stmt = $dbh->prepare($sql);
					$stmt->bindParam(':id', $id, PDO::PARAM_INT);
					$stmt->execute();
					$tag = new Tag();
					$stmt->setFetchMode(PDO::FETCH_INTO, $tag);
					$result = $stmt->fetch();
					return $result;
				} catch (PDOException $e) {
					'Unable to retrieve record ' . $e->getMessage();
				}
			}
}