<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конструктор нового продукта</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/png">
    <script src="js/jquery-1.9.1.js"></script>
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>
<div class="container pt-100 center">
    <?php
    echo "<table id='stock_table'><tr id='main_tr_stock'><td>ID</td><td>Длина</td><td>Материал</td><td>Артикул</td><td>Модель</td><td>Количество</td></tr>";
    foreach($output_data as $row) {
        echo "<tr>";
        foreach($row as $field) {
            echo "<td>$field</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</div>
    <script src="js/scripts.js"></script>
</body>
</html>