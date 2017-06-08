<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_scene_url");
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_scene` WHERE id = $id";
$row = $mydb->GetOne($sql);
$basedir = LULINROOT ."/vrpano/vrpano".$row['pid'];
$baseimgdir = $cfg_cmspath ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$imgdir = LULINROOT ."/vrpano/vrpano".$row['pid'] ."/images/scene{$row['rank']}";
$psql = "SELECT * FROM `#@__pano_main` WHERE id = {$row['pid']}";
$prow = $mydb->getOne($psql);
if ($type == 1) {
if ($row['type'] == 1) {
copytheimage($imgdir ."/pano.jpg",$imgdir ."/tb_pano.jpg",2000,1000,75);
}else if ($row['type'] == 2) {
copytheimage($imgdir ."/pano_left.jpg",$imgdir ."/tb_left.jpg",1500,1500,75);
copytheimage($imgdir ."/pano_right.jpg",$imgdir ."/tb_right.jpg",1500,1500,75);
copytheimage($imgdir ."/pano_up.jpg",$imgdir ."/tb_up.jpg",1500,1500,75);
copytheimage($imgdir ."/pano_down.jpg",$imgdir ."/tb_down.jpg",1500,1500,75);
copytheimage($imgdir ."/pano_front.jpg",$imgdir ."/tb_front.jpg",1500,1500,75);
copytheimage($imgdir ."/pano_back.jpg",$imgdir ."/tb_back.jpg",1500,1500,75);
}else if ($row['type'] == 3) {
copyscaleimage($imgdir ."/pano.jpg",$imgdir ."/tb_pano.jpg",2000,2000,75);
}
Trace2("&#24179;&#26495;&#30005;&#33041;&#22270;&#29983;&#25104;&#23436;&#25104;","vrpano_scenemaker.php?id=$id&type=2");
exit();
}else if ($type == 2) {
if ($row['type'] == 1) {
copytheimage($imgdir ."/pano.jpg",$imgdir ."/mb_pano.jpg",1000,500,75);
}else if ($row['type'] == 2) {
copytheimage($imgdir ."/pano_left.jpg",$imgdir ."/mb_left.jpg",400,400,75);
copytheimage($imgdir ."/pano_right.jpg",$imgdir ."/mb_right.jpg",400,400,75);
copytheimage($imgdir ."/pano_up.jpg",$imgdir ."/mb_up.jpg",400,400,75);
copytheimage($imgdir ."/pano_down.jpg",$imgdir ."/mb_down.jpg",400,400,75);
copytheimage($imgdir ."/pano_front.jpg",$imgdir ."/mb_front.jpg",400,400,75);
copytheimage($imgdir ."/pano_back.jpg",$imgdir ."/mb_back.jpg",400,400,75);
}else if ($row['type'] == 3) {
copyscaleimage($imgdir ."/pano.jpg",$imgdir ."/mb_pano.jpg",1000,1000,75);
}
Trace2("&#25163;&#26426;&#22270;&#29983;&#25104;&#23436;&#25104;","vrpano_scenemaker.php?id=$id&type=3");
exit();
}else if ($type == 3) {
if ($row['type'] == 1) {
copytheimage($imgdir ."/pano.jpg",$imgdir ."/preview.jpg",1000,500,50);
}else if ($row['type'] == 2) {
$arr = getimagesize($imgdir ."/mb_left.jpg");
$boxsize = $arr[0];
$dst_im = imagecreatetruecolor(400,2400);
$src_l = @imagecreatefromjpeg($imgdir ."/mb_left.jpg");
imagecopyresized($dst_im,$src_l,0,0,0,0,400,400,$boxsize,$boxsize);
$src_f = @imagecreatefromjpeg($imgdir ."/mb_front.jpg");
imagecopyresized($dst_im,$src_f,0,400,0,0,400,400,$boxsize,$boxsize);
$src_r = @imagecreatefromjpeg($imgdir ."/mb_right.jpg");
imagecopyresized($dst_im,$src_r,0,800,0,0,400,400,$boxsize,$boxsize);
$src_b = @imagecreatefromjpeg($imgdir ."/mb_back.jpg");
imagecopyresized($dst_im,$src_b,0,1200,0,0,400,400,$boxsize,$boxsize);
$src_u = @imagecreatefromjpeg($imgdir ."/mb_up.jpg");
imagecopyresized($dst_im,$src_u,0,1600,0,0,400,400,$boxsize,$boxsize);
$src_d = @imagecreatefromjpeg($imgdir ."/mb_down.jpg");
imagecopyresized($dst_im,$src_d,0,2000,0,0,400,400,$boxsize,$boxsize);
imagejpeg($dst_im,$imgdir ."/preview.jpg",70);
}else if ($row['type'] == 3) {
copyscaleimage($imgdir ."/pano.jpg",$imgdir ."/preview.jpg",1000,1000,50);
}
if($row['type'] == 2&&$row['opencut'] == 1){
Trace("&#20840;&#26223;&#22330;&#26223;&#28155;&#21152;&#25104;&#21151;","vrpano_cutpian.php?id=$id");
}else{
Trace("&#20840;&#26223;&#22330;&#26223;&#28155;&#21152;&#25104;&#21151;",$endurl);
}
exit();
}
?>