<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/class/adminlist.class.php');
PutCookie("pano_url",GetCurUrl(),time() +3600,"/");
if(empty ($page)){
$page = 0;
}
$thedb = new mysql();
$hotsql = "SELECT * FROM `#@__pano_main` WHERE zhiding=1 ORDER BY `id` ";
$thedb->SetQuery($hotsql);
$thedb->Execute("hot");
$thehtml = "";
while($therow=$thedb->GetArray("hot")){
$thehtml .= "<tr class=\"tr_white\" align=\"center\">\r\n";
$thehtml .= "<td height=\"28\">{$therow['id']}</td>\r\n";
$thehtml .= "<td><font color=\"#ff0000\">{$therow['panoname']}</font></td>\r\n";
$thehtml .= "<td>".MyDate("Y-m-d H:i:s",$therow['sendtime'])."</td>\r\n";
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