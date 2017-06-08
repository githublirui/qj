<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_photo_url");
require_once(LULINREQ ."/class/mytag.class.php");
$mydb = new MySql();
$photosql = "SELECT * FROM `#@__pano_photo` WHERE `id`=$id";
$photorow = $mydb->getOne($photosql);
$dir = LULINROOT."/vrpano/vrpano{$photorow['pid']}/photo/photo{$photorow['rank']}";
$file = scandir($dir);
$length = count($file);
$len = $length -2;
$startjs = "";
$startjs .= "<script language=\"javascript\" type=\"text/javascript\">\r\n";
$startjs .= "var panoid = {$photorow['pid']};\r\n";
$startjs .= "var photoid = {$photorow['rank']};\r\n";
$startjs .= "var photolength = {$len};\r\n";
$startjs .= "</script>\r\n";
require('template/vrpano_editphoto.htm');
?>