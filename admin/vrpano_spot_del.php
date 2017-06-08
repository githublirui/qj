<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_spot_url");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_spot` WHERE id=$id";
$row = $mydb->getOne($sql);
if($dopost == "del"){
$scenesql = "SELECT `pid` FROM `#@__pano_scene` WHERE id={$row['aid']}";
$scenerow = $mydb->getOne($scenesql);
$panoid = $scenerow['pid'];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$panoid";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
if($row['showpic']!=""){
checkdelfile($basedir."/showpic/".$row['showpic']);
}
$delsql = "DELETE FROM `#@__pano_spot` WHERE id=$id";
$mydb->DoNotBack($delsql);
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_spot_del.htm');
?>