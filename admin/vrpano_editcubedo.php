<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
if ($dopost == "cut") {
$dir = LULINROOT ."/vrpano/vrpano{$panoid}/cube/cube{$cubeid}";
$file = scandir($dir);
$mm = $key +2;
$img = $dir ."/".$file[$mm];
$arr = getimagesize($img);
$width = $arr[0];
$height = $arr[1];
$oldtype = $arr[2];
if ($width >600 ||$height >400) {
$w = $width / 3;
$h = $height / 2;
if ($w >$h) {
$ow = 600;
$oh = 600 * $height / $width;
$oh = floor($oh);
}else {
$ow = 400 * $width / $height;
$oh = 400;
$oh = floor($oh);
}
}else{
$ow = $width;
$oh = $height;
}
if ($oldtype == 1) {
$gettestimg = imagecreatefromgif($img);
$editimg = $dir ."/me.gif";
}else if ($oldtype == 2) {
$gettestimg = imagecreatefromjpeg($img);
$editimg = $dir ."/me.jpg";
}else {
$gettestimg = imagecreatefrompng($img);
$editimg = $dir ."/me.png";
}
$testpicture = imagecreatetruecolor($ow,$oh);
imagecopyresized($testpicture,$gettestimg,0,0,0,0,$ow,$oh,$width,$height);
imagejpeg($testpicture,$editimg,75);
unlink($img);
rename($editimg,$img);
$key++;
if ($key == $total) {
echo "var ok = true;";
}else {
echo "cutcube($key);";
}
}
?>