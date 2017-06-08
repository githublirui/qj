<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
PutCookie("pano_spotstyle_url",GetCurUrl(),time() +3600,"/");
if (!isset($typeid)) {
$typeid = 0;
}
if ($typeid == 0) {
$where = "";
}else {
$where = "WHERE `typeid` = $typeid";
}
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_spotstyle` $where ORDER BY `id`";
$mydb->SetQuery($sql);
$mydb->Execute("spot");
$html = "";
while ($row = $mydb->GetArray("spot")) {
if ($row['typeid'] == 1) {
$html .= "<div class=\"spotbox\">\r\n";
$html .= "<div class=\"spotimg\"><img src=\"$cmspath{$row['url']}\" onload=\"photoin(this,120,120)\" /></div>\r\n";
$html .= "<div class=\"spotcd\"><a href=\"vrpano_spot_style_edit.php?id={$row['id']}\">&#20462;&#25913;</a><a href=\"vrpano_spot_style_del.php?id={$row['id']}\">&#21024;&#38500;</a></div>\r\n";
$html .= "</div>\r\n";
}else if ($row['typeid'] == 2) {
$html .= "<div class=\"spotbox\">\r\n";
$html .= "<div class=\"spotimg\">\r\n";
$html .= "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"120\" height=\"120\">\r\n";
$html .= "<param name=\"movie\" value=\"$cmspath{$row['url']}\">\r\n";
$html .= "<param name=\"quality\" value=\"high\">\r\n";
$html .= "<param name=\"scale\" value=\"showall\">\r\n";
$html .= "<param name=\"wmode\" value=\"transparent\">\r\n";
$html .= "<embed src=\"$cmspath{$row['url']}\" width=\"120\" height=\"120\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" scale=\"showall\"></embed>\r\n";
$html .= "</object>\r\n";
$html .= "</div>\r\n";
$html .= "<div class=\"spotcd\"><a href=\"vrpano_spot_style_edit.php?id={$row['id']}\">&#20462;&#25913;</a><a href=\"vrpano_spot_style_del.php?id={$row['id']}\">&#21024;&#38500;</a></div>\r\n";
$html .= "</div>\r\n";
}if ($row['typeid'] == 3) {
$html .= "<div class=\"spotbox\">\r\n";
$html .= "<div class=\"spotimg\" style=\"background:#ace;\"><img src=\"$cmspath{$row['url']}\" width=\"120\" /></div>\r\n";
$html .= "<div class=\"spotcd\"><a href=\"vrpano_spot_style_edit.php?id={$row['id']}\">&#20462;&#25913;</a><a href=\"vrpano_spot_style_del.php?id={$row['id']}\">&#21024;&#38500;</a></div>\r\n";
$html .= "</div>\r\n";
}
}
$tphtml = "";
$tpsql = "SELECT * FROM `#@__pano_spottype` ORDER BY `id`";
$mydb->SetQuery($tpsql);
$mydb->Execute("tp");
if ($typeid == 0) {
$tps = "class=\"btn2\"";
}else {
$tps = "class=\"btn1\" onclick=\"window.location.href = 'vrpano_spot_style.php?typeid=0';\"";
}
$tphtml .= "<input type=\"button\" $tps value=\"&#20840;&#37096;\"/>";
while ($tprow = $mydb->GetArray("tp")) {
if ($typeid == $tprow['id']) {
$tps = "class=\"btn2\"";
}else {
$tps = "class=\"btn1\" onclick=\"window.location.href = 'vrpano_spot_style.php?typeid={$tprow['id']}';\"";
}
$tphtml .= "<input type=\"button\" $tps value=\"{$tprow['typename']}\" />";
}
require('template/vrpano_spot_style.htm');
?>