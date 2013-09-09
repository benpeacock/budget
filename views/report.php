<?php require_once '../controllers/init.inc.php';

if(isset($_GET['action'])) {
	$user_id = 1;
	//$user_id = $_SESSION['user_id'];
	$action = $_GET['action'];
	
	switch ($action) {
		case 'download':
			$budget = array();
			$category = array();
			$tag = array();
			$include_overhead = false;
			
			if(isset($_POST['budget'])) { $budget = $_POST['budget']; }
			if(isset($_POST['category'])) { $category = $_POST['category']; }
			if(isset($_POST['tag'])) { $tag = $_POST['tag']; }
			if(isset($_POST['include_overhead'])) { $include_overhead = $_POST['include_overhead']; }
			
			$report = new Report();
			$result = $report->getItemReport($user_id, $budget, $category, $tag, $include_overhead);
			foreach ($result as $row) {
				$line = array();
				$line[] = $row['budget'];
				$line[] = $row['name'];
				$line[] = $row['category'];
				$line[] = $row['tag'];
				$line[] = $row['amount'];
				$download[] = $line;
			}
			if (empty($download)) {
				echo 'No results available.';
			} else {
				$report->downloadSendHeaders("data_export_" . date("Y-m-d") . ".csv");
				echo $report->arrayToCsv($download);
				die();
			}
		break;
	}
	
} //end GET actions

if(isset($_POST['submit_html']) || isset($_POST['submit_csv'])) {
	$user_id = 1;
	// $user_id = $_SESSION['user_id'];
	$budget = array();
	$category = array();
	$tag = array();
	
	if(isset($_POST['budget'])) { $budget = $_POST['budget']; }
	if(isset($_POST['category'])) { $category = $_POST['category']; }
	if(isset($_POST['tag'])) { $tag = $_POST['tag']; }
	if(isset($_POST['include_overhead'])) { $include_overhead = $_POST['include_overhead']; }

	$report = new Report();
	$result = $report->getItemReport($user_id, $budget, $category, $tag, $include_overhead);
	if (empty($result)) {
		$message = 'No results found.';
	}
	if (isset($_POST['submit_html'])) {
		echo '<table>';
		echo '<tbody>';
		echo '<tr><th>Budget</th><th>Name</th><th>Category</th><th>Tag</th><th>Amount</th></tr>';
		foreach ($result as $row) {
			echo '<tr>';
				echo '<td width="20%">' . $row['budget'] . '</td>';
				echo '<td width="20%">' . $row['name'] . '</td>';
				echo '<td width="20%">' . $row['category'] . '</td>';
				echo '<td width="20%">' . $row['tag'] . '</td>';
				echo '<td width="20%">' . $row['amount'] . '</td>';
			echo '</tr>';
		}
		echo '<tr><td>Total</td><td></td><td></td><td></td><td>Goes here</td>';
		echo '</tbody>';
		echo '</table>';
	}
	if (isset($_POST['submit_csv'])) {
		foreach ($result as $row) {
			$line = array();
			$line[] = $row['budget'];
			$line[] = $row['name'];
			$line[] = $row['category'];
			$line[] = $row['tag'];
			$line[] = $row['amount'];
			$download[] = $line;
		}
		if (empty($download)) {
			echo 'Could not write to csv.';
		} else {
			$report->downloadSendHeaders("data_export_" . date("Y-m-d") . ".csv");
			echo $report->arrayToCsv($download);
			die();
		}
	}
}

require_once 'header.inc.php';
?>
<h2>Filters:</h2>
<form action="report.php" method="post">
	<ul>
		<li>
			<label>Budget Name(s):</label>
			<select id="budget" name="budget[]" multiple="multiple">
			<?php
			$user_id = 1;
			$budget = new Budget();
			$result = $budget->getByUser($user_id);
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			?>
			</select>
		</li>
		<li>
			<label>Category Name(s):</label>
			<select id="category" name="category[]" multiple="multiple">
			<?php 
			$category = new Category();
			$result = $category->getByUser($user_id);
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
			?>
			</select>
		</li>
		<li>
			<label>Tag Name(s):</label>
			<select id="tag" name="tag[]" multiple="multiple">
			<?php 
			$tag = new Tag();
			$result = $tag->getByUser($user_id);
			foreach ($result as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
			?>
			</select>
		</li>
		<li>
			Include Overhead Items?
			Yes: <input type="radio" name="include_overhead" value="yes" />
			No: <input type="radio" name="include_overhead" value="no" checked="checked"/>
		</li>
		<li>
			<input type="submit" name="submit_html" value="Create Report" />
			<input type="submit" name="submit_csv" value="Export Report to CSV" />
		</li>
	</ul>
</form>

<?php require_once 'footer.inc.php';?>

