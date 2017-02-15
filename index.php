<?php

declare(strict_types = 1);

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

const DS    = DIRECTORY_SEPARATOR;
const SYS   = __DIR__;
const INC   = SYS.DS.'lib'.DS.'php'.DS;

spl_autoload_register(function ($c) {
	$f = INC.str_replace(['\\', '_'], [DS, DS], strtolower($c)).'.php';
	if (file_exists($f)) include_once $f;
});

$controller = new PageController();
$controller->handle();
