<?php
    $kspuEnterprise = 1;

    include_once './lib/php/controller.php';
    include_once './lib/php/productModel.php';
    include_once './lib/php/viewHelper.php';

    $controller = new Controller();
    $controller->viewHelper->display("./lib/php/pages/index.php");
?>
