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
if ($dopost == "save") {
$scenesql = "SELECT `pid` FROM `#@__pano_scene` WHERE id={$row['aid']}";
$scenerow = $mydb->getOne($scenesql);
$panoid = $scenerow['pid'];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$panoid";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
if ($spottype == 1 &&$spotstyle != $row['spotstyle']) {
$spotsql = "SELECT * FROM `#@__pano_spotstyle` WHERE id=$spotstyle";
$spotrow = $mydb->getOne($spotsql);
$spotimg = $spotrow['url'];
checkmakedir($basedir ."/spot");
$spotname = basename($spotimg);
if (!is_file($basedir ."/spot/".$spotname)) {
copy(LULINROOT .$spotimg,$basedir ."/spot/".$spotname);
}
}
if ($spottype == 3 &&$smartspotpic != $row['smartspotpic']) {
if (is_file(LULINROOT .$smartspotpic)) {
checkdelfile($basedir ."/spot/".$row['smartspotpic']);
checkmakedir($basedir ."/spot");
$smartspotpicname = basename($smartspotpic);
rename(LULINROOT .$smartspotpic,$basedir ."/spot/".$smartspotpicname);
$smartspotpic = $smartspotpicname;
}else {
$smartspotpic = "";
}
}
if ($spottype == 4) {
checkmakedir($basedir ."/plugins");
if (!is_file($basedir ."/plugins/videoplayer.swf")) {
copy(LULINREQ ."/vrpano/main/plugins/videoplayer.swf",$basedir ."/plugins/videoplayer.swf");
}
if (!is_file($basedir ."/plugins/videoplayer.js")) {
copy(LULINREQ ."/vrpano/main/plugins/videoplayer.js",$basedir ."/plugins/videoplayer.js");
}
if ($video != $row['video']) {
if (is_file(LULINROOT .$video)) {
checkdelfile($basedir ."/video/".$row['video']);
checkmakedir($basedir ."/video");
$videoname = basename($video);
rename(LULINROOT .$video,$basedir ."/video/".$videoname);
$video = $videoname;
}else {
$video = "";
}
}
if ($applevideo != $row['applevideo']) {
if (is_file(LULINROOT .$applevideo)) {
checkdelfile($basedir ."/video/".$row['applevideo']);
checkmakedir($basedir ."/video");
$applevideoname = basename($applevideo);
rename(LULINROOT .$applevideo,$basedir ."/video/".$applevideoname);
$applevideo = $applevideoname;
}else {
$applevideo = "";
}
}
if ($applevideoimg != $row['applevideoimg']) {
if (is_file(LULINROOT .$applevideoimg)) {
checkdelfile($basedir ."/video/".$row['applevideoimg']);
checkmakedir($basedir ."/video");
$applevideoimgname = basename($applevideoimg);
rename(LULINROOT .$applevideoimg,$basedir ."/video/".$applevideoimgname);
$applevideoimg = $applevideoimgname;
}else {
$applevideoimg = "";
}
}
}
if ($action == 2) {
if ($showpic != $row['showpic']) {
if (is_file(LULINROOT .$showpic)) {
checkdelfile($basedir ."/showpic/".$row['showpic']);
$showpicname = basename(LULINROOT .$showpic);
checkmakedir($basedir ."/showpic");
rename(LULINROOT .$showpic,$basedir ."/showpic/".$showpicname);
$showpic = $showpicname;
}else {
Trace("展示图片不存在，检查路径","-1");
}
}
}
if ($openinfo == 1) {
if (!is_file($basedir ."/plugins/textfield.swf")) {
checkmakedir($basedir ."/plugins");
copy(LULINREQ ."/vrpano/main/plugins/textfield.swf",$basedir ."/plugins/textfield.swf");
}
}
$editsql = "UPDATE `#@__pano_spot` SET 
            `title` = '$title',
            `spottype` = '$spottype',
            `spotstyle` = '$spotstyle',
            `spoth` = '$spoth',
            `spotv` = '$spotv',
            `action` = $action,
            `panotarget` = $panotarget,
            `hotpoints` = '$hotpoints',
            `fillcolor` = '$fillcolor',
            `fillalpha` = '$fillalpha',
            `fillcolorhover` =  '$fillcolorhover',
            `fillalphahover` = '$fillalphahover',
            `bordercolor` = '$bordercolor',
            `borderalpha` = '$borderalpha',
            `borderwidth` = '$borderwidth',
            `bordercolorhover` = '$bordercolorhover',
            `borderalphahover` = '$borderalphahover',
            `borderwidthhover` = '$borderwidthhover',
            `showpic` = '$showpic',
            `showpicbordercolor` = '$showpicbordercolor',
            `showpicborderalpha` = '$showpicborderalpha',
            `showpicborderwidth` = '$showpicborderwidth',
            `targeth` = '$targeth',
            `targetv` = '$targetv',
            `httplink` = '$httplink',
            `openshowspotname` = '$openshowspotname',
            `openaction` = $openaction,
            `smartspotpic` = '$smartspotpic',
            `smartscale` = '$smartscale',
            `smartatv` = '$smartatv',
            `smartath` = '$smartath',
            `smartrz` = '$smartrz',
            `smartrx` = '$smartrx',
            `smartry` = '$smartry',
            `video` = '$video',
            `videoscale` = '$videoscale',
            `videoatv` = '$videoatv',
            `videoath` = '$videoath',
            `videorz` = '$videorz',
            `videorx` = '$videorx',
            `videory` = '$videory',
            `smartwidth` = '$smartwidth',
            `smartheight` = '$smartheight',
            `videowidth` = '$videowidth',
            `videoheight` = '$videoheight',
            `openapplevideo` = '$openapplevideo',
            `applevideo` = '$applevideo',
            `applevideoimg` = '$applevideoimg',
            `photo` = '$photo',
            `cube` = '$cube',
            `devicetype` = '$devicetype',
            `openinfo`= '$openinfo',
            `textinfo` = '$textinfo',
            `infowidth` = '$infowidth',
            `screenchange` = $screenchange,
            `openanimate` = $openanimate,
            `showpictype` = $showpictype,
            `openstartplay` = $openstartplay
            WHERE `id` = $id";
$mydb->DoNotBack($editsql);
Trace("热点修改完成！",$endurl);
exit();
}
$spotsql = "SELECT * FROM `#@__pano_spotstyle` ORDER BY `typeid`";
$mydb->SetQuery($spotsql);
$mydb->Execute("spot");
$spothtml = "<input type=\"hidden\" name=\"spotstyle\" id=\"spotstyle\" value=\"{$row['spotstyle']}\" />\r\n";
$autokey = 0;
while ($spotrow = $mydb->GetArray("spot")) {
if ($spotrow['id'] == $row['spotstyle']) {
$me = " me";
}else {
$me = "";
}
if ($spotrow['typeid'] == 1) {
$spothtml .= "<div class=\"spotbox$me\" onclick=\"getspotstyle($autokey,{$spotrow['id']});\">\r\n";
$spothtml .= "<div class=\"spotimg\"><img src=\"$cmspath{$spotrow['url']}\" onload=\"photoin(this,120,120)\" /></div>\r\n";
$spothtml .= "</div>\r\n";
}else if ($spotrow['typeid'] == 2) {
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
}if ($spotrow['typeid'] == 3) {
$spothtml .= "<div class=\"spotbox$me\" onclick=\"getspotstyle($autokey,{$spotrow['id']});\">\r\n";
$spothtml .= "<div class=\"spotimg\" style=\"background:#ace;\"><img src=\"$cmspath{$spotrow['url']}\" width=\"120\" /></div>\r\n";
$spothtml .= "</div>\r\n";
}
$autokey++;
}
$spottypehtml = "";
$spottypehtml .= "<script type=\"text/javascript\">\r\n";
$spottypehtml .= "showtb(".$row['spottype'] .");\r\n";
$spottypehtml .= "</script>\r\n";
$actionhtml = "";
$actionhtml .= "<script type=\"text/javascript\">\r\n";
$actionhtml .= "showac(".$row['action'] .");\r\n";
$actionhtml .= "</script>\r\n";
$parentsql = "SELECT * FROM `#@__pano_scene` WHERE id={$row['aid']}";
$parentrow = $mydb->GetOne($parentsql);
$pingjs = "";
if ($parentrow['type'] == 3) {
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
$panojshtml = "";
while ($panorow = $mydb->GetArray("pano")) {
if ($panorow['id'] != $row['aid']) {
$panohtml .= "<div class=\"panobox\" onclick=\"getpanotarget($autokey,{$panorow['id']});\">\r\n";
$panohtml .= "<div class=\"panotitle\"><b>名称：</b>{$panorow['scenename']}</div>\r\n";
$panohtml .= "<div class=\"panocode\"><b>编号：</b>{$panorow['rank']}</div>\r\n";
$panohtml .= "</div>\r\n";
if ($row['panotarget'] == $panorow['id']) {
$panojshtml .= "<script type=\"text/javascript\">\r\n";
$panojshtml .= "getpanotarget($autokey,".$panorow['id'] .");\r\n";
$panojshtml .= "</script>\r\n";
}
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
$photojshtml = "";
$autokey = 0;
while ($photorow = $mydb->GetArray("photo")) {
$photohtml .= "<div class=\"photobox\" onclick=\"getphoto($autokey,{$photorow['id']});\">\r\n";
$photohtml .= "<div class=\"photoimg\"><img onload=\"photoout(this,120,120);\" src=\"$cmspath/vrpano/vrpano{$parentrow['pid']}/photo/photo{$photorow['rank']}/{$photorow['litpic']}\" /></div>\r\n";
$photohtml .= "<div class=\"phototitle\"><b>名称：</b>{$photorow['title']}</div>\r\n";
$photohtml .= "</div>\r\n";
if ($row['photo'] == $photorow['id']) {
$photojshtml .= "<script type=\"text/javascript\">\r\n";
$photojshtml .= "getphoto($autokey,".$photorow['id'] .");\r\n";
$photojshtml .= "</script>\r\n";
}
$autokey++;
}
$cubesql = "SELECT * FROM `#@__pano_cube` WHERE `pid`={$parentrow['pid']}  ORDER BY `rank`";
$mydb->SetQuery($cubesql);
$mydb->Execute("cube");
$cubehtml = "<input type=\"hidden\" name=\"cube\" id=\"cube\" value=\"0\" />\r\n";
$cubejshtml = "";
$autokey = 0;
while ($cuberow = $mydb->GetArray("cube")) {
$cubehtml .= "<div class=\"cubebox\" onclick=\"getcube($autokey,{$cuberow['id']});\">\r\n";
$cubehtml .= "<div class=\"cubetitle\"><b>名称：</b>{$cuberow['title']}</div>\r\n";
$cubehtml .= "<div class=\"cubecode\"><b>编号：</b>{$cuberow['rank']}</div>\r\n";
$cubehtml .= "</div>\r\n";
if ($row['cube'] == $cuberow['id']) {
$cubejshtml .= "<script type=\"text/javascript\">\r\n";
$cubejshtml .= "getcube($autokey,".$cuberow['id'] .");\r\n";
$cubejshtml .= "</script>\r\n";
}
$autokey++;
}
$hotpointshtml = "";
$spointarr = explode("&&",$row['hotpoints']);
foreach ($spointarr as $pdata) {
if ($pdata != "") {
$pdataarr = explode("||",$pdata);
$hotpointshtml .= "<div class=\"pointdata\"><div class=\"pointdata1\">{$pdataarr[0]}</div><div class=\"pointdata2\">{$pdataarr[1]}</div></div>";
}
}
require('template/vrpano_spot_edit.htm');
?>