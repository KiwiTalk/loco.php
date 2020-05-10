<?php

require_once "../CREDENTIALS.php";
require_once "../../index.php";

$client = new \loco\Client(CREDENTIALS::EMAIL, CREDENTIALS::PASSWORD, "loco.php");

$requestLogin = (new ReflectionClass($client))->getMethod("requestLogin");
$requestLogin->setAccessible(true);

var_dump($requestLogin->invoke($client,
		base64_encode(CREDENTIALS::DEVICE_UUID),
		CREDENTIALS::OS_VERSION,
		CREDENTIALS::DEVICE_NAME,
		CREDENTIALS::PERMANENT,
		CREDENTIALS::FORCED
));