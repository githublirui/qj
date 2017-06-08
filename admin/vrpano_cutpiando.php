<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
if ($dopost == "cut") {
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_scene` WHERE `id`=$id";
$row = $mydb->getOne($sql);
$pid = $row['pid'];
$basedir = LULINROOT ."/vrpano/vrpano".$row['pid'];
$baseimgdir = $cfg_cmspath ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$imgdir = LULINROOT ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$outdir = $imgdir ."/tiles";
if ($key == 0) {
checkdeldir($outdir);
checkmakedir($outdir);
}
$file = $imgdir ."/{$putin}.jpg";
$imgdata = getimagesize($file);
$imgtype = $imgdata[2];
$imgwidth = $imgdata[0];
$imgheight = $imgdata[1];
$cutdex = 250;
$cutnum = getCutNum($imgwidth,$cutdex);
$cutlistdex = getCutLast($imgwidth,$cutdex);
$boxdex = floor(400 / $cutnum) -4;
$boxlistdex = $boxdex * $cutlistdex / $cutdex;
if ($imgtype == 1) {
$oldsrc = @imagecreatefromgif($file);
}else if ($imgtype == 2) {
$oldsrc = @imagecreatefromjpeg($file);
}else {
$oldsrc = @imagecreatefromjpng($file);
}
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
$cutx = $x * $cutdex;
$cuty = $y * $cutdex;
$xx = $x +1;
$yy = $y +1;
$dst_im = imagecreatetruecolor($cutwdex,$cuthdex);
imagecopyresized($dst_im,$oldsrc,0,0,$cutx,$cuty,$cutwdex,$cuthdex,$cutwdex,$cuthdex);
checkdelfile($outdir ."/pano_{$putout}_{$yy}_{$xx}.jpg");
imagejpeg($dst_im,$outdir ."/pano_{$putout}_{$yy}_{$xx}.jpg",100);
$dp = $y * $cutnum +$x;
echo "wan($key,$x,$y,$boxwdwx,$boxhdwx);\r\n";
}
}
$key++;
echo "cut($key);";
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
?>