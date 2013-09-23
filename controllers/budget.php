<?php
require_once('../models/init.inc.php');
require_once('../views/header.inc.php');

if (isset($_GET['action'])) {
	$action = $_GET['action'];

	switch ($action) {
		case 'delete':
			$budget = new Budget();
			$budget->deleteBudget();
			break;
		
		// form to create a budget
		case 'create':
			include '../views/create_budgets.php';
			break;
		
		//used to populate drop-down of budget names in overhead.php x-editable field
		case 'list':
			$budget = new Budget();
			$result = $budget->getTagCatByUser($session->user_id);
			echo json_encode($result);
			break;
			
		case 'display':
			$budget = new Budget();
			$id = $_GET['id'];
			$query = $budget->getById($id);
			include '../views/budgets.php';
			break;
			
		case 'edit':
			$id = $_GET['id'];
			$budget = new Budget();
			$result = $budget->getOneById($id);
			include '../views/edit_budgets.php';
			break;
			}
	}

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch($action) {
		case 'create' :
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid budget name.  Numbers and letters only.  <a href="budget.php?action=create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid budget name.  Max length 45 characters.  <a href="category.php?action=create">Try Again</a>');
			}
			$budget = new Budget();
			$budget->createBudget($session->user_id, $name);
			break;
			
		case 'edit':
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($name, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid budget id.');
			}
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid budget name.  Numbers and letters only.  <a href="budget.php?action=create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid budget name.  Max length 45 characters.  <a href="budget.php?action=create">Try Again</a>');
			}
			$budget = new Budget();
			$result = $budget->editBudget($id, $name);
			if ($result == 1) {
				header('Location: budget.php?action=display&id=' . $id);
			} else {
				echo 'Count not rename budget';
			}
			break;
	}
}

require_once('../views/footer.inc.php');
?>




