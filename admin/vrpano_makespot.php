<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
if ($dopost == "heti") {
$imgarr = explode("|",$file);
$len = count($imgarr);
$basedir = LULINROOT ."/uploads/makespot";
$picdir = $basedir ."/pic";
checkmakedir($basedir);
checkdeldir($picdir);
checkmakedir($picdir);
foreach ($imgarr as $v) {
$vname = basename($v);
rename(LULINROOT .$v,$picdir ."/".$vname);
}
header("location: vrpano_makespot.php?dopost=hetido");
exit();
}if ($dopost == "hetido") {
$basedir = LULINROOT ."/uploads/makespot";
$picdir = $basedir ."/pic";
$outdir = $basedir ."/putout";
$file = scandir($picdir);
$newfile = array();
for ($k = 2;$k <count($file);$k++) {
array_push($newfile,$file[$k]);
}
$spot_totle = count($newfile);
$spot_data = getimagesize($picdir ."/".$newfile[0]);
$spot_width = $spot_data[0];
$spot_height = $spot_data[1];
$spot_type = $spot_data[2];
$totalheight = $spot_height * $spot_totle;
checkmakedir($outdir);
$dst_im = imagecreate($spot_width,$totalheight);
for ($i = 0;$i <$spot_totle;$i++) {
$mapx = 0;
$mapy = $i * $spot_height;
if ($spot_type == 1) {
$oldsrc = @imagecreatefromgif($picdir ."/".$newfile[$i]);
imagecopyresized($dst_im,$oldsrc,$mapx,$mapy,0,0,$spot_width,$spot_height,$spot_width,$spot_height);
}else if ($spot_type == 2) {
$oldsrc = @imagecreatefromjpeg($picdir ."/".$newfile[$i]);
imagecopyresized($dst_im,$oldsrc,$mapx,$mapy,0,0,$spot_width,$spot_height,$spot_width,$spot_height);
}else {
$oldsrc = @imagecreatefrompng($picdir ."/".$newfile[$i]);
imagecopyresized($dst_im,$oldsrc,$mapx,$mapy,0,0,$spot_width,$spot_height,$spot_width,$spot_height);
}
}
imagepng($dst_im,$outdir ."/spot.png",9);
checkdeldir($picdir);
echo "var over=\"ok\";";
echo "newimg = \"/uploads/makespot/putout/spot.png\";";
echo "newimgwidth = $spot_width;";
echo "newimgheight = $spot_height;";
echo "newimgtotal = $spot_totle;";
}
?>