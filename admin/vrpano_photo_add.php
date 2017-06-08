<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_photo_url");
if ($dopost == $GLOBALS['OOO0000O0']('c2F2ZQ==')) {
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$id";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_photo` WHERE `pid`=$id ORDER BY `rank` DESC");
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsbDFs')]($therow)) {
$tid = $therow[$GLOBALS['OOO0000O0']('cmFuaw==')] +1;
}else {
$tid = 1;
}
$photodir = $basedir ."/photo";
$photobagdir = $basedir ."/photo/photo$tid";
checkmakedir($photodir);
checkmakedir($photobagdir);
$photoskindir = $basedir ."/photo/skin";
checkmakedir($photoskindir);
checkcopyfile(LULINREQ."/vrpano/main/photo/kuang.png",$photoskindir."/kuang.png");
checkcopyfile(LULINREQ."/vrpano/main/photo/mapleft.png",$photoskindir."/mapleft.png");
checkcopyfile(LULINREQ."/vrpano/main/photo/mapright.png",$photoskindir."/mapright.png");
checkcopyfile(LULINREQ."/vrpano/main/photo/x.png",$photoskindir."/x.png");
checkmakedir($basedir."/plugins");
checkcopyfile(LULINREQ."/vrpano/main/plugins/scrollarea.swf",$basedir."/plugins/scrollarea.swf");
checkcopyfile(LULINREQ."/vrpano/main/plugins/textfield.swf",$basedir."/plugins/textfield.swf");
checkcopyfile(LULINREQ."/vrpano/main/plugins/scrollarea.js",$basedir."/plugins/scrollarea.js");
if ($litpic != "") {
$litpic_basename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($litpic);
$litpic_basename = reNameMe($litpic_basename,"litpic");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$litpic,$photobagdir ."/".$litpic_basename);
$litpic = $litpic_basename;
}
$imagesVal = "";
for ($i = 0;$i <$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUkx')]($images);$i++) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$images[$i])) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWwxbElJ')]($images[$i],"station") >0) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$images[$i],$photobagdir ."/".$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($images[$i]));
$images[$i] = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($images[$i]);
}
}else {
$images[$i] = "";
}
$imagesVal .= "{lulin:imglist src=\"{$images[$i]}\"/}";
}
$sql = "INSERT INTO `#@__pano_photo` (`rank`,`pid`,`title`,`litpic`,`imglist`)
                VALUES ($tid,$id,'$title','$litpic','$imagesVal')";
$mydb->ExecuteNoneQuery($sql);
$lastid = $mydb->GetLastID();
Trace("&#21457;&#24067;&#25104;&#21151;&#65281;","vrpano_editphoto.php?id={$lastid}");
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3Bob3RvX2FkZC5odG0='));
?>