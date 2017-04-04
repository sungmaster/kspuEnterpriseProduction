$("#update_misc").click(function () {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $("#update_misc").val("789");
            setTimeout(function () {
                $("#update_misc").val("Отправить");
            }, 1000);
        }
    };

    var rows = 9;

    var data = "";
    data += $("#1-2").html() + "=" + $("#1-3").val();
    for (var i = 1; i <= rows; i++) {
        data += "&" + $("#" + i + "-2").html() + "=" + $("#" + i + "-3").val();
    }

    //alert(data);

    var href = document.location.href;
    href = href.substring(0, href.indexOf("temp_page")) + "lib/php/queries/updateMisc.php?" + data;

    //document.location.href = href;

    xmlhttp.open("GET", href, true);
    xmlhttp.send();

});

$(".btn-query").click(function (e) {
    var id = e.target.id;
    var href = document.location.href.split("/");
    var res_href = "";
    var num_dom = 5;

    res_href = res_href.substring(0, res_href.indexOf("?"));

    res_href += "?q=" + id;

    document.location.href = res_href;

});

$(document).ready(function () {
    var btn_query = $(".btn-query");

    for (var i = 0; i < btn_query.length; i++) {
        btn_query[i].id = btn_query[i].innerHTML;
    }

});







































