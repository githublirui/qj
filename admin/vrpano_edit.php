<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
require_once(dirname('0_vrpano_edit.php') ."/inc/panomenu.php");
$endurl = GetCookie("pano_url");
$mydb = new mysql();
$sql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$row = $mydb->GetOne($sql);
if ($dopost == "save") {
$thefile = "vrpano".$id;
if ($panoname != $row['panoname']) {
$html = "";
$html .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' ."\r\n";
$html .= '<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">' ."\r\n";
$html .= '<head>' ."\r\n";
$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' ."\r\n";
$html .= '<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />' ."\r\n";
$html .= '<meta name="apple-mobile-web-app-capable" content="yes" />' ."\r\n";
$html .= '<title>' .$panoname .'</title>' ."\r\n";
$html .= '<style type="text/css"> ' ."\r\n";
$html .= 'html {height: 100%;overflow: hidden;}' ."\r\n";
$html .= '#vrpano {height: 100%;}' ."\r\n";
$html .= 'body {height: 100%;margin: 0;padding: 0;background-color: #fff;}' ."\r\n";
$html .= '</style></head>' ."\r\n";
$html .= '<body>' ."\r\n";
$html .= '<div id="vrpano">' ."\r\n";
$html .= '</div>' ."\r\n";
$html .= '<script type="text/javascript" src="swfkrpano.js"></script>' ."\r\n";
$html .= '<script type="text/javascript">' ."\r\n";
$html .= 'embedpano({swf: "krpano.swf", xml: "' .$cfg_cmspath .'/require/vrpano/config.php?id=' .$id .'", target: "vrpano", html5: "auto", passQueryParameters: true});' ."\r\n";
$html .= '</script>' ."\r\n";
$html .= '</body>' ."\r\n";
$html .= '</html>' ."\r\n";
$htmlfilename = "index.html";
$htmlfile = LULINROOT ."/vrpano/$thefile"."/$htmlfilename";
checkdelfile($htmlfile);
$htmls = stripslashes($html);
$myfp = fopen($htmlfile,"w");
fputs($myfp,$htmls);
fclose($myfp);
}
if ($cursor == 0) {
@deldir(LULINROOT ."/vrpano/$thefile"."/cursor");
}else if ($cursor == $row['cursor']) {
}else {
checkmakedir(LULINROOT ."/vrpano/$thefile"."/cursor");
movepanocursor($cursor,LULINROOT ."/vrpano/$thefile"."/cursor");
}
if(!is_file(LULINROOT."/vrpano/$thefile"."/introimage.png")){
copy(LULINREQ."/vrpano/main/introimage.png",LULINROOT."/vrpano/$thefile"."/introimage.png");
}
if(!is_file(LULINROOT."/vrpano/$thefile"."/autonextclose.png")){
copy(LULINREQ."/vrpano/main/autonextclose.png",LULINROOT."/vrpano/$thefile"."/autonextclose.png");
}
$licenselength = count($license1);
$licensedata = "";
for ($p = 0;$p <$licenselength;$p++) {
if ($license1[$p] != "") {
if ($licensedata != "") {
$licensedata .= "&&";
}
$licensedata .= $license1[$p] ."|".$license2[$p] ."|";
if ($license3[$p] != 1) {
$license3[$p] = 0;
}
$licensedata .= $license3[$p];
}
}
if($musicfile != $row['musicfile']){
checkmakedir(LULINROOT ."/vrpano/$thefile"."/music");
checkdelfile(LULINROOT ."/vrpano/$thefile"."/music/".$row['musicfile']);
$musicfilename = basename($musicfile);
rename(LULINROOT.$musicfile,LULINROOT ."/vrpano/$thefile"."/music/".$musicfilename);
$musicfile = $musicfilename;
}
if($musicfile == ""){
$openallmusic = 0;
}
if ($openallmusic == 1) {
if (!is_file(LULINROOT ."/vrpano/$thefile"."/plugins/soundinterface.swf")) {
checkmakedir(LULINROOT ."/vrpano/$thefile"."/plugins");
copy(LULINREQ ."/vrpano/main/plugins/soundinterface.swf",LULINROOT ."/vrpano/$thefile"."/plugins/soundinterface.swf");
copy(LULINREQ ."/vrpano/main/plugins/soundinterface.js",LULINROOT ."/vrpano/$thefile"."/plugins/soundinterface.js");
copy(LULINREQ ."/vrpano/main/plugins/soundonoff.png",LULINROOT ."/vrpano/$thefile"."/plugins/soundonoff.png");
}
}
if($openautonext == 1){
$openautorate = 1;
}
$editsql = "UPDATE `#@__pano_main` SET 
            `panoname` = '$panoname',
            `zhiding` = '$zhiding',
            `cursor` = $cursor,
            `license` = '$licensedata',
            `openipadrate` = $openipadrate,
            `openautorate` = $openautorate,
            `autoratespeed` = $autoratespeed,
            `autorateaddspeed` = $autorateaddspeed,
            `autoratetime` = $autoratetime,
            `zip` = $zip,
            `openallmusic` = '$openallmusic',
            `musicfile` = '$musicfile',
            `musictimes` = '$musictimes',
            `musicvalue` = '$musicvalue',
            `cursortype` = $cursortype,
            `musicalign` = $musicalign,
            `musicx` = $musicx,
            `musicy` = $musicy,
            `openautonext` = '$openautonext',
            `autonexttime` = '$autonexttime'
            WHERE `id`=$id";
$mydb->DoNotBack($editsql);
Trace("&#20462;&#25913;&#23436;&#25104;&#65281;","vrpano_edit.php?id=$id");
exit();
}
function movepanocursor($n,$dir) {
$mydb = new mysql();
$sorsql = "SELECT * FROM `#@__pano_cursor` WHERE `id`=$n";
$sorrow = $mydb->GetOne($sorsql);
copy(LULINREQ ."/vrpano/main/cursor/cursor$n/".$sorrow['images'],$dir ."/".$sorrow['images']);
$xml = $sorrow['scriptdata'];
$num = rand(10,10000);
$xml = str_replace("###",$sorrow['images'],$xml);
$xmlname = "cursor.xml";
$xmlfile = $dir ."/$xmlname";
checkdelfile($xmlfile);
$xmls = stripslashes($xml);
$myfp = fopen($xmlfile,"w");
fputs($myfp,$xmls);
fclose($myfp);
}
$licensehtml = "";
if ($row['license'] != "") {
$licensearr = explode("&&",$row['license']);
$p = 0;
foreach ($licensearr as $licensedata) {
$licenseresult = explode("|",$licensedata);
$licensehtml .= '<tr class="tr_white" height="30">';
$licensehtml .= '<td style="text-align: center;"><input type="text" class="licbox" style="width:97%; margin: 0px;" name="license1[]" value="' .$licenseresult[0] .'"/></td>';
$licensehtml .= '<td style="text-align: center;"><input type="text" style="width:97%; margin: 0px;" name="license2[]" value="' .$licenseresult[1] .'"/></td>';
if ($licenseresult[2] == 1) {
$licensecheck = 'checked="checked"';
}else {
$licensecheck = "";
}
$licensehtml .= '<td style="text-align: center;"><input type="checkbox" value="1"  name="license3['.$p.']" ' .$licensecheck .'/></td>';
$licensehtml .= '<td style="text-align: center;"><input type="button" class="btn1" onclick="licensedel(this)" value="&#21024;&#38500;" /></td>';
$licensehtml .= '</tr>';
$p++;
}
}
require('template/vrpano_edit.htm');
?>