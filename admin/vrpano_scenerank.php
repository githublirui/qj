<?php

require_once(dirname(__FILE__) . "/config.php");
require_once(LULINREQ . '/tool/file.tool.php');
$endurl = GetCookie("pano_scene_url");

$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_scene` WHERE id = $id";
$row = $mydb->GetOne($sql);
$basedir = LULINROOT . "/vrpano/vrpano" . $row['pid'];
$baseimgdir = $cfg_cmspath . "/vrpano/vrpano" . $row['pid'] . "/images/scene{$row['rank']}";
$imgdir = LULINROOT . "/vrpano/vrpano" . $row['pid'] . "/images/scene{$row['rank']}";

$lensql = "SELECT * FROM `#@__pano_scene` WHERE pid = {$row['pid']}";
$mydb->SetQuery($lensql);
$mydb->Execute("len");
$len = $mydb->GetTotalRow("len");
if ($tp == "up") {
    if ($row['rank'] == 1) {
        Trace("&#24050;&#32463;&#26159;&#31532;&#19968;&#20010;&#20102;&#65281;", "$endurl");
        exit();
    }
    $bag1 = $row['rank'];
    $bag2 = $bag1 - 1;
}
if ($tp == "down") {
    if ($row['rank'] == $len) {
        Trace("&#24050;&#32463;&#26159;&#26368;&#21518;&#19968;&#20010;&#20102;&#65281;", "$endurl");
        exit();
    }
    $bag1 = $row['rank'];
    $bag2 = $bag1 + 1;
}

$bagid1 = $id;
$bag2sql = "SELECT `id` FROM `#@__pano_scene` WHERE pid = {$row['pid']} and rank = $bag2";
$bag2row = $mydb->getOne($bag2sql);
$bagid2 = $bag2row['id'];

$editsql1 = "UPDATE `#@__pano_scene` SET `rank` = $bag2 WHERE id=$bagid1";
$mydb->DoNotBack($editsql1);

$editsql2 = "UPDATE `#@__pano_scene` SET `rank` = $bag1 WHERE id=$bagid2";
$mydb->DoNotBack($editsql2);

rename($basedir."/images/scene$bag1", $basedir."/images/scene0");
rename($basedir."/images/scene$bag2", $basedir."/images/scene$bag1");
rename($basedir."/images/scene0", $basedir."/images/scene$bag2");

Trace("&#35843;&#24207;&#25104;&#21151;&#65281;", "$endurl")
?>