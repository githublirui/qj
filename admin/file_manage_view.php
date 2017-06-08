<?php
require_once(dirname(__FILE__)."/config.php");
CheckPurview('file_control');
require_once(LULINREQ."/class/fromwindow.class.php");
require_once(LULINREQ."/class/mytag.class.php");
$activepath = str_replace("..","",$activepath);
$activepath = preg_replace("#^\/{1,}#","/",$activepath);
if($activepath == "/") $activepath = "";
if($activepath == "") $inpath = $cfg_basedir;
else $inpath = $cfg_basedir.$activepath;
if($fmdo=="rename"){
$win = new fromwindow();
$win->title = '文件管理 - 更改文件名';
$win->int("file_manage_control.php","","POST","myform");
$win->addHidden("fmdo",$fmdo);
$win->addHidden("activepath",$activepath);
$win->addHidden("oldfilename",$filename);
$win->addTip("旧名称：","$filename");
$win->addInput("新名称：","input","newfilename","","newfilename");
$win->display();
}
else if($fmdo=="newdir")
{
if($activepath=="") $activepathname="根目录";
else $activepathname=$activepath;
$win = new fromwindow();
$win->title = '文件管理 - 新建目录';
$win->int("file_manage_control.php","","POST","myform");
$win->addHidden("fmdo",$fmdo);
$win->addHidden("activepath",$activepath);
$win->addTip("当前目录","$activepathname ");
$win->addInput("新目录：","input","newpath","","newpath");
$win->Display();
}
else if($fmdo=="move")
{
$win = new fromwindow();
$win->title = '文件管理 - 移动文件';
$win->int("file_manage_control.php","","POST","myform");
$win->addHidden("fmdo",$fmdo);
$win->addHidden("activepath",$activepath);
$win->addHidden("filename",$filename);
$win->addTip("被移动文件：",$filename);
$win->addTip("当前位置：",$activepath);
$win->addInput("新位置：","input","newpath","","newpath");
$win->Display();
}
else if($fmdo=="del")
{
$wintitle = "&nbsp;文件管理";
$wecome_info = "&nbsp;文件管理::删除文件 [<a href='file_manage_main.php?activepath=$activepath'>文件浏览器</a>]</a>";
$win = new fromwindow();
$win->int("file_manage_control.php","","POST","myform");
$win->addHidden("fmdo",$fmdo);
$win->addHidden("activepath",$activepath);
$win->addHidden("filename",$filename);
if(@is_dir($cfg_basedir.$activepath."/$filename"))
{
$wmsg = "你确信要删除目录：$filename 吗？";
}
else
{
$wmsg = "你确信要删除文件：$filename 吗？";
}
$win->addTip("删除文件确认：",$wmsg);
$win->Display();
}
else if($fmdo=="edit")
{
if(!isset($backurl))
{
$backurl = "";
}
$activepath = str_replace("..","",$activepath);
$filename = str_replace("..","",$filename);
$file = "$cfg_basedir$activepath/$filename";
$content = "";
if(is_file($file))
{
$fp = fopen($file,"r");
$content = fread($fp,filesize($file));
fclose($fp);
$content = htmlspecialchars($content);
}
$contentView = "<textarea name='str' style='width:99%;height:450px;'>$content</textarea>\r\n";
$GLOBALS['filename'] = $filename;
$ctp = new MyTagParse();
$ctp->LoadTemplate(LULINADMIN."/template/file_edit.htm");
$ctp->display();
}
else if($fmdo=="newfile")
{
$content = "";
$GLOBALS['filename'] = "newfile.txt";
$contentView = "<textarea name='str' style='width:99%;height:400px'></textarea>\r\n";
$ctp = new MyTagParse();
$ctp->LoadTemplate(LULINADMIN."/template/file_edit.htm");
$ctp->display();
}
else if($fmdo=="upload")
{
$ctp = new MyTagParse();
$ctp->LoadTemplate(LULINADMIN."/template/file_upload.htm");
$ctp->display();
}
?>