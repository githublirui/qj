<?php

require_once(dirname(__FILE__) . "/../../config.php");
$mydb = new MySql();
$topsql = "SELECT * FROM `#@__pano_scene` WHERE `id`=$sceneid;";
$toprow = $mydb->GetOne($topsql);
$id = $toprow['pid'];
$firstscene = "scene" . $toprow['rank'];

$sql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$row = $mydb->GetOne($sql);

$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = $id ORDER BY `rank`";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");

include (LULINREQ.'/vrpano/xml.php');

echo $xml;
?>
