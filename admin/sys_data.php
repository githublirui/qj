<?php
require_once(dirname(__FILE__) ."/config.php");
CheckPurview('sys_Data');
if (empty($dopost))
$dopost = '';
$SysTables = Array();
$otherTables = Array();
$dsql->SetQuery("SHOW TABLES");
$dsql->Execute('t');
while ($row = $dsql->GetArray('t',MYSQL_BOTH)) {
if (preg_match("#^{$cfg_dbprefix}#",$row[0])) {
$SysTables[] = $row[0];
}else {
$otherTables[] = $row[0];
}
}
$mysql_version = $dsql->GetVersion();
$syshtml = '';
$otherhtml = '';
for ($i = 0;isset($SysTables[$i]);$i++) {
$t = $SysTables[$i];
if ($i %2 == 0) {
$syshtml .= '<tr align="center"  bgcolor="#FFFFFF" height="24">';
}else {
$syshtml .= '';
}
$syshtml .= '<td><input type="checkbox" name="tables" value="'.$t .'" class="np" checked /></td>';
$syshtml .= '<td>'.$t .'</td>';
$syshtml .= '<td>'.TjCount($t,$dsql) .'</td>';
$syshtml .= '<td></td>';
if ($i %2 == 0) {
$syshtml .= '';
}else {
$syshtml .= '</tr>';
}
}
if ($i %2 == 0) {
$syshtml .= '';
}else {
$syshtml .= '<td></td>';
$syshtml .= '<td></td>';
$syshtml .= '<td></td>';
$syshtml .= '<td></td>';
$syshtml .= '</tr>';
}
for ($i = 0;isset($otherTables[$i]);$i++) {
$t = $otherTables[$i];
if ($i %2 == 0) {
$otherhtml .= '<tr align="center"  bgcolor="#FFFFFF" height="24">';
}else {
$otherhtml .= '';
}
$otherhtml .= '<td><input type="checkbox" name="tables" value="'.$t .'" class="np" /></td>';
$otherhtml .= '<td>'.$t .'</td>';
$otherhtml .= '<td>'.TjCount($t,$dsql) .'</td>';
$otherhtml .= '<td></td>';
if ($i %2 == 0) {
$otherhtml .= '';
}else {
$otherhtml .= '</tr>';
}
}
if ($i %2 == 0) {
$otherhtml .= '';
}else {
$otherhtml .= '<td></td>';
$otherhtml .= '<td></td>';
$otherhtml .= '<td></td>';
$otherhtml .= '<td></td>';
$otherhtml .= '</tr>';
}
function TjCount($tbname,&$dsql) {
$row = $dsql->GetOne("SELECT COUNT(*) AS dd FROM $tbname");
return $row['dd'];
}
require('template/sys_data.htm');
?>