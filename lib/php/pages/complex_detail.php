<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Сложные детали</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/scripts.js"></script>

</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>

<div class="container pt-100">
    <header>
        <div class="row">
            <!--<div class="header-search">
                <form action="#">
                    <input type="text" placeholder="Поиск" />
                    <input type="submit" class="search-submit" value="">
                </form>
            </div>-->
            <!--<div class="header-button">
                <a href="add_complex_detail.php"><input type="submit" class=" btn btn-light-b" value="Добавить деталь"></a>
            </div>-->
        </div>
    </header>

    <main>
        <div class="row">
            <div class="list-product">

                <?php
                $html = "";
                foreach ($output_data as $row) {
                    $html .= "
                                <div class=\"product-item\">
                                  <img src=\"".$row["base64img"]."\" alt=\"\">
                                  <div class=\"product-item-content\">
                                     <a href=\"calc.php?id=".$row["gid"]."\">".$row["gname"]."</a>
                                     <div class=\"sku\">Артикул: ".$row["garticul"]."</div>
                                     <div class=\"price\" id='".$row["gid"]."_price'></div>
                                     <div class=\"time\" id='".$row["gid"]."_time'></div>
                                     <script>get_detail_price_time(".$row["gid"].", 1, 0)</script>
                                   </div>
                                </div>";
                }
                echo $html;

                ?>

            </div>
        </div>
    </main>
</div>

</body>
</html>