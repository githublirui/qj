<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_scene_url");
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_scene` WHERE `id`=$id";
$row = $mydb->getOne($sql);
$pid = $row['pid'];
$basedir = LULINROOT ."/vrpano/vrpano".$row['pid'];
$baseimgdir = $cfg_cmspath ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$imgdir = LULINROOT ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$file = $imgdir ."/tb_up.jpg";
$imgdata = getimagesize($file);
$imgtype = $imgdata[2];
$imgwidth = $imgdata[0];
$imgheight = $imgdata[1];
$cutdex = 250;
if ($imgwidth == $imgheight &&$imgwidth >$cutdex) {
$cutnum = getCutNum($imgwidth,$cutdex);
$cutlistdex = getCutLast($imgwidth,$cutdex);
$boxdex = floor(400 / $cutnum) -4;
$boxlistdex = $boxdex * $cutlistdex / $cutdex;
$boxmainwidth = ($boxdex +4) * ($cutnum -1) +($boxlistdex +4);
$cuthtml = "";
for ($y = 0;$y <$cutnum;$y++) {
for ($x = 0;$x <$cutnum;$x++) {
if ($y == $cutnum -1) {
$cuthdex = $cutlistdex;
$boxhdwx = $boxlistdex;
}else {
$cuthdex = $cutdex;
$boxhdwx = $boxdex;
}
if ($x == $cutnum -1) {
$cutwdex = $cutlistdex;
$boxwdwx = $boxlistdex;
}else {
$cutwdex = $cutdex;
$boxwdwx = $boxdex;
}
$cuthtml .= "<div class=\"box\" style=\"width: {$boxwdwx}px; height:{$boxhdwx}px; line-height: {$boxhdwx}px;\"></div>";
}
}
}else {
$cutnum = 1;
$cutlistdex = $imgheight;
$boxmainwidth = 400;
for ($y = 0;$y <1;$y++) {
for ($x = 0;$x <1;$x++) {
$boxhdwx = 400;
$boxwdwx = 400;
$cuthtml .= "<div class=\"box\" style=\"width: {$boxwdwx}px; height:{$boxhdwx}px; line-height: {$boxhdwx}px;\"></div>";
}
}
}
function getCutNum($img,$cut) {
$num = $img / $cut;
if ($img %$cut != 0) {
return ceil($num);
}else {
return $num;
}
}
function getCutLast($img,$cut) {
$xx = $img / $cut;
if ($img %$cut != 0) {
$xxxx = floor($xx);
}else{
$xxxx = $xx-1;
}
$xxx = $img -($xxxx * $cut);
return $xxx;
}
$showhtml = "";
for($p=0;$p<6;$p++){
$showhtml .= "<div class=\"show\" id=\"pano{$p}\" style=\"width: {$boxmainwidth}px; height: {$boxmainwidth}px;\">\r\n";
$showhtml .= "<div class=\"showbox\" style=\"width: {$boxmainwidth}px; height: {$boxmainwidth}px;\">$cuthtml</div>\r\n";
$showhtml .= "</div>\r\n";
}
$startjs = "";
$startjs .= "<script language=\"javascript\" type=\"text/javascript\">\r\n";
$startjs .= "var panoid=$id;\r\n";
$startjs .= "var cutnum=$cutnum;\r\n";
$startjs .= "var imgurl=\"$baseimgdir/tiles/\";\r\n";
$startjs .= "$(document).ready(function(){\r\n";
if($row['type'] == 2&&$row['opencut']==1){
$startjs .= "cut(0);\r\n";
}else{
$startjs .= "good();\r\n";
}
$startjs .= "});\r\n";
$startjs .= "</script>\r\n";
require('template/vrpano_cutpian2.htm');
?>