<?php
require_once(dirname(__FILE__) . "/../../config.php");
$mydb = new MySql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $id";
$scenerow = $mydb->getOne($scenesql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>获取视频位置</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css"> 
            html {height: 100%;overflow: hidden;}
            #vrpano {
                height: 100%; float: left; width: 85%;
            }
            #control{
                height: 100%; float: right; width: 15%; background: url(lan.png) repeat-y; overflow: hidden; color: #fff; font: 12px/20px "微软雅黑"; 
            }
            body {height: 100%;margin: 0;padding: 0;background-color: #fff;}
            .btn1{
                width: 20px; height: 20px; background: url(up.png) no-repeat; overflow: hidden; padding: 0px; border:none;
                color: #666; cursor: pointer; font: 12px/20px "微软雅黑";
            }
            .btn2{
                width: 20px; height: 20px; background: url(down.png) no-repeat; overflow: hidden; padding: 0px; border:none;
                color: #666; cursor: pointer; font: 12px/20px "微软雅黑";
            }
        </style>
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript">
            function getback() {
                var hotspotdata = "";
                var spotscale = vrpano().get("hotspot[videospot].scale");
                var spotatv = vrpano().get("hotspot[videospot].atv");
                var spotath = vrpano().get("hotspot[videospot].ath");
                var spotrz = vrpano().get("hotspot[videospot].rz");
                var spotrx = vrpano().get("hotspot[videospot].rx");
                var spotry = vrpano().get("hotspot[videospot].ry");
                var spotrwidth = vrpano().get("hotspot[videospot].width");
                var spotrheight = vrpano().get("hotspot[videospot].height");
                hotspotdata = spotscale+"|"+spotatv+"|"+spotath+"|"+spotrz+"|"+spotrx+"|"+spotry+"|"+spotrwidth+"|"+spotrheight;
                window.opener.getvideodata(hotspotdata);
                window.close();
            }
            function vrpano() {
                return document.getElementById("krpanoSWFObject");
            }
            
            $(document).ready(function() {
                $("#scaleup").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].scale");
                    n = n + 0.05;
                    krpano.set("hotspot[videospot].scale", n);
                });
                $("#scaledown").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].scale");
                    n = n - 0.05;
                    krpano.set("hotspot[videospot].scale", n);
                });
                
                $("#xup").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].rx");
                    n = n + 1;
                    krpano.set("hotspot[videospot].rx", n);
                });
                $("#xdown").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].rx");
                    n = n - 1;
                    krpano.set("hotspot[videospot].rx", n);
                });
                
                $("#yup").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].ry");
                    n = n + 1;
                    krpano.set("hotspot[videospot].ry", n);
                });
                $("#ydown").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].ry");
                    n = n - 1;
                    krpano.set("hotspot[videospot].ry", n);
                });
                
                $("#zup").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].rz");
                    n = n + 1;
                    krpano.set("hotspot[videospot].rz", n);
                });
                $("#zdown").click(function() {
                    var krpano = document.getElementById("krpanoSWFObject");
                    var n = krpano.get("hotspot[videospot].rz");
                    n = n - 1;
                    krpano.set("hotspot[videospot].rz", n);
                });
                
            });
        </script>
    </head>
    <body>
        <div id="vrpano"></div>
        <div id="control">
            <table>
                <tr>
                    <td style="padding-left: 6px;" colspan="2"><b>鼠标操作方法</b></td>
                </tr>
                <tr>
                    <td style="padding-left: 6px;" colspan="2">
                        -鼠标点中并拖动可以移动<br/>
                        -鼠标点中，按下ctrl或shift可以放大缩小<br/>
                        -鼠标点中，按下R并拖动可以Z轴扭曲<br/>
                        -鼠标点中，按下空格并拖动可以XY轴扭曲<br/>
                    </td>
                </tr>
                <tr>
                    <td style="height: 30px;" colspan="2"></td>
                </tr>   
                <tr>
                    <td style="width: 80px;text-align: right;">缩放：</td>
                    <td>
                        <input type="button" id="scaleup" class="btn1"/>
                        <input type="button" id="scaledown"  class="btn2"/>
                    </td>
                </tr>   
                <tr>
                    <td style="width: 80px;text-align: right;">X轴旋转：</td>
                    <td>
                        <input type="button" id="xup" class="btn1"/>
                        <input type="button" id="xdown"  class="btn2"/>
                    </td>
                </tr>  
                <tr>
                    <td style="width: 80px;text-align: right;">Y轴旋转：</td>
                    <td>
                        <input type="button" id="yup" class="btn1"/>
                        <input type="button" id="ydown"  class="btn2"/>
                    </td>
                </tr>  
                <tr>
                    <td style="width: 80px;text-align: right;">Z轴旋转：</td>
                    <td>
                        <input type="button" id="zup" class="btn1"/>
                        <input type="button" id="zdown"  class="btn2"/>
                    </td>
                </tr>  
            </table>
        </div>
        <script type="text/javascript" src="<?php echo $cmspath; ?>/vrpano/vrpano<?php echo $scenerow['pid']; ?>/swfkrpano.js"></script>
        <script type="text/javascript">
            embedpano({swf: "<?php echo $cmspath; ?>/vrpano/vrpano<?php echo $scenerow['pid']; ?>/krpano.swf", xml: "editxml.php?data=<?php echo $id; ?>|<?php echo $video; ?>|<?php echo $spotid; ?>", target: "vrpano", html5: "auto", passQueryParameters: true, wmode: "transparent"});
        </script>
    </body>
</html>
