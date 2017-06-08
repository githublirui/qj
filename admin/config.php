<?php
define('LULINADMIN',str_replace("\\",'/',dirname(__FILE__)));
require_once(LULINADMIN .'/../require/function.inc.php');
require_once(LULINREQ .'/class/userlogin.class.php');
header('Cache-Control:private');
$dsql->safeCheck = FALSE;
$dsql->SetLongLink();
set_time_limit(0);
$Nowurl = $NowOnlyurl = '';
$isUrlOpen = @ini_get('allow_url_fopen');
$Nowurl = GetCurUrl();
$Nowurls = explode('?',$Nowurl);
$NowOnlyurl = $Nowurls[0];
$cmspath = $cfg_cmspath;
$cuserLogin = new userLogin();
if ($cuserLogin->getUserID() == -1) {
header("location:login.php?gotopage=".urlencode($Nowurl));
exit();
}
class GetMacAddr   
{
var $return_array = array();
var $mac_addr;
function GetMacAddr($os_type)   
{
switch ( strtolower($os_type) )   
{
case "linux":   
$this->forLinux();
break;
case "solaris":   
break;
case "unix":   
break;
case "aix":   
break;
default:   
$this->forWindows();
break;
}
$temp_array = array();
foreach ( $this->return_array as $value )   
{
if ( preg_match( "/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i",$value,$temp_array ) )   
{
$this->mac_addr = $temp_array[0];
break;
}
}
unset($temp_array);
return $this->mac_addr;
}
function forWindows()   
{
@exec("ipconfig /all",$this->return_array);
if ( $this->return_array )   
return $this->return_array;
else{
$ipconfig = $_SERVER["WINDIR"]."\system32\ipconfig.exe";
if ( is_file($ipconfig) )   
@exec($ipconfig." /all",$this->return_array);
else  
@exec($_SERVER["WINDIR"]."\system\ipconfig.exe /all",$this->return_array);
return $this->return_array;
}
}
}
?>