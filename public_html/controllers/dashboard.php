<?php 
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';
require_once ROOT . 'views/header.inc.php';

if (isset($session->user_id)) {
	include ROOT . 'views/dashboards.php';
} else {
	include ROOT . 'views/login_alert.php';
	exit();
}
include ROOT . 'views/footer.inc.php'; 
?>


