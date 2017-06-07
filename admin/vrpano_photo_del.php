<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_photo_url");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_photo` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
checkdeldir($basedir ."/photo/photo".$row['rank']);
$delsql = "DELETE FROM `#@__pano_photo` WHERE id=$id";
$mydb->DoNotBack($delsql);
$findsql = "SELECT `id` FROM `#@__pano_spot` WHERE `photo`=$id";
$mydb->SetQuery($findsql);
$mydb->Execute("find");
while ($findrow = $mydb->GetArray("find")) {
$editsql = "UPDATE `#@__pano_spot` SET 
                        `photo`=0,
                        `openaction`=0
                        WHERE `id`={$findrow['id']}";
$mydb->DoNotBack($editsql);
}
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_photo_del.htm');
?>