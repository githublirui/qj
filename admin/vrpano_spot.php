<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/class/adminlist.class.php');
PutCookie("pano_spot_url",GetCurUrl(),time() +3600,"/");
$endurl = GetCookie("pano_scene_url");
if (empty($id)) {
Trace('<b>?#20146;&#65292;&#35835;&#19981;&#21040;$id?/b>&#19981;&#33021;&#20026;&#31354;&#65281;',"-1");
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
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_spot` WHERE id = $me";
$row = $mydb->getOne($sql);
if($row['action'] == 1){
return "&#28459;&#28216;&#28909;&#28857;";
}else if($row['action'] == 2){
$scenesql = "SELECT `pid` FROM `#@__pano_scene` WHERE id={$row['aid']}";
$scenerow = $mydb->getOne($scenesql);
$imgurl = $cmspath."/vrpano/vrpano".$scenerow['pid']."/showpic/".$row['showpic'];;
return "<span img=\"$imgurl\" class=\"imgspan\">&#24377;&#20986;&#22270;&#29255;</span><div class=\"picbox\"><img src=\"$imgurl\" onload=\"photoin(this,120,120)\" /></div>";
}else if($row['action'] == 3){
return "&#22806;&#37096;&#36229;&#38142;&#25509;";
}else if($row['action'] == 4){
return "&#28857;&#20987;&#39134;&#20986;";
}else if($row['action'] == 5){
return "&#22270;&#38598;";
}else if($row['action'] == 6){
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
$mydb = new mysql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE id=$id";
$row = $mydb->getOne($scenesql);
return $row['scenename'];
}
?>