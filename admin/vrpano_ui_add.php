<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_ui");
if ($dopost == "save") {
$mydb = new mysql();
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$pid";
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
$sql = "INSERT INTO `#@__pano_ui` (`title`,`uitype`,`pid`,`videofile`,`imgfile`)
                VALUES ('$title','$uitype','$pid','$videofile','$imgfile')";
$mydb->ExecNoneQuery($sql);
$newid = $mydb->GetLastID();
Trace("UI&#28155;&#21152;&#25104;&#21151;&#65281;","vrpano_ui_edit.php?id=$newid");
exit();
}
require('template/vrpano_ui_add.htm');
?>