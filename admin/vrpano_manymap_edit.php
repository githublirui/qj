<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_maps_url");
$mydb = new mysql();
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_maps` WHERE id=$id";
$row = $dsql->getOne($sql);
$pid = $row['pid'];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
$mapdir = $basedir ."/map";
$mapurl = $cfg_cmspath ."/vrpano/".$mainrow['filedir'] ."/map";
if ($dopost == "save") {
checkmakedir($mapdir);
if ($file != $row['file']) {
$therow = $dsql->getOne("SELECT `rank` FROM `#@__pano_maps` WHERE `id`=$id");
$file_basename = basename($file);
$file_basename = reNameMe($file_basename,"map".$therow['rank']);
if ($row['file'] != "") {
@unlink($mapdir ."/".$row['file']);
}
rename(LULINROOT .$file,$mapdir ."/".$file_basename);
$file = $file_basename;
}
$addsql = "UPDATE `#@__pano_maps` SET
        title = '$title',
        file = '$file'          
        WHERE id=$id";
$mydb->ExecuteNoneQuery($addsql);
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_manymap_edit.htm');
?>