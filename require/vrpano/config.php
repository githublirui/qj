<?php
require_once (str_replace("\\",'/',dirname(__FILE__)) ."/../function.inc.php");
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$row = $mydb->GetOne($sql);
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = $id ORDER BY `rank`";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
include (LULINREQ.'/vrpano/xml.php');
echo $xml;
?>