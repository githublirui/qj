<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
if ($dopost == "mapxy") {
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `mapsx` = $mapx,
                    `mapsy` = $mapy
                    WHERE `rank`= $id and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}else if ($dopost == "mapopen") {
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `openmaps` = $value
                    WHERE `rank`= $id and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}else if ($dopost == "mapradar") {
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `mapsrote` = $value
                    WHERE `rank`= $rank and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}else if ($dopost == "mapid") {
$mydb = new MySql();
$editsql = "UPDATE `#@__pano_scene` SET 
                    `mapsid` = $value
                    WHERE `rank`= $rank and `pid` = $pid";
$mydb->DoNotBack($editsql);
echo "var ok = true;";
exit();
}
$mydb = new MySql();
$mainsql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$mainrow = $mydb->GetOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$mapdir = $basedir ."/map";
$mapurl = $cfg_cmspath ."/vrpano/".$mainrow['filedir'] ."/map";
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid`=$id ORDER BY `rank`";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
$scenehtml = "";
while ($scenerow = $mydb->GetArray("scene")) {
$scenehtml .= "<div class=\"mapmainout\">\r\n";
$scenehtml .= "<div class=\"mapmain\">\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#22330;&#26223;&#21517;&#31216;&#65306;</b>{$scenerow['scenename']}</div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#22330;&#26223;&#25490;&#24207;&#65306;</b>{$scenerow['rank']}</div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#28857;&#20987;&#39044;&#35272;&#65306;</b><input type=\"button\" class=\"btn1\"  onclick=\"lookscene({$scenerow['id']});\" value=\"&#39044;&#35272;\" /></div>\r\n";
$scenehtml .= "<div class=\"mapkong\"></div>\r\n";
$scenehtml .= "<div class=\"mapoffbox\"><b style=\"float: left;\">&#26159;&#21542;&#24320;&#21551;&#65306;</b><div class=\"maponoff\" key=\"{$scenerow['rank']}\" value=\"{$scenerow['openmaps']}\"></div></div>\r\n";
if ($scenerow['mapsid'] == 0) {
$scenehtml .= "<div class=\"mapimg\">";
$scenehtml .= "<div class=\"mapingin\" id=\"ch{$scenerow['rank']}\" onclick=\"choosemap({$scenerow['rank']});\"><span><center>&#28857;&#20987;&#36873;&#25321;&#22320;&#22270;</center></span></div>";
$scenehtml .= "<input type=\"hidden\" name=\"mapsid{$scenerow['rank']}\" id=\"mapsid{$scenerow['rank']}\" value=\"{$scenerow['mapsid']}\" />";
$scenehtml .= "</div>";
}else {
$mprow = $mydb->getOne("SELECT * FROM `#@__pano_maps` WHERE `pid`={$scenerow['pid']} and `rank`={$scenerow['mapsid']}");
$scenehtml .= "<div class=\"mapimg\" onclick=\"choosemap({$scenerow['rank']});\">";
$scenehtml .= "<div class=\"mapingin\" id=\"ch{$scenerow['rank']}\"><span><img src=\"{$mapurl}/{$mprow['file']}\" onload=\"photoin(this,150,150);\" /></span></div>";
$scenehtml .= "<input type=\"hidden\" name=\"mapsid{$scenerow['rank']}\" id=\"mapsid{$scenerow['rank']}\" value=\"{$scenerow['mapsid']}\" />";
$scenehtml .= "</div>";
}
$scenehtml .= "<div class=\"maptline\">\r\n";
$scenehtml .= "<b>&#27880;&#28857;&#20301;&#32622;&#65306;</b><input type=\"text\" id=\"mapx{$scenerow['rank']}\" name=\"mapx{$scenerow['rank']}\" value=\"{$scenerow['mapsx']}\" size=\"5\" />\r\n";
$scenehtml .= "<input type=\"text\" id=\"mapy{$scenerow['rank']}\" name=\"mapy{$scenerow['rank']}\" value=\"{$scenerow['mapsy']}\" size=\"5\" />\r\n";
$scenehtml .= "</div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#28857;&#20987;&#25235;&#21462;&#65306;</b><input type=\"button\" onclick=\"getmap($id,{$scenerow['rank']});\" class=\"btn1\" value=\"&#25235;&#21462;\" /></div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#38647;&#36798;&#26041;&#21521;&#65306;</b><input type=\"text\" id=\"rote{$scenerow['rank']}\" name=\"rote{$scenerow['rank']}\" value=\"{$scenerow['mapsrote']}\" size=\"12\" /></div>\r\n";
$scenehtml .= "<div class=\"maptline\"><b>&#26041;&#21521;&#25235;&#21462;&#65306;</b><input type=\"button\" onclick=\"getmapradar($id,{$scenerow['rank']});\" class=\"btn1\" value=\"&#25351;&#21335;&#38024;\" /></div>\r\n";
$scenehtml .= "</div>\r\n";
$scenehtml .= "</div>\r\n";
}
$maps = "";
$mapjs = "<script type=\"text/javascript\">\r\n";
$mapjs .= "var mapsrc = new Array();\r\n";
$mapjs .= "var mapid = new Array();";
$mapssql = "SELECT * FROM `#@__pano_maps` WHERE `pid`=$id ORDER BY `rank`";
$mydb->SetQuery($mapssql);
$mydb->Execute("maps");
while ($mapsrow = $mydb->GetArray("maps")) {
$maps .= "<div class=\"choosecube\" onclick=\"chooseback({$mapsrow['rank']});\">";
$maps .= "<div class=\"choosecubein\"><span><img src=\"{$mapurl}/{$mapsrow['file']}\" onload=\"photoin(this,150,150)\" /></span></div>";
$maps .= "</div>";
$mapjs .= "mapsrc[{$mapsrow['rank']}] = \"{$mapurl}/{$mapsrow['file']}\";\r\n";
$mapjs .= "mapid[{$mapsrow['rank']}] = {$mapsrow['id']};\r\n";
}
$mapjs .= "</script>";
require('template/vrpano_manymapcontrol.htm');
?>