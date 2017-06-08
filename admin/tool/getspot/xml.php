<?php

require_once(dirname(__FILE__) . "/../../config.php");
$datas = explode("|", $data);
$id = $datas[0];
$styleid = $datas[1];
$h = $datas[2];
$v = $datas[3];
$mydb = new MySql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $id";
$scenerow = $mydb->getOne($scenesql);

$spotsql = "SELECT * FROM `#@__pano_spotstyle` WHERE `id` = $styleid";
$spotrow = $mydb->getOne($spotsql);

$xml = "";
$xml .= '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$xml .= '<krpano version="1.0.8" onstart="action(start);" >' . "\r\n";

$xml .= '<action name="start">' . "\r\n";
$xml .= 'loadscene(scene1, null, MERGE);' . "\r\n";
$xml .= '</action>' . "\r\n";

$xml .= '<events onloadcomplete="" />' . "\r\n";

$xml .= '<scene name="scene1">' . "\r\n";
if ($scenerow['type'] == 1 || $scenerow['type'] == 2) {
    $xml .= '<view fov="80" fisheye="0" hlookat="' . $h . '" vlookat="' . $v . '" fovmin="60" fovmax="120" />' . "\r\n";
} else {
    $xml .= "<view limitview=\"auto\" maxpixelzoom=\"2.0\" />\r\n";
}

$xml .= '<preview url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/preview.jpg" />' . "\r\n";
if ($scenerow['type'] == 1) {
    $xml .= '<image type="SPHERE">' . "\r\n";
    $xml .= '<sphere url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else if ($scenerow['type'] == 2) {
    $xml .= '<image type="CUBE">' . "\r\n";
    $xml .= '<left url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_left.jpg" />' . "\r\n";
    $xml .= '<front url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_front.jpg" />' . "\r\n";
    $xml .= '<right url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_right.jpg" />' . "\r\n";
    $xml .= '<back url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_back.jpg" />' . "\r\n";
    $xml .= '<up url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_up.jpg" />' . "\r\n";
    $xml .= '<down url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_down.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else if ($scenerow['type'] == 3) {
    $xml .= '<image hfov="1.0">' . "\r\n";
    $xml .= '<cylinder url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
}
if ($spotrow['typeid'] != 3) {
    $xml .= '<hotspot name="introimage" alpha="1" ath="' . $h . '" atv="' . $v . '" url="' . $cmspath . $spotrow['url'] . '" ondown="draghotspot();" onclick="getback();"  keep="true" align="center"/>' . "\r\n";
} else {
    $xml .= '<hotspot name="introimage" alpha="1" ath="' . $h . '" atv="' . $v . '" url="' . $cmspath . $spotrow['url'] . '" ';
    $xml .= "crop=\"0|0|{$spotrow['framewidth']}|{$spotrow['frameheight']}\" ";
    $lastframenum = $spotrow['lastframe'] - 1;
    $xml .= "framewidth=\"{$spotrow['framewidth']}\" frameheight=\"{$spotrow['frameheight']}\" frame=\"0\" lastframe=\"$lastframenum\" ";
    $xml .= "onloaded=\"hotspot_animate({$spotrow['speed']});\" ";
    $xml .= 'ondown="draghotspot();" onclick="getback();"  keep="true" align="center"/>' . "\r\n";
}

$xml .= "<action name=\"hotspot_animate\">\r\n";
$xml .= "inc(frame,1,get(lastframe),0);\r\n";
$xml .= "mul(ypos,frame,frameheight);\r\n";
$xml .= "txtadd(crop,'0|',get(ypos),'|',get(framewidth),'|',get(frameheight));\r\n";
$xml .= "delayedcall(%1, if(loaded, hotspot_animate(%1) ) );\r\n";
$xml .= "</action>\r\n";

$xml .= '</scene>' . "\r\n";


$xml .= "<action name=\"draghotspot\">\r\n";
$xml .= "<![CDATA[\r\n";
$xml .= "if(%1 != dragging,\r\n";
$xml .= "spheretoscreen(ath, atv, hotspotcenterx, hotspotcentery);\r\n";
$xml .= "sub(drag_adjustx, mouse.stagex, hotspotcenterx); \r\n";
$xml .= "sub(drag_adjusty, mouse.stagey, hotspotcentery); \r\n";
$xml .= "draghotspot(dragging);\r\n";
$xml .= ",\r\n";
$xml .= "if(pressed,\r\n";
$xml .= "sub(dx, mouse.stagex, drag_adjustx);\r\n";
$xml .= "sub(dy, mouse.stagey, drag_adjusty);\r\n";
$xml .= "screentosphere(dx, dy, ath, atv);\r\n";
$xml .= "copy(print_ath, ath);\r\n";
$xml .= "copy(print_atv, atv);\r\n";
$xml .= "roundval(print_ath, 3);\r\n";
$xml .= "roundval(print_atv, 3);\r\n";
$xml .= "txtadd(plugin[hotspotinfo].html, '&lt;hotspot name=\"',get(name),'\"[br]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ath=\"',get(print_ath),'\"[br]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;atv=\"',get(print_atv),'\"[br]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...[br]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&gt;');\r\n";
$xml .= "delayedcall(0, draghotspot(dragging) );\r\n";
$xml .= ");\r\n";
$xml .= ");\r\n";
$xml .= "]]>\r\n";
$xml .= "</action>\r\n";

$xml .= '<action name="getback">' . "\r\n";
$xml .= 'js(back(get(hotspot[introimage].ath),get(hotspot[introimage].atv)));' . "\r\n";
$xml .= '</action>' . "\r\n";
$xml .= '</krpano>' . "\r\n";

echo $xml;
?>
