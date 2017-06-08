<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_photo_url");
require_once(LULINREQ ."/class/mytag.class.php");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_photo` WHERE id=$id";
$row = $dsql->getOne($sql);
$pid = $row[$GLOBALS['OOO0000O0']('cGlk')];
$mainsql = "SELECT `filedir` FROM `#@__pano_main` WHERE id={$row['pid']}";
$mainrow = $mydb->getOne($mainsql);
$basedir = LULINROOT ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')];
$photodir = $basedir ."/photo";
$photobagdir = $basedir ."/photo/photo".$row[$GLOBALS['OOO0000O0']('cmFuaw==')];
$photobagurl = $cfg_cmspath ."/vrpano/".$mainrow[$GLOBALS['OOO0000O0']('ZmlsZWRpcg==')] ."/photo/photo".$row[$GLOBALS['OOO0000O0']('cmFuaw==')];
if ($dopost == "save") {
$editok = false;
checkmakedir($photodir);
checkmakedir($photobagdir);
$photoskindir = $basedir ."/photo/skin";
checkmakedir($photoskindir);
checkcopyfile(LULINREQ."/vrpano/main/photo/kuang.png",$photoskindir."/kuang.png");
checkcopyfile(LULINREQ."/vrpano/main/photo/mapleft.png",$photoskindir."/mapleft.png");
checkcopyfile(LULINREQ."/vrpano/main/photo/mapright.png",$photoskindir."/mapright.png");
checkcopyfile(LULINREQ."/vrpano/main/photo/x.png",$photoskindir."/x.png");
checkmakedir($basedir."/plugins");
checkcopyfile(LULINREQ."/vrpano/main/plugins/scrollarea.swf",$basedir."/plugins/scrollarea.swf");
checkcopyfile(LULINREQ."/vrpano/main/plugins/textfield.swf",$basedir."/plugins/textfield.swf");
checkcopyfile(LULINREQ."/vrpano/main/plugins/scrollarea.js",$basedir."/plugins/scrollarea.js");
if ($litpic != $row[$GLOBALS['OOO0000O0']('bGl0cGlj')]) {
$litpic_basename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($litpic);
$litpic_basename = reNameMe($litpic_basename,"litpic");
if ($row[$GLOBALS['OOO0000O0']('bGl0cGlj')] != "") {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsMTEx')]($photobagdir."/".$row[$GLOBALS['OOO0000O0']('bGl0cGlj')]);
}
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$litpic,$photobagdir ."/".$litpic_basename);
$litpic = $litpic_basename;
}
$imagesVal = "";
for ($i = 0;$i <$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUkx')]($images);$i++) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT.$images[$i])) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWwxbElJ')]($images[$i],"station") >0) {
$editok = true;
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT .$images[$i],$photobagdir ."/".$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($images[$i]));
}
$images[$i] = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($images[$i]);
}else {
$images[$i] = "";
}
$imagesVal .= "{lulin:imglist src=\"{$images[$i]}\"/}";
}
$delimgs = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsSWxs')]("|",$delimg);
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsbDFs')]($delimgs)) {
foreach ($delimgs as $r =>$v) {
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')]($photobagdir ."/".$v)) {
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsMTEx')]($photobagdir ."/".$v);
}
}
}
$addsql = "UPDATE `#@__pano_photo` SET
        title = '$title',
        litpic = '$litpic',
        imglist = '$imagesVal'            
        WHERE id=$id";
$mydb->ExecuteNoneQuery($addsql);
if($editok == true){
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;","vrpano_editphoto.php?id={$id}");
}else{
Trace("&#20462;&#25913;&#25104;&#21151;&#65281;",$endurl);
}
exit();
}
$imgdtp = new MyTagParse();
$imgdtp->SetNameSpace($GLOBALS['OOO0000O0']('bHVsaW4='),$GLOBALS['OOO0000O0']('ew=='),$GLOBALS['OOO0000O0']('fQ=='));
$imgdtp->LoadSource($row["imglist"]);
$data = "";
if ($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsbDFs')]($imgdtp->CTags)) {
foreach ($imgdtp->CTags as $imgs =>$imgctag) {
if ($imgctag->GetName() == "imglist") {
if ($data != "") {
$data .= "|";
}
$data .= $photobagurl ."/".$imgctag->GetAtt("src");
}
}
}
$scripthtml = "<script language=\"javascript\" type=\"text/javascript\">\r\n";
$scripthtml .= "$(\"#images_box\").editimgbox(\"$data\",\"images\",\"$cfg_cmspath\");\r\n";
$scripthtml .= "</script>\r\n";
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX3Bob3RvX2VkaXQuaHRt'));
?>