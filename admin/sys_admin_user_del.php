<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) .$GLOBALS['OOO0000O0']('L2NvbmZpZy5waHA='));
CheckPurview($GLOBALS['OOO0000O0']('c3lzX1VzZXI='));
if (empty($dopost))
$dopost = $GLOBALS['OOO0000O0']('');
$id = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsSWwx')]("#[^0-9]#",$GLOBALS['OOO0000O0'](''),$id);
if ($dopost == $GLOBALS['OOO0000O0']('ZGVsZWN0bWU=')) {
$safecodeok = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($cfg_cookie_encode .$randcode),0,24);
if ($safecodeok != $safecode) {
Trace("请填写正确的安全验证串！","sys_admin_user_del.php?id={$id}");
exit();
}
$rs = $dsql->ExecuteNoneQuery("DELETE FROM `#@__admin` WHERE id='$id' AND id<>1 AND id<>'".$cuserLogin->getUserID()."' ");
if($rs>0)
{
Trace("成功删除一个帐户！","sys_admin_user.php");
}
else
{
Trace("不能删除id为1的创建人帐号，不能删除自己！","sys_admin_user.php",0,3000);
}
exit();
}
$randcode = mt_rand(10000,99999);
$safecode = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($cfg_cookie_encode .$randcode),0,24);
$typeOptions = $GLOBALS['OOO0000O0']('');
$row = $dsql->GetOne("SELECT * FROM `#@__admin` WHERE id='$id'");
$tphtml = $GLOBALS['OOO0000O0']('');
$dsql->SetQuery("Select * from #@__admintype order by rank asc");
$dsql->Execute("ut");
while ($myrow = $dsql->GetObject("ut")) {
if ($row[$GLOBALS['OOO0000O0']('dXNlcnR5cGU=')] == $myrow->rank)
$tphtml .= "$myrow->typename";
else
$tphtml .= "";
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvc3lzX2FkbWluX3VzZXJfZGVsLmh0bQ=='));
?>