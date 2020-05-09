<?php

require_once "index.php";

$client = new \loco\Client("email", "password", "loco.php");
var_dump($client->requestPasscode(
		base64_encode("uuid"),
		"10.0",
		"PC",
		false,
		false
));