<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_maps_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_maps` WHERE id=$id";
$row = $dsql->getOne($sql);
$pid = $row[$GLOBALS['OOO0000O0']('cGlk')];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
$mapdir = $basedir ."/map";
$mapurl = $cfg_cmspath ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')] ."/map";
if ($dopost == "save") {
checkmakedir($mapdir);
if ($file != $row[$GLOBALS['OOO0000O0']('ZmlsZQ==')]) {
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_maps` WHERE `id`=$id");
$file_basename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($file);
$file_basename = reNameMe($file_basename,"map".$therow[$GLOBALS['OOO0000O0']('cmFuaw==')]);
if ($row[$GLOBALS['OOO0000O0']('ZmlsZQ==')] != "") {
@$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsMTEx')]($mapdir ."/".$row[$GLOBALS['OOO0000O0']('ZmlsZQ==')]);
}
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$file,$mapdir ."/".$file_basename);
$file = $file_basename;
}
$addsql = "UPDATE `#@__pano_maps` SET
        title = '$title',
        file = '$file'          
        WHERE id=$id";
$mydb->ExecuteNoneQuery($addsql);
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX21hbnltYXBfZWRpdC5odG0='));
?>