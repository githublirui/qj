<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L2NsYXNzL2FkbWlubGlzdC5jbGFzcy5waHA='));
PutCookie("pano_spot_url",GetCurUrl(),$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSWxJ')]() +3600,"/");
$endurl = GetCookie("pano_scene_url");
if (empty($id)) {
Trace($GLOBALS['OOO0000O0']('PGI+PyMyMDE0NjsmIzY1MjkyOyYjMzU4MzU7JiMxOTk4MTsmIzIxMDQwOyRpZD8vYj4mIzE5OTgxOyYjMzMwMjE7JiMyMDAyNjsmIzMxMzU0OyYjNjUyODE7'),"-1");
exit();
}
$sql = "SELECT * FROM `#@__pano_spot` WHERE aid = $id ORDER BY `id`";
if(empty ($page)){
$page = 0;
}
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/vrpano_spot.htm");
$dlist->display();
function getaction($me){
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_spot` WHERE id = $me";
$row = $mydb->getOne($sql);
if($row[$GLOBALS['OOO0000O0']('YWN0aW9u')] == 1){
return "&#28459;&#28216;&#28909;&#28857;";
}else if($row[$GLOBALS['OOO0000O0']('YWN0aW9u')] == 2){
$scenesql = "SELECT `pid` FROM `#@__pano_scene` WHERE id={$row['aid']}";
$scenerow = $mydb->getOne($scenesql);
$imgurl = $cmspath."/vrpano/vrpano".$scenerow[$GLOBALS['OOO0000O0']('cGlk')]."/showpic/".$row[$GLOBALS['OOO0000O0']('c2hvd3BpYw==')];;
return "<span img=\"$imgurl\" class=\"imgspan\">&#24377;&#20986;&#22270;&#29255;</span><div class=\"picbox\"><img src=\"$imgurl\" onload=\"photoin(this,120,120)\" /></div>";
}else if($row[$GLOBALS['OOO0000O0']('YWN0aW9u')] == 3){
return "&#22806;&#37096;&#36229;&#38142;&#25509;";
}else if($row[$GLOBALS['OOO0000O0']('YWN0aW9u')] == 4){
return "&#28857;&#20987;&#39134;&#20986;";
}else if($row[$GLOBALS['OOO0000O0']('YWN0aW9u')] == 5){
return "&#22270;&#38598;";
}else if($row[$GLOBALS['OOO0000O0']('YWN0aW9u')] == 6){
return "360&#29289;&#20307;";
}
}
function getopenaction($me){
if($me==1){
return "&#24050;&#24320;&#21551;";
}else{
return "&#26080;&#29305;&#25928;";
}
}
function getname($id){
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE id=$id";
$row = $mydb->getOne($scenesql);
return $row[$GLOBALS['OOO0000O0']('c2NlbmVuYW1l')];
}
?>