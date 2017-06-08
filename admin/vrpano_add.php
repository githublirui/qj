<?php
if (md5($_SERVER[$GLOBALS['OOO0000O0']('SFRUUF9IT1NU')])!=$GLOBALS['OOO0000O0']('MWZlMTUzMWM0ZDE3YTM5ZWQ3OGI0Njc2Mjc0ODg0MzY=')  or  md5(gethostbyname($_SERVER[$GLOBALS['OOO0000O0']('U0VSVkVSX05BTUU=')]))!=$GLOBALS['OOO0000O0']('MjUzZWRkYjk5MTI1ZDMxMjhkNWNhZTM4MTE2MDkwMGI='))
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once($GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSUlJ')](__FILE__) ."/config.php");
require_once(LULINREQ .$GLOBALS['OOO0000O0']('L3Rvb2wvZmlsZS50b29sLnBocA=='));
$endurl = GetCookie("pano_url");
if($dopost == "save"){
$mydb = new $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlsbGxs')]();
$time = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUlJSWxJ')]()+28800;
$sql = "INSERT INTO `#@__pano_main` (`panoname`,`sendtime`,`zip`) VALUES ('$panoname',$time,$zip)";
$mydb->ExecNoneQuery($sql);
$mapsql = "INSERT INTO `#@__pano_map` (`openmap`) VALUES (0)";
$mydb->ExecNoneQuery($mapsql);
$getsql = "SELECT `id` FROM `#@__pano_main` ORDER BY `id` DESC";
$row = $mydb->GetOne($getsql);
$newid = $row[$GLOBALS['OOO0000O0']('aWQ=')];
$newfile = "vrpano".$newid;
$editsql = "UPDATE `#@__pano_main` SET 
            filedir = '$newfile' 
            WHERE id = $newid";
$mydb->ExecNoneQuery($editsql);
checkmakedir(LULINROOT."/vrpano");
checkmakedir(LULINROOT."/vrpano/$newfile");
checkmakedir(LULINROOT."/vrpano/$newfile/js");
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
$html .= $GLOBALS['OOO0000O0']('ZW1iZWRwYW5vKHtzd2Y6ICJrcnBhbm8uc3dmIiwgeG1sOiAi').$cfg_cmspath.$GLOBALS['OOO0000O0']('L3JlcXVpcmUvdnJwYW5vL2NvbmZpZy5waHA/aWQ9').$newid.$GLOBALS['OOO0000O0']('IiwgdGFyZ2V0OiAidnJwYW5vIiwgaHRtbDU6ICJhdXRvIiwgcGFzc1F1ZXJ5UGFyYW1ldGVyczogdHJ1ZX0pOw==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9zY3JpcHQ+') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9ib2R5Pg==') ."\r\n";
$html .= $GLOBALS['OOO0000O0']('PC9odG1sPg==') ."\r\n";
$htmlfilename = "index.html";
$htmlfile = LULINROOT."/vrpano/$newfile"."/$htmlfilename";
$htmls = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSUlJ')]($html);
$myfp = $GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSUkx')]($htmlfile,"w");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWxJ')]($myfp,$htmls);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWxs')]($myfp);
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/krpano.swf",LULINROOT."/vrpano/$newfile"."/krpano.swf");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/introimage.png",LULINROOT."/vrpano/$newfile"."/introimage.png");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/autonextclose.png",LULINROOT."/vrpano/$newfile"."/autonextclose.png");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/krpano.license",LULINROOT."/vrpano/$newfile"."/krpano.license");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/krpanoiphone.license.js",LULINROOT."/vrpano/$newfile"."/krpanoiphone.license.js");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/js/swfkrpano.js",LULINROOT."/vrpano/$newfile/swfkrpano.js");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/js/krpanoiphone.js",LULINROOT."/vrpano/$newfile/krpanoiphone.js");
$GLOBALS[$GLOBALS['OOO0000O0']('SUlJSUlJSUkxSWwx')](LULINREQ."/vrpano/main/js/gyro.js",LULINROOT."/vrpano/$newfile/js/gyro.js");
Trace("&#28155;&#21152;&#39033;&#30446;&#25104;&#21151;&#65281;","vrpano_scene.php?id=$newid");
exit();
}
require($GLOBALS['OOO0000O0']('dGVtcGxhdGUvdnJwYW5vX2FkZC5odG0='));
?>