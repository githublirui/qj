<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L2NsYXNzL2FkbWlubGlzdC5jbGFzcy5waHA='));
PutCookie("pano_url",GetCurUrl(),$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSWxJ')]() +3600,"/");
if(empty ($page)){
$page = 0;
}
$thedb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$hotsql = "SELECT * FROM `#@__pano_main` WHERE zhiding=1 ORDER BY `id` ";
$thedb->SetQuery($hotsql);
$thedb->Execute("hot");
$thehtml = "";
while($therow=$thedb->GetArray("hot")){
$thehtml .= "<tr class=\"tr_white\" align=\"center\">\r\n";
$thehtml .= "<td height=\"28\">{$therow['id']}</td>\r\n";
$thehtml .= "<td><font color=\"#ff0000\">{$therow['panoname']}</font></td>\r\n";
$thehtml .= "<td>".MyDate("Y-m-d H:i:s",$therow[$GLOBALS['OOO0000O0']('c2VuZHRpbWU=')])."</td>\r\n";
$thehtml .= "<td>\r\n";
$thehtml .= "<input type=\"button\" class=\"btn1\" value=\"&#x7f16;&#x8f91;\" onclick=\"window.location.href='vrpano_scene.php?id={$therow['id']}';\"/>\r\n";
$thehtml .= "<input type=\"button\" class=\"btn1\" value=\"&#x9879;&#x76ee;&#x9884;&#x89c8;\" onclick=\"penoshow('{$therow['id']}');\"/>\r\n";
$thehtml .= "<input type=\"button\" class=\"btn1\" value=\"&#x8f93;&#x51fa;&#x6587;&#x4ef6;\" onclick=\"window.location.href='vrpano_maker.php?id={$therow['id']}';\"/>\r\n";
$thehtml .= "</td>\r\n";
$thehtml .= "</tr>\r\n";
}
$sql = "SELECT * 
FROM `#@__pano_main` WHERE zhiding=0 ORDER BY `id` DESC ";
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/vrpano_main.htm");
$dlist->display();
?>