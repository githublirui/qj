<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
CheckPurview($GLOBALS['OOO0000O0']('c3lzX1VzZXI='));
if (empty($dopost))
$dopost = $GLOBALS['OOO0000O0']('');
if ($dopost == $GLOBALS['OOO0000O0']('YWRk')) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbElJ')]("#[^0-9a-zA-Z_@!\.-]#",$pwd) ||$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbElJ')]("#[^0-9a-zA-Z_@!\.-]#",$userid)) {
Trace($GLOBALS['OOO0000O0']('5a+G56CB5oiW5oiW55So5oi35ZCN5LiN5ZCI5rOV77yMPGJyIC8+6K+35L2/55SoWzAtOWEtekEtWl9AIS4tXeWGheeahOWtl+espu+8gQ=='),$GLOBALS['OOO0000O0']('LTE='),0,3000);
exit();
}
$safecodeok = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($cfg_cookie_encode .$randcode),0,24);
if ($safecode != $safecodeok) {
Trace($GLOBALS['OOO0000O0']('6K+35aGr5YaZ5a6J5YWo6aqM6K+B5Liy77yB'),$GLOBALS['OOO0000O0']('LTE='),0,3000);
exit();
}
$row = $dsql->GetOne("SELECT COUNT(*) AS dd FROM `#@__member` WHERE userid LIKE '$userid' ");
if ($row[$GLOBALS['OOO0000O0']('ZGQ=')] >0) {
Trace($GLOBALS['OOO0000O0']('55So5oi35ZCN5bey5a2Y5Zyo77yB'),$GLOBALS['OOO0000O0']('LTE='));
exit();
}
$mpwd = md5($pwd);
$pwd = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($pwd),5,20);
$typeid = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJMWxJ')]($GLOBALS['OOO0000O0']('LA=='),$typeids);
if ($typeid == $GLOBALS['OOO0000O0']('MA==')){
$typeid = $GLOBALS['OOO0000O0']('');
}
$inquery = "INSERT INTO `#@__admin`(usertype,userid,pwd,uname,typeid,tname,email) VALUES('$usertype','$userid','$pwd','$uname','$typeid','$tname','$email'); ";
$rs = $dsql->ExecuteNoneQuery($inquery);
Trace($GLOBALS['OOO0000O0']('5oiQ5Yqf5aKe5Yqg5LiA5Liq55So5oi377yB'),$GLOBALS['OOO0000O0']('c3lzX2FkbWluX3VzZXIucGhw'));
exit();
}
$randcode = mt_rand(10000,99999);
$safecode = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJbGxs')](md5($cfg_cookie_encode .$randcode),0,24);
$tphtml = $GLOBALS['OOO0000O0']('');
$dsql->SetQuery("Select * from `#@__admintype` order by rank asc");
$dsql->Execute("ut");
while ($myrow = $dsql->GetObject("ut")) {
$tphtml .= "<option value='".$myrow->rank ."'>".$myrow->typename ."</option>\r\n";
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvc3lzX2FkbWluX3VzZXJfYWRkLmh0bQ=='));
?>