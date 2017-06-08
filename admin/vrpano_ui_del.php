<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_ui");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_ui` WHERE id=$id";
$row = $mydb->getOne($sql);
if($dopost == "del"){
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow['filedir'];
if($row['uishowpic']!=""){
checkdelfile($basedir."/showpic/".$row['uishowpic']);
}
if($row['imgfile']!=""){
checkdelfile($basedir."/ui/".$row['imgfile']);
}
if($row['videofile']!=""){
checkdelfile($basedir."/ui/".$row['videofile']);
}
$delsql = "DELETE FROM `#@__pano_ui` WHERE id=$id";
$mydb->DoNotBack($delsql);
Trace("&#21024;&#38500;&#25104;&#21151;&#65281;",$endurl);
exit();
}
require('template/vrpano_ui_del.htm');
?>