<?php
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';
require_once ROOT . 'views/header.inc.php';

if (!isset($session->user_id)) {
	include ROOT . 'views/login_alert.php';
	exit();
}

if (isset($_GET['action'])) {
	$action = $_GET['action'];

	switch ($action) {
		case 'delete':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit('Invalid budget id.');
			}
			$budget = new Budget();
			$budget->deleteBudget($id, $session->user_id);
			break;
		
		// form to create a budget
		case 'create':
			include ROOT . 'views/create_budgets.php';
			break;
		
		//used to populate drop-down of budget names in overhead.php x-editable field
		case 'list':
			$budget = new Budget();
			$result = $budget->getTagCatByUser($session->user_id);
			echo json_encode($result);
			break;
			
		case 'display':
			$budget = new Budget();
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit('Invalid budget ID number.');
			}
			$query = $budget->getById($id);
			if ($budget->user_id != $session->user_id) {
				exit ('Invalid ID match.');
			}
			include ROOT . 'views/budgets.php';
			break;
			
		case 'edit':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit('Invalid budget ID number.');
			}
			$budget = new Budget();
			$result = $budget->getOneById($id);
			if ($budget->user_id != $session->user_id) {
				exit ('Invalid ID match.');
			}
			include ROOT . 'views/edit_budgets.php';
			break;
			}
	}

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch($action) {
		case 'create' :
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid budget name.  Numbers and letters only.  <a href="/budget/create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid budget name.  Max length 45 characters.  <a href="/category/create">Try Again</a>');
			}
			$budget = new Budget();
			$budget->createBudget($session->user_id, $name);
			break;
			
		case 'edit':
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid budget id.');
			}
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid budget name.  Numbers and letters only.  <a href="/budget/create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid budget name.  Max length 45 characters.  <a href="/budget/create">Try Again</a>');
			}
			$budget = new Budget();
			$result = $budget->editBudget($id, $name, $session->user_id);
			if ($result == 1) {
				header('Location: budget/display/' . $id);
			} else {
				echo 'Count not rename budget';
			}
			break;
	}
}

require_once ROOT . 'views/footer.inc.php';
?>




