<?phpecho '﻿';
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
if ($dopost == "cuber2six") {
$imgfile = LULINROOT .$file;
echo "var imgcut = false;";
if (is_file($imgfile)) {
$arr = getimagesize($imgfile);
$width = $arr[0];
$height = $arr[1];
$imgype = $arr[2];
if ($width == $height * 6) {
if ($imgype == 1) {
$getimg = @imagecreatefromgif($imgfile);
}else if ($imgype == 2) {
$getimg = @imagecreatefromjpeg($imgfile);
}else {
$getimg = @imagecreatefrompng($imgfile);
}
$front = imagecreatetruecolor($height,$height);
$right = imagecreatetruecolor($height,$height);
$back = imagecreatetruecolor($height,$height);
$left = imagecreatetruecolor($height,$height);
$up = imagecreatetruecolor($height,$height);
$down = imagecreatetruecolor($height,$height);
imagecopy($front,$getimg,0,0,0,0,$height,$height);
imagecopy($right,$getimg,0,0,$height,0,$height,$height);
imagecopy($back,$getimg,0,0,2 * $height,0,$height,$height);
imagecopy($left,$getimg,0,0,3 * $height,0,$height,$height);
imagecopy($up,$getimg,0,0,4 * $height,0,$height,$height);
imagecopy($down,$getimg,0,0,5 * $height,0,$height,$height);
$filenametemp = time();
imagejpeg($front,LULINROOT ."/uploads/station/".$filenametemp ."_front.jpg",100);
imagejpeg($right,LULINROOT ."/uploads/station/".$filenametemp ."_right.jpg",100);
imagejpeg($back,LULINROOT ."/uploads/station/".$filenametemp ."_back.jpg",100);
imagejpeg($left,LULINROOT ."/uploads/station/".$filenametemp ."_left.jpg",100);
imagejpeg($up,LULINROOT ."/uploads/station/".$filenametemp ."_up.jpg",100);
imagejpeg($down,LULINROOT ."/uploads/station/".$filenametemp ."_down.jpg",100);
unlink($imgfile);
echo "imgcut = true;";
echo "var newimg = new Array();";
echo "newimg['front'] = '/uploads/station/".$filenametemp ."_front.jpg';";
echo "newimg['back'] = '/uploads/station/".$filenametemp ."_back.jpg';";
echo "newimg['up'] = '/uploads/station/".$filenametemp ."_up.jpg';";
echo "newimg['down'] = '/uploads/station/".$filenametemp ."_down.jpg';";
echo "newimg['left'] = '/uploads/station/".$filenametemp ."_left.jpg';";
echo "newimg['right'] = '/uploads/station/".$filenametemp ."_right.jpg';";
}else if ($width * 6 == $height) {
if ($imgype == 1) {
$getimg = @imagecreatefromgif($imgfile);
}else if ($imgype == 2) {
$getimg = @imagecreatefromjpeg($imgfile);
}else {
$getimg = @imagecreatefrompng($imgfile);
}
$front = imagecreatetruecolor($width,$width);
$right = imagecreatetruecolor($width,$width);
$back = imagecreatetruecolor($width,$width);
$left = imagecreatetruecolor($width,$width);
$up = imagecreatetruecolor($width,$width);
$down = imagecreatetruecolor($width,$width);
imagecopy($front,$getimg,0,0,0,0,$width,$width);
imagecopy($right,$getimg,0,0,0,$width,$width,$width);
imagecopy($back,$getimg,0,0,0,2 * $width,$width,$width);
imagecopy($left,$getimg,0,0,0,3 * $width,$width,$width);
imagecopy($up,$getimg,0,0,0,4 * $width,$width,$width);
imagecopy($down,$getimg,0,0,0,5 * $width,$width,$width);
$filenametemp = time();
imagejpeg($front,LULINROOT ."/uploads/station/".$filenametemp ."_front.jpg",100);
imagejpeg($right,LULINROOT ."/uploads/station/".$filenametemp ."_right.jpg",100);
imagejpeg($back,LULINROOT ."/uploads/station/".$filenametemp ."_back.jpg",100);
imagejpeg($left,LULINROOT ."/uploads/station/".$filenametemp ."_left.jpg",100);
imagejpeg($up,LULINROOT ."/uploads/station/".$filenametemp ."_up.jpg",100);
imagejpeg($down,LULINROOT ."/uploads/station/".$filenametemp ."_down.jpg",100);
unlink($imgfile);
echo "imgcut = true;";
echo "var newimg = new Array();";
echo "newimg['front'] = '/uploads/station/".$filenametemp ."_front.jpg';";
echo "newimg['back'] = '/uploads/station/".$filenametemp ."_back.jpg';";
echo "newimg['up'] = '/uploads/station/".$filenametemp ."_up.jpg';";
echo "newimg['down'] = '/uploads/station/".$filenametemp ."_down.jpg';";
echo "newimg['left'] = '/uploads/station/".$filenametemp ."_left.jpg';";
echo "newimg['right'] = '/uploads/station/".$filenametemp ."_right.jpg';";
}else {
echo "alert('转化失败，上传图片不是标准条形图！');";
}
}
exit();
}else if ($dopost == "ball2six") {
$xitong = PHP_OS;
if ($xitong == "WINNT"||$xitong == "Windows"||$xitong == "WIN32") {
$imgfile = LULINROOT .$file;
echo "var imgcut = false;";
if (is_file($imgfile)) {
$arr = getimagesize($imgfile);
$width = $arr[0];
$height = $arr[1];
$imgype = $arr[2];
if ($imgype == 1) {
$imgtp = ".gif";
}else if ($imgype == 2) {
$imgtp = ".jpg";
}else {
$imgtp = ".png";
}
$basedir = LULINROOT ."/uploads/transform";
checkdeldir($basedir);
mkdir($basedir);
$newpano = $basedir ."/pano".$imgtp;
rename($imgfile,$newpano);
if (exec(LULINREQ ."/vrpano/main/tools/sphere2cube.bat $newpano",$output)) {
echo "imgcut = true;";
echo "var newimg = new Array();";
echo "newimg['front'] = \"/uploads/transform/pano_f$imgtp\";";
echo "newimg['back'] = \"/uploads/transform/pano_b$imgtp\";";
echo "newimg['up'] = \"/uploads/transform/pano_u$imgtp\";";
echo "newimg['down'] = \"/uploads/transform/pano_d$imgtp\";";
echo "newimg['left'] = \"/uploads/transform/pano_l$imgtp\";";
echo "newimg['right'] = \"/uploads/transform/pano_r$imgtp\";";
checkdelfile($newpano);
}
}
exit();
}else {
echo "alert('此功能只能在Windows环境下有效!');";
exit();
}
}else if ($dopost == "suipian2six") {
$imgarr = explode("|",$file);
$len = count($imgarr);
$pano_everylen = $len / 6;
$pano_zhenlie = sqrt($pano_everylen);
if (is_numeric($pano_zhenlie)) {
$basedir = LULINROOT ."/uploads/panotu";
$picdir = $basedir ."/pic";
checkmakedir($basedir);
checkdeldir($picdir);
checkmakedir($picdir);
foreach ($imgarr as $v) {
$vname = basename($v);
rename(LULINROOT .$v,$picdir ."/".$vname);
}
header("location: vrpano_pintu.php?action=new");
}else {
echo "var over = \"err\";";
}
exit();
}
?>