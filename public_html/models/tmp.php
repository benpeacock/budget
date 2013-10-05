<?php
require_once('init.inc.php');
require '../vendor/autoload.php';
use Mailgun\Mailgun;


# Instantiate the client.
$mgClient = new Mailgun('key-6pfc3ghhk9rk4dtl4ws9a4b9fp2nwl12');
$domain = "budget.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Excited User <me@budget.mailgun.org>',
                        'to'      => 'Baz <ben9910@gmail.com>',
                        'subject' => 'Hello',
                        'text'    => 'Testing some Mailgun awesomness!'));
