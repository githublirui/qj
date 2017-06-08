<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_cube_url");
require_once(LULINREQ ."/class/mytag.class.php");
$mydb = new MySql();
$cubesql = "SELECT * FROM `#@__pano_cube` WHERE `id`=$id";
$cuberow = $mydb->getOne($cubesql);
$dir = LULINROOT."/vrpano/vrpano{$cuberow['pid']}/cube/cube{$cuberow['rank']}";
$file = scandir($dir);
$length = count($file);
$len = $length -2;
$startjs = "";
$startjs .= "<script language=\"javascript\" type=\"text/javascript\">\r\n";
$startjs .= "var panoid = {$cuberow['pid']};\r\n";
$startjs .= "var cubeid = {$cuberow['rank']};\r\n";
$startjs .= "var cubelength = {$len};\r\n";
$startjs .= "</script>\r\n";
require('template/vrpano_editcube.htm');
?>