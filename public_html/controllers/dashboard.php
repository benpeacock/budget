<?php 
require_once('../models/init.inc.php');
require_once('../views/header.inc.php');

if (isset($session->user_id)) {
	include '../views/dashboards.php';
} else {
	include '../views/login_alert.php';
	exit();
}
include '../views/footer.inc.php'; 
?>


