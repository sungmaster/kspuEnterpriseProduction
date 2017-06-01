<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Склад</title>
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
    echo "<table id='stock_table'><tr id='main_tr_stock'><td>Артикул</td><td>Материал</td><td>Количество</td></tr>";
    foreach($output_data as $row) {
        echo "<tr>";
        echo "
            <td>".$row["dmarticul"]."</td>
            <td>".$row["mname"]."</td>
            <td>".$row["count"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>

    
</div>
<div class="container pt-100 center">
    <div class="misc stock-new">
        <input id="smodel" list="model-list">
        <!--<select id="smodel">-->
        <datalist id="model-list">
        <?php
        foreach($models as $row) {
            echo '<option value="'.$row['dmid'].'">'.$row['dmarticul'].'</option>';
        }?>
        </datalist>
        <!--</select>-->
        <input id="smaterial" list="material-list">
        <!--<select id="smaterial">-->
        <datalist id="material-list">
        <?php
        foreach($materials as $row) {
            echo '<option value="'.$row['mid'].'">'.$row['mname'].'</option>';
        }?>
        </datalist>
        <!--</select>-->
        <input type="number" step="1" placeholder="Количество" id="dcount">
        <input id="ssave" type="button" value="Сохранить">
    </div>
</div>
    <script src="js/scripts.js"></script>
    <script>
        $("#ssave").click(function(){
            var a = $("#smodel").val();
            var b = $("#smaterial").val();
            //var c = parseFloat($("#dlen").val()).toFixed(2);
            var d = parseInt($("#dcount").val());
            if (d != 0){
                var oReq = new XMLHttpRequest();
                oReq.onload = function(){
                    if (d > 0)
                        alert("Деталь \""+$("#model-list > option[value='"+a+"']").html()+"\" ("+
                            $("#material-list > option[value='"+b+"']").html()+" - "+Math.abs(d)+" шт.) добавлена на склад");
                    else {
                        alert("Деталь \""+$("#model-list > option[value='"+a+"']").html()+"\" ("+
                        $("#material-list > option[value='"+b+"']").html()+" - "+Math.abs(d)+" шт.) списана со склада");
                    }
                    location.reload();
                };
                oReq.open("get", "./lib/php/pages/xmlhttp.php?q=updatedetail&material="+b+"&dmodel="+a+"&count="+d, true);
                oReq.send();
            }

        });
    </script>
</body>
</html>