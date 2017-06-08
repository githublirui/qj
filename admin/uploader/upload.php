<?php
define('ME', str_replace("\\", '/', dirname(__FILE__)));
require_once(ME . '/../../require/function.inc.php');

require_once(LULINREQ.'/tool/file.tool.php');

$nowtime = time();
$basedir = "/uploads/station";
if (is_dir(LULINROOT.$basedir) == FALSE) {
    mkdir(LULINROOT.$basedir);
}


$filetype = explode(".", $_FILES['Filedata']['name']);
$len = count($filetype) - 1;
$filetype = $filetype[$len];
$pinfo = basename($_FILES['Filedata']['tmp_name']);
$pinfo = explode(".", $pinfo);
$pinfo = $nowtime . $pinfo[0] . "." . $filetype; //生成文件名称
$pinfo = str_replace("php","",$pinfo);
$fileurl = $basedir."/" . $pinfo;

if (move_uploaded_file($_FILES['Filedata']['tmp_name'], LULINROOT . $fileurl)) {
    echo $fileurl;
}
?>
