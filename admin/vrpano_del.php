<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_url");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_main` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$basedir = LULINROOT ."/vrpano/".$row['filedir'];
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE pid=$id";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
while($scenerow = $mydb->GetArray("scene")){
$spotdel = "DELETE FROM `#@__pano_spot` WHERE aid={$scenerow['id']}";
$mydb->DoNotBack($spotdel);
}
$scenedel = "DELETE FROM `#@__pano_scene` WHERE pid=$id";
$mydb->DoNotBack($scenedel);
$uidel = "DELETE FROM `#@__pano_ui` WHERE pid=$id";
$mydb->DoNotBack($uidel);
$photodel = "DELETE FROM `#@__pano_photo` WHERE pid=$id";
$mydb->DoNotBack($photodel);
$cubedel = "DELETE FROM `#@__pano_cube` WHERE pid=$id";
$mydb->DoNotBack($cubedel);
checkdeldir($basedir);
$delsql = "DELETE FROM `#@__pano_main` WHERE id=$id";
$mydb->DoNotBack($delsql);
$delmapsql = "DELETE FROM `#@__pano_map` WHERE id=$id";
$mydb->DoNotBack($delmapsql);
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_del.htm');
?>