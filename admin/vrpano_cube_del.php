<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_cube_url");
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_cube` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
checkdeldir($basedir ."/cube/cube".$row['rank']);
checkdelfile($basedir ."/cube/cube{$row['rank']}.xml");
$delsql = "DELETE FROM `#@__pano_cube` WHERE id=$id";
$mydb->DoNotBack($delsql);
$findsql = "SELECT `id` FROM `#@__pano_spot` WHERE `cube`=$id";
$mydb->SetQuery($findsql);
$mydb->Execute("find");
while ($findrow = $mydb->GetArray("find")) {
$editsql = "UPDATE `#@__pano_spot` SET 
                        `cube`=0,
                        `openaction`=0
                        WHERE `id`={$findrow['id']}";
$mydb->DoNotBack($editsql);
}
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_cube_del.htm');
?>