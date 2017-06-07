<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(dirname('vrpano_ui.php') ."/inc/panomenu.php");
require_once(LULINREQ .'/class/adminlist.class.php');
PutCookie("pano_ui",GetCurUrl(),time() +3600,"/");
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