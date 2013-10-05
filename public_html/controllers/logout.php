<?php
require_once('../models/init.inc.php');
$session->logout();
header('Location:index.php');