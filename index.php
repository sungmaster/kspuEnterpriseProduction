<?php

declare(strict_types = 1);

$kspuEnterprise = 1;

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include_once './lib/php/controller.php';
include_once './lib/php/model.php';
//include_once './lib/php/productModel.php';
include_once './lib/php/viewHelper.php';

$controller = new Controller();
$controller->handle();
