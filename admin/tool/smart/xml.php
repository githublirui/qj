<?php

require_once(dirname(__FILE__) . "/../../config.php");
$datas = explode("|", $data);
$id = $datas[0];
$img = $datas[1];
$mydb = new MySql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $id";
$scenerow = $mydb->getOne($scenesql);

$xml = "";
$xml .= '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$xml .= '<krpano version="1.0.8"  basedir="" onstart="action(start);" >' . "\r\n";
$xml .= "<plugin name=\"editor\" url=\"{$cmspath}/admin/tool/smart/plugins/editor.swf\" keep=\"true\"/>\r\n";
$xml .= '<action name="start">' . "\r\n";
$xml .= 'loadscene(scene1, null, MERGE);' . "\r\n";
$xml .= '</action>' . "\r\n";

$xml .= '<events onloadcomplete="" />' . "\r\n";

$xml .= '<scene name="scene1">' . "\r\n";
if ($scenerow['type'] == 1 || $scenerow['type'] == 2) {
    $xml .= '<view fov="80" fisheye="0" fovmin="60" fovmax="120" />' . "\r\n";
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
$xml .= "<hotspot url=\"" . $cmspath . $img . "\" volume=\"1\" width=\"\" height=\"\" atv=\"0\" ath=\"0\" scale=\"1\" rz=\"0\" ry=\"0\" rx=\"0\" zoom=\"True\" name=\"me\" capture=\"False\" enabled=\"True\" visible=\"True\" rotatewithview=\"False\" distorted=\"True\" smoothing=\"True\" refreshrate=\"\" blendmode=\"NORMAL\" zorder=\"1\" />\r\n";

$xml .= '</scene>' . "\r\n";
$xml .= "<plugin name=\"endbtn\" url=\"{$cmspath}/admin/tool/smart/button.png\" keep=\"true\" align=\"rightbottom\" x=\"18\" y=\"18\" alpha=\"0.8\" onover=\"tween(alpha,1);\" onout=\"tween(alpha,0.8);\" onclick=\"js(getback();)\"/>\r\n";

$xml .= '</krpano>' . "\r\n";
echo $xml;
?>
