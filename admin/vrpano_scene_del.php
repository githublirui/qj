<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_scene_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_scene` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$basedir = LULINROOT ."/vrpano/vrpano".$row[$GLOBALS['OOO0000O0']('cGlk')];
$baseimgdir = $cfg_cmspath ."/vrpano/vrpano".$row[$GLOBALS['OOO0000O0']('cGlk')] ."/images/scene{$row['rank']}";
$imgdir = LULINROOT ."/vrpano/vrpano".$row[$GLOBALS['OOO0000O0']('cGlk')] ."/images/scene{$row['rank']}";
checkdeldir($imgdir);
$delsql = "DELETE FROM `#@__pano_scene` WHERE id=$id";
$mydb->DoNotBack($delsql);
$spotdel = "DELETE FROM `#@__pano_spot` WHERE aid=$id";
$mydb->DoNotBack($spotdel);
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;","vrpano_autorank.php?id={$row['pid']}");
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3NjZW5lX2RlbC5odG0='));
?>