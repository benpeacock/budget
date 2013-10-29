<?php
require ROOT . '../vendor/raven/raven/lib/Raven/Autoloader.php';
Raven_Autoloader::register();
$client = new Raven_Client(SENTRY_KEY);

$error_handler = new Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();
?>