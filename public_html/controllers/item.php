<?php
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';

if (!isset($session->user_id)) {
	include '../views/login_alert.php';
	exit();
}

if (isset($_GET['action'])) {
	$action = $_GET['action'];
	
	switch($action) {
		case 'delete':
			$id = $_GET['id'];
			$budget_id = $_GET['budget_id'];
			$item = new Item();
			$result = $item->deleteRecord($id);
			header('Location:budget.php?action=display&id=' . $budget_id . '');
			break;
	}
}

if (isset($_POST['submit'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'add':
			$budget_id = filter_input(INPUT_POST, 'budget_id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($budget_id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid budget id.  <a href="dashboard.php">Try Again</a>');
			}
			$name = filter_input(INPUT_POST, 'name',  FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid item name.  <a href="dashboard.php">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid item name.  Max legnth 45 characters. <a href="dashboard.php">Try Again</a>');
			}
			if (!empty($category)) {
				$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($category, FILTER_VALIDATE_INT) == false) {
					exit ('Invalid item category. <a href="dashboard.php">Try Again</a>');
				}
			}
			if (!empty($tag)) {
				$tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($tag, FILTER_VALIDATE_INT) == false) {
					exit ('Invalid item tag. <a href="dashboard.php">Try Again</a>');
				}
			}
			$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
			if (!is_numeric($amount)) {
				exit('Invalid item amount. <a href="dashboard.php">Try Again</a>');
			}
			if (!empty($note)) {
				$note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);
				if (filter_var($note, FILTER_VALIDATE_REGEXP, '^[a-zA-Z0-9]+$') == false) {
					exit ('Invalid note. <a href="dashboard.php">Try Again</a>');
				}
			}
			$item = new Item();
			$result = $item->addItem($session->user_id, $budget_id, $name, $category='', $tag='', $amount, $note='');
			if ($result != 1) {
				exit('Could not create item.');
			} else {
			header('Location:budget.php?action=display&id=' . $budget_id . '');
			}
			break;
	}
}