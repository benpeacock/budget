<?php
require_once('../models/init.inc.php');
// require_once 'header.inc.php';

if (isset($_GET['action'])) {
	$action = $_GET['action'];

	switch ($action) {
		case 'create':
			include '../views/header.inc.php';
			include '../views/create_categories.php';
			break;
		
		case 'list':
			$user_id = $_GET['user_id'];
			$category = new Category();
			$result = $category->getTagCatByUser($user_id);
			echo json_encode($result);
			break;
		
		case 'display':
			$user_id = 1;
			$category = new Category();
			$result = $category->getByUser($user_id);
			include '../views/header.inc.php';
			include '../views/categories.php';
			break;
			
		case 'edit':
			$id = $_GET['id'];
			$category = new Category();
			$result = $category->getOneById($id);
			include '../views/header.inc.php';
			include ('../views/edit_categories.php');
			break;
					
		case 'delete':
			$id = $_GET['id'];
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
			// $user_id = $_SESSION['user_id'];
			$user_id = 1;
			$name = $_POST['name'];
			$category = new Category();
			$result = $category->createCategory($user_id, $name);
			break;
		case 'edit':
			// $user_id = $_SESSION['user_id'];
			$user_id = 1;
			$id = $_POST['id'];
			$name = $_POST['name'];				
			$category = new Category();
			$result = $category->updateById($id, $name);
			if ($result == 1) {
				header('Location:dashboard.php');
			} else {
				echo 'Unable to update category.';
			}
	}
}
// require_once('footer.inc.php');
?>