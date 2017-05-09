<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Настройки</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.9.1.js"></script>
</head>
<body>
<?php
include_once("./lib/php/pages/menu.php");
?>

<div class="container pt-100">
    <h1>Страница настройки расходов</h1>

    <div class="misc" style="text-align: -webkit-center;">
        <table id="table_misc">
            <tr>
                <td style="width: 30%">
                    <label for="weldorSalary">Зарплата cварщика</label>
                </td>
                <td>
                    <input id="weldorSalary" type="text" class="" placeholder="Зарплата cварщика">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Зарплата маляра</label>
                </td>
                <td>
                    <input id="painterSalary" type="text" class="" placeholder="Зарплата маляра">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Зарплата оператора станка</label>
                </td>
                <td>
                    <input id="operatorSalary" type="text" class="" placeholder="Зарплата оператора станка">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Стоимость электрода</label>
                </td>
                <td>
                    <input id="electrodeCost" type="text" class="" placeholder="Стоимость электрода">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Ресурс электрода</label>
                </td>
                <td>
                    <input id="electrodeSpending" type="text" class="" placeholder="Ресурс электрода">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Стоимость краски</label>
                </td>
                <td>
                    <input id="inkCost" type="text" class="" placeholder="Стоимость краски">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Стоимость грунтовки</label>
                </td>
                <td>
                    <input id="primerCost" type="text" class="" placeholder="Стоимость грунтовки">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Продолжительность покраски</label>
                </td>
                <td>
                    <input id="coloringDuration" type="text" class="" placeholder="Продолжительность покраски">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Продолжительность сваривания</label>
                </td>
                <td>
                    <input id="weldTime" type="text" class="" placeholder="Продолжительность сваривания">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: -webkit-center;">
                    <input id="save" type="button" value="Сохранить">
                </td>
            </tr>
        </table>
        <?php
        foreach ($output_data as $row) {
            echo "<script>$('#" . $row["name"] . "').val('" . $row["value"] . "')</script>";
        }
        ?>
    </div>
</div>
<script src="js/scripts.js"></script>
</body>

</html>