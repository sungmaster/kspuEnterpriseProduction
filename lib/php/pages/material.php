<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Материалы</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/png">
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/scripts.js"></script>

</head>


<body>
<?php
include_once("./lib/php/pages/menu.php");
?>
<style>
    .menu_main{
        margin-top: -20px;
    }
</style>
        <div class="container pt-100">
            <div class="row">
                <!--<div class="header-search">
                    <form action="#">
                        <input type="text" placeholder="Поиск" />
                        <input type="submit" class="search-submit" value="">
                    </form>
                </div>-->
                <!--<div class="header-button">
                    <a href="add_material.php"><input type="submit" class=" btn btn-light-b" value="Добавить деталь"></a>
                </div>-->
            </div>
            <div class="row">
                <div class="list-product">
                    <?php
                    $html = "";
                    foreach ($output_data as $row) {
                        $html .= "
                                <div class=\"product-item\">
                                  <img src=\"" . $row["base64img"] . "\" alt=\"\">
                                  <div class=\"product-item-content\">
                                     <a href=\"\">" . $row["mname"] . "</a>
                                     <div class=\"sku\">Артикул: " . $row["marticul"] . "</div>
                                     <div class=\"price\">" . $row["price"] . " грн.</div>
                                   </div>
                                </div>";
                    }
                    echo $html;

                    ?>

                </div>
            </div>
        </div>



</body>
</html>