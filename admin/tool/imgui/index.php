<?php
require_once(dirname(__FILE__) . "/../../config.php");
$mydb = new MySql();
$uisql = "SELECT * FROM `#@__pano_ui` WHERE `id` = $id";
$uirow = $mydb->getOne($uisql);
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = {$uirow['pid']}";
$scenerow = $mydb->getOne($scenesql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>获取UI位置</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css"> 
            html {height: 100%;overflow: hidden;}
            #vrpano {
                height: 100%; float: left; width: 85%;
            }
            #control{
                height: 100%; float: right; width: 15%; background: url(lan.png) repeat-y; overflow: hidden;
            }
            body {height: 100%;margin: 0;padding: 0;background-color: #fff;}
            .ovo{
                width: auto; height: auto; overflow: hidden; margin: 0 auto; padding: 10px; color: #fff; font: 12px/24px "微软雅黑";
            }
            .btn1{
                width: 68px; height: 22px; background: url(../../images/common/btn1.jpg) no-repeat; overflow: hidden; padding: 0px; margin: 2px; border:none;
                color: #666; cursor: pointer; font: 12px/22px "微软雅黑";
            }
            .btn1:hover{
                background-position: 0 -22px;
            }
        </style>
        <style type="text/css">
            .tian{
                width: 72px; height: 72px; overflow: hidden;
            }
            .tian .box{
                width: 22px; height: 22px; overflow: hidden; float: left; _display: inline; background: url(../../images/vrpano/ding.png) no-repeat; cursor: pointer; margin: 1px;
            }
            .tian .box:hover{
                background-image: url(../../images/vrpano/ding3.png);
            }
            .tian .box.me{
                width: 22px; height: 22px; overflow: hidden; float: left; _display: inline; background: url(../../images/vrpano/ding2.png) no-repeat;
            }
            .tian .box.a1{
                background-position: 0px 0px;
            }
            .tian .box.a2{
                background-position: -22px 0px;
            }
            .tian .box.a3{
                background-position: -44px 0px;
            }
            .tian .box.a4{
                background-position: 0px -22px;
            }
            .tian .box.a5{
                background-position: -22px -22px;
            }
            .tian .box.a6{
                background-position: -44px -22px;
            }
            .tian .box.a7{
                background-position: 0px -44px;
            }
            .tian .box.a8{
                background-position: -22px -44px;
            }
            .tian .box.a9{
                background-position: -44px -44px;
            }
        </style>
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript">
            function back(h,v){
                $("#spoth", opener.document).val(h);
                $("#spotv", opener.document).val(v);
                window.close();
            }
            var allgood = false;
            $(document).ready(function(){
                allgood = true;
            });
            function onetian(n){
                var k=n-1;
                $(".tian").children(".box").removeClass("me");
                $(".tian").children(".box").eq(k).addClass("me");
                $("#pos").val(n);
                changeswf();
            }
            function changeswf(){
                var fang = new Array();
                fang[1] = "lefttop";
                fang[2] = "top";
                fang[3] = "righttop";
                fang[4] = "left";
                fang[5] = "center";
                fang[6] = "right";
                fang[7] = "leftbottom";
                fang[8] = "bottom";
                fang[9] = "rightbottom";
                if(allgood == true){
                    var krpano = document.getElementById("krpanoSWFObject");
                    var uipos = $("#pos").val();
                    var uix = $("#uix").val();
                    var uiy = $("#uiy").val();
                    var uiscale = $("#uiscale").val();
                    var uizorder = $("#uizorder").val();
                    var uialpha = $("#uialpha").val();
                    krpano.set("plugin[me].align", fang[uipos]);
                    krpano.set("plugin[me].x", uix);
                    krpano.set("plugin[me].y", uiy);
                    krpano.set("plugin[me].scale", uiscale);
                    krpano.set("plugin[me].zorder", uizorder);
                    krpano.set("plugin[me].alpha", uialpha);
                }
            }
            function backdata(){
                var uipos = $("#pos").val();
                var uix = $("#uix").val();
                var uiy = $("#uiy").val();
                var uiscale = $("#uiscale").val();
                var uizorder = $("#uizorder").val();
                var uialpha = $("#uialpha").val();
                
                var data = new Array();
                data['uipos'] = uipos;
                data['uix'] = uix;
                data['uiy'] = uiy;
                data['uiscale'] = uiscale;
                data['uizorder'] = uizorder;
                data['uialpha'] = uialpha;
                
                opener.uibackdata(data);
                window.close();
            }
        </script>
    </head>
    <body>        
        <div id="vrpano"></div>
        <div id="control">
            <div class="ovo">
                <table>
                    <tr>
                        <td colspan="2" height="30px"><b>UI定位</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="pos" id="pos" value="<?php echo $uirow['uipos']; ?>" />
                            <div class="tian">
                                <div class="box a1 me" onclick="onetian(1);"></div>
                                <div class="box a2" onclick="onetian(2);"></div>
                                <div class="box a3" onclick="onetian(3);"></div>
                                <div class="box a4" onclick="onetian(4);"></div>
                                <div class="box a5" onclick="onetian(5);"></div>
                                <div class="box a6" onclick="onetian(6);"></div>
                                <div class="box a7" onclick="onetian(7);"></div>
                                <div class="box a8" onclick="onetian(8);"></div>
                                <div class="box a9" onclick="onetian(9);"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" height="10px"></td>
                    </tr>
                    <tr>
                        <td height="24px" width="50px" align="right"><b>X坐标：</b></td>
                        <td height="24px"><input type="text" id="uix" name="uix" value="<?php echo $uirow['uix']; ?>" size="6" /></td>
                    </tr>
                    <tr>
                        <td height="24px" width="50px" align="right"><b>Y坐标：</b></td>
                        <td height="24px"><input type="text" id="uiy" name="uiy" value="<?php echo $uirow['uiy']; ?>" size="6" /></td>
                    </tr>

                    <tr>
                        <td colspan="2" height="10px"></td>
                    </tr>
                    <tr>
                        <td height="24px" width="50px" align="right"><b>缩放：</b></td>
                        <td height="24px"><input type="text" id="uiscale" name="uiscale" value="<?php echo $uirow['uiscale']; ?>" size="6" /></td>
                    </tr>

                    <tr>
                        <td colspan="2" height="10px"></td>
                    </tr>
                    <tr>
                        <td height="24px" width="50px" align="right"><b>层级：</b></td>
                        <td height="24px"><input type="text" id="uizorder" name="uizorder" value="<?php echo $uirow['uizorder']; ?>" size="6" /></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" height="10px"></td>
                    </tr>
                    <tr>
                        <td height="24px" width="50px" align="right"><b>透明度：</b></td>
                        <td height="24px"><input type="text" id="uialpha" name="uialpha" value="<?php echo $uirow['uialpha']; ?>" size="6" /> (0~1)</td>
                    </tr>

                    <tr>
                        <td colspan="2" height="10px"></td>
                    </tr>
                    <tr>
                        <td colspan="2" height="26px">
                            <input type="button" value="修改预览" class="btn1" onclick="changeswf();" />
                            <input type="button" value="获取结果" class="btn1" onclick="backdata();" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            onetian(<?php echo $uirow['uipos']; ?>);
        </script>
        <script type="text/javascript" src="<?php echo $cmspath; ?>/vrpano/vrpano<?php echo $scenerow['pid']; ?>/swfkrpano.js"></script>
        <script type="text/javascript">
            embedpano({swf: "<?php echo $cmspath; ?>/vrpano/vrpano<?php echo $scenerow['pid']; ?>/krpano.swf", xml: "xml.php?id=<?php echo $id; ?>", target: "vrpano", html5: "auto", passQueryParameters: true});
        </script>
    </body>
</html>
