<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конструктор простой детали</title>
    <link rel="shortcut icon" href="img/icon.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.9.1.js"></script>
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>
<div class="container pt-100">
    <h1>Создание новой детали</h1>

    <div class="container_photo">
        <label for="photo_file">Фото: </label>
        <input type="file" id="photo_file">
        <!--<input type="submit" id="mat_photo" class=" btn btn-light-b add_photo" value="Фото">-->
    </div>
    <div class="container_sku">
        <input id="dmname" type="text" placeholder="Название">
        <input id="dmarticul" type="text" placeholder="Артикул">
        <input id="time2m" type="text" placeholder="Время работы на 1м">
        <input id="btime" type="text" placeholder="Дополнительные затраты времени">
        <input id="amortization2m" type="text" placeholder="Затраты на 1м">
        <input id="spending" type="text" placeholder="Дополнительные затраты">
        <!--<input id="det_length" type="text" placeholder="Длина прута">-->
        <input id="base64img" type="hidden">
        <br>
        <div id="dcatalog" class="categorys-list"><br>
            <?php
            foreach ($output_data as $tmp) {
                echo "&nbsp;&nbsp;<input type='radio' name='catalog' class='catalog' id='".$tmp["dcid"]."_model'>
                    <label class='catalog' for='".$tmp["dcid"]."_model'>".$tmp["dcname"]."</label><br>";
            }
            ?>
        </div>
        <input id="back" type="button" value="Назад" onclick="history.back()">
        <input id="sim_det_submit" type="button" value="Сохранить">
    </div>
    <script src="js/scripts.js"></script>

</body>
</html>