<?php
require(dirname(__FILE__) ."/config.php");
CheckPurview('file_control');
if (!isset($activepath))
$activepath = "";
$inpath = "";
$activepath = str_replace("..","",$activepath);
$activepath = preg_replace("#^\/{1,}#","/",$activepath);
if ($activepath == "/")
$activepath = "";
if ($activepath == "")
$inpath = $cfg_basedir;
else
$inpath = $cfg_basedir .$activepath;
$activeurl = $activepath;
if (preg_match("#".$cfg_templets_dir ."#i",$activepath)) {
$istemplets = TRUE;
}else {
$istemplets = FALSE;
}
$dh = dir($inpath);
$ty1 = "";
$ty2 = "";
$files = $dirs = array();
while (($file = $dh->read()) !== false) {
if ($file != "."&&$file != ".."&&!is_dir("$inpath/$file")) {
@$filesize = filesize("$inpath/$file");
@$filesize = $filesize / 1024;
@$filetime = filemtime("$inpath/$file");
@$filetime = MyDate("Y-m-d H:i:s",$filetime);
if ($filesize <0.1) {
@list($ty1,$ty2) = explode(".",$filesize);
$filesize = $ty1 .".".substr($ty2,0,2);
}else {
@list($ty1,$ty2) = explode(".",$filesize);
$filesize = $ty1 .".".substr($ty2,0,1);
}
}
$file = iconv('GB2312','UTF-8',$file);
$getme = false;
if ($file == ".") {
continue;
$getme = true;
}else if ($file == "..") {
if ($activepath == "") {
continue;
}
$tmp = preg_replace("#[\/][^\/]*$#i","",$activepath);
$line = '<tr>
                <td bgcolor="#ffffff" height="25">
                    <a href=file_manage_main.php?activepath='.urlencode($tmp) .'><img src="images/file_ico/up.png" border="0" width="16" height="16" align="absmiddle">上级目录</a>
                </td>
                <td colspan="3" bgcolor="#ffffff">当前目录：<b>'.$activepath .'</b></td>
            </tr>';
$dirs[] = $line;
$getme = true;
}else if (is_dir("$inpath/$file")) {
if (preg_match("#^_(.*)$#i",$file))
continue;#屏蔽FrontPage扩展目录和linux隐蔽目录
if (preg_match("#^\.(.*)$#i",$file))
continue;
$line = '<tr bgcolor="#FFFFFF" height="26">
                <td>
                    <a href=file_manage_main.php?activepath='.urlencode("$activepath/$file") .'><img src="images/file_ico/folder.png" border="0" width="16" height="16" align="absmiddle">'.$file .'</a></td>
                <td></td>
                <td></td>
                <td>
                    <a href="file_manage_view.php?filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'&fmdo=rename">[改名]</a>
                    &nbsp;
                    <a href="file_manage_view.php?filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'&type=dir&fmdo=del">[删除]</a>
                </td>
                </td>
            </tr>';
$dirs[] = $line;
$getme = true;
}
else if (preg_match("#\.(rm|rmvb)#i",$file)) {
$line = "\n<tr bgcolor='#FFFFFF' height='26' onMouseMove=\"javascript:this.bgColor='#FCFDEE';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\">
                <td>
                    <a href=$activeurl/$file target=_blank><img src=images/rm.gif border=0 width=16 height=16 align=absmiddle>$file</a></td>
                <td>$filesize KB</td>
                <td align='center' class='linerow'>$filetime</td>
                <td>
                    <a href='file_manage_view.php?fmdo=rename&filename=".urlencode($file) ."&activepath=".urlencode($activepath) ."'>[改名]</a>
                    &nbsp;
                    <a href='file_manage_view.php?fmdo=del&filename=".urlencode($file) ."&activepath=".urlencode($activepath) ."'>[删除]</a>
                    &nbsp;
                    <a href='file_manage_view.php?fmdo=move&filename=".urlencode($file) ."&activepath=".urlencode($activepath) ."'>[移动]</a>
                </td>
            </tr>";
$files[] = $line;
$getme = true;
}
$fb1 = array("jpg","png","gif","swf","fla","avi","mov","mp3","wma","wmv","rar","zip","exe","pdf","doc","bat","7z");
foreach ($fb1 as $_k =>$_v) {
if (cheakfiletype($_v,$file)) {
$line = '<tr bgcolor="#FFFFFF" height="26">
                <td>
                    <a href="'.$activeurl .'/'.$file .'" target="_blank"><img src="images/file_ico/'.$_v .'.png" border="0" width="16" height="16" align="absmiddle">'.$file .'</a></td>
                <td>'.$filesize .' KB</td>
                <td align="center">'.$filetime .'</td>
                <td>
                    <a href="file_manage_view.php?fmdo=rename&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[改名]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=del&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[删除]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=move&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[移动]</a>
                </td>
            </tr>';
$files[] = $line;
$getme = true;
}
}
$fb2 = array("txt","php","js","css","xml","htm","html");
foreach ($fb2 as $_k =>$_v) {
if (cheakfiletype($_v,$file)) {
$edurl = "file_manage_view.php?fmdo=edit&filename=".urlencode($file) ."&activepath=".urlencode($activepath);
$line = '<tr bgcolor="#FFFFFF" height="26">
                <td>
                    <a href="'.$activeurl .'/'.$file .'" target="_blank"><img src="images/file_ico/'.$_v .'.png" border="0" width="16" height="16" align="absmiddle">'.$file .'</a></td>
                <td>'.$filesize .' KB</td>
                <td align="center">'.$filetime .'</td>
                <td>
                    <a href="'.$edurl .'">[编辑]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=rename&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[改名]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=del&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[删除]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=move&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[移动]</a>
                </td>
            </tr>';
$files[] = $line;
$getme = true;
}
}
if ($getme == false) {
$line = '<tr bgcolor="#FFFFFF" height="26">
                <td>
                    <a href="'.$activeurl .'/'.$file .'" target="_blank"><img src="images/file_ico/none.png" border="0" width="16" height="16" align="absmiddle">'.$file .'</a></td>
                <td>'.$filesize .' KB</td>
                <td align="center">'.$filetime .'</td>
                <td>
                    <a href="file_manage_view.php?fmdo=rename&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[改名]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=del&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[删除]</a>
                    &nbsp;
                    <a href="file_manage_view.php?fmdo=move&filename='.urlencode($file) .'&activepath='.urlencode($activepath) .'">[移动]</a>
                </td>
            </tr>';
$files[] = $line;
$getme = true;
}
}
function cheakfiletype($string,$file){
$arr = explode(".",$file);
$num = count($arr) -1;
if($string ==$arr[$num]&&count($arr)>1){
return TRUE;
}else{
return FALSE;
}
}
$dh->close();
include('template/file_manage_main.htm');?>