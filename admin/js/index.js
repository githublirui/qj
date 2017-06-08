var nowchannel;
var winopen = true;
$(document).ready(function() {
    setWin();
    changeChannel(0);
    $(".cube_parent").click(function() {
        var len = $(this).parent().prevAll().length;
        changeChannel(len);
    });
    $("#onoffbtn").click(function() {
        if (winopen == true) {

            $(".cube_child").hide();
            $(".icontitle").hide();
            $("#arrowtext").hide();
            $("#leftbox").css("width", "30px");
            $("#arrow").css("background-position","0 -20px");
            winopen = false;
        } else {
            changeChannel(nowchannel);
        }
    });
});
function setWin() {
    var $width = $(window).width();
    var $height = $(window).height();
    $("#leftbox").css("height", ($height - 28) + "px");
    $("#rightbox").css("height", ($height - 28) + "px");    
}
$(window).resize(function() {
    setWin();
});

function changeChannel(n) {
    if (winopen == false) {
        $("#leftbox").css("width", "145px");
        $(".icontitle").show();
        $("#arrowtext").show();
        $("#arrow").css("background-position","0 0");
        winopen = true;
    }

    if (n != nowchannel) {
        $(".cube_child").stop().slideUp(200);
        $(".cube_child").eq(n).stop().slideDown(200);
    }else{
        $(".cube_child").hide();
        $(".cube_child").eq(n).show();
    }
    nowchannel = n;
}