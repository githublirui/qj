<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/tool/file.tool.php');
$endurl = GetCookie("pano_url");
if($dopost == "save"){
$mydb = new mysql();
$time = time()+28800;
$sql = "INSERT INTO `#@__pano_main` (`panoname`,`sendtime`,`zip`) VALUES ('$panoname',$time,$zip)";
$mydb->ExecNoneQuery($sql);
$mapsql = "INSERT INTO `#@__pano_map` (`openmap`) VALUES (0)";
$mydb->ExecNoneQuery($mapsql);
$getsql = "SELECT `id` FROM `#@__pano_main` ORDER BY `id` DESC";
$row = $mydb->GetOne($getsql);
$newid = $row['id'];
$newfile = "vrpano".$newid;
$editsql = "UPDATE `#@__pano_main` SET 
            filedir = '$newfile' 
            WHERE id = $newid";
$mydb->ExecNoneQuery($editsql);
checkmakedir(LULINROOT."/vrpano");
checkmakedir(LULINROOT."/vrpano/$newfile");
checkmakedir(LULINROOT."/vrpano/$newfile/js");
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
$html .= 'embedpano({swf: "krpano.swf", xml: "'.$cfg_cmspath.'/require/vrpano/config.php?id='.$newid.'", target: "vrpano", html5: "auto", passQueryParameters: true});' ."\r\n";
$html .= '</script>' ."\r\n";
$html .= '</body>' ."\r\n";
$html .= '</html>' ."\r\n";
$htmlfilename = "index.html";
$htmlfile = LULINROOT."/vrpano/$newfile"."/$htmlfilename";
$htmls = stripslashes($html);
$myfp = fopen($htmlfile,"w");
fputs($myfp,$htmls);
fclose($myfp);
copy(LULINREQ."/vrpano/main/krpano.swf",LULINROOT."/vrpano/$newfile"."/krpano.swf");
copy(LULINREQ."/vrpano/main/introimage.png",LULINROOT."/vrpano/$newfile"."/introimage.png");
copy(LULINREQ."/vrpano/main/autonextclose.png",LULINROOT."/vrpano/$newfile"."/autonextclose.png");
copy(LULINREQ."/vrpano/main/krpano.license",LULINROOT."/vrpano/$newfile"."/krpano.license");
copy(LULINREQ."/vrpano/main/krpanoiphone.license.js",LULINROOT."/vrpano/$newfile"."/krpanoiphone.license.js");
copy(LULINREQ."/vrpano/main/js/swfkrpano.js",LULINROOT."/vrpano/$newfile/swfkrpano.js");
copy(LULINREQ."/vrpano/main/js/krpanoiphone.js",LULINROOT."/vrpano/$newfile/krpanoiphone.js");
copy(LULINREQ."/vrpano/main/js/gyro.js",LULINROOT."/vrpano/$newfile/js/gyro.js");
Trace("&#28155;&#21152;&#39033;&#30446;&#25104;&#21151;&#65281;","vrpano_scene.php?id=$newid");
exit();
}
require('template/vrpano_add.htm');
?>