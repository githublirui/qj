<?php
require_once(dirname(__FILE__) . "/../../config.php");
$mydb = new MySql();
$mapsql = "SELECT * FROM `#@__pano_maps` WHERE `id` = $mapid";
$maprow = $mydb->getOne($mapsql);
$imgfile = $cmspath."/vrpano/vrpano$id/map/".$maprow['file'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>My Map</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript">
            
            function getmap(x,y){
                opener.getmapdata(x,y,"<?php echo $key; ?>");
                window.close();
            }
        </script>

        <style type="text/css"> 
            html {
                height: 100%;
                overflow: hidden;
            }
            #flashContent {
                height: 100%;
            }
            body {
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #fff;
            }
        </style>

    </head>
    <body>
        <div id="flashContent">
            <object id="myFlash" codeBase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="100%" align="middle" height="100%">
                <param name="allow script Access" value="sameDomain"/>
                <param name="movie" value="map.swf"/>
                <param name="quality" value="high"/>
                <param name="bgcolor" value="#ffffff"/>
                <param name="menu" value="false"/>
                <param name="wmode" value="Transparent"/>
                <param name="flashvars" value="images=<?php echo $imgfile; ?>"/>
                <embed width="100%" height="100%" name="myFlash" flashvars="images=<?php echo $imgfile; ?>" wmode="Transparent" type="application/x-shockwave-flash" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer" src="map.swf" swLiveConnect="true" Access="sameDomain" menu="false" bgcolor="#ffffff" quality="high"/>
            </object>
        </div>
    </body>
</html>