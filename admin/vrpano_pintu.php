<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
$basedir = LULINROOT ."/uploads/panotu";
$picdir = $basedir ."/pic";
$outdir = $basedir ."/putout";
$file = scandir($picdir);
$tp = array();
$tp[1] = "_b";
$tp[2] = "_d";
$tp[3] = "_f";
$tp[4] = "_l";
$tp[5] = "_r";
$tp[6] = "_u";
$newfile = array();
for ($k = 2;$k <count($file);$k++) {
array_push($newfile,$file[$k]);
}
$pano_totle = count($newfile);
$pano_everylen = $pano_totle / 6;
$pano_zhenlie = sqrt($pano_everylen);
$panoarr = array();
for ($o = 1;$o <= 6;$o++) {
for ($a = 1;$a <= $pano_zhenlie;$a++) {
for ($b = 1;$b <= $pano_zhenlie;$b++) {
$c = ($o -1) * $pano_everylen +($a -1) * $pano_zhenlie +$b -1;
$panoarr[$o][$a][$b] = $newfile[$c];
}
}
}
if ($type == "") {
$type = 1;
}
$wanzheng = $picdir ."/".$panoarr[$type][1][1];
$buwanzheng = $picdir ."/".$panoarr[$type][$pano_zhenlie][$pano_zhenlie];
$wanzhengarr = getimagesize($wanzheng);
$wanzhengwidth = $wanzhengarr[0];
$imgtype = $wanzhengarr[2];
$buwanzhengarr = getimagesize($buwanzheng);
$buwanzhengwidth = $buwanzhengarr[0];
$totalwidth = ($pano_zhenlie -1) * $wanzhengwidth +$buwanzhengwidth;
$picwidtharr = array();
$picheightarr = array();
for ($i = 1;$i <= $pano_zhenlie;$i++) {
for ($j = 1;$j <= $pano_zhenlie;$j++) {
if ($i == $pano_zhenlie &&$j == $pano_zhenlie) {
$picwidtharr[$i][$j] = $buwanzhengwidth;
$picheightarr[$i][$j] = $buwanzhengwidth;
}else if ($i == $pano_zhenlie) {
$picwidtharr[$i][$j] = $wanzhengwidth;
$picheightarr[$i][$j] = $buwanzhengwidth;
}else if ($j == $pano_zhenlie) {
$picwidtharr[$i][$j] = $buwanzhengwidth;
$picheightarr[$i][$j] = $wanzhengwidth;
}else {
$picwidtharr[$i][$j] = $wanzhengwidth;
$picheightarr[$i][$j] = $wanzhengwidth;
}
}
}
function showpic($n,$m) {
global $picwidtharr,$picheightarr;
echo "&#24403;&#21069;&#22270;&#29255;&#23485;&#24230;&#21644;&#39640;&#24230;&#20026;&#65306;".$picwidtharr[$n][$m] ."x".$picheightarr[$n][$m];
echo "<br/>";
}
if ($action == "new") {
checkdeldir($outdir);
$cutid = 1;
}
checkmakedir($outdir);
$dst_im = imagecreatetruecolor($totalwidth,$totalwidth);
for ($i = 1;$i <= $pano_zhenlie;$i++) {
for ($j = 1;$j <= $pano_zhenlie;$j++) {
$mapx = ($j -1) * $wanzhengwidth;
$mapy = ($i -1) * $wanzhengwidth;
if ($imgtype == 1) {
$oldsrc = @imagecreatefromgif($picdir ."/".$panoarr[$cutid][$i][$j]);
imagecopyresized($dst_im,$oldsrc,$mapx,$mapy,0,0,$picwidtharr[$i][$j],$picheightarr[$i][$j],$picwidtharr[$i][$j],$picheightarr[$i][$j]);
}else if ($imgtype == 2) {
$oldsrc = @imagecreatefromjpeg($picdir ."/".$panoarr[$cutid][$i][$j]);
imagecopyresized($dst_im,$oldsrc,$mapx,$mapy,0,0,$picwidtharr[$i][$j],$picheightarr[$i][$j],$picwidtharr[$i][$j],$picheightarr[$i][$j]);
}else {
$oldsrc = @imagecreatefromjpng($picdir ."/".$panoarr[$cutid][$i][$j]);
imagecopyresized($dst_im,$oldsrc,$mapx,$mapy,0,0,$picwidtharr[$i][$j],$picheightarr[$i][$j],$picwidtharr[$i][$j],$picheightarr[$i][$j]);
}
}
}
imagejpeg($dst_im,$outdir ."/pano".$tp[$cutid] .".jpg",100);
if ($action == "new") {
$cutid++;
header("location: vrpano_pintu.php?action=goon&cutid=$cutid");
exit();
}
if ($action == "goon"&&$cutid <= 5) {
$cutid++;
header("location: vrpano_pintu.php?action=goon&cutid=$cutid");
exit();
}else {
checkdeldir($picdir);
$imgtp = ".jpg";
echo "var over=\"ok\";";
echo "var newimg = new Array();";
echo "newimg['front'] = \"/uploads/panotu/putout/pano_f$imgtp\";";
echo "newimg['back'] = \"/uploads/panotu/putout/pano_b$imgtp\";";
echo "newimg['up'] = \"/uploads/panotu/putout/pano_u$imgtp\";";
echo "newimg['down'] = \"/uploads/panotu/putout/pano_d$imgtp\";";
echo "newimg['left'] = \"/uploads/panotu/putout/pano_l$imgtp\";";
echo "newimg['right'] = \"/uploads/panotu/putout/pano_r$imgtp\";";
exit();
}
?>