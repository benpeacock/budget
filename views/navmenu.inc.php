<?php
$session = new Session();
if ($session->isLoggedIn()) {
?>
		<ul class="main_nav">
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="report.php">Reports</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="help.php">Help</a></li>
			<li><a href="logout.php">Logout</a></li>
            <li>Hello, <?php echo $session->username; ?></li>
		</ul>
<?php
	} else {
?>
		<ul class="main_nav">
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="help.php">Help</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
<?php
}
?>
