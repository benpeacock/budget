<?php 
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';

if (!isset($session->user_id)) {
	include ROOT . 'views/login_alert.php';
	exit();
}

$submit = '';
$budget = array();
$category = array();
$tag = array();

// Filter arrays coming back from reports.php by calling reportFilter() against each value in array
if (!empty($_POST['budget'])) {
	$budget = array_filter($_POST['budget'], "is_numeric");
}
if (!empty($_POST['category'])) {
	$category = array_filter($_POST['category'], "is_numeric");
}
if (!empty($_POST['tag'])) {
	$tag = array_filter($_POST['tag'], "is_numeric"); 
}

if(isset($_POST['submit_html'])) { $submit = 'html'; }
if(isset($_POST['submit_csv'])) { $submit = 'csv'; }

switch ($submit) {
	case '':
		include ROOT . 'views/header.inc.php';
		include ROOT . 'views/reports.php';
		include ROOT . 'views/footer.inc.php';
		break;
		
	case 'html':
		$report = new Report();
		$report_result = $report->getItemReport($session->user_id, $budget, $category, $tag);
		include ROOT . 'views/header.inc.php';
		include ROOT . 'views/html_reports.php';
		include ROOT . 'views/footer.inc.php';
		break;

	case 'csv':
		$report = new Report();
		$csv_result = $report->getItemReport($session->user_id, $budget, $category, $tag);
		if (empty($csv_result)) {
			exit ('No results found');
		}
		$file = array();
		foreach ($csv_result as $row) {
			$line = array();
			$line[] = $row['item'];
			$line[] = $row['budget'];
			$line[] = $row['category'];
			$line[] = $row['tag'];
			$line[] = $row['amount'];
			$file[] = $line;
		}
		$report->downloadSendHeaders("data_export_" . date("Y-m-d") . ".csv");
		echo $report->arrayToCsv($file);
		die();
		break;
}
?>

