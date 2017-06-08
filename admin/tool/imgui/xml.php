<?php

require_once(dirname(__FILE__) . "/../../config.php");

$mydb = new MySql();
$uisql = "SELECT * FROM `#@__pano_ui` WHERE `id` = $id";
$uirow = $mydb->getOne($uisql);
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = {$uirow['pid']}";
$scenerow = $mydb->getOne($scenesql);

$alluisql = "SELECT * FROM `#@__pano_ui` WHERE `pid` = {$uirow['pid']} and id<>$id ORDER BY `id`";
$mydb->SetQuery($alluisql);
$mydb->Execute("allui");

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
$xml .= '</scene>' . "\r\n";

$fang[1] = "lefttop";
$fang[2] = "top";
$fang[3] = "righttop";
$fang[4] = "left";
$fang[5] = "center";
$fang[6] = "right";
$fang[7] = "leftbottom";
$fang[8] = "bottom";
$fang[9] = "rightbottom";

while ($alluirow = $mydb->GetArray("allui")) {
    if ($alluirow['openui'] == 1) {
        if ($alluirow['uitype'] == 1) {
            $xml .= "<plugin name=\"ui{$alluirow['id']}\" url=\"%SWFPATH%/ui/{$alluirow['imgfile']}\" ";
        } else {
            $xml .= "<plugin name=\"ui{$uirow['id']}\" url=\"%SWFPATH%/plugins/videoplayer.swf\" alturl=\"%SWFPATH%/plugins/videoplayer.js\" ";
            $xml .= "updateeveryframe=\"true\" videourl=\"%SWFPATH%/ui/{$alluirow['videofile']}\" loop=\"True\" volume=\"0.7\" onhover=\"showtext('点击播放/暂停');\" onclick=\"togglepause();\" ";
        }
        $xml .= "zorder=\"{$alluirow['uizorder']}\" alpha=\"1\" align=\"{$fang[$alluirow['uipos']]}\" x=\"{$alluirow['uix']}\" y=\"{$alluirow['uiy']}\" ox=\"0\" oy=\"0\" width=\"\" height=\"\" ";
        $xml .= "scale=\"{$alluirow['uiscale']}\" visible=\"True\" enabled=\"True\" capture=\"True\" keep=\"True\" showpic=\"\" ";
        $xml .= "handcursor=\"False\" ";
        $xml .= "/>\r\n";
    }
}

if ($uirow['uitype'] == 1) {
    $xml .= "<plugin name=\"me\" url=\"%SWFPATH%/ui/{$uirow['imgfile']}\" ";
} else {
    $xml .= "<plugin name=\"me\" url=\"%SWFPATH%/plugins/videoplayer.swf\" alturl=\"%SWFPATH%/plugins/videoplayer.js\" ";
    $xml .= "updateeveryframe=\"true\" videourl=\"%SWFPATH%/ui/{$uirow['videofile']}\" loop=\"True\" volume=\"0.7\" onhover=\"showtext('点击播放/暂停');\" onclick=\"togglepause();\" ";
}
$xml .= "zorder=\"{$uirow['uizorder']}\" alpha=\"1\" align=\"{$fang[$uirow['uipos']]}\" x=\"{$uirow['uix']}\" y=\"{$uirow['uiy']}\" ox=\"0\" oy=\"0\" width=\"\" height=\"\" ";
$xml .= "scale=\"{$uirow['uiscale']}\" visible=\"True\" enabled=\"True\" capture=\"True\" keep=\"True\" showpic=\"\" ";
$xml .= "/>\r\n";

$xml .= '</krpano>' . "\r\n";
echo $xml;
?>
