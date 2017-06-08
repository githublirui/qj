<?php
require_once(dirname(__FILE__) . "/../../require/function.inc.php");

if ($num == 1) {
    $swfurl = "uploader.swf";
} else {
    $swfurl = "uploaders.swf";
}
if ($tp == "image") {
    $filetp = "jpg|jpeg|gif|png|bmp";
} else if ($tp == "audio") {
    $filetp = "mp3|wma";
} else if ($tp == "all") {
    $filetp = "jpg|jpeg|gif|png|bmp|mp3|wma|flv|swf|mp4|m4v";
}else if ($tp == "video") {
    $filetp = "wma|flv|swf|mp4|m4v";
}else if ($tp == "applevideo") {
    $filetp = "mp4|m4v";
}

if($namecode == "self"){
    $phpdir = "upload2.php";
}else{
    $phpdir = "upload.php";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="uploadtool.js"></script>
        <script type="text/javascript">
            var cmspath = "<?php echo $cms; ?>";
            function push() {
                if ($(".imgbox").children("img").length == 1) {
                    var data = $(".imgbox").children("img").attr("result");
                } else {
                    var data = "";
                    for (i = 0; i < $(".imgbox").children("img").length; i++) {
                        if (i > 0) {
                            data += "|";
                        }
                        data += $(".imgbox").children("img").eq(i).attr("result");
                    }
                }

                opener.<?php echo $jsname; ?>(data);
                window.close();
            }
        </script>
    </head>
    <body style="padding: 5px;">

        <div id="control">
            <div id="flash">
                <object id="myFlash" codeBase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="300" align="middle" height="30">
                    <param name="allow script Access" value="sameDomain"/>
                    <param name="movie" value="<?php echo $swfurl; ?>"/>
                    <param name="quality" value="high"/>
                    <param name="bgcolor" value="#ffffff"/>
                    <param name="menu" value="false"/>
                    <param name="flashvars" value="phpurl=<?php echo $phpdir; ?>&filetype=<?php echo $filetp; ?>&filemax=<?php echo $cfg_upload_size*1024 ?>&filetypeinfo=<?php echo $tp; ?>"/>
                    <param name="wmode" value="Transparent"/>
                    <embed width="300" height="30" flashvars="phpurl=<?php echo $phpdir; ?>&filetype=<?php echo $filetp; ?>&filemax=<?php echo $cfg_upload_size*1024 ?>&filetypeinfo=<?php echo $tp; ?>" name="myFlash" wmode="Transparent" type="application/x-shockwave-flash" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer" src="<?php echo $swfurl; ?>" swLiveConnect="true" Access="sameDomain" menu="false" bgcolor="#ffffff" quality="high"/>
                </object>
            </div>
        </div>
        <div id="selected"></div>
        <div id="result"></div>
        <div id="subbox"><input type="button" class="btn1" value="提交" onClick="push();" />&nbsp;<font color="red">(&nbsp;等上传的内容显示后再点“提交”)</font></div>
    </body>
</html>
