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