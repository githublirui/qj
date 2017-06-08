<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_spotstyle_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_spotstyle` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "save") {
if ($url != $row[$GLOBALS['OOO0000O0']('dXJs')]) {
$file = LULINROOT .$url;
$oldfilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($file);
$newfilename = reNameMe($oldfilename,"spot".$id);
checkdelfile(LULINROOT ."/require/vrpano/main/spot/".$newfilename);
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')]($file,LULINROOT ."/require/vrpano/main/spot/".$newfilename)) {
$url = "/require/vrpano/main/spot/".$newfilename;
}
}
$editsql = "UPDATE `#@__pano_spotstyle` SET 
            `title` = '$title',
            `url` = '$url',
            `framewidth` = '$framewidth',
            `frameheight` = '$frameheight',
            `lastframe` = '$lastframe',
            `speed` = '$speed',
            `typeid` = $typeid 
            WHERE `id` = $id";
$mydb->DoNotBack($editsql);
Trace("&#26032;&#28909;&#28857;&#20462;&#25913;&#23436;&#25104;&#65281;",$endurl);
exit();
}
$opsql = "SELECT * FROM `#@__pano_spottype` ORDER BY `id`";
$mydb->SetQuery($opsql);
$mydb->Execute("op");
$ophtml = "";
$k=1;
while ($oprow = $mydb->GetArray("op")) {
$ophtml .= "<input type=\"radio\" name=\"typeid\" onclick=\"op($k);\" value=\"$k\" ".checkme($row[$GLOBALS['OOO0000O0']('dHlwZWlk')],$k) ."/>{$oprow['typename']}\r\n";
$k++;
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3Nwb3Rfc3R5bGVfZWRpdC5odG0='));
?>