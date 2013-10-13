<?php
require_once '../../config.php';
require_once ROOT . 'models/init.inc.php';
$session->logout();
header('Location:/');