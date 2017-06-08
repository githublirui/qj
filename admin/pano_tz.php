<?php
error_reporting(0);
@header("content-Type: text/html; charset=utf-8");
ob_start();
function valid_email($str) 
{
return ( !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$str)) ?FALSE : TRUE;
}
function show($varName)
{
switch($result = get_cfg_var($varName))
{
case 0:
return '<font color="red">×</font>';
break;
case 1:
return '<font color="green">√</font>';
break;
default:
return $result;
break;
}
}
if ($_GET['act'] == "phpinfo") 
{
phpinfo();
exit();
}
elseif($_GET['act'] == "Function")
{
$arr = get_defined_functions();
Function php()
{
}
echo "<pre>";
Echo "这里显示系统所支持的所有函数,和自定义函数\n";
print_r($arr);
echo "</pre>";
exit();
}elseif($_GET['act'] == "disable_functions")
{
$disFuns=get_cfg_var("disable_functions");
if(empty($disFuns))
{
$arr = '<font color=red>×</font>';
}
else
{
$arr = $disFuns;
}
Function php()
{
}
echo "<pre>";
Echo "这里显示系统被禁用的函数\n";
print_r($arr);
echo "</pre>";
exit();
}
if ($_POST['act'] == 'MySQL检测')
{
$host = isset($_POST['host']) ?trim($_POST['host']) : '';
$port = isset($_POST['port']) ?(int) $_POST['port'] : '';
$login = isset($_POST['login']) ?trim($_POST['login']) : '';
$password = isset($_POST['password']) ?trim($_POST['password']) : '';
$host = preg_match('~[^a-z0-9\-\.]+~i',$host) ?'': $host;
$port = intval($port) ?intval($port) : '';
$login = preg_match('~[^a-z0-9\_\-]+~i',$login) ?'': htmlspecialchars($login);
$password = is_string($password) ?htmlspecialchars($password) : '';
}
elseif ($_POST['act'] == '函数检测')
{
$funRe = "函数".$_POST['funName']."支持状况检测结果：".isfun1($_POST['funName']);
}
elseif ($_POST['act'] == '邮件检测')
{
$mailRe = "邮件发送检测结果：发送";
if($_SERVER['SERVER_PORT']==80){$mailContent = "http://".$_SERVER['SERVER_NAME'].($_SERVER['PHP_SELF'] ?$_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);}
else{$mailContent = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].($_SERVER['PHP_SELF'] ?$_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);}
$mailRe .= (false !== @mail($_POST["mailAdd"],$mailContent,"This is a test mail!\n\nhttp://lnmp.org")) ?"完成":"失败";
}
function isfun($funName = '')
{
if (!$funName ||trim($funName) == ''||preg_match('~[^a-z0-9\_]+~i',$funName,$tmp)) return '错误';
return (false !== function_exists($funName)) ?'<font color="green">√</font>': '<font color="red">×</font>';
}
function isfun1($funName = '')
{
if (!$funName ||trim($funName) == ''||preg_match('~[^a-z0-9\_]+~i',$funName,$tmp)) return '错误';
return (false !== function_exists($funName)) ?'√': '×';
}
;echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>phpStudy 探针 2014 </title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
* {font-family: Tahoma, "Microsoft Yahei", Arial; }
body{text-align: center; margin: 0 auto; padding: 0; background-color:#FFFFFF;font-size:12px;font-family:Tahoma, Arial}
h1 {font-size: 26px; font-weight: normal; padding: 0; margin: 0; color: #444444;}
h1 small {font-size: 11px; font-family: Tahoma; font-weight: bold; }
a{color: #000000; text-decoration:none;}
a.black{color: #000000; text-decoration:none;}
b{color: #999999;}
table{clear:both;padding: 0; margin: 0 0 10px;border-collapse:collapse; border-spacing: 0;}
th{padding: 3px 6px; font-weight:bold;background:#3066a6;color:#FFFFFF;border:1px solid #3066a6; text-align:left;}
.th_1{padding: 3px 6px; font-weight:bold;background:#666699;color:#FFFFFF;border:1px solid #3066a6; text-align:left;}

tr{padding: 0; background:#F7F7F7;}
td{padding: 3px 6px; border:1px solid #CCCCCC;}
input{padding: 2px; background: #FFFFFF; border-top:1px solid #666666; border-left:1px solid #666666; border-right:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; font-size:12px}
input.btn{font-weight: bold; height: 20px; line-height: 20px; padding: 0 6px; color:#666666; background: #f2f2f2; border:1px solid #999;font-size:12px}
.bar {border:1px solid #999999; background:#FFFFFF; height:5px; font-size:2px; width:89%; margin:2px 0 5px 0;padding:1px;overflow: hidden;}
.bar_1 {border:1px dotted #999999; background:#FFFFFF; height:5px; font-size:2px; width:89%; margin:2px 0 5px 0;padding:1px;overflow: hidden;}
.barli_red{background:#ff6600; height:5px; margin:0px; padding:0;}
.barli_blue{background:#0099FF; height:5px; margin:0px; padding:0;}
.barli_green{background:#36b52a; height:5px; margin:0px; padding:0;}
.barli_1{background:#999999; height:5px; margin:0px; padding:0;}
.barli{background:#36b52a; height:5px; margin:0px; padding:0;}
#page {width: 920px; padding: 0 20px; margin: 0 auto; text-align: left;}
#header{position: relative; padding: 10px;}
#footer {padding: 15px 15px; text-align: left; font-size: 12px; font-family: Tahoma, Verdana;line-height:16px}
#lnmplink {position: absolute; top: 20px; left: 200px; text-align: right; font-weight: bold; color: #06C;}
#lnmplink a {color: #0000FF; text-decoration: underline;}
#lnmplink2 {position: absolute; top: 20px; right: 80px; text-align: right; font-weight: bold; color: #06C;}
#lnmplink2 a {color: #0000FF; text-decoration: underline;}
.w_small{font-family: Courier New;}
.w_number{color: #f800fe;}
.sudu {padding: 0; background:#5dafd1; }
.suduk { margin:0px; padding:0;}
.resNo{color: #FF0000;}
.word{word-break:break-all;}
-->
</style>

</head>
<body>

<div id="page">
    <div id="header">
        <h1>phpStudy 探针</h1>
         <div id="lnmplink">for <a href="http://www.phpstudy.net/" target="_blank">phpStudy 2014</a></div>
         <div id="lnmplink2">not <a href="http://www.phpstudy.net/a.php/192.html" target="_blank">不想显示 phpStudy 探针</a></div>
    </div>

<!--服务器相关参数-->
<table width="100%" cellpadding="3" cellspacing="0">
  <tr><th colspan="4">服务器参数</th></tr>
  <tr>
    <td>服务器域名/IP地址</td>
    <td colspan="3">';echo $_SERVER['SERVER_NAME'];;echo '(';if('/'==DIRECTORY_SEPARATOR){echo $_SERVER['SERVER_ADDR'];}else{echo @gethostbyname($_SERVER['SERVER_NAME']);};echo ')</td>
  </tr>
  <tr>
    <td>服务器标识</td>
    <td colspan="3">';if($sysInfo['win_n'] != ''){echo $sysInfo['win_n'];}else{echo @php_uname();};;echo '</td>
  </tr>
  <tr>
    <td width="13%">服务器操作系统</td>
    <td width="37%">';$os = explode(" ",php_uname());echo $os[0];;echo ' &nbsp;内核版本：';if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];};echo '</td>
    <td width="13%">服务器解译引擎</td>
    <td width="37%">';echo $_SERVER['SERVER_SOFTWARE'];;echo '</td>
  </tr>
  <tr>
    <td>服务器语言</td>
    <td>';echo getenv("HTTP_ACCEPT_LANGUAGE");;echo '</td>
    <td>服务器端口</td>
    <td>';echo $_SERVER['SERVER_PORT'];;echo '</td>
  </tr>
  <tr>
	  <td>服务器主机名</td>
	  <td>';if('/'==DIRECTORY_SEPARATOR ){echo $os[1];}else{echo $os[2];};echo '</td>
	  <td>绝对路径</td>
	  <td>';echo $_SERVER['DOCUMENT_ROOT']?str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']):str_replace('\\','/',dirname(__FILE__));;echo '</td>
	</tr>
  <tr>
	  <td>管理员邮箱</td>
	  <td>';echo $_SERVER['SERVER_ADMIN'];;echo '</td>
		<td>探针路径</td>
		<td>';echo str_replace('\\','/',__FILE__)?str_replace('\\','/',__FILE__):$_SERVER['SCRIPT_FILENAME'];;echo '</td>
	</tr>
</table>



<table width="100%" cellpadding="3" cellspacing="0" align="center">
  <tr>
    <th colspan="4">PHP已编译模块检测</th>
  </tr>
  <tr>
    <td colspan="4"><span class="w_small">
';
$able=get_loaded_extensions();
foreach ($able as $key=>$value) {
if ($key!=0 &&$key%13==0) {
echo '<br />';
}
echo "$value&nbsp;&nbsp;";
}
;echo '</span>
    </td>
  </tr>
</table>
<table width="100%" cellpadding="3" cellspacing="0" align="center">
  <tr><th colspan="4">PHP相关参数</th></tr>
  <tr>
    <td width="32%">PHP信息（phpinfo）：</td>
    <td width="18%">
		';
$phpSelf = $_SERVER[PHP_SELF] ?$_SERVER[PHP_SELF] : $_SERVER[SCRIPT_NAME];
$disFuns=get_cfg_var("disable_functions");
;echo '    ';echo (false!==eregi("phpinfo",$disFuns))?'<font color="red">×</font>':"<a href='$phpSelf?act=phpinfo' target='_blank'>PHPINFO</a>";;echo '    </td>
    <td width="32%">PHP版本（php_version）：</td>
    <td width="18%">';echo PHP_VERSION;;echo '</td>
  </tr>
  <tr>
    <td>PHP运行方式：</td>
    <td>';echo strtoupper(php_sapi_name());;echo '</td>
    <td>脚本占用最大内存（memory_limit）：</td>
    <td>';echo show("memory_limit");;echo '</td>
  </tr>
  <tr>
    <td>PHP安全模式（safe_mode）：</td>
    <td>';echo show("safe_mode");;echo '</td>
    <td>POST方法提交最大限制（post_max_size）：</td>
    <td>';echo show("post_max_size");;echo '</td>
  </tr>
  <tr>
    <td>上传文件最大限制（upload_max_filesize）：</td>
    <td>';echo show("upload_max_filesize");;echo '</td>
    <td>浮点型数据显示的有效位数（precision）：</td>
    <td>';echo show("precision");;echo '</td>
  </tr>
  <tr>
    <td>脚本超时时间（max_execution_time）：</td>
    <td>';echo show("max_execution_time");;echo '秒</td>
    <td>socket超时时间（default_socket_timeout）：</td>
    <td>';echo show("default_socket_timeout");;echo '秒</td>
  </tr>
  <tr>
    <td>PHP页面根目录（doc_root）：</td>
    <td>';echo show("doc_root");;echo '</td>
    <td>用户根目录（user_dir）：</td>
    <td>';echo show("user_dir");;echo '</td>
  </tr>
  <tr>
    <td>dl()函数（enable_dl）：</td>
    <td>';echo show("enable_dl");;echo '</td>
    <td>指定包含文件目录（include_path）：</td>
    <td>';echo show("include_path");;echo '</td>
  </tr>
  <tr>
    <td>显示错误信息（display_errors）：</td>
    <td>';echo show("display_errors");;echo '</td>
    <td>自定义全局变量（register_globals）：</td>
    <td>';echo show("register_globals");;echo '</td>
  </tr>
  <tr>
    <td>数据反斜杠转义（magic_quotes_gpc）：</td>
    <td>';echo show("magic_quotes_gpc");;echo '</td>
    <td>"&lt;?...?&gt;"短标签（short_open_tag）：</td>
    <td>';echo show("short_open_tag");;echo '</td>
  </tr>
  <tr>
    <td>"&lt;% %&gt;"ASP风格标记（asp_tags）：</td>
    <td>';echo show("asp_tags");;echo '</td>
    <td>忽略重复错误信息（ignore_repeated_errors）：</td>
    <td>';echo show("ignore_repeated_errors");;echo '</td>
  </tr>
  <tr>
    <td>忽略重复的错误源（ignore_repeated_source）：</td>
    <td>';echo show("ignore_repeated_source");;echo '</td>
    <td>报告内存泄漏（report_memleaks）：</td>
    <td>';echo show("report_memleaks");;echo '</td>
  </tr>
  <tr>
    <td>自动字符串转义（magic_quotes_gpc）：</td>
    <td>';echo show("magic_quotes_gpc");;echo '</td>
    <td>外部字符串自动转义（magic_quotes_runtime）：</td>
    <td>';echo show("magic_quotes_runtime");;echo '</td>
  </tr>
  <tr>
    <td>打开远程文件（allow_url_fopen）：</td>
    <td>';echo show("allow_url_fopen");;echo '</td>
    <td>声明argv和argc变量（register_argc_argv）：</td>
    <td>';echo show("register_argc_argv");;echo '</td>
  </tr>
  <tr>
    <td>Cookie 支持：</td>
    <td>';echo isset($_COOKIE)?'<font color="green">√</font>': '<font color="red">×</font>';;echo '</td>
    <td>拼写检查（ASpell Library）：</td>
    <td>';echo isfun("aspell_check_raw");;echo '</td>
  </tr>
   <tr>
    <td>高精度数学运算（BCMath）：</td>
    <td>';echo isfun("bcadd");;echo '</td>
    <td>PREL相容语法（PCRE）：</td>
    <td>';echo isfun("preg_match");;echo '</td>
   <tr>
    <td>PDF文档支持：</td>
    <td>';echo isfun("pdf_close");;echo '</td>
    <td>SNMP网络管理协议：</td>
    <td>';echo isfun("snmpget");;echo '</td>
  </tr> 
   <tr>
    <td>VMailMgr邮件处理：</td>
    <td>';echo isfun("vm_adduser");;echo '</td>
    <td>Curl支持：</td>
    <td>';echo isfun("curl_init");;echo '</td>
  </tr> 
   <tr>
    <td>SMTP支持：</td>
    <td>';echo get_cfg_var("SMTP")?'<font color="green">√</font>': '<font color="red">×</font>';;echo '</td>
    <td>SMTP地址：</td>
    <td>';echo get_cfg_var("SMTP")?get_cfg_var("SMTP"):'<font color="red">×</font>';;echo '</td>
  </tr> 
	<tr>
		<td>默认支持函数（enable_functions）：</td>
		<td colspan="3"><a href=\'';echo $phpSelf;;echo '?act=Function\' target=\'_blank\' class=\'static\'>请点这里查看详细！</a></td>		
	</tr>
	<tr>
		<td>被禁用的函数（disable_functions）：</td>
		<td colspan="3" class="word">
';
$disFuns=get_cfg_var("disable_functions");
if(empty($disFuns))
{
echo '<font color=red>×</font>';
}
else
{
$disFuns_array =  explode(',',$disFuns);
foreach ($disFuns_array as $key=>$value) 
{
if ($key!=0 &&$key%5==0) {
echo '<br />';
}
echo "$value&nbsp;&nbsp;";
}
}
;echo '		</td>
	</tr>
</table>
<!--组件信息-->
<table width="100%" cellpadding="3" cellspacing="0" align="center">
  <tr><th colspan="4" >组件支持</th></tr>
  <tr>
    <td width="32%">FTP支持：</td>
    <td width="18%">';echo isfun("ftp_login");;echo '</td>
    <td width="32%">XML解析支持：</td>
    <td width="18%">';echo isfun("xml_set_object");;echo '</td>
  </tr>
  <tr>
    <td>Session支持：</td>
    <td>';echo isfun("session_start");;echo '</td>
    <td>Socket支持：</td>
    <td>';echo isfun("socket_accept");;echo '</td>
  </tr>
  <tr>
    <td>Calendar支持</td>
    <td>';echo isfun('cal_days_in_month');;echo '	</td>
    <td>允许URL打开文件：</td>
    <td>';echo show("allow_url_fopen");;echo '</td>
  </tr>
  <tr>
    <td>GD库支持：</td>
    <td>
    ';
if(function_exists(gd_info)) {
$gd_info = @gd_info();
echo $gd_info["GD Version"];
}else{echo '<font color="red">×</font>';}
;echo '</td>
    <td>压缩文件支持(Zlib)：</td>
    <td>';echo isfun("gzclose");;echo '</td>
  </tr>
  <tr>
    <td>IMAP电子邮件系统函数库：</td>
    <td>';echo isfun("imap_close");;echo '</td>
    <td>历法运算函数库：</td>
    <td>';echo isfun("JDToGregorian");;echo '</td>
  </tr>
  <tr>
    <td>正则表达式函数库：</td>
    <td>';echo isfun("preg_match");;echo '</td>
    <td>WDDX支持：</td>
    <td>';echo isfun("wddx_add_vars");;echo '</td>
  </tr>
  <tr>
    <td>Iconv编码转换：</td>
    <td>';echo isfun("iconv");;echo '</td>
    <td>mbstring：</td>
    <td>';echo isfun("mb_eregi");;echo '</td>
  </tr>
  <tr>
    <td>高精度数学运算：</td>
    <td>';echo isfun("bcadd");;echo '</td>
    <td>LDAP目录协议：</td>
    <td>';echo isfun("ldap_close");;echo '</td>
  </tr>
  <tr>
    <td>MCrypt加密处理：</td>
    <td>';echo isfun("mcrypt_cbc");;echo '</td>
    <td>哈稀计算：</td>
    <td>';echo isfun("mhash_count");;echo '</td>
  </tr>
</table>

<!--第三方组件信息-->
<table width="100%" cellpadding="3" cellspacing="0" align="center">
  <tr><th colspan="4" >第三方组件</th></tr>
  <tr>
    <td width="32%">Zend版本</td>
    <td width="18%">';$zend_version = zend_version();if(empty($zend_version)){echo '<font color=red>×</font>';}else{echo $zend_version;};echo '</td>
    <td width="32%">
';
$PHP_VERSION = PHP_VERSION;
$PHP_VERSION = substr($PHP_VERSION,2,1);
if($PHP_VERSION >2)
{
echo "ZendGuardLoader[启用]";
}
else
{
echo "Zend Optimizer";
}
;echo '	</td>
    <td width="18%">';if($PHP_VERSION >2){echo (get_cfg_var("zend_loader.enable"))?'<font color=green>√</font>':'<font color=red>×</font>';}else{if(function_exists('zend_optimizer_version')){echo zend_optimizer_version();}else{echo (get_cfg_var("zend_optimizer.optimization_level")||get_cfg_var("zend_extension_manager.optimizer_ts")||get_cfg_var("zend.ze1_compatibility_mode")||get_cfg_var("zend_extension_ts"))?'<font color=green>√</font>':'<font color=red>×</font>';}};echo '</td>
  </tr>
  <tr>
    <td>eAccelerator</td>
    <td>';if((phpversion('eAccelerator'))!=''){echo phpversion('eAccelerator');}else{echo "<font color=red>×</font>";};echo '</td>
    <td>ioncube</td>
    <td>';if(extension_loaded('ionCube Loader')){$ys = ioncube_loader_iversion();$gm = ".".(int)substr($ys,3,2);echo ionCube_Loader_version().$gm;}else{echo "<font color=red>×</font>";};echo '</td>
  </tr>
  <tr>
    <td>XCache</td>
    <td>';if((phpversion('XCache'))!=''){echo phpversion('XCache');}else{echo "<font color=red>×</font>";};echo '</td>
    <td>APC</td>
    <td>';if((phpversion('APC'))!=''){echo phpversion('APC');}else{echo "<font color=red>×</font>";};echo '</td>
  </tr>
</table>

<!--数据库支持-->
<table width="100%" cellpadding="3" cellspacing="0" align="center">
  <tr><th colspan="4">数据库支持</th></tr>
  <tr>
    <td width="32%">MySQL 数据库：</td>
    <td width="18%">';echo isfun("mysql_close");;echo '    ';
if(function_exists("mysql_get_server_info")) {
$s = @mysql_get_server_info();
$s = $s ?'&nbsp; mysql_server 版本：'.$s : '';
$c = '&nbsp; mysql_client 版本：'.@mysql_get_client_info();
echo $s;
}
;echo '	</td>
    <td width="32%">ODBC 数据库：</td>
    <td width="18%">';echo isfun("odbc_close");;echo '</td>
  </tr>
  <tr>
    <td>Oracle 数据库：</td>
    <td>';echo isfun("ora_close");;echo '</td>
    <td>SQL Server 数据库：</td>
    <td>';echo isfun("mssql_close");;echo '</td>
  </tr>
  <tr>
    <td>dBASE 数据库：</td>
    <td>';echo isfun("dbase_close");;echo '</td>
    <td>mSQL 数据库：</td>
    <td>';echo isfun("msql_close");;echo '</td>
  </tr>
  <tr>
    <td>SQLite 数据库：</td>
    <td>';if(extension_loaded('sqlite3')) {$sqliteVer = SQLite3::version();echo '<font color=green>√</font>　';echo "SQLite3　Ver ";echo $sqliteVer[versionString];}else {echo isfun("sqlite_close");if(isfun("sqlite_close") == '<font color="green">√</font>') {echo "&nbsp; 版本： ".@sqlite_libversion();}};echo '</td>
    <td>Hyperwave 数据库：</td>
    <td>';echo isfun("hw_close");;echo '</td>
  </tr>
  <tr>
    <td>Postgre SQL 数据库：</td>
    <td>';echo isfun("pg_close");;echo '</td>
    <td>Informix 数据库：</td>
    <td>';echo isfun("ifx_close");;echo '</td>
  </tr>
  <tr>
    <td>DBA 数据库：</td>
    <td>';echo isfun("dba_close");;echo '</td>
    <td>DBM 数据库：</td>
    <td>';echo isfun("dbmclose");;echo '</td>
  </tr>
  <tr>
    <td>FilePro 数据库：</td>
    <td>';echo isfun("filepro_fieldcount");;echo '</td>
    <td>SyBase 数据库：</td>
    <td>';echo isfun("sybase_close");;echo '</td>
  </tr> 
</table>

<form action="';echo $_SERVER[PHP_SELF]."#bottom";;echo '" method="post">
<!--MySQL数据库连接检测-->
<table width="100%" cellpadding="3" cellspacing="0" align="center">
	<tr><th colspan="3">MySQL数据库连接检测</th></tr>
  <tr>
    <td width="15%"></td>
    <td width="60%">
      地址：<input type="text" name="host" value="localhost" size="10" />
      端口：<input type="text" name="port" value="3306" size="10" />
      用户名：<input type="text" name="login" size="10" />
      密码：<input type="password" name="password" size="10" />
    </td>
    <td width="25%">
      <input class="btn" type="submit" name="act" value="MySQL检测" />
    </td>
  </tr>
</table>
  ';
if ($_POST['act'] == 'MySQL检测') {
if(function_exists("mysql_close")==1) {
$link = @mysql_connect($host.":".$port,$login,$password);
if ($link){
echo "<script>alert('连接到MySql数据库正常')</script>";
}else {
echo "<script>alert('无法连接到MySql数据库！')</script>";
}
}else {
echo "<script>alert('服务器不支持MySQL数据库！')</script>";
}
}
;echo '<!--函数检测-->
<table width="100%" cellpadding="3" cellspacing="0" align="center">
	<tr><th colspan="3">函数检测</th></tr>
  <tr>
    <td width="15%"></td>
    <td width="60%">
      请输入您要检测的函数：
      <input type="text" name="funName" size="50" />
    </td>
    <td width="25%">
      <input class="btn" type="submit" name="act" align="right" value="函数检测" />
    </td>
  </tr>
  ';
if ($_POST['act'] == '函数检测') {
echo "<script>alert('$funRe')</script>";
}
;echo '</table>

</form>


<div id="footer">
<p>　　phpStudy集成最新的Apache+Nginx+IIS+Lighttpd+PHP+MySQL+phpMyAdmin+SQL-Front+Zend Loader，一次性安装，无须配置即可使用，是非常方便、好用的PHP调试环境。该程序绿色小巧简易迷你，有专门的控制面板。总之学习PHP只需一个包。对学习PHP的新手来说，WINDOWS下环境配置是一件很困难的事；对老手来说也是一件烦琐的事。因此无论你是新手还是老手，该程序包都是一个不错的选择。
本程序纯绿色使用完全免费，自由复制传播。版权所有 <a href="http://www.phpstudy.net/" target="_blank">www.phpstudy.net</a></p>
</div>

</div>
</body>
</html>';?>