<?php
require_once(dirname(__FILE__) .'/../require/function.inc.php');
require_once(LULINREQ .'/class/userlogin.class.php');
if (empty($dopost))
$dopost = '';
$admindirs = explode('/',str_replace("\\",'/',dirname(__FILE__)));
$admindir = $admindirs[count($admindirs) -1];
if ($dopost == 'login') {
$svali = strtolower(GetCkVdValue());
if (($validate != '')) {
ResetVdValue();
Trace('验证码不正确!','login.php',1000);
exit;
}else{
$cuserLogin = new userLogin($admindir);
if (!empty($userid) &&!empty($pwd)) {
$res = $cuserLogin->checkUser($userid,$pwd );
if ($res == 1) {
$cuserLogin->keepUser();
if (!empty($gotopage)) {
Trace('成功登录，正在转向管理管理主页！',$gotopage,300);
exit();
}else {
Trace('成功登录，正在转向管理管理主页！',"index.php",300);
exit();
}
}
else if ($res == -3) {
Trace('你的用户名不存在-3!',-1,1000);
exit;
}
else if ($res == -1) {
Trace('你的用户名不存在!',-1,1000);
exit;
}else {
Trace('你的密码错误!',-1,1000);
exit;
}
}
else {
Trace('用户和密码没填写完整!',-1,1000);
exit;
}
}
exit();
}
require('template/login.htm');
?>