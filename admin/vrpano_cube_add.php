<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_cube_url");
if ($dopost == 'save') {
$mydb = new MySql();
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$id";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_cube` WHERE `pid`=$id ORDER BY `rank` DESC");
if (is_array($therow)) {
$tid = $therow['rank'] +1;
}else {
$tid = 1;
}
$photodir = $basedir ."/cube";
$photobagdir = $basedir ."/cube/cube$tid";
checkmakedir($photodir);
checkdeldir($photobagdir);
checkmakedir($photobagdir);
$photoskindir = $basedir ."/cube/skin";
checkmakedir($photoskindir);
checkcopyfile(LULINREQ ."/vrpano/main/cube/play.png",$photoskindir ."/play.png");
checkcopyfile(LULINREQ ."/vrpano/main/cube/x.png",$photoskindir ."/x.png");
checkcopyfile(LULINREQ ."/vrpano/main/cube/sound.png",$photoskindir ."/sound.png");
checkcopyfile(LULINREQ ."/vrpano/main/cube/cube.xml",$photodir ."/cube$tid.xml");
checkmakedir($basedir ."/plugins");
checkcopyfile(LULINREQ ."/vrpano/main/plugins/textfield.swf",$basedir ."/plugins/textfield.swf");
$imagesVal = "";
for ($i = 0;$i <count($images);$i++) {
if (is_file(LULINROOT .$images[$i])) {
if ($i == 0) {
$arr = getimagesize(LULINROOT .$images[$i]);
$arrwidth = $arr[0];
$arrheight = $arr[1];
}
if (substr_count($images[$i],"station") >0) {
rename(LULINROOT .$images[$i],$photobagdir ."/".basename($images[$i]));
$images[$i] = basename($images[$i]);
}
$k  = $i +1;
if($i==0){
$imgxml .= "<layer  name=\"cube{$tid}_img{$k}\" visible=\"True\" url=\"%SWFPATH%/cube/cube{$tid}/$images[$i]\" preload=\"True\" align=\"center\"  edge=\"center\"  width=\"#width#\" height=\"#height#\" x=\"0\" y=\"0\"></layer>\r\n";
}else{
$imgxml .= "<layer  name=\"cube{$tid}_img{$k}\" visible=\"False\" url=\"%SWFPATH%/cube/cube{$tid}/$images[$i]\" preload=\"False\" align=\"center\"  edge=\"center\"  width=\"#width#\" height=\"#height#\" x=\"0\" y=\"0\"></layer>\r\n";
}
}else {
$images[$i] = "";
}
$imagesVal .= "{lulin:imglist src=\"{$images[$i]}\"/}";
}
if ($arrwidth >600 ||$arrheight >400) {
$w = $arrwidth / 3;
$h = $arrheight / 2;
if ($w >$h) {
$ow = 600;
$oh = 600 * $arrheight / $arrwidth;
$oh = floor($oh);
}else {
$ow = 400 * $arrwidth / $arrheight;
$oh = 400;
$ow = floor($ow);
}
}else {
$ow = $arrwidth;
$oh = $arrheight;
}
$xmlfilestring = file_get_contents($photodir ."/cube$tid.xml");
$xmlfilestring = str_replace("#title#",$title,$xmlfilestring);
$xmlfilestring = str_replace("#total#",count($images),$xmlfilestring);
$xmlfilestring = str_replace("#rank#",$tid,$xmlfilestring);
$xmlfilestring = str_replace("#photo#",$imgxml,$xmlfilestring);
$xmlfilestring = str_replace("#width#",$ow,$xmlfilestring);
$xmlfilestring = str_replace("#height#",$oh,$xmlfilestring);
$maxwidth = $ow +40;
$maxheight= $oh +100;
$xmlfilestring = str_replace("#maxwidth#",$maxwidth,$xmlfilestring);
$xmlfilestring = str_replace("#maxheight#",$maxheight,$xmlfilestring);
$xmlfile = fopen($photodir ."/cube$tid.xml","w");
fwrite($xmlfile,$xmlfilestring);
$sql = "INSERT INTO `#@__pano_cube` (`rank`,`pid`,`title`,`imglist`,`width`,`height`)
                VALUES ($tid,$id,'$title','$imagesVal',$ow,$oh)";
$dsql->ExecuteNoneQuery($sql);
$lastid = $mydb->GetLastID();
Trace("&#21457;&#24067;&#25104;&#21151;&#65281;","vrpano_editcube.php?id={$lastid}");
exit();
}
require('template/vrpano_cube_add.htm');
?>