<?php
require_once('init.inc.php');

class Report extends DatabaseObject {
	
	const DB_TABLE = 'report';
	
	public $user_id;
	public $budget_id;
	
	public function getItemReport($user_id, $budget, $category, $tag, $include_overhead) {
		$dbh = Database::getPdo();
		try {
			//uses item_report sql view
			$sql = "SELECT name, budget, category, tag, amount FROM item_report WHERE user_id = {$user_id}";
			
			if(!empty($budget)) {
				$budget_string = implode(", ", $budget);
				$sql .= " AND budget_id IN ($budget_string)";
			}
			
			if(!empty($category)) { 
				$category_string = implode(", ", $category); 
				$sql .= " AND category_id IN ($category_string)";
			}
	
			if(!empty($tag)) { 
				$tag_string = implode(", ", $tag); 
				$sql .= " AND tag_id IN ($tag_string)";
			}
	
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		} catch (PDOException $e) {
			echo 'Unable to complete report query';
		}
	}
	
// 		public function arrayToCsv(array &$array) {
// 		   if (count($array) == 0) {
// 		     return null;
// 		   }
// 		   ob_start();
// 		   $fh = fopen("php://output", 'w');
// 		   fputcsv($fh, array_keys(reset($array)));
// 		   foreach ($array as $row) {
// 		      fputcsv($fh, $row);
// 		   }
// 		   fclose($fh);
// 		   return ob_get_clean();
// 		}

		public function arrayToCsv($array) {
			$fh = fopen("php://output", 'w');
			$header = array();
			if (empty($header)) {
				$header = array_keys($array);
				fputcsv($fh, $header);
			}
			foreach ($array as $row) {
				fputcsv($fh, $row);
			}
			fclose($fh);
		}
	
		public function downloadSendHeaders($filename) {
		    // disable caching
		    $now = gmdate("D, d M Y H:i:s");
		    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		    header("Last-Modified: {$now} GMT");
		
		    // force download  
		    header("Content-Type: application/force-download");
		    header("Content-Type: application/octet-stream");
		    header("Content-Type: application/download");
		
		    // disposition / encoding on response body
		    header("Content-Disposition: attachment;filename={$filename}");
		    header("Content-Transfer-Encoding: binary");
		}
		
} // end report class

