<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_scene_url");
if (!isset($id) ||$id == "") {
Trace("&#26080;&#27861;&#33719;&#21462;&#21040;id",-1);
exit();
}
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_main` WHERE id=$id";
$row = $mydb->getOne($sql);
$scenesql = "SELECT *  FROM `#@__pano_scene` WHERE `pid`=$id ORDER BY `rank`";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
$scenelen = $mydb->GetTotalRow("scene");
$javascript = "";
$javascript .= "<script type=\"text/javascript\">\r\n";
$javascript .= "var id = $id;\r\n";
$javascript .= "var scene = new Array();\r\n";
$javascript .= "var scenerank = new Array();\r\n";
while ($scenerow = $mydb->GetArray("scene")) {
$javascript .= "scene.push({$scenerow['id']});\r\n";
$javascript .= "scenerank.push({$scenerow['rank']});\r\n";
}
$javascript .= "var endurl = \"$endurl\";\r\n";
$javascript .= "var filename = \"{$row['filedir']}\";\r\n";
$javascript .= "</script>\r\n";
require('template/vrpano_autorank.htm');
?>