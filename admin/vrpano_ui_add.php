<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_ui");
if ($dopost == "save") {
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$pid";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
if ($imgfile != $row[$GLOBALS['OOO0000O0']('aW1nZmlsZQ==')]) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$imgfile)) {
checkdelfile($basedir ."/ui/".$row[$GLOBALS['OOO0000O0']('aW1nZmlsZQ==')]);
checkmakedir($basedir ."/ui");
$imgfilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($imgfile);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$imgfile,$basedir ."/ui/".$imgfilename);
$imgfile = $imgfilename;
}else {
$imgfile = "";
}
}
if ($videofile != $row[$GLOBALS['OOO0000O0']('dmlkZW9maWxl')]) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$videofile)) {
checkdelfile($basedir ."/ui/".$row[$GLOBALS['OOO0000O0']('dmlkZW9maWxl')]);
checkmakedir($basedir ."/ui");
$videofilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($videofile);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$videofile,$basedir ."/ui/".$videofilename);
$videofile = $videofilename;
}else {
$videofile = "";
}
}
if ($uitype == 2) {
checkmakedir($basedir ."/plugins");
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/videoplayer.swf")) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/videoplayer.swf",$basedir ."/plugins/videoplayer.swf");
}
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/videoplayer.js")) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/videoplayer.js",$basedir ."/plugins/videoplayer.js");
}
}
$sql = "INSERT INTO `#@__pano_ui` (`title`,`uitype`,`pid`,`videofile`,`imgfile`)
                VALUES ('$title','$uitype','$pid','$videofile','$imgfile')";
$mydb->ExecNoneQuery($sql);
$newid = $mydb->GetLastID();
Trace("UI&#28155;&#21152;&#25104;&#21151;&#65281;","vrpano_ui_edit.php?id=$newid");
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3VpX2FkZC5odG0='));
?>