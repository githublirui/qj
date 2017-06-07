<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_photo_url");
if ($dopost == 'save') {
$mydb = new mysql();
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$id";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_photo` WHERE `pid`=$id ORDER BY `rank` DESC");
if (is_array($therow)) {
$tid = $therow['rank'] +1;
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
$litpic_basename = basename($litpic);
$litpic_basename = reNameMe($litpic_basename,"litpic");
rename(LULINROOT .$litpic,$photobagdir ."/".$litpic_basename);
$litpic = $litpic_basename;
}
$imagesVal = "";
for ($i = 0;$i <count($images);$i++) {
if (is_file(LULINROOT .$images[$i])) {
if (substr_count($images[$i],"station") >0) {
rename(LULINROOT .$images[$i],$photobagdir ."/".basename($images[$i]));
$images[$i] = basename($images[$i]);
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
require('template/vrpano_photo_add.htm');
?>