<?php
require_once('../models/init.inc.php');

if (isset($_GET['action'])) {
	$action = $_GET['action'];

	switch ($action) {
		case 'create':
			require_once 'header.inc.php';
			?>
			<form action="category.php" method="post">
				<input type="hidden" name="action" value="create" />
				<input type="text" name="name" required />
				<input type="submit" name="submit" value="Create Category" />
			</form>
		<?php
			require_once 'footer.inc.php';
			break;
		
		case 'list':
			$user_id = $_GET['user_id'];
			$category = new Category();
			$result = $category->getTagCatByUser($user_id);
			echo json_encode($result);
			break;
		
		case 'display':
			require_once('header.inc.php');
			?>
			<div>This is where categories go.</div>
			<?php
			require_once('footer.inc.php');
	}
}

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	
	switch ($action) {
		case 'create':
			$user_id = $_SESSION['user_id'];
			$name = $_POST['name'];
			$category = new Category();
			$result = $category->createCategory($user_id, $name);
			break;
	}
}
?>