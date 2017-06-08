<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_spotstyle_url");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_spotstyle` WHERE id=$id";
$row = $mydb->getOne($sql);
if ($dopost == "save") {
if ($url != $row['url']) {
$file = LULINROOT .$url;
$oldfilename = basename($file);
$newfilename = reNameMe($oldfilename,"spot".$id);
checkdelfile(LULINROOT ."/require/vrpano/main/spot/".$newfilename);
if (rename($file,LULINROOT ."/require/vrpano/main/spot/".$newfilename)) {
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
$ophtml .= "<input type=\"radio\" name=\"typeid\" onclick=\"op($k);\" value=\"$k\" ".checkme($row['typeid'],$k) ."/>{$oprow['typename']}\r\n";
$k++;
}
require('template/vrpano_spot_style_edit.htm');
?>