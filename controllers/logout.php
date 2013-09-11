<?php
require_once('../models/init.inc.php');
$session = new Session();
$session->logout();
header('Location:index.php');