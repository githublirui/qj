<?php
error_reporting (0);
@session_start();
function file_get_contentx($url) {
$ch = curl_init();
$timeout = 5;
curl_setopt ($ch,CURLOPT_URL,$url);
curl_setopt ($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
return $file_contents;
}
function createFolder($path){
if (!file_exists($path)){
createFolder(dirname($path));
mkdir($path,0777);
}
}
class resizeimage
{
var $type;
var $width;
var $height;
var $resize_width;
var $resize_height;
var $cut;
var $srcimg;
var $dstimg;
var $im;
function resizeimage($img,$wid,$hei,$c,$dstpath)
{
$this->srcimg = $img;
$this->resize_width = $wid;
$this->resize_height = $hei;
$this->cut = $c;
$this->type = strtolower(substr(strrchr($this->srcimg,"."),1));
$this->initi_img();
$this ->dst_img($dstpath);
$this->width = imagesx($this->im);
$this->height = imagesy($this->im);
$this->newimg();
ImageDestroy ($this->im);
}
function newimg()
{
$resize_ratio = ($this->resize_width)/($this->resize_height);
$ratio = ($this->width)/($this->height);
if(($this->cut)=="1")
{
if($ratio>=$resize_ratio)
{
$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
imagecopyresampled($newimg,$this->im,0,0,0,0,$this->resize_width,$this->resize_height,(($this->height)*$resize_ratio),$this->height);
ImageJpeg ($newimg,$this->dstimg);
}
if($ratio<$resize_ratio)
{
$newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
imagecopyresampled($newimg,$this->im,0,0,0,0,$this->resize_width,$this->resize_height,$this->width,(($this->width)/$resize_ratio));
ImageJpeg ($newimg,$this->dstimg);
}
}
else
{
if($ratio>=$resize_ratio)
{
$newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
imagecopyresampled($newimg,$this->im,0,0,0,0,$this->resize_width,($this->resize_width)/$ratio,$this->width,$this->height);
ImageJpeg ($newimg,$this->dstimg);
}
if($ratio<$resize_ratio)
{
$newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
imagecopyresampled($newimg,$this->im,0,0,0,0,($this->resize_height)*$ratio,$this->resize_height,$this->width,$this->height);
ImageJpeg ($newimg,$this->dstimg);
}
}
}
function initi_img()
{
if($this->type=="jpg")
{
$this->im = imagecreatefromjpeg($this->srcimg);
}
if($this->type=="gif")
{
$this->im = imagecreatefromgif($this->srcimg);
}
if($this->type=="png")
{
$this->im = imagecreatefrompng($this->srcimg);
}
}
function dst_img($dstpath)
{
$full_length  = strlen($this->srcimg);
$type_length  = strlen($this->type);
$name_length  = $full_length-$type_length;
$name         = substr($this->srcimg,0,$name_length-1);
$this->dstimg = $dstpath;
}
}
function cp_files($rootFrom,$rootTo){
$handle=opendir($rootFrom);
while(false  !== ($file = readdir($handle))){
$fileFrom=$rootFrom.DIRECTORY_SEPARATOR.$file;
$fileTo=$rootTo.DIRECTORY_SEPARATOR.$file;
if($file=='.'||$file=='..'){continue;}
if(is_dir($fileFrom)){
mkdir($fileTo,0777);
cp_files($fileFrom,$fileTo);
}else{
@copy($fileFrom,$fileTo);
}
}
}
function qiege($wnum,$qgsrc,$filepre,$direction,$upid,$sceneid){
$w1=512;
$source = @imagecreatefromjpeg( $qgsrc );
$source_width = imagesx( $source );
$source_height = imagesy( $source );
$allsizearr = getimagesize($qgsrc);
$whsize =    $allsizearr[0];
$yuwithnum=floor($whsize/$w1);
$yuwith=$whsize-($yuwithnum*$w1);
if($yuwith==0){$yuwith=512;}
if($wnum==1){
$fn11 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_1.jpg";
$fn12 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_2.jpg";
$fn21 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_1.jpg";
$fn22 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_2.jpg";
$im11 = @imagecreatetruecolor($w1,$w1);
imagecopyresized( $im11,$source,0,0,0,0,$w1,$w1,$w1,$w1 );
imagejpeg( $im11,$fn11 );
imagedestroy( $im11 );
$im12 = @imagecreatetruecolor($yuwith,$w1);
imagecopyresized( $im12,$source,0,0,$w1,0,$yuwith,$w1,$yuwith,$w1 );
imagejpeg( $im12,$fn12 );
imagedestroy( $im12 );
$im21 = @imagecreatetruecolor($w1,$yuwith);
imagecopyresized( $im21,$source,0,0,0,$w1,$w1,$yuwith,$w1,$yuwith );
imagejpeg( $im21,$fn21 );
imagedestroy( $im21 );
$im22 = @imagecreatetruecolor($yuwith,$yuwith);
imagecopyresized( $im22,$source,0,0,$w1,$w1,$yuwith,$w1,$yuwith,$w1 );
imagejpeg( $im22,$fn22 );
imagedestroy( $im22 );
}
if($wnum==2){
$fn211 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_1.jpg";
$fn212 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_2.jpg";
$fn213 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_3.jpg";
$fn221 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_1.jpg";
$fn222 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_2.jpg";
$fn223 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_3.jpg";
$fn231 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_1.jpg";
$fn232 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_2.jpg";
$fn233 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_3.jpg";
$im211 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im211,$source,0,0,0      ,0       ,$w1,$w1,$w1,$w1 );
imagejpeg( $im211,$fn211 );imagedestroy( $im211 );
$im212 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im212,$source,0,0,$w1    ,0       ,$w1,$w1,$w1,$w1 );
imagejpeg( $im212,$fn212 );imagedestroy( $im212 );
$im213 = @imagecreatetruecolor($yuwith,$w1);imagecopyresized( $im213,$source,0,0,$w1*2  ,0       ,$yuwith,$w1,$yuwith,$w1 );
imagejpeg( $im213,$fn213 );imagedestroy( $im213 );
$im221 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im221,$source,0,0,0      ,$w1      ,$w1,$w1,$w1,$w1 );
imagejpeg( $im221,$fn221 );imagedestroy( $im221 );
$im222 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im222,$source,0,0,$w1    ,$w1      ,$w1,$w1,$w1,$w1 );
imagejpeg( $im222,$fn222 );imagedestroy( $im222 );
$im223 = @imagecreatetruecolor($yuwith,$w1);imagecopyresized( $im223,$source,0,0,$w1*2  ,$w1      ,$yuwith,$w1,$yuwith,$w1 );
imagejpeg( $im223,$fn223 );imagedestroy( $im223 );
$im231 = @imagecreatetruecolor($w1,$yuwith);imagecopyresized( $im231,$source,0,0,0      ,$w1*2    ,$w1,$yuwith,$w1,$yuwith );
imagejpeg( $im231,$fn231 );imagedestroy( $im231 );
$im232 = @imagecreatetruecolor($w1,$yuwith);imagecopyresized( $im232,$source,0,0,$w1    ,$w1*2    ,$w1,$yuwith,$w1,$yuwith );
imagejpeg( $im232,$fn232 );imagedestroy( $im232 );
$im233 = @imagecreatetruecolor($yuwith,$yuwith);imagecopyresized( $im233,$source,0,0,$w1*2,$w1*2,$yuwith,$yuwith,$yuwith,$yuwith );
imagejpeg( $im233,$fn233 );imagedestroy( $im233 );
}
if($wnum==3){
$fn411 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_1.jpg";
$fn412 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_2.jpg";
$fn413 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_3.jpg";
$fn414 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_1_4.jpg";
$fn421 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_1.jpg";
$fn422 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_2.jpg";
$fn423 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_3.jpg";
$fn424 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_2_4.jpg";
$fn431 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_1.jpg";
$fn432 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_2.jpg";
$fn433 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_3.jpg";
$fn434 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_3_4.jpg";
$fn441 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_4_1.jpg";
$fn442 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_4_2.jpg";
$fn443 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_4_3.jpg";
$fn444 = "up/".$upid."/".$sceneid."/".$filepre.$direction."_4_4.jpg";
$im411 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im411,$source,0,0,0   ,0 ,$w1 ,$w1 ,$w1 ,$w1 );imagejpeg( $im411,$fn411 );imagedestroy( $im411 );
$im412 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im412,$source,0,0,$w1  ,0 ,$w1 ,$w1 ,$w1 ,$w1 );imagejpeg( $im412,$fn412 );imagedestroy( $im412 );
$im413 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im413,$source,0,0,$w1*2 ,0 ,$w1,$w1,$w1,$w1 );imagejpeg( $im413,$fn413 );imagedestroy( $im413 );
$im414 = @imagecreatetruecolor($yuwith,$w1);imagecopyresized( $im414,$source,0,0,$w1*3 ,0 ,$yuwith,$w1,$yuwith,$w1 );imagejpeg( $im414,$fn414 );imagedestroy( $im414 );
$im421 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im421,$source,0,0,0   ,$w1,$w1,$w1,$w1,$w1 );imagejpeg( $im421,$fn421 );imagedestroy( $im421 );
$im422 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im422,$source,0,0,$w1  ,$w1,$w1,$w1,$w1,$w1 );imagejpeg( $im422,$fn422 );imagedestroy( $im422 );
$im423 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im423,$source,0,0,$w1*2 ,$w1,$w1,$w1,$w1,$w1 );imagejpeg( $im423,$fn423 );imagedestroy( $im423 );
$im424 = @imagecreatetruecolor($yuwith,$w1);imagecopyresized( $im424,$source,0,0,$w1*3 ,$w1 ,$yuwith,$w1,$yuwith,$w1 );imagejpeg( $im424,$fn424 );imagedestroy( $im424 );
$im431 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im431,$source,0,0,0   ,$w1*2,$w1,$w1,$w1,$w1 );imagejpeg( $im431,$fn431 );imagedestroy( $im431 );
$im432 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im432,$source,0,0,$w1  ,$w1*2,$w1,$w1,$w1,$w1 );imagejpeg( $im432,$fn432 );imagedestroy( $im432 );
$im433 = @imagecreatetruecolor($w1,$w1);imagecopyresized( $im433,$source,0,0,$w1*2 ,$w1*2,$w1,$w1,$w1,$w1 );imagejpeg( $im433,$fn433 );imagedestroy( $im433 );
$im434 = @imagecreatetruecolor($yuwith,$w1);imagecopyresized( $im434,$source,0,0,$w1*3 ,$w1*2,$yuwith,$w1,$yuwith,$w1 );imagejpeg( $im434,$fn434 );imagedestroy( $im434 );
$im441 = @imagecreatetruecolor($w1,$yuwith);imagecopyresized( $im441,$source,0,0,0   ,$w1*3,$w1,$yuwith,$w1,$yuwith );imagejpeg( $im441,$fn441 );imagedestroy( $im441 );
$im442 = @imagecreatetruecolor($w1,$yuwith);imagecopyresized( $im442,$source,0,0,$w1  ,$w1*3,$w1,$yuwith,$w1,$yuwith );imagejpeg( $im442,$fn442 );imagedestroy( $im442 );
$im443 = @imagecreatetruecolor($w1,$yuwith);imagecopyresized( $im443,$source,0,0,$w1*2 ,$w1*3,$w1,$yuwith,$w1,$yuwith );imagejpeg( $im443,$fn443 );imagedestroy( $im443 );
$im444 = @imagecreatetruecolor($yuwith,$yuwith);imagecopyresized( $im444,$source,0,0,$w1*3 ,$w1*3,$yuwith,$yuwith,$yuwith,$yuwith );imagejpeg( $im444,$fn444 );imagedestroy( $im444 );
}
}
class GetMacAddr   
{
var $return_array = array();
var $mac_addr;
function GetMacAddr($os_type)   
{
switch ( strtolower($os_type) )   
{
case "linux":   
$this->forLinux();
break;
case "solaris":   
break;
case "unix":   
break;
case "aix":   
break;
default:   
$this->forWindows();
break;
}
$temp_array = array();
foreach ( $this->return_array as $value )   
{
if ( preg_match( "/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i",$value,$temp_array ) )   
{
$this->mac_addr = $temp_array[0];
break;
}
}
unset($temp_array);
return $this->mac_addr;
}
function forWindows()   
{
@exec("ipconfig /all",$this->return_array);
if ( $this->return_array )   
return $this->return_array;
else{
$ipconfig = $_SERVER["WINDIR"]."\system32\ipconfig.exe";
if ( is_file($ipconfig) )   
@exec($ipconfig." /all",$this->return_array);
else  
@exec($_SERVER["WINDIR"]."\system\ipconfig.exe /all",$this->return_array);
return $this->return_array;
}
}
}
function str2hex($s,$jqm)    
{
$r = "";
$hexes = array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
for ($i=0;$i<strlen($s);$i++)    
$r .= ($hexes [(ord($s{$i}) >>4)] .$hexes [(ord($s{$i}) &0xf)]);
$r=md5($r.$jqm);
return $r;
}
function qiege6($liuyiurl){
$liuyif_q="up/q_".time().rand(0,999).".jpg";
$liuyif_h="up/h_".time().rand(0,999).".jpg";
$liuyif_z="up/z_".time().rand(0,999).".jpg";
$liuyif_y="up/y_".time().rand(0,999).".jpg";
$liuyif_s="up/s_".time().rand(0,999).".jpg";
$liuyif_x="up/x_".time().rand(0,999).".jpg";
$liuyiarr = @getimagesize($liuyiurl);
$liuyix = $liuyiarr[0];
$liuyiy = $liuyiarr[1];
$source_q = @imagecreatefromjpeg($liuyiurl);
$liuyibg_q = @imagecreatetruecolor($liuyiy,$liuyiy);
imagecopyresized($liuyibg_q,$source_q ,0,0,0   ,0 ,$liuyiy ,$liuyiy ,$liuyiy ,$liuyiy );
imagejpeg($liuyibg_q,$liuyif_q);
imagedestroy($liuyibg_q);
unset($source_q);unset($liuyibg_q);
$source_h = @imagecreatefromjpeg($liuyiurl);
$liuyibg_h = @imagecreatetruecolor($liuyiy,$liuyiy);
imagecopyresized($liuyibg_h,$source_h ,0,0,$liuyiy*2   ,0 ,$liuyiy*3 ,$liuyiy ,$liuyiy*3 ,$liuyiy );
imagejpeg($liuyibg_h,$liuyif_h);
imagedestroy($liuyibg_h);
unset($source_h);unset($liuyibg_h);
$source_z = @imagecreatefromjpeg($liuyiurl);
$liuyibg_z = @imagecreatetruecolor($liuyiy,$liuyiy);
imagecopyresized($liuyibg_z,$source_z ,0,0,$liuyiy*3   ,0 ,$liuyiy*4 ,$liuyiy ,$liuyiy*4 ,$liuyiy );
imagejpeg($liuyibg_z,$liuyif_z);
imagedestroy($liuyibg_z);
unset($source_z);unset($liuyibg_z);
$source_y = @imagecreatefromjpeg($liuyiurl);
$liuyibg_y = @imagecreatetruecolor($liuyiy,$liuyiy);
imagecopyresized($liuyibg_y,$source_y ,0,0,$liuyiy   ,0 ,$liuyiy*2 ,$liuyiy ,$liuyiy*2 ,$liuyiy );
imagejpeg($liuyibg_y,$liuyif_y);
imagedestroy($liuyibg_y);
unset($source_y);unset($liuyibg_y);
$source_s = @imagecreatefromjpeg($liuyiurl);
$liuyibg_s = @imagecreatetruecolor($liuyiy,$liuyiy);
imagecopyresized($liuyibg_s,$source_s ,0,0,$liuyiy*4   ,0 ,$liuyiy*5 ,$liuyiy ,$liuyiy*5 ,$liuyiy );
imagejpeg($liuyibg_s,$liuyif_s);
imagedestroy($liuyibg_s);
unset($source_s);unset($liuyibg_s);
$source_x = @imagecreatefromjpeg($liuyiurl);
$liuyibg_x = @imagecreatetruecolor($liuyiy,$liuyiy);
imagecopyresized($liuyibg_x,$source_x ,0,0,$liuyiy*5   ,0 ,$liuyiy*6 ,$liuyiy ,$liuyiy*6 ,$liuyiy );
imagejpeg($liuyibg_x,$liuyif_x);
imagedestroy($liuyibg_x);
unset($source_x);unset($liuyibg_x);
return $liuyif_q."|".$liuyif_h."|".$liuyif_z."|".$liuyif_y."|".$liuyif_s."|".$liuyif_x;
}
?>