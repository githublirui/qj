<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$basedir = LULINROOT ."/vrpano/".$filename;
if ($dopost == "rank") {
$rightkey = $key +1;
if ($rightkey != $therank) {
if (is_dir($basedir ."/images/scene".$therank)) {
checkdeldir($basedir ."/images/scene".$rightkey);
rename($basedir ."/images/scene".$therank,$basedir ."/images/scene".$rightkey);
$mydb = new Mysql();
$editsql = "UPDATE `#@__pano_scene` SET `rank` = '$rightkey' WHERE `id`=$sceneid";
$mydb->DoNotBack($editsql);
}
}
$key++;
if ($rightkey == $total) {
echo "var end = true;";
}else {
echo "rankdo($key);";
}
}
?>