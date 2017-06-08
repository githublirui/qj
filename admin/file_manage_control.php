<?php
require(dirname(__FILE__)."/config.php");
CheckPurview('plus_control');
require_once(LULINADMIN.'/file_class.php');
$activepath = str_replace("..","",$activepath);
$activepath = preg_replace("#^\/{1,}#","/",$activepath);
if($activepath == "/") $activepath = "";
if($activepath == "") $inpath = $cfg_basedir;
else $inpath = $cfg_basedir.$activepath;
$fmm = new FileManagement();
$fmm->Init();
if($fmdo=="rename")
{
$oldfilename = iconv( 'UTF-8','GB2312',$oldfilename);
$newfilename = iconv( 'UTF-8','GB2312',$newfilename);
$fmm->RenameFile($oldfilename,$newfilename);
}
else if($fmdo=="newdir")
{
$fmm->NewDir($newpath);
}
else if($fmdo=="move")
{
$filename = iconv( 'UTF-8','GB2312',$filename);
$fmm->MoveFile($filename,$newpath);
}
else if($fmdo=="del")
{
$filename = iconv( 'UTF-8','GB2312',$filename);
$fmm->DeleteFile($filename);
}
else if($fmdo=="edit")
{
$filename = str_replace("..","",$filename);
$file = "$cfg_basedir$activepath/$filename";
$str = stripslashes($str);
$fp = fopen($file,"w");
fputs($fp,$str);
fclose($fp);
if(empty($backurl))
{
Trace("成功保存一个文件！","file_manage_main.php?activepath=$activepath");
}
else
{
Trace("成功保存文件！",$backurl);
}
exit();
}
else if($fmdo=="upload")
{
$j=0;
for($i=1;$i<=50;$i++)
{
$upfile = "upfile".$i;
$upfile_name = "upfile".$i."_name";
if(!isset(${$upfile}) ||!isset(${$upfile_name}))
{
continue;
}
$upfile = ${$upfile};
$upfile_name = ${$upfile_name};
if(is_uploaded_file($upfile))
{
if(!file_exists($cfg_basedir.$activepath."/".$upfile_name))
{
$upfile_name = iconv( 'UTF-8','GB2312',$upfile_name);
move_uploaded_file($upfile,$cfg_basedir.$activepath."/".$upfile_name);
}
@unlink($upfile);
$j++;
}
}
Trace("成功上传 $j 个文件到: $activepath","file_manage_main.php?activepath=$activepath");
exit();
}
?>