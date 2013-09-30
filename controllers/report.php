<?php 
require_once '../models/init.inc.php';

$submit = '';
$budget = array();
$category = array();
$tag = array();

// add sanitization, validation here
if(isset($_POST['budget'])) { $budget = $_POST['budget']; }
if(isset($_POST['category'])) { $category = $_POST['category']; }
if(isset($_POST['tag'])) { $tag = $_POST['tag']; }
if(isset($_POST['submit_html'])) { $submit = 'html'; }
if(isset($_POST['submit_csv'])) { $submit = 'csv'; }

//TESTING ONLY
echo '<div style="margin-top: 80px;">';
echo 'user id: ' . $session->user_id . '<br />';
echo 'budget: ' . var_dump($budget) . '<br />';
echo 'category: ' . var_dump($category) . '<br />';
echo 'tag: ' . var_dump($tag) . '<br />';
echo 'submit: ' . var_dump($submit);
echo '</div>';
// END TESTING

switch ($submit) {
	case '':
		include '../views/header.inc.php';
		include '../views/reports.php';
		include '../views/footer.inc.php';
		break;
		
	case 'html':
		$report = new Report();
		$report_result = $report->getItemReport($session->user_id, $budget, $category, $tag);
		echo 'html result: <br />';
		if (empty($report_result)) {
			exit ('No results found');
		}
		include '../views/header.inc.php';
		include '../views/html_reports.php';
		include '../views/footer.inc.php';
		break;

	case 'csv':
// 		$report = new Report();
// 		$result = $report->getItemReport($session->user_id, $budget, $category, $tag);
// 		var_dump($result);
// 		if (empty($result)) {
// 			exit ('No results found');
// 		}
// 		$report->downloadSendHeaders("data_export_" . date("Y-m-d") . ".csv");
// 		echo $report->arrayToCsv($result);
// 		die();
		break;
}
?>

