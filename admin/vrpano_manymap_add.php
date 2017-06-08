<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_maps_url");
$mydb = new mysql();
if ($dopost == 'save') {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id=$id";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_maps` WHERE `pid`=$id ORDER BY `rank` DESC");
if (is_array($therow)) {
$tid = $therow['rank'] +1;
}else {
$tid = 1;
}
$mapdir = $basedir ."/map";
checkmakedir($mapdir);
if ($file != "") {
$file_basename = basename($file);
$file_basename = reNameMe($file_basename,"map".$tid);
checkdelfile($mapdir ."/".$file_basename);
rename(LULINROOT .$file,$mapdir ."/".$file_basename);
$file = $file_basename;
}
$sql = "INSERT INTO `#@__pano_maps` (`rank`,`pid`,`title`,`file`)
                VALUES ($tid,$id,'$title','$file')";
$mydb->ExecuteNoneQuery($sql);
Trace("&#21457;&#24067;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_manymap_add.htm');
?>