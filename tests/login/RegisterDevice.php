<?php

require_once "../CREDENTIALS.php";
require_once "../../index.php";

$client = new \loco\Client(CREDENTIALS::EMAIL, CREDENTIALS::PASSWORD, "loco.php");
var_dump($client->registerDevice(
		CREDENTIALS::PASSCODE,
		base64_encode(CREDENTIALS::DEVICE_UUID),
		CREDENTIALS::OS_VERSION,
		CREDENTIALS::DEVICE_NAME,
		CREDENTIALS::PERMANENT
));