<?php
require_once('../models/init.inc.php');
// can't include header or footer directly for x-editable compatibility.  Including below in switch blocks.

if (isset($_GET['action'])) {
	$action = $_GET['action'];

	switch ($action) {
		case 'create':
			include '../views/header.inc.php';
			include '../views/create_categories.php';
			include '../views/footer.inc.php';
			break;
		
		case 'list':
			$category = new Category();
			$result = $category->getTagCatByUser($session->user_id);
			echo json_encode($result);
			break;
		
// 		case 'display':
// 			$user_id = 1;
// 			$category = new Category();
// 			$result = $category->getByUser($user_id);
// 			include '../views/header.inc.php';
// 			include '../views/categories.php';
// 			include '../views/footer.inc.php';
// 			break;
			
		case 'edit':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid category id.  <a href="dashboard.php">Try Again</a>');
			}
			$category = new Category();
			$category_result = $category->getOneById($id);
			include '../views/header.inc.php';
			include ('../views/edit_categories.php');
			include '../views/footer.inc.php';
			break;
					
		case 'delete':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid category id.  <a href="dashboard.php">Try Again</a>');
			}
			$category = new Category();
			$result = $category->deleteRecord($id);
			if ($result == 1) {
				header('Location:dashboard.php');
			} else {
				echo 'Unable to delete category.';
				}
	}
}

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'create':
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid category name.  Numbers and letters only.  <a href="category.php?action=create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid category name.  Max length 45 characters.  <a href="category.php?action=create">Try Again</a>');
			}
			$category = new Category();
			$result = $category->createCategory($session->user_id, $name);
			break;
			
		case 'edit':
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid category id.  <a href="category.php?action=create">Try Again</a>');
			}
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid category name.  Numbers and letters only.  <a href="category.php?action=create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid category name.  Max length 45 characters.  <a href="category.php?action=create">Try Again</a>');
			}			
			$category = new Category();
			$result = $category->updateById($id, $name);
			if ($result == 1) {
				header('Location:dashboard.php');
			} else {
				echo 'Unable to update category.';
			}
	}
}
?>