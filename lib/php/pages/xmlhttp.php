<?php
$kspuEnterprise = 1;

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include_once '../controller.php';
include_once '../productModel.php';
include_once '../viewHelper.php';

$controller = new Controller();
$controller->handle();