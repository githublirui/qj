<?php
error_reporting(E_ALL &~E_NOTICE &~E_STRICT &~E_DEPRECATED);
define('LULINREQ',str_replace("\\",'/',dirname(__FILE__)));
define('LULINROOT',str_replace("\\",'/',substr(LULINREQ,0,-8)));
define('LULINDATA',LULINROOT .'/data');
define('LULINTEMPLATE',LULINROOT .'/templets');
if (version_compare(PHP_VERSION,'5.3.0','<')) {
set_magic_quotes_runtime(0);
}
require_once(LULINREQ."/tool/requie.tool.php");
$sessSavePath = LULINDATA."/sessions/";
if(is_writeable($sessSavePath) &&is_readable($sessSavePath))
{
session_save_path($sessSavePath);
}
$cfg_basedir = preg_replace('#'.$cfg_cmspath .'\/require#i','',LULINREQ);
require_once(LULINDATA."/setting.php");
$cfg_templets_dir = $cfg_cmspath.'/templets';
$cfg_templets_skin = empty($cfg_model)?$cfg_templets_dir."/default": $cfg_templets_dir."/$cfg_model";
require_once(LULINDATA.'/config.php');
require_once(LULINREQ.'/function.func.php');
require_once(LULINREQ.'/class/mysql.class.php');
$lulinNowurl = GetCurUrl();
require_once(LULINREQ."/tool/cookie.tool.php");
require_once(LULINREQ."/tool/time.tool.php");
?>