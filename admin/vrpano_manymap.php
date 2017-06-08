<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L2NsYXNzL2FkbWlubGlzdC5jbGFzcy5waHA='));
PutCookie("pano_maps_url",GetCurUrl(),3600,"/");
$endurl = GetCookie("pano_map_url");
if (empty($id)) {
Trace($GLOBALS['OOO0000O0']('PGI+PyMyMDE0NjsmIzY1MjkyOyYjMzU4MzU7JiMxOTk4MTsmIzIxMDQwOyRpZD8vYj4mIzE5OTgxOyYjMzMwMjE7JiMyMDAyNjsmIzMxMzU0OyYjNjUyODE7'),"-1");
exit();
}
$sql = "SELECT * FROM `#@__pano_maps` WHERE pid = $id ORDER BY `id`";
function testimg($imgurl) {
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$imgurl)) {
return "/admin/images/noimg.jpg";
}else {
$key = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJMTFs')](0,9999);
return $imgurl ."?".$key;
}
}
if(empty ($page)){
$page = 0;
}
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/vrpano_manymap.htm");
$dlist->display();
?>