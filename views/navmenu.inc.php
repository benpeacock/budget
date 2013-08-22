<?php
$session = new Session();
if ($session->isLoggedIn()) {
	$nav_menu = '<ul class="main_nav">
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="help.php">Help</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>';
	// show user id for testing purposes only
	echo $_SESSION['user_id'];
} else {
	$nav_menu = '<ul class="main_nav">
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="help.php">Help</a></li>
					<li><a href="login.php">Login</a></li>
				</ul>';
}
?>