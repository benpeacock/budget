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
			
		case 'create':
			include '../views/create_budgets.php';
			break;
		
		//used to populate drop-down of budget names in overhead.php x-editable field
		case 'list':
			$user_id = $_GET['user_id'];
			$budget = new Budget();
			$result = $budget->getTagCatByUser($user_id);
			echo json_encode($result);
			break;
			
		case 'display':
			$budget = new Budget();
			$user_id = 1;
			$id = $_GET['id'];
			$query = $budget->getById($id);
			// Is there a more effecient way to extract this than by using foreach?
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
			$budget = new Budget();
			$budget->createBudget();
			break;
			
		case 'edit':
			$id = $_POST['id'];
			$name = $_POST['name'];
			$budget = new Budget();
			$result = $budget->editBudget($id, $name);
			if ($result == 1) {
				header('Location: budget.php?action=display&id=' . $id);
			} else {
				echo 'Count not rename budget';
			}
	}
}

require_once('../views/footer.inc.php');
?>




