<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
if($dopost == "mapxy"){
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `onemapx` = $mapx,
                    `onemapy` = $mapy
                    WHERE `rank`= $id and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}elseif($dopost=="mapopen"){
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `openonemap` = $value
                    WHERE `rank`= $id and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}elseif($dopost=="mapradar"){
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `onemaprote` = $value
                    WHERE `rank`= $rank and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}
$mydb = new MySql();
$mainsql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$mainrow = $mydb->GetOne($mainsql);
$mapsql = "SELECT * FROM `#@__pano_map` WHERE `id`=$id";
$maprow = $mydb->GetOne($mapsql);
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid`=$id ORDER BY `rank`";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
$scenehtml = "";
while($scenerow = $mydb->GetArray("scene")){
$scenehtml .= "<div class=\"mapmainout\">\r\n";
$scenehtml .= "<div class=\"mapmain\">\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#22330;&#26223;&#21517;&#31216;&#65306;</b>{$scenerow['scenename']}</div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#22330;&#26223;&#25490;&#24207;&#65306;</b>{$scenerow['rank']}</div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#28857;&#20987;&#39044;&#35272;&#65306;</b><input type=\"button\" class=\"btn1\"  onclick=\"lookscene({$scenerow['id']});\" value=\"&#39044;&#35272;\" /></div>\r\n";
$scenehtml .= "<div class=\"mapkong\"></div>\r\n";
$scenehtml .= "<div class=\"mapoffbox\"><b style=\"float: left;\">&#26159;&#21542;&#24320;&#21551;&#65306;</b><div class=\"maponoff\" key=\"{$scenerow['rank']}\" value=\"{$scenerow['openonemap']}\"></div></div>\r\n";
$scenehtml .= "<div class=\"maptline\">\r\n";
$scenehtml .= "<b>&#27880;&#28857;&#20301;&#32622;&#65306;</b><input type=\"text\" id=\"mapx{$scenerow['rank']}\" name=\"mapx{$scenerow['rank']}\" value=\"{$scenerow['onemapx']}\" size=\"5\" />\r\n";
$scenehtml .= "<input type=\"text\" id=\"mapy{$scenerow['rank']}\" name=\"mapy{$scenerow['rank']}\" value=\"{$scenerow['onemapy']}\" size=\"5\" />\r\n";
$scenehtml .= "</div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#28857;&#20987;&#25235;&#21462;&#65306;</b><input type=\"button\" onclick=\"getmap($id,{$scenerow['rank']});\" class=\"btn1\" value=\"&#25235;&#21462;\" /></div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#38647;&#36798;&#26041;&#21521;&#65306;</b><input type=\"text\" id=\"rote{$scenerow['rank']}\" name=\"rote{$scenerow['rank']}\" value=\"{$scenerow['onemaprote']}\" size=\"12\" /></div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#26041;&#21521;&#25235;&#21462;&#65306;</b><input type=\"button\" onclick=\"getmapradar($id,{$scenerow['rank']});\" class=\"btn1\" value=\"&#25351;&#21335;&#38024;\" /></div>\r\n";
$scenehtml .= "</div>\r\n";
$scenehtml .= "</div>\r\n";
}
require('template/vrpano_onemapcontrol.htm');
?>