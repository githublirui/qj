<?php
if (!defined('LULINREQ'))
exit('not find require');
function Trace($msg,$gourl,$limittime=0) {
if ($gourl == '-1') {
if ($limittime == 0)
$litime = 200;
$gourl = "javascript:history.go(-1);";
}
$htmlhead = "<html>\r\n<head>\r\n<title>提示信息</title>\r\n";
$htmlhead .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=100\"/>\r\n";
$htmlhead .= "<base target='_self'/>\r\n<style type=\"text/css\">\r\n";
$htmlhead .= "body{background:#fff;margin:0px;}\r\n";
$htmlhead .= "#showbox{background:url(".$cfg_cmspath."/require/images/showbox.gif) no-repeat; width:377px; height:232px; overflow:hidden; margin:0 auto; margin-top:40px;}\r\n";
$htmlhead .= "#title{height:30px; overflow:hidden; margin-top:7px;  text-align: center; font: bold 14px/30px '微软雅黑'; color:#333;}";
$htmlhead .= "#main{width: 360px; height: 188px; overflow: hidden; margin-left: 9px; font: 12px/20px 微软雅黑; color: #be0000;}";
$htmlhead .= ".text{font: 12px/20px 微软雅黑; color: #be0000;}";
$htmlhead .= "</style>\r\n</head>\r\n";
$htmlhead .= "<body>\r\n<center>\r\n";
$htmlhead .= "<div id=\"showbox\">";
$htmlhead .= "<div id=\"title\">提示信息</div>\r\n<div id=\"main\">\r\n";
$htmlhead .= "<table width=\"90%\" height=\"188px\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n";
$htmlhead .= "<tr>\r\n<td class=\"text\" align=\"center\" height=\"188px\">";
$htmlhead .= "$msg</br></br><a href=\"$gourl\">点击这里快速跳转</a>";
$htmlhead .= "</td></tr>\r\n";
$htmlhead .= "</table>\r\n</div>\r\n</div>\r\n";
$htmlhead .= "</center>\r\n<script>\r\n";
$htmlfoot = "</script>\r\n</body>\r\n</html>\r\n";
$litime = ($limittime == 0 ?200 : $limittime);
$func = '';
$func .= "var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
$rmsg = $func;
if ($gourl != 'javascript:;'&&$gourl != '') {
$rmsg .= "setTimeout('JumpUrl()',$litime);";
}else {
$rmsg .= "";
}
$msg = $htmlhead .$rmsg .$htmlfoot;
echo $msg;
}
function Trace2($msg,$gourl,$limittime=0) {
if ($gourl == '-1') {
if ($limittime == 0)
$litime = 200;
$gourl = "javascript:history.go(-1);";
}
$htmlhead = "<html>\r\n<head>\r\n<title>提示信息</title>\r\n";
$htmlhead .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=100\"/>\r\n";
$htmlhead .= "<base target='_self'/>\r\n<style type=\"text/css\">\r\n";
$htmlhead .= "body{background:#fff;margin:0px;}\r\n";
$htmlhead .= "#showbox{background:url(".$cfg_cmspath."/require/images/showbox.gif) no-repeat; width:377px; height:232px; overflow:hidden; margin:0 auto; margin-top:40px;}\r\n";
$htmlhead .= "#title{height:30px; overflow:hidden; margin-top:7px;  text-align: center; font: bold 14px/30px '微软雅黑'; color:#333;}";
$htmlhead .= "#main{width: 360px; height: 188px; overflow: hidden; margin-left: 9px; font: 12px/20px 微软雅黑; color: #be0000;}";
$htmlhead .= ".text{font: 12px/20px 微软雅黑; color: #be0000;}";
$htmlhead .= "</style>\r\n</head>\r\n";
$htmlhead .= "<body>\r\n<center>\r\n";
$htmlhead .= "<div id=\"showbox\">";
$htmlhead .= "<div id=\"title\">提示信息</div>\r\n<div id=\"main\">\r\n";
$htmlhead .= "<table width=\"90%\" height=\"188px\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n";
$htmlhead .= "<tr>\r\n<td class=\"text\" align=\"center\" height=\"188px\">";
$htmlhead .= "$msg</br>";
$htmlhead .= "</td></tr>\r\n";
$htmlhead .= "</table>\r\n</div>\r\n</div>\r\n";
$htmlhead .= "</center>\r\n<script>\r\n";
$htmlfoot = "</script>\r\n</body>\r\n</html>\r\n";
$litime = ($limittime == 0 ?200 : $limittime);
$func = '';
$func .= "var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
$rmsg = $func;
if ($gourl != 'javascript:;'&&$gourl != '') {
$rmsg .= "setTimeout('JumpUrl()',$litime);";
}else {
$rmsg .= "";
}
$msg = $htmlhead .$rmsg .$htmlfoot;
echo $msg;
}
if (!function_exists('GetIP')) {
function GetIP() {
static $realip = NULL;
if ($realip !== NULL) {
return $realip;
}
if (isset($_SERVER)) {
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
$arr = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
foreach ($arr as $ip) {
$ip = trim($ip);
if ($ip != 'unknown') {
$realip = $ip;
break;
}
}
}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
$realip = $_SERVER['HTTP_CLIENT_IP'];
}else {
if (isset($_SERVER['REMOTE_ADDR'])) {
$realip = $_SERVER['REMOTE_ADDR'];
}else {
$realip = '0.0.0.0';
}
}
}else {
if (getenv('HTTP_X_FORWARDED_FOR')) {
$realip = getenv('HTTP_X_FORWARDED_FOR');
}elseif (getenv('HTTP_CLIENT_IP')) {
$realip = getenv('HTTP_CLIENT_IP');
}else {
$realip = getenv('REMOTE_ADDR');
}
}
preg_match("/[\d\.]{7,15}/",$realip,$onlineip);
$realip = !empty($onlineip[0]) ?$onlineip[0] : '0.0.0.0';
return $realip;
}
}
if (!function_exists('GetCurUrl')) {
function GetCurUrl() {
if (!empty($_SERVER["REQUEST_URI"])) {
$scriptName = $_SERVER["REQUEST_URI"];
$nowurl = $scriptName;
}else {
$scriptName = $_SERVER["PHP_SELF"];
if (empty($_SERVER["QUERY_STRING"])) {
$nowurl = $scriptName;
}else {
$nowurl = $scriptName ."?".$_SERVER["QUERY_STRING"];
}
}
return $nowurl;
}
}
function GetCkVdValue() {
@session_id($_COOKIE['PHPSESSID']);
@session_start();
return isset($_SESSION['securimage_code_value']) ?$_SESSION['securimage_code_value'] : '';
}
function ResetVdValue() {
@session_start();
$_SESSION['securimage_code_value'] = '';
}
if ( !function_exists('ExecTime'))
{
function ExecTime()
{
$time = explode(" ",microtime());
$usec = (double)$time[0];
$sec = (double)$time[1];
return $sec +$usec;
}
}
function checkme($temp1,$temp2) {
if ($temp1 == $temp2) {
return 'checked="checked"';
}else {
return '';
}
}
function checkop($temp1,$temp2) {
if ($temp1 == $temp2) {
return 'selected="true"';
}else {
return '';
}
}
function checkimg($img,$noimg="images/noimg.jpg"){
if(!is_file(LULINROOT.$img)){
return $noimg;
}else{
return $img;
}
}
if ( !function_exists('AttDef'))
{
function AttDef($oldvar,$nv){
if(empty($oldvar)||$oldvar == ""){
return $nv;
}else{
return $oldvar;
}
}
}
?>