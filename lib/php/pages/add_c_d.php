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
<div class="container pt-100">
    <h1>Создание нового продукта</h1>

    <div class="container_photo">
        <label for="photo_file">Фото: </label>
        <input type="file" id="photo_file">
        <!--<input type="submit" id="mat_photo" class=" btn btn-light-b add_photo" value="Фото">-->
    </div>
    <div class="container_sku">
        <input id="gname" type="text" class="" placeholder="Название">
        <input id="garticul" type="text" class="" placeholder="Артикул">
        <br>
        <div id="com_cat" class="categorys-list"><table id="mod_table"><tr><td class='center'>Деталь</td><td class='center'>К-во</td><td class='center'>Длина (мм)</td></tr>
            <?php
            foreach ($output_data as $row) {
                echo "<tr><td><input type='checkbox' id='".$row["dmid"]."_model'>
                    <label for='".$row["dmid"]."_model'>".$row["dmname"]."</label></td>
                    <td class='center'><input class='mod_num' type='number' min='1' value='1' id='".$row["dmid"]."_num'></td>
                    <td class='center'><input type='number' min='1' value='100' class='len_text mod_num' id='".$row["dmid"]."_len'></td></tr>";
            }
            ?>
            </table>
        </div>
        <input id="details_count" type="hidden" class="" placeholder="Количество деталей">
        <input id="gcatalog" type="hidden" class="" placeholder="Каталог">
        <input id="details" type="hidden" class="" placeholder="Детали">
        <input id="base64img" type="hidden" class="" placeholder="Фото">
        <input id="gpoints" type="text" class="" placeholder="Количество точек сварки">
        <input id="width" type="text" class="" placeholder="Ширина">
        <input id="height" type="text" class="" placeholder="Высота">
        <input id="gamortization" type="text" class="" placeholder="Дополнительные затраты">

        <input id="back" type="button" value="Назад" onclick="history.back()">
        <input id="s_d_submit" type="button" value="Отправить">
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>