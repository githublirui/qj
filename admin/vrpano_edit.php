<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')]($GLOBALS['OOO0000O0']('MF92cnBhbm9fZWRpdC5waHA=')) ."/inc/panomenu.php");
$endurl = GetCookie("pano_url");
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$row = $mydb->GetOne($sql);
if ($dopost == "save") {
$thefile = "vrpano".$id;
if ($panoname != $row[$GLOBALS['OOO0000O0']('cGFub25hbWU=')]) {
$html = "";
$html .= $GLOBALS['OOO0000O0']('PCFET0NUWVBFIGh0bWwgUFVCTElDICItLy9XM0MvL0RURCBYSFRNTCAxLjAgU3RyaWN0Ly9FTiIgImh0dHA6Ly93d3cudzMub3JnL1RSL3hodG1sMS9EVEQveGh0bWwxLXN0cmljdC5kdGQiPg==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PGh0bWwgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGh0bWwiIGxhbmc9ImVuIiB4bWw6bGFuZz0iZW4iPg==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PGhlYWQ+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1UeXBlIiBjb250ZW50PSJ0ZXh0L2h0bWw7IGNoYXJzZXQ9dXRmLTgiIC8+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PG1ldGEgbmFtZT0idmlld3BvcnQiIGNvbnRlbnQ9InRhcmdldC1kZW5zaXR5ZHBpPWRldmljZS1kcGksIHdpZHRoPWRldmljZS13aWR0aCwgaW5pdGlhbC1zY2FsZT0xLjAsIG1pbmltdW0tc2NhbGU9MS4wLCBtYXhpbXVtLXNjYWxlPTEuMCIgLz4=') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PG1ldGEgbmFtZT0iYXBwbGUtbW9iaWxlLXdlYi1hcHAtY2FwYWJsZSIgY29udGVudD0ieWVzIiAvPg==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PHRpdGxlPg==') .$panoname .$GLOBALS['OOO0000O0']('PC90aXRsZT4=') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PHN0eWxlIHR5cGU9InRleHQvY3NzIj4g') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('aHRtbCB7aGVpZ2h0OiAxMDAlO292ZXJmbG93OiBoaWRkZW47fQ==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('I3ZycGFubyB7aGVpZ2h0OiAxMDAlO30=') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('Ym9keSB7aGVpZ2h0OiAxMDAlO21hcmdpbjogMDtwYWRkaW5nOiAwO2JhY2tncm91bmQtY29sb3I6ICNmZmY7fQ==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9zdHlsZT48L2hlYWQ+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PGJvZHk+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PGRpdiBpZD0idnJwYW5vIj4=') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9kaXY+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0ic3dma3JwYW5vLmpzIj48L3NjcmlwdD4=') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPg==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('ZW1iZWRwYW5vKHtzd2Y6ICJrcnBhbm8uc3dmIiwgeG1sOiAi') .$cfg_cmspath .$GLOBALS['OOO0000O0']('L3JlcXVpcmUvdnJwYW5vL2NvbmZpZy5waHA/aWQ9') .$id .$GLOBALS['OOO0000O0']('IiwgdGFyZ2V0OiAidnJwYW5vIiwgaHRtbDU6ICJhdXRvIiwgcGFzc1F1ZXJ5UGFyYW1ldGVyczogdHJ1ZX0pOw==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9zY3JpcHQ+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9ib2R5Pg==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9odG1sPg==') ."\r\n";
$htmlfilename = "index.html";
$htmlfile = LULINROOT ."/vrpano/$thefile"."/$htmlfilename";
checkdelfile($htmlfile);
$htmls = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSUlJ')]($html);
$myfp = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSUkx')]($htmlfile,"w");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWxJ')]($myfp,$htmls);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWxs')]($myfp);
}
if ($cursor == 0) {
@deldir(LULINROOT ."/vrpano/$thefile"."/cursor");
}else if ($cursor == $row[$GLOBALS['OOO0000O0']('Y3Vyc29y')]) {
}else {
checkmakedir(LULINROOT ."/vrpano/$thefile"."/cursor");
movepanocursor($cursor,LULINROOT ."/vrpano/$thefile"."/cursor");
}
if(!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT."/vrpano/$thefile"."/introimage.png")){
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/introimage.png",LULINROOT."/vrpano/$thefile"."/introimage.png");
}
if(!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT."/vrpano/$thefile"."/autonextclose.png")){
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/autonextclose.png",LULINROOT."/vrpano/$thefile"."/autonextclose.png");
}
$licenselength = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUkx')]($license1);
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
if($musicfile != $row[$GLOBALS['OOO0000O0']('bXVzaWNmaWxl')]){
checkmakedir(LULINROOT ."/vrpano/$thefile"."/music");
checkdelfile(LULINROOT ."/vrpano/$thefile"."/music/".$row[$GLOBALS['OOO0000O0']('bXVzaWNmaWxl')]);
$musicfilename = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUls')]($musicfile);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJSUkx')](LULINROOT.$musicfile,LULINROOT ."/vrpano/$thefile"."/music/".$musicfilename);
$musicfile = $musicfilename;
}
if($musicfile == ""){
$openallmusic = 0;
}
if ($openallmusic == 1) {
if (!$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxMUlJ')](LULINROOT ."/vrpano/$thefile"."/plugins/soundinterface.swf")) {
checkmakedir(LULINROOT ."/vrpano/$thefile"."/plugins");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/soundinterface.swf",LULINROOT ."/vrpano/$thefile"."/plugins/soundinterface.swf");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/soundinterface.js",LULINROOT ."/vrpano/$thefile"."/plugins/soundinterface.js");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/plugins/soundonoff.png",LULINROOT ."/vrpano/$thefile"."/plugins/soundonoff.png");
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
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$sorsql = "SELECT * FROM `#@__pano_cursor` WHERE `id`=$n";
$sorrow = $mydb->GetOne($sorsql);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ ."/vrpano/main/cursor/cursor$n/".$sorrow[$GLOBALS['OOO0000O0']('aW1hZ2Vz')],$dir ."/".$sorrow[$GLOBALS['OOO0000O0']('aW1hZ2Vz')]);
$xml = $sorrow[$GLOBALS['OOO0000O0']('c2NyaXB0ZGF0YQ==')];
$num = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxJMTFs')](10,10000);
$xml = str_replace("###",$sorrow[$GLOBALS['OOO0000O0']('aW1hZ2Vz')],$xml);
$xmlname = "cursor.xml";
$xmlfile = $dir ."/$xmlname";
checkdelfile($xmlfile);
$xmls = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSUlJ')]($xml);
$myfp = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSUkx')]($xmlfile,"w");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWxJ')]($myfp,$xmls);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWxs')]($myfp);
}
$licensehtml = "";
if ($row[$GLOBALS['OOO0000O0']('bGljZW5zZQ==')] != "") {
$licensearr = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsSWxs')]("&&",$row[$GLOBALS['OOO0000O0']('bGljZW5zZQ==')]);
$p = 0;
foreach ($licensearr as $licensedata) {
$licenseresult = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSWxsSWxs')]("|",$licensedata);
$licensehtml .= $GLOBALS['OOO0000O0']('PHRyIGNsYXNzPSJ0cl93aGl0ZSIgaGVpZ2h0PSIzMCI+');
$licensehtml .= $GLOBALS['OOO0000O0']('PHRkIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij48aW5wdXQgdHlwZT0idGV4dCIgY2xhc3M9ImxpY2JveCIgc3R5bGU9IndpZHRoOjk3JTsgbWFyZ2luOiAwcHg7IiBuYW1lPSJsaWNlbnNlMVtdIiB2YWx1ZT0i') .$licenseresult[0] .$GLOBALS['OOO0000O0']('Ii8+PC90ZD4=');
$licensehtml .= $GLOBALS['OOO0000O0']('PHRkIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij48aW5wdXQgdHlwZT0idGV4dCIgc3R5bGU9IndpZHRoOjk3JTsgbWFyZ2luOiAwcHg7IiBuYW1lPSJsaWNlbnNlMltdIiB2YWx1ZT0i') .$licenseresult[1] .$GLOBALS['OOO0000O0']('Ii8+PC90ZD4=');
if ($licenseresult[2] == 1) {
$licensecheck = $GLOBALS['OOO0000O0']('Y2hlY2tlZD0iY2hlY2tlZCI=');
}else {
$licensecheck = "";
}
$licensehtml .= $GLOBALS['OOO0000O0']('PHRkIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij48aW5wdXQgdHlwZT0iY2hlY2tib3giIHZhbHVlPSIxIiAgbmFtZT0ibGljZW5zZTNb').$p.$GLOBALS['OOO0000O0']('XSIg') .$licensecheck .$GLOBALS['OOO0000O0']('Lz48L3RkPg==');
$licensehtml .= $GLOBALS['OOO0000O0']('PHRkIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij48aW5wdXQgdHlwZT0iYnV0dG9uIiBjbGFzcz0iYnRuMSIgb25jbGljaz0ibGljZW5zZWRlbCh0aGlzKSIgdmFsdWU9IiYjMjEwMjQ7JiMzODUwMDsiIC8+PC90ZD4=');
$licensehtml .= $GLOBALS['OOO0000O0']('PC90cj4=');
$p++;
}
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX2VkaXQuaHRt'));
?>