<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
require_once(dirname('vrpano_fuzhu.php') ."/inc/panomenu.php");
$endurl = GetCookie("pano_url");
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$row = $mydb->GetOne($sql);
if ($dopost == "save") {
$thefile = "vrpano".$id;
if ($openluopan == 1) {
$checksql = "SELECT * FROM `#@__pano_scene` WHERE pid=$id and luopan=0";
$mydb->SetQuery($checksql);
$mydb->Execute("luopan");
$lens = $mydb->GetTotalRow("luopan");
if($lens>0){
$openluopan = 0;
}
}
if ($openluopan == 1) {
if(!is_dir(LULINROOT ."/vrpano/$thefile"."/luopan")){
checkmakedir(LULINROOT ."/vrpano/$thefile"."/luopan");
copydir(LULINREQ ."/vrpano/main/luopan/",LULINROOT ."/vrpano/$thefile"."/luopan");
}
}else {
checkdeldir(LULINROOT ."/vrpano/$thefile"."/luopan");
}
$editsql = "UPDATE `#@__pano_main` SET 
            `openluopan` = '$openluopan',
            `luopanalign` = '$luopanalign',
            `luopanx` = '$luopanx',
            `luopany` = '$luopany'
            WHERE `id`=$id";
$mydb->DoNotBack($editsql);
Trace("&#20462;&#25913;&#23436;&#25104;&#65281;","vrpano_fuzhu.php?id=$id");
exit();
}
$mapbassposscript = "";
$mapbassposscript .= "<script type=\"text/javascript\">";
$mapbassposscript .= "onetian({$row['luopanalign']});";
$mapbassposscript .= "</script>";
require('template/vrpano_fuzhu.htm');
?>