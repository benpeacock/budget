<?php
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';
// can't include header or footer directl for x-editable compatability.  Including instead for each switch case.

if (!isset($session->user_id)) {
	include ROOT . 'views/login_alert.php';
}

if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	switch($action) {
		case 'create':
			include ROOT . 'views/header.inc.php';
			include ROOT . 'views/create_tags.php';
			include ROOT . 'views/footer.inc.php';
			break;
		
		case 'list':
			$tag = new Tag();
			$result = $tag->getTagCatByUser($session->user_id);
			echo json_encode($result);
			break;
		
		case 'edit':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid tag id.  <a href="/dashboard">Try Again</a>');
			}
			$tag = new Tag();
			$tag_result = $tag->getOneById($id);
			if ($tag_result['user_id'] != $session->user_id) {
				exit ('Invalid ID match.');
			}
			include ROOT . 'views/header.inc.php';
			include ROOT . 'views/edit_tags.php';
			include ROOT . 'views/footer.inc.php';
			break;
			
		case 'delete':
			$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid tag id.  <a href="/dashboard">Try Again</a>');
			}
			$tag = new Tag();
			$result = $tag->deleteRecord($id, $session->user_id);
			if ($result == 1) {
				header('Location:/dashboard');
			} else {
				echo 'Unable to delete tag.';
			}
			break;
	}
}

if(isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'create':
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid tag name.  Numbers and letters only.  <a href="/tag/create">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid tag name.  Max length 45 characters.  <a href="/tag/create">Try Again</a>');
			}
			$tag = new Tag();
			$result = $tag->createTag($session->user_id, $name);
			break;
		
		case 'edit':
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			if (filter_var($id, FILTER_VALIDATE_INT) == false) {
				exit ('Invalid tag id.  <a href="/tag/create">Try Again</a>');
			}
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			if (!ctype_alnum($name)) {
				exit ('Invalid tag name.  Numbers and letters only.  <a href="/dashbroard">Try Again</a>');
			}
			if (strlen($name) > 45) {
				exit ('Invalid tag name.  Max length 45 characters.  <a href="/dashboard">Try Again</a>');
			}		
			$tag = new Tag();
			$result = $tag->updateById($id, $name, $session->user_id);
			if ($result == 1) {
				header('Location:/dashboard');
			} else {
				echo 'Unable to update tag.';
			}
		}
}
?>