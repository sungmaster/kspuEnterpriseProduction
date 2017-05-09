$(document).ready(function() {
    $('a[href^="#"]').click(function(){
        var el = $(this).attr('href');
        $('body').animate({
            scrollTop: $(el).offset().top}, 500);
        return false;
    });
});
function get_detail_price_time(pid, mid, calc) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (calc == 0) {
                $("#" + pid + "_price").html(Math.floor(parseFloat(xmlhttp.responseText.split("&")[0]) * 100) / 100);
                $("#" + pid + "_time").html(norm_time(parseInt(xmlhttp.responseText.split("&")[1])));
            }
            else {
                $("#tprice").val(xmlhttp.responseText.split("&")[0] + " грн.");
                $("#ttime").val(norm_time(parseInt(xmlhttp.responseText.split("&")[1])));
            }
        }
    };
    xmlhttp.open("GET", "lib/php/pages/xmlhttp.php?pid="+pid+"&mid="+mid+"&q=calculateProductParam", true);
    xmlhttp.send();
}
function norm_time(time) {
    if (time < 60) {
        return time + " мин.";
    }
    else {
        var h = parseInt(time / 60);
        var m = time - h * 60;
        return h + " ч. " + m + " мин.";

    }
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
$("#s_d_submit").on("click", function () {
    if (count_gpoints() == 0 || $("#gpoints").val() == "") {
        alert("Вы не выбрали ни одной детали!");
        return;
    }
    var rus = {
        "details_count": "Количество деталей",
        "details": "Детали",
        "width": "Ширина",
        "height": "Высота",
        "garticul": "Артикул",
        "gname": "Название",
        "gpoints": "Количество точек сварки",
        "gamortization": "Дополнительные затраты",
        "gcatalog": "Каталог",
        "base64img": "Фото"};
    var ids = {
        "details_count": "#details_count",
        "details": "#details",
        "width": "#width",
        "height": "#height",
        "garticul": "#garticul",
        "gname": "#gname",
        "gpoints": "#gpoints",
        "gamortization": "#gamortization",
        "gcatalog": "#gcatalog",
        "base64img": "#base64img"};

    var details = "[";
    var checked = $("input[type='checkbox']:checked");
    var len = parseInt($("#"+parseInt(checked[0].id)+"_len").val()) / 1000;
    var num = $("#"+parseInt(checked[0].id)+"_num").val();
    details += "["+parseInt(checked[0].id)+","+len+","+num+"]";
    for (var i = 1; i < checked.length; i++) {
        len = parseInt($("#"+parseInt(checked[i].id)+"_len").val()) / 1000;
        num = $("#"+parseInt(checked[i].id)+"_num").val();
        details += ",["+parseInt(checked[i].id)+","+len+","+num+"]";
    }
    details += "]";
    $("#details").val(details);
    $("#details_count").val(checked.length);
    $("#gcatalog").val(count_gpoints() > 1 ? 4 : 3);
    add_record(rus, ids, "updateProduct");
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
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            /*if (xmlhttp.responseText.indexOf("error") != -1 || xmlhttp.responseText.indexOf("otice") != -1) {
                alert(xmlhttp.responseText);
            }*/
            switch(add_function) {
                case "updateDetailModelList": {
                    alert("Деталь добавлена!");
                    break;
                }
                case "updateMaterial": {
                    alert("Материал добавлен!");
                    break;
                }
                case "updateProduct": {
                    alert("Продукт добавлен!");
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
$(".mat_table_tr").on("click", function (e) {
    var td = e.target;

    while (td.previousSibling) {
        td = td.previousSibling;
    }
    var id = td.nextSibling.innerHTML;
    var gid = location.href.substring(location.href.indexOf("id=")+3, location.href.indexOf("&") != -1 ? location.href.indexOf("&") : location.href.length);

    get_detail_price_time(gid, id, 1);
});


function get_img() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "lib/php/pages/xmlhttp.php?q=getProduct&pid="+location.href.split("?")[1].split("&")[0].split("=")[1], true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $("#gname").val(xmlhttp.responseText.split("&")[6]);
            $("#g_img").attr("src", xmlhttp.responseText.split("&")[10]);
        }
    };
    xmlhttp.send();
}

$("#save").click(function () {
    var params = "";
    var t_par = ['weldorSalary', 'operatorSalary', 'painterSalary', 'electrodeCost',
        'electrodeSpending', 'inkCost', 'primerCost', 'coloringDuration', 'weldTime'];
    for (var i = 0; i < t_par.length; i++) {
        params += "&" + t_par[i] + "=" + $("#"+t_par[i]).val();
    }

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "lib/php/pages/xmlhttp.php?q=updateMisc"+params, true);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert("Готово!");
            location.reload();
        }
    };
    xmlhttp.send();
});
$("input[type='checkbox']").on("click", function (e) {
    count_gpoints();
});
$(".mod_num").on("click", function () {
    count_gpoints();
}).on("change", function () {
    count_gpoints();
});

function count_gpoints() {
    var checked = $("input[type='checkbox']:checked");
    var sum = 0;

    for (var i = 0; i < checked.length; i++) {
        sum += parseInt($("#" + parseInt(checked[i].id) + "_num").val());
    }
    $("#gpoints").val(sum);
    return sum;
}







