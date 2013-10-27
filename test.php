<?php
require('vendor/raven/raven/lib/Raven/Autoloader.php');

Raven_Autoloader::register();

$client = new Raven_Client('https://4e3e17bc92a54b4b8aa163593c50474f:6903f6792901447b8ac7210ace18ef08@app.getsentry.com/14950');

// record a simple message
$client->captureMessage('hello world!');

// capture an exception
try {
	throw new Exception('Uh oh!');
}
catch (Exception $e) {
	$client->captureException($e);
}