<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_scene_url");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_scene` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$basedir = LULINROOT ."/vrpano/vrpano".$row['pid'];
$baseimgdir = $cfg_cmspath ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$imgdir = LULINROOT ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
checkdeldir($imgdir);
$delsql = "DELETE FROM `#@__pano_scene` WHERE id=$id";
$mydb->DoNotBack($delsql);
$spotdel = "DELETE FROM `#@__pano_spot` WHERE aid=$id";
$mydb->DoNotBack($spotdel);
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;","vrpano_autorank.php?id={$row['pid']}");
exit();
}
require('template/vrpano_scene_del.htm');
?>