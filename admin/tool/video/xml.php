<?php
require_once(dirname(__FILE__) . "/../../config.php");
$datas = explode("|", $data);
$id = $datas[0];
$video = $datas[1];
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
$xml .= '<view fov="80" fisheye="0" fovmin="60" fovmax="120" />' . "\r\n";
$xml .= '<preview url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/preview.jpg" />' . "\r\n";
if ($scenerow['type'] == 1) {
    $xml .= '<image type="SPHERE">' . "\r\n";
    $xml .= '<sphere url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else {
    $xml .= '<image type="CUBE">' . "\r\n";
    $xml .= '<left url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_left.jpg" />' . "\r\n";
    $xml .= '<front url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_front.jpg" />' . "\r\n";
    $xml .= '<right url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_right.jpg" />' . "\r\n";
    $xml .= '<back url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_back.jpg" />' . "\r\n";
    $xml .= '<up url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_up.jpg" />' . "\r\n";
    $xml .= '<down url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_down.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
}

$xml .= "<hotspot name=\"videospot\" url=\"{$cmspath}/admin/tool/video/plugins/videoplayer.swf\"  alturl=\"{$cmspath}/admin/tool/video/plugins/videoplayer.js\" ";
$xml .= "videourl=\"".$cmspath.$video."\" ";
$xml .= "altvideourl=\"".$cmspath.$video."\" ";
$xml .= "distorted=\"true\" ath=\"0\" atv=\"0\" edge=\"center\" scale=\"1.0\" rx=\"0\" ry=\"0\" rz=\"0\" ";
$xml .= "loop=\"true\" pausedonstart=\"False\" directionalsound=\"true\" range=\"110\" volume=\"0.7\" />\r\n";

$xml .= '</scene>' . "\r\n";
$xml .= "<plugin name=\"endbtn\" url=\"{$cmspath}/admin/tool/video/button.png\" keep=\"true\" align=\"rightbottom\" x=\"18\" y=\"18\" alpha=\"0.8\" onover=\"tween(alpha,1);\" onout=\"tween(alpha,0.8);\" onclick=\"js(getback();)\"/>\r\n";

$xml .= '</krpano>' . "\r\n";
echo $xml;
?>
