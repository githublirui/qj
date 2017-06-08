<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_ui");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$uisql = "SELECT * FROM `#@__pano_ui` WHERE `id`= $id";
$row = $mydb->getOne($uisql);
if ($dopost == "save") {
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
if ($imgfile != $row[$GLOBALS['OOO0000O0']('aW1nZmlsZQ==')]) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$imgfile)) {
checkdelfile($basedir ."/ui/".$row[$GLOBALS['OOO0000O0']('aW1nZmlsZQ==')]);
checkmakedir($basedir ."/ui");
$imgfilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($imgfile);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$imgfile,$basedir ."/ui/".$imgfilename);
$imgfile = $imgfilename;
}else {
$imgfile = "";
}
}
if ($videofile != $row[$GLOBALS['OOO0000O0']('dmlkZW9maWxl')]) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$videofile)) {
checkdelfile($basedir ."/ui/".$row[$GLOBALS['OOO0000O0']('dmlkZW9maWxl')]);
checkmakedir($basedir ."/ui");
$videofilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($videofile);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$videofile,$basedir ."/ui/".$videofilename);
$videofile = $videofilename;
}else {
$videofile = "";
}
}
if ($uitype == 2) {
checkmakedir($basedir ."/plugins");
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/videoplayer.swf")) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/videoplayer.swf",$basedir ."/plugins/videoplayer.swf");
}
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($basedir ."/plugins/videoplayer.js")) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/videoplayer.js",$basedir ."/plugins/videoplayer.js");
}
}
if ($action == 2) {
if ($showpic != $row[$GLOBALS['OOO0000O0']('c2hvd3BpYw==')]) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT .$showpic)) {
checkdelfile($basedir ."/showpic/".$row[$GLOBALS['OOO0000O0']('c2hvd3BpYw==')]);
$showpicname = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')](LULINROOT .$showpic);
checkmakedir($basedir ."/showpic");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$showpic,$basedir ."/showpic/".$showpicname);
$showpic = $showpicname;
}else {
Trace("&#23637;&#31034;&#22270;&#29255;&#19981;&#23384;&#22312;&#65292;&#26816;&#26597;&#36335;&#24452;","-1");
}
}
}
$editsql = "UPDATE `#@__pano_ui` SET 
            `title` = '$title',
            `uitype` = '$uitype',
            `openui` = '$openui',
            `imgfile` = '$imgfile',
            `videofile` = '$videofile',
            `uipos` = '$uipos',
            `uix` = '$uix',
            `uiy` = '$uiy',
            `uiscale` = '$uiscale',
            `uizorder` = '$uizorder',
            `uialpha` = '$uialpha',
            `openaction` = $openaction,
            `action` = $action,
            `panotarget` = $panotarget,
            `targeth` = $targeth,
            `targetv` = $targetv,
            `showpic` = '$showpic',
            `showpicbordercolor` = '$showpicbordercolor',
            `showpicborderalpha` = '$showpicborderalpha',
            `showpicborderwidth` = '$showpicborderwidth',
            `httplink` = '$httplink'
            WHERE `id`= $id";
$mydb->DoNotBack($editsql);
Trace("&#20462;&#25913;&#23436;&#25104;&#65281;",$endurl);
exit();
}
$uitypejs = "";
$uitypejs .= "<script type=\"text/javascript\" />";
$uitypejs .= "showtb({$row['uitype']});";
$uitypejs .= "</script>";
$uiposjs = "";
$uiposjs .= "<script type=\"text/javascript\" />";
$uiposjs .= "onetian({$row['uipos']});";
$uiposjs .= "</script>";
$actionhtml = "";
$actionhtml .= "<script type=\"text/javascript\">\r\n";
$actionhtml .= "showac(".$row[$GLOBALS['OOO0000O0']('YWN0aW9u')] .");\r\n";
$actionhtml .= "</script>\r\n";
$parentsql = "SELECT * FROM `#@__pano_ui` WHERE id=$id";
$parentrow = $mydb->GetOne($parentsql);
$panosql = "SELECT * FROM `#@__pano_scene` WHERE pid={$parentrow['pid']} ORDER BY `rank`";
$mydb->SetQuery($panosql);
$mydb->Execute("pano");
$panohtml = "<input type=\"hidden\" name=\"panotarget\" id=\"panotarget\" value=\"0\" />\r\n";
$autokey = 0;
$panojshtml = "";
while ($panorow = $mydb->GetArray("pano")) {
$panohtml .= "<div class=\"panobox\" onclick=\"getpanotarget($autokey,{$panorow['id']});\">\r\n";
$panohtml .= "<div class=\"panotitle\"><b>&#21517;&#31216;&#65306;</b>{$panorow['scenename']}</div>\r\n";
$panohtml .= "<div class=\"panocode\"><b>&#32534;&#21495;&#65306;</b>{$panorow['rank']}</div>\r\n";
$panohtml .= "</div>\r\n";
if ($row[$GLOBALS['OOO0000O0']('cGFub3RhcmdldA==')] == $panorow[$GLOBALS['OOO0000O0']('aWQ=')]) {
$panojshtml .= "<script type=\"text/javascript\">\r\n";
$panojshtml .= "getpanotarget($autokey,".$panorow[$GLOBALS['OOO0000O0']('aWQ=')] .");\r\n";
$panojshtml .= "</script>\r\n";
}
$autokey++;
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3VpX2VkaXQuaHRt'));
?>