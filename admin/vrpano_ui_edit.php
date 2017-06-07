<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_ui");
$mydb = new mysql();
$uisql = "SELECT * FROM `#@__pano_ui` WHERE `id`= $id";
$row = $mydb->getOne($uisql);
if ($dopost == "save") {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
if ($imgfile != $row['imgfile']) {
if (is_file(LULINROOT .$imgfile)) {
checkdelfile($basedir ."/ui/".$row['imgfile']);
checkmakedir($basedir ."/ui");
$imgfilename = basename($imgfile);
rename(LULINROOT .$imgfile,$basedir ."/ui/".$imgfilename);
$imgfile = $imgfilename;
}else {
$imgfile = "";
}
}
if ($videofile != $row['videofile']) {
if (is_file(LULINROOT .$videofile)) {
checkdelfile($basedir ."/ui/".$row['videofile']);
checkmakedir($basedir ."/ui");
$videofilename = basename($videofile);
rename(LULINROOT .$videofile,$basedir ."/ui/".$videofilename);
$videofile = $videofilename;
}else {
$videofile = "";
}
}
if ($uitype == 2) {
checkmakedir($basedir ."/plugins");
if (!is_file($basedir ."/plugins/videoplayer.swf")) {
copy(LULINREQ ."/vrpano/main/plugins/videoplayer.swf",$basedir ."/plugins/videoplayer.swf");
}
if (!is_file($basedir ."/plugins/videoplayer.js")) {
copy(LULINREQ ."/vrpano/main/plugins/videoplayer.js",$basedir ."/plugins/videoplayer.js");
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
Trace("&#23637;&#31034;&#22270;&#29255;&#19981;&#23384;&#22312;&#65292;&#26816;&#26597;&#36335;&#24452;","-1");
}
}
}
$editsql = "UPDATE `#@__pano_ui` SET 
            `title` = '$title',
            `uitype` = '$uitype',
            `openui` = '$openui',
            `imgfile` = '$imgfile',
            `videofile` = '$videofile',
            `uipos` = '$uipos',
            `uix` = '$uix',
            `uiy` = '$uiy',
            `uiscale` = '$uiscale',
            `uizorder` = '$uizorder',
            `uialpha` = '$uialpha',
            `openaction` = $openaction,
            `action` = $action,
            `panotarget` = $panotarget,
            `targeth` = $targeth,
            `targetv` = $targetv,
            `showpic` = '$showpic',
            `showpicbordercolor` = '$showpicbordercolor',
            `showpicborderalpha` = '$showpicborderalpha',
            `showpicborderwidth` = '$showpicborderwidth',
            `httplink` = '$httplink'
            WHERE `id`= $id";
$mydb->DoNotBack($editsql);
Trace("&#20462;&#25913;&#23436;&#25104;&#65281;",$endurl);
exit();
}
$uitypejs = "";
$uitypejs .= "<script type=\"text/javascript\" />";
$uitypejs .= "showtb({$row['uitype']});";
$uitypejs .= "</script>";
$uiposjs = "";
$uiposjs .= "<script type=\"text/javascript\" />";
$uiposjs .= "onetian({$row['uipos']});";
$uiposjs .= "</script>";
$actionhtml = "";
$actionhtml .= "<script type=\"text/javascript\">\r\n";
$actionhtml .= "showac(".$row['action'] .");\r\n";
$actionhtml .= "</script>\r\n";
$parentsql = "SELECT * FROM `#@__pano_ui` WHERE id=$id";
$parentrow = $mydb->GetOne($parentsql);
$panosql = "SELECT * FROM `#@__pano_scene` WHERE pid={$parentrow['pid']} ORDER BY `rank`";
$mydb->SetQuery($panosql);
$mydb->Execute("pano");
$panohtml = "<input type=\"hidden\" name=\"panotarget\" id=\"panotarget\" value=\"0\" />\r\n";
$autokey = 0;
$panojshtml = "";
while ($panorow = $mydb->GetArray("pano")) {
$panohtml .= "<div class=\"panobox\" onclick=\"getpanotarget($autokey,{$panorow['id']});\">\r\n";
$panohtml .= "<div class=\"panotitle\"><b>&#21517;&#31216;&#65306;</b>{$panorow['scenename']}</div>\r\n";
$panohtml .= "<div class=\"panocode\"><b>&#32534;&#21495;&#65306;</b>{$panorow['rank']}</div>\r\n";
$panohtml .= "</div>\r\n";
if ($row['panotarget'] == $panorow['id']) {
$panojshtml .= "<script type=\"text/javascript\">\r\n";
$panojshtml .= "getpanotarget($autokey,".$panorow['id'] .");\r\n";
$panojshtml .= "</script>\r\n";
}
$autokey++;
}
require('template/vrpano_ui_edit.htm');
?>