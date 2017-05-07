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
            $("#"+pid+"_detail").html(xmlhttp.responseText);
        }
    };
    var params = "pid="+pid+"&mid="+mid+"&type=simple";
    xmlhttp.open("GET", "lib/php/pages/xmlhttp.php", true);
    xmlhttp.send(params);
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
    coolFile.filetype = file.type;
    coolFile.size = file.size;
    coolFile.filename = file.name;
    reader.readAsBinaryString(file);
}
$("load_img").click(function () {
    base64( $('#asd'), function(data){console.log('data:image/jpeg;base64,'+data.base64)});
});