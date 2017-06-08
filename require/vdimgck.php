<?php
require_once (dirname(__FILE__) .'/function.inc.php');
$config = array(
'font_size'=>14,
'img_height'=>24,
'word_type'=>4,
'img_width'=>80,
'use_boder'=>TRUE,
'font_file'=>dirname(__FILE__) .'/data/fonts/ggbi.ttf',
'wordlist_file'=>dirname(__FILE__) .'/data/words/words.txt',
'filter_type'=>5);
$sessSavePath = LULINDATA ."/sessions/";
if (is_writeable($sessSavePath) &&is_readable($sessSavePath)) {
session_save_path($sessSavePath);
}
if (!empty($cfg_domain_cookie))
session_set_cookie_params(0,'/',$cfg_domain_cookie);
if (!echo_validate_image($config)) {
@session_start();
$_SESSION['securimage_code_value'] = strtolower('abcd');
$im = @imagecreatefromjpeg(dirname(__FILE__) .'/data/vdcode.jpg');
header("Pragma:no-cache\r\n");
header("Cache-Control:no-cache\r\n");
header("Expires:0\r\n");
imagejpeg($im);
imagedestroy($im);
}
function echo_validate_image($config = array()) {
@session_start();
$font_size = isset($config['font_size']) ?$config['font_size'] : 14;
$img_height = isset($config['img_height']) ?$config['img_height'] : 24;
$img_width = isset($config['img_width']) ?$config['img_width'] : 68;
$font_file = isset($config['font_file']) ?$config['font_file'] : LULINDATA .'/data/font/ggbi.ttf';
$use_boder = isset($config['use_boder']) ?$config['use_boder'] : TRUE;
$filter_type = isset($config['filter_type']) ?$config['filter_type'] : 0;
$im = @imagecreate($img_width,$img_height);
imagecolorallocate($im,255,255,255);
$fontColor[] = imagecolorallocate($im,0x15,0x15,0x15);
$fontColor[] = imagecolorallocate($im,0x95,0x1e,0x04);
$fontColor[] = imagecolorallocate($im,0x93,0x14,0xa9);
$fontColor[] = imagecolorallocate($im,0x12,0x81,0x0a);
$fontColor[] = imagecolorallocate($im,0x06,0x3a,0xd5);
$fontColor[] = imagecolorallocate($im,0xbe,0x00,0x00);
$rndstring = '';
if ($config['word_type'] != 4) {
if ($config['word_type'] != 3) {
for ($i = 0;$i <4;$i++) {
if ($config['word_type'] == 1) {
$c = chr(mt_rand(48,57));
}else if ($config['word_type'] == 2) {
$c = chr(mt_rand(65,90));
if ($c == 'I')
$c = 'P';
if ($c == 'O')
$c = 'N';
}
$rndstring .= $c;
}
}else {
$fp = @fopen($config['wordlist_file'],'rb');
if (!$fp)
return FALSE;
$fsize = filesize($config['wordlist_file']);
if ($fsize <32)
return FALSE;
if ($fsize <128) {
$max = $fsize;
}else {
$max = 128;
}
fseek($fp,rand(0,$fsize -$max),SEEK_SET);
$data = fread($fp,128);
fclose($fp);
$data = preg_replace("/\r?\n/","\n",$data);
$start = strpos($data,"\n",rand(0,100)) +1;
$end = strpos($data,"\n",$start);
$rndstring = strtolower(substr($data,$start,$end -$start));
}
$_SESSION['securimage_code_value'] = strtolower($rndstring);
}else {
$a = chr(mt_rand(48,57));
$b = chr(mt_rand(48,57));
$a = mt_rand(1,9);
$b = mt_rand(1,9);
$c = $a +$b;
$as = chr($a +48);
$bs = chr($b +48);
$_SESSION['securimage_code_value'] = strtolower($c);
$rndstring = $as ."+".$bs ."=?";
}
$rndcodelen = strlen($rndstring);
$lineColor1 = imagecolorallocate($im,0xda,0xd9,0xd1);
for ($j = 3;$j <= $img_height -3;$j = $j +3) {
imageline($im,2,$j,$img_width -2,$j,$lineColor1);
}
$lineColor2 = imagecolorallocate($im,0xaa,0xcc,0xee);
for ($j = 2;$j <100;$j = $j +6) {
imageline($im,$j,0,$j +8,$img_height,$lineColor2);
}
if ($use_boder &&$filter_type == 0) {
$bordercolor = imagecolorallocate($im,0x9d,0x9e,0x96);
imagerectangle($im,0,0,$img_width -1,$img_height -1,$bordercolor);
}
$lastc = '';
for ($i = 0;$i <$rndcodelen;$i++) {
$bc = mt_rand(0,1);
$rndstring[$i] = strtoupper($rndstring[$i]);
$c_fontColor = $fontColor[mt_rand(0,4)];
$y_pos = $i == 0 ?4 : $i * ($font_size +2);
$c = mt_rand(0,15);
@imagettftext($im,$font_size,$c,$y_pos,19,$c_fontColor,$font_file,$rndstring[$i]);
$lastc = $rndstring[$i];
}
switch ($filter_type) {
case 1:
imagefilter($im,IMG_FILTER_NEGATE);
break;
case 2:
imagefilter($im,IMG_FILTER_EMBOSS);
break;
case 3:
imagefilter($im,IMG_FILTER_EDGEDETECT);
break;
default:
break;
}
header("Pragma:no-cache\r\n");
header("Cache-Control:no-cache\r\n");
header("Expires:0\r\n");
if (function_exists("imagejpeg")) {
header("content-type:image/jpeg\r\n");
imagejpeg($im);
}else {
header("content-type:image/png\r\n");
imagepng($im);
}
imagedestroy($im);
exit();
}
?>