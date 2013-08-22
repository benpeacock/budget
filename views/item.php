<?php
require_once('../controllers/init.inc.php');

if (isset($_GET['action'])) {
	$action = $_GET['action'];
	
	switch($action) {
		case 'delete':
			$id = $_GET['id'];
			$budget_id = $_GET['budget_id'];
			$item = new Item();
			$result = $item->deleteRecord($id);
			header('Location:budget.php?id=' . $budget_id . '');
			break;
	}
}

if (isset($_POST['submit'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'add':
			$budget_id = $_POST['budget_id'];
			$item = new Item();
			$result = $item->addItem();
			header('Location:budget.php?id=' . $budget_id . '');
			break;
	}
}