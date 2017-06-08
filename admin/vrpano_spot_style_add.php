<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_spotstyle_url");
if ($dopost == "save") {
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$topsql = "SELECT * FROM `#@__pano_spotstyle` ORDER BY `id` DESC ";
$mydb->SetQuery($topsql);
$mydb->Execute("top");
$toplen = $mydb->GetTotalRow("top");
if ($toplen >0) {
$toprow = $mydb->getOne($topsql);
$nowid = $toprow[$GLOBALS['OOO0000O0']('aWQ=')];
$newid = $nowid +1;
}else {
$newid = 1;
}
$file = LULINROOT .$url;
$oldfilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($file);
$newfilename = reNameMe($oldfilename,"spot".$newid);
checkdelfile(LULINROOT ."/require/vrpano/main/spot/".$newfilename);
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')]($file,LULINROOT ."/require/vrpano/main/spot/".$newfilename)) {
$url = "/require/vrpano/main/spot/".$newfilename;
}
$sql = "INSERT INTO `#@__pano_spotstyle` (`title`,`url`,`typeid`,`framewidth`,`frameheight`,`lastframe`,`speed`) VALUES ('$title' , '$url' , '$typeid','$framewidth','$frameheight','$lastframe','$speed')";
$mydb->DoNotBack($sql);
Trace("&#26032;&#28909;&#28857;&#28155;&#21152;&#23436;&#25104;&#65281;",$endurl);
exit();
}
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
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
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3Nwb3Rfc3R5bGVfYWRkLmh0bQ=='));
?>