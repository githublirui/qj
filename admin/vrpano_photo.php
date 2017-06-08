<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/class/adminlist.class.php');
require_once(dirname('vrpano_photo.php') ."/inc/panomenu.php");
PutCookie("pano_photo_url",GetCurUrl(),3600,"/");
if (empty($id)) {
Trace('<b>?#20146;&#65292;&#35835;&#19981;&#21040;$id?/b>&#19981;&#33021;&#20026;&#31354;&#65281;',"-1");
exit();
}
$sql = "SELECT * FROM `#@__pano_photo` WHERE pid = $id ORDER BY `id`";
function testimg($imgurl) {
if (!is_file(LULINROOT .$imgurl)) {
return "/admin/images/noimg.jpg";
}else {
$key = rand(0,9999);
return $imgurl ."?".$key;
}
}
if(empty ($page)){
$page = 0;
}
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/vrpano_photo.htm");
$dlist->display();
?>