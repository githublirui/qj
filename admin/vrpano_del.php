<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_main` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$basedir = LULINROOT ."/vrpano/".$row[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
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
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX2RlbC5odG0='));
?>