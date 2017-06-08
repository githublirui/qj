<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_cube_url");
require_once(LULINREQ ."/class/mytag.class.php");
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_cube` WHERE id=$id";
$row = $dsql->getOne($sql);
$pid = $row['pid'];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$photodir = $basedir ."/cube";
$photobagdir = $basedir ."/cube/cube".$row['rank'];
$photobagurl = $cfg_cmspath ."/vrpano/".$mainrow['filedir'] ."/cube/cube".$row['rank'];
if ($dopost == "save") {
$editok = false;
checkmakedir($photodir);
checkmakedir($photobagdir);
$photoskindir = $basedir ."/cube/skin";
checkmakedir($photoskindir);
checkcopyfile(LULINREQ ."/vrpano/main/cube/play.png",$photoskindir ."/play.png");
checkcopyfile(LULINREQ ."/vrpano/main/cube/x.png",$photoskindir ."/x.png");
checkcopyfile(LULINREQ ."/vrpano/main/cube/sound.png",$photoskindir ."/sound.png");
checkdelfile($photodir ."/cube{$row['rank']}.xml");
checkcopyfile(LULINREQ ."/vrpano/main/cube/cube.xml",$photodir ."/cube{$row['rank']}.xml");
checkmakedir($basedir ."/plugins");
checkcopyfile(LULINREQ ."/vrpano/main/plugins/textfield.swf",$basedir ."/plugins/textfield.swf");
$imagesVal = "";
$imgxml = "";
for ($i = 0;$i <count($images);$i++) {
if (is_file(LULINROOT .$images[$i])) {
if (substr_count($images[$i],"station") >0) {
$editok = true;
rename(LULINROOT .$images[$i],$photobagdir ."/".basename($images[$i]));
}
$images[$i] = basename($images[$i]);
$k = $i +1;
if ($i == 0) {
$imgxml .= "<layer  name=\"cube{$row['rank']}_img{$k}\" visible=\"True\" url=\"%SWFPATH%/cube/cube{$row['rank']}/$images[$i]\" preload=\"True\" align=\"center\"  edge=\"center\"  width=\"{$row['width']}\" height=\"{$row['height']}\" x=\"0\" y=\"0\"></layer>\r\n";
}else {
$imgxml .= "<layer  name=\"cube{$row['rank']}_img{$k}\" visible=\"False\" url=\"%SWFPATH%/cube/cube{$row['rank']}/$images[$i]\" preload=\"False\" align=\"center\"  edge=\"center\"  width=\"{$row['width']}\" height=\"{$row['height']}\" x=\"0\" y=\"0\"></layer>\r\n";
}
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
$xmlfilestring = file_get_contents($photodir ."/cube{$row['rank']}.xml");
$xmlfilestring = str_replace("#title#",$title,$xmlfilestring);
$xmlfilestring = str_replace("#total#",count($images),$xmlfilestring);
$xmlfilestring = str_replace("#rank#",$row['rank'],$xmlfilestring);
$xmlfilestring = str_replace("#photo#",$imgxml,$xmlfilestring);
$xmlfilestring = str_replace("#width#",$row['width'],$xmlfilestring);
$xmlfilestring = str_replace("#height#",$row['height'],$xmlfilestring);
$maxwidth = $row['width'] +40;
$maxheight = $row['height'] +100;
$xmlfilestring = str_replace("#maxwidth#",$maxwidth,$xmlfilestring);
$xmlfilestring = str_replace("#maxheight#",$maxheight,$xmlfilestring);
$xmlfile = fopen($photodir ."/cube{$row['rank']}.xml","w");
fwrite($xmlfile,$xmlfilestring);
$addsql = "UPDATE `#@__pano_cube` SET
        `title` = '$title',
        `imglist` = '$imagesVal',
        `width` = '$width',
        `height` = '$height'
        WHERE id=$id";
$dsql->ExecuteNoneQuery($addsql);
if ($editok == true) {
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;","vrpano_editcube.php?id={$id}");
}else {
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
require('template/vrpano_cube_edit.htm');
?>