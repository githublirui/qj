<?php
require_once(dirname(__FILE__) ."/config.php");
CheckPurview('sys_Group');
if (!empty($dopost)) {
$row = $dsql->GetOne("SELECT * FROM #@__admintype WHERE rank='".$rankid ."'");
if (is_array($row)) {
Trace('你所创建的组别的级别值已存在，不允许重复!','-1');
exit();
}
if ($rankid >10) {
Trace('组级别值不能大于10， 否则一切权限设置均无效!','-1');
exit();
}
$AllPurviews = '';
if (is_array($purviews)) {
foreach ($purviews as $pur) {
$AllPurviews = $pur .' ';
}
$AllPurviews = trim($AllPurviews);
}
$dsql->ExecuteNoneQuery("INSERT INTO #@__admintype(rank,typename,system,purviews) VALUES ('$rankid','$groupname', 0, '$AllPurviews');");
Trace("成功创建一个新的用户组!","sys_group.php");
exit();
}
$have_num = "";
$dsql->SetQuery("Select rank From #@__admintype");
$dsql->Execute();
$i = 0;
while ($row = $dsql->GetObject()) {
if ($i >0) {
$have_num .= '、';
}
$have_num .= '<font color="red">'.$row->rank .'</font>';
$i++;
}
$start = 0;
$k = 0;
$html = '';
$gouplists = file(dirname(__FILE__) .'/inc/grouplist.txt');
foreach ($gouplists as $line) {
$line = trim($line);
if ($line == "")
continue;
if (preg_match("#^>>#",$line)) {
if ($start >0) {
$html .= '</td></tr>';
}
$start++;
$html .= '<tr>';
$html .= '<td height="30" colspan="2" bgcolor="#f6f6f6" style="text-align:left; padding-left: 10px;">'.$start .'、'.str_replace('>>','',$line) .'</td>';
$html .= '</tr>';
$html .= '<tr><td height="28" colspan="2" style="text-align:left; line-height:24px;  padding-left: 10px;">';
}else if (preg_match("#^>#",$line)) {
$ls = explode('>',$line);
$tag = $ls[1];
$tagname = str_replace('[br]','<br />',$ls[2]);
if (!preg_match("#<br \/>#",$tagname)) {
$tagname .= "<font color='#888888'>($tag)</font>";
}else {
$tagname = str_replace('<br />',"<font color='#888888'>($tag)</font><br />",$tagname);
}
$html .= '<input name="purviews[]" type="checkbox" class="np" id="purviews'.$k .'" value="'.$tag .'"/>'.$tagname;
$k++;
}
}
require('template/sys_group_add.htm');
?>