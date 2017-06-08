<?php

define('ME', str_replace("\\", '/', dirname(__FILE__)));
require_once(ME . '/../../require/function.inc.php');

require_once(LULINREQ . '/tool/file.tool.php');

$basedir = "/uploads/station";
checkmakedir(LULINROOT.$basedir);

$fileurl = $basedir . "/" . $_FILES['Filedata']['name'];
checkdelfile(LULINROOT . $fileurl);
if (move_uploaded_file($_FILES['Filedata']['tmp_name'], LULINROOT . $fileurl)) {
    echo $fileurl;
}
?>
