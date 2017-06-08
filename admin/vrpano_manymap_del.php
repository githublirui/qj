<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_maps_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_maps` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "del") {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
checkdelfile($basedir ."/map/".$row[$GLOBALS['OOO0000O0']('ZmlsZQ==')]);
$delsql = "DELETE FROM `#@__pano_maps` WHERE id=$id";
$mydb->DoNotBack($delsql);
$findsql = "SELECT `id` FROM `#@__pano_scene` WHERE `mapsid`=$id";
$mydb->SetQuery($findsql);
$mydb->Execute("find");
while ($findrow = $mydb->GetArray("find")) {
$editsql = "UPDATE `#@__pano_scene` SET 
                        `mapsid`=0,
                        `openmaps`=0
                        WHERE `id`={$findrow['id']}";
$mydb->DoNotBack($editsql);
}
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX21hbnltYXBfZGVsLmh0bQ=='));
?>