<?php

require_once(dirname(__FILE__) . "/../../config.php");
$dataarr = explode("|", $data);
$xml = "";
$xml .= '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$xml .= '<krpano version="1.0.8" basedir="" onstart="action(start);" >' . "\r\n";

$xml .= '<action name="start">' . "\r\n";
$xml .= 'loadscene(scene1, null, MERGE);' . "\r\n";
$xml .= '</action>' . "\r\n";

$xml .= '<events onloadcomplete="" />' . "\r\n";

$xml .= '<scene name="scene1">' . "\r\n";
if ($dataarr[0] == 1 || $dataarr[0] == 2) {
    $xml .= '<view fov="80" fisheye="0" fovmin="60" fovmax="120" />' . "\r\n";
} else {
    $xml .= "<view limitview=\"auto\" maxpixelzoom=\"2.0\" />\r\n";
}
if ($dataarr[0] == 1) {
    $xml .= '<image type="SPHERE">' . "\r\n";
    $xml .= '<sphere url="' . $cmspath . $dataarr[1] . '" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else if ($dataarr[0] == 2) {
    $xml .= '<image type="CUBE">' . "\r\n";
    $xml .= '<left url="' . $cmspath . $dataarr[3] . '" />' . "\r\n";
    $xml .= '<front url="' . $cmspath . $dataarr[1] . '" />' . "\r\n";
    $xml .= '<right url="' . $cmspath . $dataarr[4] . '" />' . "\r\n";
    $xml .= '<back url="' . $cmspath . $dataarr[2] . '" />' . "\r\n";
    $xml .= '<up url="' . $cmspath . $dataarr[5] . '" />' . "\r\n";
    $xml .= '<down url="' . $cmspath . $dataarr[6] . '" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else if ($dataarr[0] == 3) {
    $xml .= '<image hfov="1.0">' . "\r\n";
    $xml .= '<cylinder url="' . $cmspath . $dataarr[1] . '" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
}

$xml .= '<hotspot name="introimage" alpha="0.6" url="%BASEDIR%/introimage.png" onover="tween(alpha,1.0);" ondown="draghotspot();" onout="tween(alpha,0.6);" onclick="getback();"  keep="true" align="center"/>' . "\r\n";
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
