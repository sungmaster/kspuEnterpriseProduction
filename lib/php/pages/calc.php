<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Расчет затрат</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.9.1.js"></script>
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>

<div class="container pt-100">
    <h1>Расчет временны́х и денежных затрат</h1>

    <div class="container_sku">
        <input id="gname" type="text" class="" placeholder="Название изделия" value="<?php if(isset($_GET["gname"])) echo $_GET["gname"] ?>">
        <img src="" width="200" id="g_img">
        <div id="calc_time_price">
            <label for="tprice">Стоимость изготовления</label>
            <input type="text" disabled id="tprice"><br>
            <label for="ttime">Время изготовления</label>
            <input type="text" disabled id="ttime">
        </div>
        <div id="det_cat" class="categorys-list">
            <?php
            echo "<table id='mat_table'><tr id='main_tr_calc'><td>ID</td><td>Артикул</td><td>Название</td><td>Стоимость</td></tr>";
            foreach($output_data as $row) {
                echo "<tr class='mat_table_tr'>";
                echo "
                    <td>".$row["mid"]."</td><td>".$row["marticul"]."</td><td>".$row["mname"]."</td><td>".$row["price"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </div>

        <input id="mat_back" type="button" value="Назад" onclick="history.back()">
    </div>
    <script src="js/scripts.js"></script>
    <script>get_img()</script>
</body>
</html>