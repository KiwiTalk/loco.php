<?php

function autoLoad(string $path) {
	foreach ((new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path))) as $info) {
		/** @var SplFileInfo $info */
		if (is_file($info->getRealPath()) && substr($info->getFilename(), -4, 4) === ".php") {
			require_once $info->getRealPath();
		}
	}
}

autoLoad('./src/');
/*
$parallelManager = new \loco\parallel\ParallelManager();

while (true) {
	$nextRun = microtime(true) + 20;

	$parallelManager->tick();

	$now = microtime(true);
	if ($now < $nextRun) usleep($nextRun - $now);
}
*/