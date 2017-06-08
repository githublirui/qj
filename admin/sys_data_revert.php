<?php
require_once(dirname(__FILE__) ."/config.php");
CheckPurview('sys_Data');
$bkdir = LULINDATA ."/backdata";
$filelists = Array();
$dh = dir($bkdir);
$structfile = "没找到数据结构文件";
while (($filename = $dh->read()) !== false) {
if (!preg_match("#txt$#",$filename)) {
continue;
}
if (preg_match("#tables_struct#",$filename)) {
$structfile = $filename;
}else if (filesize("$bkdir/$filename") >0) {
$filelists[] = $filename;
}
}
$dh->close();
$backhtml = '';
for ($i = 0;$i <count($filelists);$i++) {
if ($i %2 == 0) {
$backhtml .= '<tr class="tr_white" align="center" height="24">';
}else {
$backhtml .= '';
}
$backhtml .= '<td width="10%"><input type="checkbox" name="bakfile" id="bakfile" value="'.$filelists[$i].'" /></td>';
$backhtml .= '<td width="40%">'.$filelists[$i].'</td>';
if ($i %2 == 0) {
$backhtml .= '';
}else {
$backhtml .= '</tr>';
}
}
if ($i %2 == 0) {
$backhtml .= '';
}else {
$backhtml .= '<td></td>';
$backhtml .= '<td></td>';
$backhtml .= '</tr>';
}
require ('template/sys_data_revert.htm');
?>