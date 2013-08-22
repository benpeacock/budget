<?php
require_once('../controllers/init.inc.php');

if(isset($_GET['action'])) {
	$action = $_GET['action'];
	
	switch($action) {
		case 'create':
		?>
			<form action="tag.php" method="post">
				<input type="hidden" name="action" value="create" />
				<input type="text" name="name" required />
				<input type="submit" name="submit" value="Create Tag" />
			</form>
		<?php
			break;
		
		case 'list':
			$user_id = $_GET['user_id'];
			$tag = new Tag();
			$result = $tag->getTagCatByUser($user_id);
			echo json_encode($result);
			break;
			
		case 'display':
			require_once('header.inc.php');
			?>
			<div>This is where tags go.</div>
			<?php
			require_once('footer.inc.php');
	}
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