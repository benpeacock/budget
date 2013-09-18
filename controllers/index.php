<?php
require_once '../models/init.inc.php';
require_once '../views/header.inc.php';

if (!isset($_GET['action']) && !isset($_POST['action'])) {
	include '../views/welcome_message.php';
}

if (isset($_GET['action'])) {
 $action = $_GET['action'];
 
 switch ($action) {
	 case 'create_user':
	 include '../views/create_user.php';
	 break;
	 
 } // end switch
} // end GET

require_once '../views/footer.inc.php';