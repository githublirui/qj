<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L2NsYXNzL2FkbWlubGlzdC5jbGFzcy5waHA='));
CheckPurview($GLOBALS['OOO0000O0']('c3lzX1VzZXI='));
if (empty($page)) {
$page = 0;
}
setcookie("ENV_GOBACK_URL",$vrNowurl,$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSWxJ')]() +3600,"/");
$sql = "SELECT * FROM `#@__admin` ORDER BY id";
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/sys_admin_user.htm");
$dlist->display();
function GetChannel($c) {
if ($c == ""||$c == 0)
return "所有频道";
else
return $c;
}
?>