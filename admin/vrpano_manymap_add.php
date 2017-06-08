<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_maps_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
if ($dopost == $GLOBALS['OOO0000O0']('c2F2ZQ==')) {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$id";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_maps` WHERE `pid`=$id ORDER BY `rank` DESC");
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsbDFs')]($therow)) {
$tid = $therow[$GLOBALS['OOO0000O0']('cmFuaw==')] +1;
}else {
$tid = 1;
}
$mapdir = $basedir ."/map";
checkmakedir($mapdir);
if ($file != "") {
$file_basename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($file);
$file_basename = reNameMe($file_basename,"map".$tid);
checkdelfile($mapdir ."/".$file_basename);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$file,$mapdir ."/".$file_basename);
$file = $file_basename;
}
$sql = "INSERT INTO `#@__pano_maps` (`rank`,`pid`,`title`,`file`)
                VALUES ($tid,$id,'$title','$file')";
$mydb->ExecuteNoneQuery($sql);
Trace("&#21457;&#24067;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX21hbnltYXBfYWRkLmh0bQ=='));
?>