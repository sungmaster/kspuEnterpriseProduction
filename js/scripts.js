$(document).ready(function() {
    $('a[href^="#"]').click(function(){
        var el = $(this).attr('href');
        $('body').animate({
            scrollTop: $(el).offset().top}, 500);
        return false;
    });
});
function get_detail_price(pid, mid) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $("#"+pid+"_detail").html(xmlhttp.responseText.split("&")[0] + " грн.");
        }
    };
    xmlhttp.open("GET", "lib/php/pages/xmlhttp.php?pid="+pid+"&mid="+mid+"&q=calculateProductParam", true);
    xmlhttp.send();
}
function base64(f, callback){
    var coolFile = {};
    function readerOnload(e){
        coolFile.base64 = btoa(e.target.result);
        callback(coolFile)
    }

    var reader = new FileReader();
    reader.onload = readerOnload;

    var file = f[0].files[0];
    if (file === undefined) {
        alert("Выберите файл!");
        return;
    }
    coolFile.filetype = file.type;
    coolFile.size = file.size;
    coolFile.filename = file.name;
    reader.readAsBinaryString(file);
}
$("#photo_file").on("change", function (e) {
    var form = e.target.id.split("_")[0];
    base64( $('#photo_file'), function(data){
        $("#base64img").val('data:image/jpeg;base64,'+data.base64);
        //alert(data.base64);
    });
});
$("#mat_submit").click(function () {
    var rus = {"mname": "Название", "marticul": "Артикул", "price": "Цена за 1м", "inkconsumption": "Расход на покраску", "base64img": "Фото"};
    var ids = {"mname": "#mname", "marticul": "#marticul", "price": "#price", "inkconsumption": "#inkconsumption", "base64img": "#base64img"};
    add_record(rus, ids, "updateMaterial");

});
$("#sim_det_submit").click(function () {
    var rus = {
        "time2m": "Время работы на 1м",
        "btime": "Дополнительные затраты времени",
        "amortization2m": "Затраты на 1м",
        "spending": "Дополнительные затраты",
        "dmarticul": "Артикул",
        "dmname": "Название",
        "dcatalog": "Каталог",
        "base64img": "Фото"};
    var ids = {
        "time2m": "#time2m",
        "btime": "#btime",
        "amortization2m": "#amortization2m",
        "spending": "#spending",
        "dmarticul": "#dmarticul",
        "dmname": "#dmname",
        "dcatalog": "#dcatalog",
        "base64img": "#base64img"};
    add_record(rus, ids, "updateDetailModelList");
});
function add_record(rus_params, ids_params, add_function) {
    var params = {};
    for (var par in ids_params) {
        if (par == "dcatalog") {
            params[par] = parseInt($("input[type='radio']:checked").attr("id"));
        }
        else {
            params[par] = $(ids_params[par]).val();
        }
        if (params[par] == "") {
            alert("Вы не указали параметр: " + rus_params[par]);
            return;
        }
    }

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "lib/php/pages/xmlhttp.php", true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText.indexOf("error") != -1) {
                alert(xmlhttp.responseText);
            }
            switch(add_function) {
                case "updateDetailModelList": {
                    alert("Деталь добавлена!");
                    break;
                }
                case "updateMaterial": {
                    alert("Материал добавлен!");
                    break;
                }
                default: {
                    alert("Готово!");
                }
            }
            location.reload();
        }
    };

    var pars = "q="+encodeURIComponent(add_function);
    for (par in params) {
        pars += "&" + par + "=" + encodeURIComponent(params[par]);
    }

    xmlhttp.send(pars);
}
$(".dModel").on("click", function (e) {
    $(".dModel").css("backgroundColor", "#fff");
    e.target.style.backgroundColor = "#bbbbbb";
});










