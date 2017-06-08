<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_spot_url");
if ($dopost == "save") {
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$scenesql = "SELECT `pid` FROM `#@__pano_scene` WHERE id=$aid";
$scenerow = $mydb->getOne($scenesql);
$panoid = $scenerow[$GLOBALS['OOO0000O0']('cGlk')];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$panoid";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
if ($spottype == 1) {
$spotsql = "SELECT * FROM `#@__pano_spotstyle` WHERE id=$spotstyle";
$spotrow = $mydb->getOne($spotsql);
$spotimg = $spotrow[$GLOBALS['OOO0000O0']('dXJs')];
checkmakedir($basedir ."/spot");
$spotname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($spotimg);
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/spot/".$spotname)) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINROOT .$spotimg,$basedir ."/spot/".$spotname);
}
}
if ($spottype == 3) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$smartspotpic)) {
$smartspotpicname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($smartspotpic);
checkmakedir($basedir ."/spot");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$smartspotpic,$basedir ."/spot/".$smartspotpicname);
$smartspotpic = $smartspotpicname;
}else {
$smartspotpic = "";
}
}
if ($openinfo == 1) {
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/textfield.swf")) {
checkmakedir($basedir ."/plugins");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/textfield.swf",$basedir ."/plugins/textfield.swf");
}
}
if ($spottype == 4) {
checkmakedir($basedir ."/plugins");
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/videoplayer.swf")) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/videoplayer.swf",$basedir ."/plugins/videoplayer.swf");
}
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/videoplayer.js")) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/videoplayer.js",$basedir ."/plugins/videoplayer.js");
}
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$video)) {
$videoname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($video);
checkmakedir($basedir ."/video");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$video,$basedir ."/video/".$videoname);
$video = $videoname;
}else {
$video = "";
}
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$applevideo)) {
$applevideoname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($applevideo);
checkmakedir($basedir ."/video");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$applevideo,$basedir ."/video/".$applevideoname);
$applevideo = $applevideoname;
}else {
$applevideo = "";
}
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$applevideoimg)) {
$applevideoimgname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($applevideoimg);
checkmakedir($basedir ."/video");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$applevideoimg,$basedir ."/video/".$applevideoimgname);
$applevideoimg = $applevideoimgname;
}else {
$applevideoimg = "";
}
}
if ($action == 2) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$showpic)) {
$showpicname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')](LULINROOT .$showpic);
checkmakedir($basedir ."/showpic");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$showpic,$basedir ."/showpic/".$showpicname);
$showpic = $showpicname;
}else {
Trace("展示图片不存在，检查路径","-1");
}
}
$sql = "INSERT INTO `#@__pano_spot` 
    (`title`,`aid`,`spottype` , `spotstyle`,`spoth`,`spotv`,`action`,`panotarget`,`hotpoints`,`fillcolor`,`fillalpha`,`fillcolorhover`,`fillalphahover`,`bordercolor`,`borderalpha`,`borderwidth`,`bordercolorhover`,`borderalphahover`,`borderwidthhover`,`showpic`,`showpicbordercolor`,`showpicborderalpha`,`showpicborderwidth`,`targeth`,`targetv`,`httplink`,`openshowspotname`,`openaction`,`smartspotpic`,`smartscale`,`smartatv`,`smartath`,`smartrz`,`smartrx`,`smartry`,`video`,`videoscale`,`videoatv`,`videoath`,`videorz`,`videorx`,`videory`,`smartwidth`,`smartheight`,`videowidth`,`videoheight`,`openapplevideo`,`applevideo`,`applevideoimg`,`photo`,`cube`,`devicetype`,`openinfo`,`textinfo`,`infowidth`,`screenchange`,`openanimate`,`showpictype`,`openstartplay`) VALUES 
    ('$title' , '$aid' , '$spottype' , '$spotstyle',$spoth,$spotv,$action,$panotarget,'$hotpoints','$fillcolor','$fillalpha','$fillcolorhover','$fillalphahover','$bordercolor','$borderalpha','$borderwidth','$bordercolorhover','$borderalphahover','$borderwidthhover','$showpic','$showpicbordercolor','$showpicborderalpha','$showpicborderwidth','$targeth','$targetv','$httplink',$openshowspotname,$openaction,'$smartspotpic','$smartscale','$smartatv','$smartath','$smartrz','$smartrx','$smartry','$video','$videoscale','$videoatv','$videoath','$videorz','$videorx','$videory','$smartwidth','$smartheight','$videowidth','$videoheight','$openapplevideo','$applevideo','$applevideoimg','$photo','$cube','$devicetype','$openinfo','$textinfo','$infowidth',$screenchange,$openanimate,$showpictype,$openstartplay)";
$mydb->DoNotBack($sql);
Trace("热点添加完成！",$endurl);
exit();
}
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$spotsql = "SELECT * FROM `#@__pano_spotstyle` ORDER BY `typeid`";
$mydb->SetQuery($spotsql);
$mydb->Execute("spot");
$spothtml = "<input type=\"hidden\" name=\"spotstyle\" id=\"spotstyle\" value=\"1\" />\r\n";
$autokey = 0;
while ($spotrow = $mydb->GetArray("spot")) {
if ($autokey == 0) {
$me = " me";
}else {
$me = "";
}
if ($spotrow[$GLOBALS['OOO0000O0']('dHlwZWlk')] == 1) {
$spothtml .= "<div class=\"spotbox$me\" onclick=\"getspotstyle($autokey,{$spotrow['id']});\">\r\n";
$spothtml .= "<div class=\"spotimg\"><img src=\"$cmspath{$spotrow['url']}\" onload=\"photoin(this,120,120)\" /></div>\r\n";
$spothtml .= "</div>\r\n";
}else if ($spotrow[$GLOBALS['OOO0000O0']('dHlwZWlk')] == 2) {
$spothtml .= "<div class=\"spotbox$me\" onclick=\"getspotstyle($autokey,{$spotrow['id']});\">\r\n";
$spothtml .= "<div class=\"spotimg\">\r\n";
$spothtml .= "<div class=\"spotimgmask\">\r\n";
$spothtml .= "</div>\r\n";
$spothtml .= "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"120\" height=\"120\">\r\n";
$spothtml .= "<param name=\"movie\" value=\"$cmspath{$spotrow['url']}\">\r\n";
$spothtml .= "<param name=\"quality\" value=\"high\">\r\n";
$spothtml .= "<param name=\"wmode\" value=\"Transparent\">\r\n";
$spothtml .= "<embed src=\"$cmspath{$spotrow['url']}\" width=\"120\" height=\"120\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed>\r\n";
$spothtml .= "</object>\r\n";
$spothtml .= "</div>\r\n";
$spothtml .= "</div>\r\n";
}if ($spotrow[$GLOBALS['OOO0000O0']('dHlwZWlk')] == 3) {
$spothtml .= "<div class=\"spotbox$me\" onclick=\"getspotstyle($autokey,{$spotrow['id']});\">\r\n";
$spothtml .= "<div class=\"spotimg\" style=\"background:#ace;\"><img src=\"$cmspath{$spotrow['url']}\" width=\"120\" /></div>\r\n";
$spothtml .= "</div>\r\n";
}
$autokey++;
}
$parentsql = "SELECT * FROM `#@__pano_scene` WHERE id=$aid";
$parentrow = $mydb->GetOne($parentsql);
$pingjs = "";
if ($parentrow[$GLOBALS['OOO0000O0']('dHlwZQ==')] == 3) {
$pingjs .= "<script type=\"text/javascript\">\r\n";
$pingjs .= "$('.tb').eq(2).hide();\r\n";
$pingjs .= "$('.tb').eq(3).hide();\r\n";
$pingjs .= "</script>\r\n";
}
$panosql = "SELECT * FROM `#@__pano_scene` WHERE pid={$parentrow['pid']} ORDER BY `rank`";
$mydb->SetQuery($panosql);
$mydb->Execute("pano");
$panohtml = "<input type=\"hidden\" name=\"panotarget\" id=\"panotarget\" value=\"0\" />\r\n";
$autokey = 0;
while ($panorow = $mydb->GetArray("pano")) {
if ($panorow[$GLOBALS['OOO0000O0']('aWQ=')] != $aid) {
$panohtml .= "<div class=\"panobox\" onclick=\"getpanotarget($autokey,{$panorow['id']});\">\r\n";
$panohtml .= "<div class=\"panotitle\"><b>名称：</b>{$panorow['scenename']}</div>\r\n";
$panohtml .= "<div class=\"panocode\"><b>编号：</b>{$panorow['rank']}</div>\r\n";
$panohtml .= "</div>\r\n";
$autokey++;
}else {
$panohtml .= "<div class=\"panoboxme\">\r\n";
$panohtml .= "<div class=\"panotitleme\"><b>名称：</b>{$panorow['scenename']}(自己)</div>\r\n";
$panohtml .= "<div class=\"panocodeme\"><b>编号：</b>{$panorow['rank']}</div>\r\n";
$panohtml .= "</div>\r\n";
}
}
$photosql = "SELECT * FROM `#@__pano_photo` WHERE `pid`={$parentrow['pid']}  ORDER BY `rank`";
$mydb->SetQuery($photosql);
$mydb->Execute("photo");
$photohtml = "<input type=\"hidden\" name=\"photo\" id=\"photo\" value=\"0\" />\r\n";
$autokey = 0;
while ($photorow = $mydb->GetArray("photo")) {
$photohtml .= "<div class=\"photobox\" onclick=\"getphoto($autokey,{$photorow['id']});\">\r\n";
$photohtml .= "<div class=\"photoimg\"><img onload=\"photoout(this,120,120);\" src=\"$cmspath/vrpano/vrpano{$parentrow['pid']}/photo/photo{$photorow['rank']}/{$photorow['litpic']}\" /></div>\r\n";
$photohtml .= "<div class=\"phototitle\"><b>名称：</b>{$photorow['title']}</div>\r\n";
$photohtml .= "</div>\r\n";
$autokey++;
}
$cubesql = "SELECT * FROM `#@__pano_cube` WHERE `pid`={$parentrow['pid']}  ORDER BY `rank`";
$mydb->SetQuery($cubesql);
$mydb->Execute("cube");
$cubehtml = "<input type=\"hidden\" name=\"cube\" id=\"cube\" value=\"0\" />\r\n";
$autokey = 0;
while ($cuberow = $mydb->GetArray("cube")) {
$cubehtml .= "<div class=\"cubebox\" onclick=\"getcube($autokey,{$cuberow['id']});\">\r\n";
$cubehtml .= "<div class=\"cubetitle\"><b>名称：</b>{$cuberow['title']}</div>\r\n";
$cubehtml .= "<div class=\"cubecode\"><b>编号：</b>{$cuberow['rank']}</div>\r\n";
$cubehtml .= "</div>\r\n";
$autokey++;
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3Nwb3RfYWRkLmh0bQ=='));
?>