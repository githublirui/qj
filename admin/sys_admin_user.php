<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/class/adminlist.class.php');
CheckPurview('sys_User');
if (empty($page)) {
$page = 0;
}
setcookie("ENV_GOBACK_URL",$vrNowurl,time() +3600,"/");
$sql = "SELECT * FROM `#@__admin` ORDER BY id";
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/sys_admin_user.htm");
$dlist->display();
function GetChannel($c) {
if ($c == ""||$c == 0)
return "æ‰?æœ‰é¢‘é?";
else
return $c;
}
?>