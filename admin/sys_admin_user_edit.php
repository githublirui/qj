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
if ($dopost == $GLOBALS['OOO0000O0']('c2F2ZWVkaXQ=')) {
$pwd = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsSTEx')]($pwd);
if ($pwd != $GLOBALS['OOO0000O0']('') &&$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbElJ')]("#[^0-9a-zA-Z_@!\.-]#",$pwd)) {
Trace($GLOBALS['OOO0000O0']('5a+G56CB5LiN5ZCI5rOV77yM6K+35L2/55SoWzAtOWEtekEtWl9AIS4tXeWGheeahOWtl+espu+8gQ=='),$GLOBALS['OOO0000O0']('LTE='),0,3000);
exit();
}
$safecodeok = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($cfg_cookie_encode .$randcode),0,24);
if ($safecodeok != $safecode) {
Trace("请填写正确的安全验证串！","sys_admin_user_edit.php?id={$id}&dopost=edit");
exit();
}
$pwdm = $GLOBALS['OOO0000O0']('');
if ($pwd != $GLOBALS['OOO0000O0']('')) {
$pwdm = ",pwd='".md5($pwd) ."'";
$pwd = ",pwd='".$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($pwd),5,20) ."'";
}
if (empty($typeids)) {
$typeid = $GLOBALS['OOO0000O0']('');
}else {
$typeid = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJMWxJ')]($GLOBALS['OOO0000O0']('LA=='),$typeids);
if ($typeid == $GLOBALS['OOO0000O0']('MA=='))
$typeid = $GLOBALS['OOO0000O0']('');
}
if ($id != 1) {
$query = "UPDATE `#@__admin` SET uname='$uname',usertype='$usertype',tname='$tname',email='$email',typeid='$typeid' $pwd WHERE id='$id'";
}else {
$query = "UPDATE `#@__admin` SET uname='$uname',tname='$tname',email='$email',typeid='$typeid' $pwd WHERE id='$id'";
}
$dsql->ExecuteNoneQuery($query);
Trace("成功更改一个帐户！","sys_admin_user.php");
exit();
}
$randcode = mt_rand(10000,99999);
$safecode = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($cfg_cookie_encode .$randcode),0,24);
$row = $dsql->GetOne("SELECT * FROM `#@__admin` WHERE id='$id'");
$tphtml = $GLOBALS['OOO0000O0']('');
$dsql->SetQuery("Select * from #@__admintype order by rank asc");
$dsql->Execute("ut");
while ($myrow = $dsql->GetObject("ut")) {
if ($row[$GLOBALS['OOO0000O0']('dXNlcnR5cGU=')] == $myrow->rank)
$tphtml .= "<option value='".$myrow->rank ."' selected='1'>".$myrow->typename ."</option>\r\n";
else
$tphtml .= "<option value='".$myrow->rank ."'>".$myrow->typename ."</option>\r\n";
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvc3lzX2FkbWluX3VzZXJfZWRpdC5odG0='));
?>