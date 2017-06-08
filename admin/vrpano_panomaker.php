<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/tool/file.tool.php');
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_main` WHERE id=$id";
$row = $mydb->getOne($sql);
$basedir = LULINROOT ."/vrpano/".$row['filedir'];
$newbasedir = LULINROOT ."/putout/".$row['filedir'];
if ($dopost == "step1") {
checkmakedir(LULINROOT ."/putout/");
checkdeldir($newbasedir);
mkdir($newbasedir);
echo "var step1ok = true;";
}else if ($dopost == "step2") {
copy($basedir ."/krpano.swf",$newbasedir ."/krpano.swf");
copy($basedir ."/swfkrpano.js",$newbasedir ."/swfkrpano.js");
copy($basedir ."/krpanoiphone.js",$newbasedir ."/krpanoiphone.js");
copy($basedir ."/autonextclose.png",$newbasedir ."/autonextclose.png");
copy($basedir ."/introimage.png",$newbasedir ."/introimage.png");
copy($basedir ."/krpano.license",$newbasedir ."/krpano.license");
copy($basedir ."/krpanoiphone.license.js",$newbasedir ."/krpanoiphone.license.js");
mkdir($newbasedir ."/images");
mkdir($newbasedir ."/js");
copydir($basedir ."/js",$newbasedir ."/js");
if ($row['cursor'] != 0) {
mkdir($newbasedir ."/cursor");
copydir($basedir ."/cursor",$newbasedir ."/cursor");
}
if (is_dir($basedir ."/plugins")) {
checkmakedir($newbasedir ."/plugins");
copydir($basedir ."/plugins",$newbasedir ."/plugins");
}
if (is_dir($basedir ."/thumb")) {
checkmakedir($newbasedir ."/thumb");
copydir($basedir ."/thumb",$newbasedir ."/thumb");
}
if (is_dir($basedir ."/music")) {
checkmakedir($newbasedir ."/music");
copydir($basedir ."/music",$newbasedir ."/music");
}
if (is_dir($basedir ."/luopan")) {
checkmakedir($newbasedir ."/luopan");
copydir($basedir ."/luopan",$newbasedir ."/luopan");
}
if (is_dir($basedir ."/control")) {
checkmakedir($newbasedir ."/control");
copydir($basedir ."/control",$newbasedir ."/control");
}
if (is_dir($basedir ."/ui")) {
checkmakedir($newbasedir ."/ui");
copydir($basedir ."/ui",$newbasedir ."/ui");
}
mkdir($newbasedir ."/spot");
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = $id";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
$spotarr = array();
while ($scenerow = $mydb->GetArray("scene")) {
$spotsql = "SELECT * FROM `#@__pano_spot` WHERE `aid` = {$scenerow['id']}";
$mydb->SetQuery($spotsql);
$mydb->Execute("spot");
while ($spotrow = $mydb->GetArray("spot")) {
if ($spotrow['spottype'] == 1) {
if (!in_array($spotrow['spotstyle'],$spotarr)) {
array_push($spotarr,$spotrow['spotstyle']);
}
}
}
}
foreach ($spotarr as $sp) {
$spotstylesql = "SELECT * FROM `#@__pano_spotstyle` WHERE `id`= $sp";
$spotstylerow = $mydb->getOne($spotstylesql);
$spotfilename = basename($spotstylerow['url']);
if (is_file($basedir ."/spot/".$spotfilename)) {
copy($basedir ."/spot/".$spotfilename,$newbasedir ."/spot/".$spotfilename);
}
}
$html = "";
$html .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\r\n";
$html .= '<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">'."\r\n";
$html .= '  <head>'."\r\n";
$html .= '      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'."\r\n";
$html .= '<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />'."\r\n";
$html .= '<meta name="apple-mobile-web-app-capable" content="yes" />'."\r\n";
$html .= '      <title>'.$row['panoname'] .'</title>'."\r\n";
$html .= '      <style type="text/css"> '."\r\n";
$html .= '          html {height: 100%;overflow: hidden;}'."\r\n";
$html .= '          #vrpano {height: 100%;}'."\r\n";
$html .= '          body {height: 100%;margin: 0;padding: 0;background-color: #fff;}'."\r\n";
$html .= '      </style>'."\r\n";
$html .= '  </head>'."\r\n";
$html .= '  <body>'."\r\n";
$html .= '      <div id="vrpano"></div>'."\r\n";
$html .= '      <script type="text/javascript" src="swfkrpano.js"></script>'."\r\n";
$html .= '      <script type="text/javascript">'."\r\n";
$html .= '          embedpano({swf: "krpano.swf", xml: "krpano.xml", target: "vrpano", html5: "auto", passQueryParameters: true});'."\r\n";
$html .= '      </script>'."\r\n";
$html .= '  </body>'."\r\n";
$html .= '</html>'."\r\n";
$htmlfile = $newbasedir ."/index.html";
$htmldata = stripslashes($html);
$myfp = fopen($htmlfile,"w");
fputs($myfp,$htmldata);
fclose($myfp);
echo "var step2ok = true;";
}else if ($dopost == "step3") {
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $sceneid";
$scenerow = $mydb->GetOne($scenesql);
if (is_dir($basedir ."/images/scene".$scenerow['rank'])) {
checkmakedir($newbasedir ."/images/scene".$scenerow['rank']);
copydir($basedir ."/images/scene".$scenerow['rank'],$newbasedir ."/images/scene".$scenerow['rank']);
}
$key++;
if ($key == $total) {
echo "var step3ok = true;";
}else {
echo "step3($key);";
}
}else if ($dopost == "step4") {
if (is_file($basedir ."/showpic/".$pic)) {
checkmakedir($newbasedir ."/showpic");
copy($basedir ."/showpic/".$pic,$newbasedir ."/showpic/".$pic);
}
$key++;
if ($key == $total) {
echo "var step4ok = true;";
}else {
echo "step4($key);";
}
}else if ($dopost == "step5") {
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = $id ORDER BY `rank`";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");
include (LULINREQ .'/vrpano/xml.php');
$xmlfilename = "krpano.xml";
$file = $newbasedir ."/$xmlfilename";
$vrxml = stripslashes($xml);
$fp = fopen($file,"w");
fputs($fp,$vrxml);
fclose($fp);
echo "var step5ok = true;";
}else if ($dopost == "step6") {
if (is_file($basedir ."/spot/".$pic)) {
checkmakedir($newbasedir ."/spot");
copy($basedir ."/spot/".$pic,$newbasedir ."/spot/".$pic);
}
$key++;
if ($key == $total) {
echo "var step6ok = true;";
}else {
echo "step6($key);";
}
}else if ($dopost == "step7") {
if (is_file($basedir ."/video/".$pic)) {
checkmakedir($newbasedir ."/video");
copy($basedir ."/video/".$pic,$newbasedir ."/video/".$pic);
}
$key++;
if ($key == $total) {
echo "var step7ok = true;";
}else {
echo "step7($key);";
}
}else if ($dopost == "step8") {
if (is_file($basedir ."/video/".$pic)) {
checkmakedir($newbasedir ."/video");
copy($basedir ."/video/".$pic,$newbasedir ."/video/".$pic);
}
if (is_file($basedir ."/video/".$video)) {
checkmakedir($newbasedir ."/video");
copy($basedir ."/video/".$video,$newbasedir ."/video/".$video);
}
$key++;
if ($key == $total) {
echo "var step8ok = true;";
}else {
echo "step8($key);";
}
}else if ($dopost == "step9") {
$mapsql = "SELECT * FROM `#@__pano_map` WHERE `id` = $id";
$maprow = $mydb->getOne($mapsql);
if ($maprow['openmap'] == 1) {
copydir($basedir ."/map",$newbasedir ."/map");
}
echo "var step9ok = true;";
}else if ($dopost == "step10") {
if (is_file($basedir ."/showpic/".$pic)) {
checkmakedir($newbasedir ."/showpic");
copy($basedir ."/showpic/".$pic,$newbasedir ."/showpic/".$pic);
}
$key++;
if ($key == $total) {
echo "var step10ok = true;";
}else {
echo "step10($key);";
}
}else if ($dopost == "step11") {
if (is_dir($basedir ."/photo/photo".$photoid)) {
checkmakedir($newbasedir ."/photo");
if(!is_dir($newbasedir ."/photo/skin")){
mkdir($newbasedir ."/photo/skin");
copydir($basedir ."/photo/skin",$newbasedir ."/photo/skin");
}
checkmakedir($newbasedir ."/photo/photo".$photoid);
copydir($basedir ."/photo/photo".$photoid,$newbasedir ."/photo/photo".$photoid);
}
$key++;
if ($key == $total) {
echo "var step11ok = true;";
}else {
echo "step11($key);";
}
}else if ($dopost == "step12") {
if (is_dir($basedir ."/cube/cube".$cubeid)) {
checkmakedir($newbasedir ."/cube");
if(!is_dir($newbasedir ."/cube/skin")){
mkdir($newbasedir ."/cube/skin");
copydir($basedir ."/cube/skin",$newbasedir ."/cube/skin");
}
checkmakedir($newbasedir ."/cube/cube".$cubeid);
copydir($basedir ."/cube/cube".$cubeid,$newbasedir ."/cube/cube".$cubeid);
checkcopyfile($basedir ."/cube/cube{$cubeid}.xml",$newbasedir ."/cube/cube{$cubeid}.xml");
}
$key++;
if ($key == $total) {
echo "var step12ok = true;";
}else {
echo "step12($key);";
}
}
?>