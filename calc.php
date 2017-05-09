<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>

<div class="container pt-100">
    <h1>Расчет сложной детали</h1>

    <div class="container_sku">
        <input id="calc_sum" type="text" class="" placeholder="Стоимость">
        <input id="calc_time" type="text" class="" placeholder="Временные затраты">

        <br>
        <div id="det_cat" class="categorys-list">
            <ul>
                <li><a href="#">category 1</a></li>
            </ul>
        </div>
        <a id="del_new_cat" href="#" style="width: 418px;">Добавить категорию</a>

        <a href="#" onclick="history.back(); return false;">Назад</a>
        <input type="submit" value="Зберегти">
    </div>
</body>
</html>