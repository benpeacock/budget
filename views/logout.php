<?php
require_once('../controllers/init.inc.php');
$session = new Session();
$session->logout();
header('Location:index.php');