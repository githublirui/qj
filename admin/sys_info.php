<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ."/tool/string_cut.tool.php");
CheckPurview('sys_Info');
if (empty($dopost))
$dopost = "";
$configfile = LULINDATA .'/setting.php';
function ReWriteConfig() {
global $dsql,$configfile;
if (!is_writeable($configfile)) {
echo "配置文件'{$configfile}'不支持写入，无法修改系统配置参数！";
exit();
}
$fp = fopen($configfile,'w');
flock($fp,3);
fwrite($fp,"<"."?php\r\n");
$dsql->SetQuery("SELECT `varname`,`type`,`value`,`groupid` FROM `#@__sysconfig` ORDER BY aid ASC ");
$dsql->Execute();
while ($row = $dsql->GetArray()) {
if ($row['type'] == 'number') {
if ($row['value'] == '')
$row['value'] = 0;
fwrite($fp,"\${$row['varname']} = ".$row['value'] .";\r\n");
}
else {
fwrite($fp,"\${$row['varname']} = '".str_replace("'",'',$row['value']) ."';\r\n");
}
}
fwrite($fp,"?".">");
fclose($fp);
}
if ($dopost == 'add') {
if ($vartype == 'bool'&&($nvarvalue != 'Y'&&$nvarvalue != 'N')) {
Trace("布尔变量值必须为'Y'或'N'!","-1");
exit();
}
if (trim($nvarname) == ''||preg_match("#[^a-z_]#i",$nvarname)) {
Trace("变量名不能为空并且必须为[a-z_]组成!","-1");
exit();
}
$row = $dsql->GetOne("SELECT varname FROM `#@__sysconfig` WHERE varname LIKE '$nvarname' ");
if (is_array($row)) {
Trace("该变量名称已经存在!","-1");
exit();
}
$inquery = "INSERT INTO `#@__sysconfig`(`varname`,`info`,`value`,`type`,`groupid`)
    VALUES ('$nvarname','$varmsg','$nvarvalue','$vartype','$vargroup')";
$rs = $dsql->ExecuteNoneQuery($inquery);
if (!$rs) {
Trace("新增变量失败，可能有非法字符！","sys_info.php?gp=$vargroup");
exit();
}
if (!is_writeable($configfile)) {
Trace("成功保存变量，但由于 $configfile 无法写入，因此不能更新配置文件！","sys_info.php?gp=$vargroup");
exit();
}else {
ReWriteConfig();
Trace("成功保存变量并更新配置文件！","sys_info.php?gp=$vargroup");
exit();
}
}else if($dopost=="save"){
foreach($_POST as $k=>$v)
{
if(preg_match("#^edit___#",$k))
{
$v = cn_substrR(${$k},1024);
}
else
{
continue;
}
$k = preg_replace("#^edit___#","",$k);
$dsql->ExecuteNoneQuery("UPDATE `#@__sysconfig` SET `value`='$v' WHERE varname='$k' ");
}
ReWriteConfig();
Trace("成功更改站点配置！","sys_info.php");
exit();
}
$ds = file(LULINADMIN .'/inc/configgroup.txt');
$totalGroup = count($ds);
$i = 0;
$config_html = "";
$config_select = "";
foreach ($ds as $dl) {
$dl = trim($dl);
if (empty($dl))
continue;
$dls = explode(',',$dl);
$i++;
$config_select .= "<option value='{$dls[0]}'>{$dls[1]}</option>";
if ($i >1)
$config_html .= " | <a href='javascript:ShowConfig($i)'>{$dls[1]}</a> ";
else {
$config_html .= " <a href='javascript:ShowConfig($i)'>{$dls[1]}</a> ";
}
}
function getback() {
global $ds;
global $dsql;
$n = 0;
$html = '';
foreach ($ds as $dl) {
$dl = trim($dl);
if (empty($dl))
continue;
$dls = explode(',',$dl);
$n++;
$dsql->SetQuery("Select * From `#@__sysconfig` where groupid='{$dls[0]}' order by aid asc");
$dsql->Execute();
$html .= '<table width="100%" class="result_back_box" style="display:none;" border="0" cellspacing="1" cellpadding="1" bgcolor="#c8ddff">';
$html .= '<tr class="tr_hui" align="center" height="30"><td width="300">参数说明</td><td>参数值</td><td width="220">变量名</td></tr>';
$i = 1;
while ($row = $dsql->GetArray()) {
if ($i %2 == 0) {
$bgcolor = "f6f6f6";
}else {
$bgcolor = "#ffffff";
}
$i++;
$html .= '<tr align="center" bgcolor="'.$bgcolor.'" height="30">';
$html .= '<td width="300">'.$row['info'] .'：</td>';
$html .= '<td align="left" style="padding:3px;">';
if ($row['type'] == 'bool') {
$c1 = '';
$c2 = '';
$row['value'] == 'Y'?$c1 = " checked": $c2 = " checked";
$html .= '<input type="radio" class="np" name="edit___'.$row['varname'].'" value="Y"'.$c1.'>是 ';
$html .= '<input type="radio" class="np" name="edit___'.$row['varname'].'" value="N"'.$c2.'>否 ';
}else if($row['type']=='bstring'){
$html .= '<textarea name="edit___'.$row['varname'].'" row="4" id="edit___'.$row['varname'].'" class="textarea_info" style="width:98%;height:50px">'.htmlspecialchars($row['value']).'</textarea>';
}else if($row['type']=='number'){
$html .= '<input type="text" name="edit___'.$row['varname'].'" id="edit___'.$row['varname'].'" value="'.$row['value'].'" style="width:30%">';
}else{
$html .= '<input type="text" name="edit___'.$row['varname'].'" id="edit___'.$row['varname'].'" value="'.htmlspecialchars($row['value']).'" style="width:80%">';
}
$html .= '</td>';
$html .= '<td>'.$row['varname'] .'</td>';
$html .= '</tr>';
}
$html .= '</table>';
}
echo $html;
}
require ('template/sys_info.htm');
?>