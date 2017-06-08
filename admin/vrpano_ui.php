<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')]($GLOBALS['OOO0000O0']('dnJwYW5vX3VpLnBocA==')) ."/inc/panomenu.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L2NsYXNzL2FkbWlubGlzdC5jbGFzcy5waHA='));
PutCookie("pano_ui",GetCurUrl(),$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSWxJ')]() +3600,"/");
if(empty ($page)){
$page = 0;
}
$sql = "SELECT * 
FROM `#@__pano_ui`WHERE `pid`=$id ORDER BY `id` DESC ";
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/vrpano_ui.htm");
$dlist->display();
function checktype($type){
if($type==1){
return "&#22270;&#29255;";
}else{
return "&#35270;&#39057;";
}
}
function checkopen($k){
if($k==1){
return "<font color=\"green\">&#24320;&#21551;</font>";
}else{
return "<font color=\"red\">&#26410;&#24320;&#21551;</font>";
}
}
?>