<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_spotstyle_url");
if ($dopost == "save") {
$mydb = new mysql();
$topsql = "SELECT * FROM `#@__pano_spotstyle` ORDER BY `id` DESC ";
$mydb->SetQuery($topsql);
$mydb->Execute("top");
$toplen = $mydb->GetTotalRow("top");
if ($toplen >0) {
$toprow = $mydb->getOne($topsql);
$nowid = $toprow['id'];
$newid = $nowid +1;
}else {
$newid = 1;
}
$file = LULINROOT .$url;
$oldfilename = basename($file);
$newfilename = reNameMe($oldfilename,"spot".$newid);
checkdelfile(LULINROOT ."/require/vrpano/main/spot/".$newfilename);
if (rename($file,LULINROOT ."/require/vrpano/main/spot/".$newfilename)) {
$url = "/require/vrpano/main/spot/".$newfilename;
}
$sql = "INSERT INTO `#@__pano_spotstyle` (`title`,`url`,`typeid`,`framewidth`,`frameheight`,`lastframe`,`speed`) VALUES ('$title' , '$url' , '$typeid','$framewidth','$frameheight','$lastframe','$speed')";
$mydb->DoNotBack($sql);
Trace("&#26032;&#28909;&#28857;&#28155;&#21152;&#23436;&#25104;&#65281;",$endurl);
exit();
}
$mydb = new mysql();
$opsql = "SELECT * FROM `#@__pano_spottype` ORDER BY `id`";
$mydb->SetQuery($opsql);
$mydb->Execute("op");
$ophtml = "";
$k=1;
while ($oprow = $mydb->GetArray("op")) {
if($k==1){
$ophtml .= "<input type=\"radio\" name=\"typeid\" value=\"$k\" onclick=\"op($k);\" checked=\"checked\"/>{$oprow['typename']}\r\n";
}else{
$ophtml .= "<input type=\"radio\" name=\"typeid\" value=\"$k\" onclick=\"op($k);\" />{$oprow['typename']}\r\n";
}
$k++;
}
require('template/vrpano_spot_style_add.htm');
?>