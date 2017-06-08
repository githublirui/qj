<?php
require_once(dirname(__FILE__) . "/../../config.php");
$mydb = new MySql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $id";
$scenerow = $mydb->getOne($scenesql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>获取多边形</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css"> 
            html {height: 100%;overflow: hidden;}
            #vrpano {height: 100%;}
            body {height: 100%;margin: 0;padding: 0;background-color: #fff;}
        </style>
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript">
            function getback() {
                var num_hotspot = vrpano().get("hotspot.count");
                var points = "";
                if (num_hotspot > 0) {
                    num_hotspot = num_hotspot - 1;
                    var num_points = vrpano().get("hotspot[" + num_hotspot + "].point.count");                    
                    for (var i = 0; i < num_points; i++) {
                        if(points!=""){
                            points += "&&";
                        }
                        points += str_point(num_hotspot, i, 'ath') + '||' + str_point(num_hotspot, i, 'atv');
                    }
                    window.opener.getpoints(points);
                    window.close();
                }else{
                    alert("请添加多边形热区！");
                }
            }
            function vrpano() {
                return document.getElementById("krpanoSWFObject");
            }
            function str_point(num_hotspot, i, hv) {
                return vrpano().get('hotspot[' + num_hotspot + '].point[' + i + '].' + hv);
            }
            function add_hotspot(){
                var name = "temp_name";
                krpano().call("addhotspot(" + name + ");");
            }
        </script>
    </head>
    <body>
        <div id="vrpano">
        </div>
        <script type="text/javascript" src="<?php echo $cmspath; ?>/vrpano/vrpano<?php echo $scenerow['pid']; ?>/swfkrpano.js"></script>
        <script type="text/javascript">
            embedpano({swf: "<?php echo $cmspath; ?>/vrpano/vrpano<?php echo $scenerow['pid']; ?>/krpano.swf", xml: "xml.php?id=<?php echo $id; ?>", target: "vrpano", html5: "auto", passQueryParameters: true, wmode: "transparent"});
        </script>
    </body>
</html>
