<?php
require_once('../models/init.inc.php');

if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	require_once('../controllers/header.inc.php');
	
	switch($action) {
		case 'create':
			include ('../views/create_tags.php');
			break;
		
		case 'list':
			$user_id = $_GET['user_id'];
			$tag = new Tag();
			$result = $tag->getTagCatByUser($user_id);
			echo json_encode($result);
			break;
			
		case 'display':
			$user_id = 1;
			$tag = new Tag();
			$result = $tag->getByUser($user_id);
			include ('../views/tags.php');
			break;
		
		case 'edit':
			$id = $_GET['id'];
			$tag = new Tag();
			$result = $tag->getTagObjectById($id);
			include ('../views/edit_tags.php');
			break;
	}
	
	require_once('../controllers/footer.inc.php');
}

if(isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'create':
			$user_id = $_SESSION['user_id'];
			$name = $_POST['name'];
			$tag = new Tag();
			$result = $tag->createTag($user_id, $name);
			break;
		}
}