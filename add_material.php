<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Новый материал</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/png">
    <script src="js/jquery-1.9.1.js"></script>
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>

<div class="container pt-100">
    <h1>Создание нового материала</h1>
    <div class="container_photo">
        <label for="photo_file">Фото: </label>
        <input type="file" id="photo_file">
        <!--<input type="submit" id="mat_photo" class=" btn btn-light-b add_photo" value="Фото">-->
    </div>
    <div class="container_sku">
        <input id="mname" type="text" class="" placeholder="Название">
        <input id="marticul" type="text" class="" placeholder="Артикул">
        <input id="price" type="text" class="" placeholder="Цена за 1м.">
        <input id="inkconsumption" type="text" class="" placeholder="Расход на покраску">
        <input id="base64img" type="hidden"  class="">

        <input id="mat_back" type="button" value="Назад" onclick="history.back()">
        <input id="mat_submit" type="button" value="Добавить">
    </div>
</div>
<script src="js/scripts.js"></script>
</body>
</html>