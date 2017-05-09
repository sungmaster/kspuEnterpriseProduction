<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Конструктор сложной детали</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>
<div class="container pt-100">
    <h1>Создание сложной детали</h1>

    <div class="container_photo">
        <label for="mat_file">Фото: </label>
        <input type="file" id="mat_file">
        <!--<input type="submit" id="mat_photo" class=" btn btn-light-b add_photo" value="Фото">-->
    </div>
    <div class="container_sku">
        <input id="com_name" type="text" class="" placeholder="Название">
        <input id="com_art" type="text" class="" placeholder="Артикул">
        <br>
        <div id="com_cat" class="categorys-list">
            <ul>
                <li><label for="com_categorys-list_1"><input type="checkbox" value="">category 1<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_2"><input type="checkbox" value="">category 2<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_3"><input type="checkbox" value="">category 3<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_4"><input type="checkbox" value="">category 4<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_5"><input type="checkbox" value="">category 5<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_6"><input type="checkbox" value="">category 6<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_7"><input type="checkbox" value="">category 7<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_8"><input type="checkbox" value="">category 8<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_9"><input type="checkbox" value="">category 1<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_10"><input type="checkbox" value="">category 2<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_11"><input type="checkbox" value="">category 3<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_12"><input type="checkbox" value="">category 4<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_13"><input type="checkbox" value="">category 5<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_14"><input type="checkbox" value="">category 6<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_15"><input type="checkbox" value="">category 7<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
                <li><label for="com_categorys-list_16"><input type="checkbox" value="">category 8<input type="text" value="1" style="width: 20px;height: 10px;float: none;margin-left: 10px;"></label></li>
            </ul>
        </div>
        <input id="com_time" type="text" class="" placeholder="Время работы">
        <input id="com_sv" type="text" class="" placeholder="Количество точек сварки">
        <input id="com_width" type="text" class="" placeholder="Ширина">
        <input id="com_height" type="text" class="" placeholder="Высота">
        <input id="com_rab" type="text" class="" placeholder="Tрудовые затраты">

        <input id="mat_back" type="button" value="Назад" onclick="history.back()">
        <input id="mat_submit" type="button" value="Сохранить">
    </div>

</body>
</html>