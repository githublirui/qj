<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_photo_url");
require_once(LULINREQ ."/class/mytag.class.php");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_photo` WHERE id=$id";
$row = $dsql->getOne($sql);
$pid = $row['pid'];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$photodir = $basedir ."/photo";
$photobagdir = $basedir ."/photo/photo".$row['rank'];
$photobagurl = $cfg_cmspath ."/vrpano/".$mainrow['filedir'] ."/photo/photo".$row['rank'];
if ($dopost == "save") {
$editok = false;
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
if ($litpic != $row['litpic']) {
$litpic_basename = basename($litpic);
$litpic_basename = reNameMe($litpic_basename,"litpic");
if ($row['litpic'] != "") {
unlink($photobagdir."/".$row['litpic']);
}
rename(LULINROOT .$litpic,$photobagdir ."/".$litpic_basename);
$litpic = $litpic_basename;
}
$imagesVal = "";
for ($i = 0;$i <count($images);$i++) {
if (is_file(LULINROOT.$images[$i])) {
if (substr_count($images[$i],"station") >0) {
$editok = true;
rename(LULINROOT .$images[$i],$photobagdir ."/".basename($images[$i]));
}
$images[$i] = basename($images[$i]);
}else {
$images[$i] = "";
}
$imagesVal .= "{lulin:imglist src=\"{$images[$i]}\"/}";
}
$delimgs = explode("|",$delimg);
if (is_array($delimgs)) {
foreach ($delimgs as $r =>$v) {
if (is_file($photobagdir ."/".$v)) {
unlink($photobagdir ."/".$v);
}
}
}
$addsql = "UPDATE `#@__pano_photo` SET
        title = '$title',
        litpic = '$litpic',
        imglist = '$imagesVal'            
        WHERE id=$id";
$mydb->ExecuteNoneQuery($addsql);
if($editok == true){
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;","vrpano_editphoto.php?id={$id}");
}else{
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;",$endurl);
}
exit();
}
$imgdtp = new MyTagParse();
$imgdtp->SetNameSpace('lulin','{','}');
$imgdtp->LoadSource($row["imglist"]);
$data = "";
if (is_array($imgdtp->CTags)) {
foreach ($imgdtp->CTags as $imgs =>$imgctag) {
if ($imgctag->GetName() == "imglist") {
if ($data != "") {
$data .= "|";
}
$data .= $photobagurl ."/".$imgctag->GetAtt("src");
}
}
}
$scripthtml = "<script language=\"javascript\" type=\"text/javascript\">\r\n";
$scripthtml .= "$(\"#images_box\").editimgbox(\"$data\",\"images\",\"$cfg_cmspath\");\r\n";
$scripthtml .= "</script>\r\n";
require('template/vrpano_photo_edit.htm');
?>