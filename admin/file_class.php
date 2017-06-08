<?php if(!defined('LULINREQ')) exit();
require_once(LULINREQ."/tools/ftp.tool.php");
class FileManagement
{
var $baseDir="";
var $activeDir="";
var $allowDeleteDir=0;
function Init()
{
global $cfg_basedir,$activepath;
$this->baseDir = $cfg_basedir;
$this->activeDir = $activepath;
}
function RenameFile($oldname,$newname)
{
$oldname = $this->baseDir.$this->activeDir."/".$oldname;
$newname = $this->baseDir.$this->activeDir."/".$newname;
if(($newname!=$oldname) &&is_writable($oldname))
{
rename($oldname,$newname);
}
Trace("成功更改一个文件名！","file_manage_main.php?activepath=".$this->activeDir);
return 0;
}
function NewDir($dirname)
{
$newdir = $dirname;
$dirname = $this->baseDir.$this->activeDir."/".$dirname;
if(is_writable($this->baseDir.$this->activeDir))
{
MkdirAll($dirname,$GLOBALS['cfg_dir_purview']);
CloseFtp();
Trace("成功创建一个新目录！","file_manage_main.php?activepath=".$this->activeDir."/".$newdir);
return 1;
}
else
{
Trace("创建新目录失败，因为这个位置不允许写入！","file_manage_main.php?activepath=".$this->activeDir);
return 0;
}
}
function MoveFile($mfile,$mpath)
{
if($mpath!=""&&!preg_match("#\.\.#",$mpath))
{
$oldfile = $this->baseDir.$this->activeDir."/$mfile";
$mpath = str_replace("\\","/",$mpath);
$mpath = preg_replace("#\/{1,}#","/",$mpath);
if(!preg_match("#^/#",$mpath))
{
$mpath = $this->activeDir."/".$mpath;
}
$truepath = $this->baseDir.$mpath;
if(is_readable($oldfile) &&is_readable($truepath) &&is_writable($truepath))
{
if(is_dir($truepath))
{
copy($oldfile,$truepath."/$mfile");
}
else
{
MkdirAll($truepath,$GLOBALS['cfg_dir_purview']);
CloseFtp();
copy($oldfile,$truepath."/$mfile");
}
unlink($oldfile);
Trace("成功移动文件！","file_manage_main.php?activepath=$mpath",0,1000);
return 1;
}
else
{
Trace("移动文件 $oldfile -&gt; $truepath/$mfile 失败，可能是某个位置权限不足！","file_manage_main.php?activepath=$mpath",0,1000);
return 0;
}
}
else
{
Trace("对不起，你移动的路径不合法！","-1",0,5000);
return 0;
}
}
function RmDirFiles($indir)
{
if(!is_dir($indir))
{
return ;
}
$dh = dir($indir);
while($filename = $dh->read())
{
if($filename == "."||$filename == "..")
{
continue;
}
else if(is_file("$indir/$filename"))
{
@unlink("$indir/$filename");
}
else
{
$this->RmDirFiles("$indir/$filename");
}
}
$dh->close();
@rmdir($indir);
}
function GetMatchFiles($indir,$fileexp,&$filearr)
{
$dh = dir($indir);
while($filename = $dh->read())
{
$truefile = $indir.'/'.$filename;
if($filename == "."||$filename == "..")
{
continue;
}
else if(is_dir($truefile))
{
$this->GetMatchFiles($truefile,$fileexp,$filearr);
}
else if(preg_match("/\.(".$fileexp.")/i",$filename))
{
$filearr[] = $truefile;
}
}
$dh->close();
}
function DeleteFile($filename)
{
$filename = $this->baseDir.$this->activeDir."/$filename";
if(is_file($filename))
{
@unlink($filename);$t="文件";
}
else
{
$t = "目录";
if($this->allowDeleteDir==1)
{
$this->RmDirFiles($filename);
}else
{
Trace("系统禁止删除".$t."！","file_manage_main.php?activepath=".$this->activeDir);
exit;
}
}
Trace("成功删除一个".$t."！","file_manage_main.php?activepath=".$this->activeDir);
return 0;
}
}
class SpaceUse
{
var $totalsize=0;
function checksize($indir)
{
$dh=dir($indir);
while($filename=$dh->read())
{
if(!preg_match("#^\.#",$filename))
{
if(is_dir("$indir/$filename"))
{
$this->checksize("$indir/$filename");
}
else
{
$this->totalsize=$this->totalsize +filesize("$indir/$filename");
}
}
}
}
function setkb($size)
{
$size=$size/1024;
if($size>0)
{
list($t1,$t2)=explode(".",$size);
$size=$t1.".".substr($t2,0,1);
}
return $size;
}
function setmb($size)
{
$size=$size/1024/1024;
if($size>0)
{
list($t1,$t2)=explode(".",$size);
$size=$t1.".".substr($t2,0,2);
}
return $size;
}
}?>