<?php
@ob_start();
@set_time_limit(0);
require_once(dirname(__FILE__) .'/config.php');
require_once(LULINREQ .'/tool/ftp.tool.php');
CheckPurview('sys_Data');
if (empty($dopost))
$dopost = '';
$bkdir = LULINDATA .'/backdata';
$gotojs = "function GotoNextPage(){
    document.gonext."."submit();
}"."\r\nset"."Timeout('GotoNextPage()',500);";
$dojs = "<script language='javascript'>$gotojs</script>";
if ($dopost == 'bak') {
if (empty($tablearr)) {
Trace('你没选中任何表！','javascript:;');
exit();
}
if (!is_dir($bkdir)) {
MkdirAll($bkdir,$cfg_dir_purview);
CloseFtp();
}
$tables = explode(',',$tablearr);
if (!isset($isstruct)) {
$isstruct = 0;
}
if (!isset($startpos)) {
$startpos = 0;
}
if (!isset($iszip)) {
$iszip = 0;
}
if (empty($nowtable)) {
$nowtable = '';
}
if (empty($fsize)) {
$fsize = 2048;
}
$fsizeb = $fsize * 1024;
if ($nowtable == '') {
$tmsg = '';
$dh = dir($bkdir);
while ($filename = $dh->read()) {
if (!preg_match("#txt$#",$filename)) {
continue;
}
$filename = $bkdir ."/$filename";
if (!is_dir($filename)) {
unlink($filename);
}
}
$dh->close();
$tmsg .= "清除备份目录旧数据完成...<br />";
if ($isstruct == 1) {
$bkfile = $bkdir ."/tables_struct_".substr(md5(time() .mt_rand(1000,5000) .$cfg_cookie_encode),0,16) .".txt";
$mysql_version = $dsql->GetVersion();
$fp = fopen($bkfile,"w");
foreach ($tables as $t) {
fwrite($fp,"DROP TABLE IF EXISTS `$t`;\r\n\r\n");
$dsql->SetQuery("SHOW CREATE TABLE ".$dsql->dbName .".".$t);
$dsql->Execute('me');
$row = $dsql->GetArray('me',MYSQL_BOTH);
$row[1] = preg_replace("#AUTO_INCREMENT=([0-9]{1,})[ \r\n\t]{1,}#i","",$row[1]);
if ($datatype == 4.0 &&$mysql_version >4.0) {
$eng1 = "#ENGINE=MyISAM[ \r\n\t]{1,}DEFAULT[ \r\n\t]{1,}CHARSET=".$cfg_db_language ."#i";
$tableStruct = preg_replace($eng1,"TYPE=MyISAM",$row[1]);
}
else if ($datatype == 4.1 &&$mysql_version <4.1) {
$eng1 = "#ENGINE=MyISAM DEFAULT CHARSET={$cfg_db_language}#i";
$tableStruct = preg_replace("TYPE=MyISAM",$eng1,$row[1]);
}
else {
$tableStruct = $row[1];
}
fwrite($fp,''.$tableStruct .";\r\n\r\n");
}
fclose($fp);
$tmsg .= "备份数据表结构信息完成...<br />";
}
$tmsg .= "<font color='#199372'>正在进行数据备份的初始化工作，请稍后...</font>";
$doneForm = "<form name='gonext' method='post' action='sys_data_done.php'>
           <input type='hidden' name='isstruct' value='$isstruct' />
           <input type='hidden' name='dopost' value='bak' />
           <input type='hidden' name='fsize' value='$fsize' />
           <input type='hidden' name='tablearr' value='$tablearr' />
           <input type='hidden' name='nowtable' value='{$tables[0]}' />
           <input type='hidden' name='startpos' value='0' />
           <input type='hidden' name='iszip' value='$iszip' />\r\n</form>\r\n{$dojs}\r\n";
PutInfo($tmsg,$doneForm);
exit();
}
else {
$j = 0;
$fs = $bakStr = '';
$dsql->GetTableFields($nowtable);
$intable = "INSERT INTO `$nowtable` (";
while ($r = $dsql->GetFieldObject()) {
$fs[$j] = trim($r->name);
if($j>0){
$intable .= ",";
}
$intable .= "`".trim($r->name)."`";
$j++;
}
$intable .= ") VALUES(";
$fsd = $j -1;
$dsql->SetQuery("SELECT * FROM `$nowtable` ");
$dsql->Execute();
$m = 0;
$bakfilename = "$bkdir/{$nowtable}_{$startpos}_".substr(md5(time() .mt_rand(1000,5000) .$cfg_cookie_encode),0,16) .".txt";
while ($row2 = $dsql->GetArray()) {
if ($m <$startpos) {
$m++;
continue;
}
if (strlen($bakStr) >$fsizeb) {
$fp = fopen($bakfilename,"w");
fwrite($fp,$bakStr);
fclose($fp);
$tmsg = "<font color='#199372'>完成到{$m}条记录的备份，继续备份{$nowtable}...</font>";
$doneForm = "<form name='gonext' method='post' action='sys_data_done.php'>
                <input type='hidden' name='isstruct' value='$isstruct' />
                <input type='hidden' name='dopost' value='bak' />
                <input type='hidden' name='fsize' value='$fsize' />
                <input type='hidden' name='tablearr' value='$tablearr' />
                <input type='hidden' name='nowtable' value='$nowtable' />
                <input type='hidden' name='startpos' value='$m' />
                <input type='hidden' name='iszip' value='$iszip' />\r\n</form>\r\n{$dojs}\r\n";
PutInfo($tmsg,$doneForm);
exit();
}
$line = $intable;
for ($j = 0;$j <= $fsd;$j++) {
if ($j <$fsd) {
$line .= "'".RpLine(addslashes($row2[$fs[$j]])) ."',";
}else {
$line .= "'".RpLine(addslashes($row2[$fs[$j]])) ."');\r\n";
}
}
$m++;
$bakStr .= $line;
}
if ($bakStr != '') {
$fp = fopen($bakfilename,"w");
fwrite($fp,$bakStr);
fclose($fp);
}
for ($i = 0;$i <count($tables);$i++) {
if ($tables[$i] == $nowtable) {
if (isset($tables[$i +1])) {
$nowtable = $tables[$i +1];
$startpos = 0;
break;
}else {
PutInfo("完成所有数据备份！","");
exit();
}
}
}
$tmsg = "<font color='#199372'>完成到{$m}条记录的备份，继续备份{$nowtable}...</font>";
$doneForm = "<form name='gonext' method='post' action='sys_data_done.php?dopost=bak'>
          <input type='hidden' name='isstruct' value='$isstruct' />
          <input type='hidden' name='fsize' value='$fsize' />
          <input type='hidden' name='tablearr' value='$tablearr' />
          <input type='hidden' name='nowtable' value='$nowtable' />
          <input type='hidden' name='startpos' value='$startpos'>\r\n</form>\r\n{$dojs}\r\n";
PutInfo($tmsg,$doneForm);
exit();
}
}
else if ($dopost == 'redat') {
if ($bakfiles == '') {
Trace('没指定任何要还原的文件!','javascript:;');
exit();
}
$bakfilesTmp = $bakfiles;
$bakfiles = explode(',',$bakfiles);
if (empty($structfile)) {
$structfile = "";
}
if (empty($delfile)) {
$delfile = 0;
}
if (empty($startgo)) {
$startgo = 0;
}
if ($startgo == 0 &&$structfile != '') {
$tbdata = '';
$fp = fopen("$bkdir/$structfile",'r');
while (!feof($fp)) {
$tbdata .= fgets($fp,1024);
}
fclose($fp);
$querys = explode(';',$tbdata);
foreach ($querys as $q) {
$dsql->ExecuteNoneQuery(trim($q) .';');
}
if ($delfile == 1) {
@unlink("$bkdir/$structfile");
}
$tmsg = "<font color='#199372'>完成数据表信息还原，准备还原数据...</font>";
$doneForm = "<form name='gonext' method='post' action='sys_data_done.php?dopost=redat'>
        <input type='hidden' name='startgo' value='1' />
        <input type='hidden' name='delfile' value='$delfile' />
        <input type='hidden' name='bakfiles' value='$bakfilesTmp' />
        </form>\r\n{$dojs}\r\n";
PutInfo($tmsg,$doneForm);
exit();
}else {
$nowfile = $bakfiles[0];
$bakfilesTmp = preg_replace("#".$nowfile ."[,]{0,1}#","",$bakfilesTmp);
$oknum = 0;
if (filesize("$bkdir/$nowfile") >0) {
$fp = fopen("$bkdir/$nowfile",'r');
while (!feof($fp)) {
$line = trim(fgets($fp,512 * 1024));
if ($line == "")
continue;
$rs = $dsql->ExecuteNoneQuery($line);
if ($rs)
$oknum++;
}
fclose($fp);
}
if ($delfile == 1) {
@unlink("$bkdir/$nowfile");
}
if ($bakfilesTmp == "") {
Trace('成功还原所有的文件的数据!','javascript:;');
exit();
}
$tmsg = "成功还原{$nowfile}的{$oknum}条记录<br/><br/>正在准备还原其它数据...";
$doneForm = "<form name='gonext' method='post' action='sys_data_done.php?dopost=redat'>
        <input type='hidden' name='startgo' value='1' />
        <input type='hidden' name='delfile' value='$delfile' />
        <input type='hidden' name='bakfiles' value='$bakfilesTmp' />
        </form>\r\n{$dojs}\r\n";
PutInfo($tmsg,$doneForm);
exit();
}
}
function PutInfo($msg1,$msg2) {
global $cfg_cmspath,$cfg_soft_lang;
$msginfo = "<html>\n<head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=100\"/>
        <title>提示信息</title>
        <style type=\"text/css\">
            body{background:#fff;margin:0px;}
            .msgbox{background:url(".$cfg_cmspath."/require/images/showbox.gif) no-repeat; width:377px; height:232px; overflow:hidden; margin:0 auto; margin-top:40px;}
            .msgbox_title{height:30px; overflow:hidden; margin-top:7px;  text-align: center; font: bold 14px/30px '微软雅黑'; color:#333;}
            .msgbox_body{width: 360px; height: 188px; overflow: hidden; margin-left: 9px; font: 12px/20px 微软雅黑; color: #be0000;}
            .text{font: 12px/20px 微软雅黑; color: #be0000;}
        </style>
        <base target='_self'/></head>\n<body leftmargin='0' topmargin='0'><center>
        <div class='msgbox'>
        <div class='msgbox_title'>提示信息</div>
        <div class='msgbox_body'>
            <table width=\"90%\" height=\"188px\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
            <tr><td class=\"text\" align=\"center\" height=\"188px\">$msg1</td></tr>
            </table>
        </div>
        </div>\r\n{$msg2}";
echo $msginfo ."</center>\n</body>\n</html>";
}
function RpLine($str) {
$str = str_replace("\r","\\r",$str);
$str = str_replace("\n","\\n",$str);
return $str;
}?>