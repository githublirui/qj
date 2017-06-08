<?php
require_once(dirname(__FILE__) ."/config.php");
CheckPurview('sys_Group');
if (empty($dopost))
$dopost = "";
if ($dopost == 'save') {
if ($rank == 10) {
Trace('超级管理员的权限不允许更改!','sys_group.php');
exit();
}
$purview = "";
if (is_array($purviews)) {
foreach ($purviews as $p) {
$purview .= "$p ";
}
$purview = trim($purview);
}
$dsql->ExecuteNoneQuery("UPDATE `#@__admintype` SET typename='$typename',purviews='$purview' WHERE CONCAT(`rank`)='$rank'");
Trace('成功更改用户组的权限!','sys_group.php');
exit();
}else if ($dopost == 'del') {
$dsql->ExecuteNoneQuery("DELETE FROM `#@__admintype` WHERE CONCAT(`rank`)='$rank' AND system='0';");
Trace("成功删除一个用户组!","sys_group.php");
exit();
}
$groupRanks = Array();
$groupSet = $dsql->GetOne("SELECT * FROM `#@__admintype` WHERE CONCAT(`rank`)='{$rank}' ");
$groupRanks = explode(' ',$groupSet['purviews']);
$start = 0;
$k = 0;
$gouplists = file(dirname(__FILE__) .'/inc/grouplist.txt');
$html = '';
foreach ($gouplists as $line) {
$line = trim($line);
if ($line == "") {
continue;
}
if (preg_match("#^>>#",$line)) {
if ($start >0) {
$html .= '</td></tr>';
}
$start++;
$html .= '<tr>';
$html .= '<td height="32" colspan="2" bgcolor="#f6f6f6" style="text-align:left; padding-left: 10px;">'.$start .'、'.str_replace('>>','',$line) .'</td>';
$html .= '</tr>';
$html .= '<tr><td height="25" colspan="2" style="text-align:left; padding-left: 10px;">';
}else if (preg_match("#^>#",$line)) {
$ls = explode('>',$line);
$tag = $ls[1];
$tagname = str_replace('[br]','<br>',$ls[2]);
if (!preg_match("#<br \/>#",$tagname)) {
$tagname .= "<font color='#888888'>($tag)</font>";
}else {
$tagname = str_replace('<br />',"<font color='#888888'>($tag)</font><br />",$tagname);
}
$html .= '<input name="purviews[]" type="checkbox" class="np" id="purviews'.$k.'" value="'.$tag .'"'.CRank($tag) .'>'.$tagname;
$k++;
}
}
require('template/sys_group_edit.htm');
function CRank($n) {
global $groupRanks;
return in_array($n,$groupRanks) ?' checked': '';
}
?>