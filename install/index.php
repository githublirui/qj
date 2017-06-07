<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
@set_time_limit(0);
$s_lang = 'utf-8';
$insLockfile = dirname(__FILE__) . '/install_lock.txt';
header("Content-Type: text/html; charset={$s_lang}");

define('LULINREQ', dirname(__FILE__) . '/../require');
define('LULINDATA', dirname(__FILE__) . '/../data');
define('LULINROOT', preg_replace("#[\\\\\/]install#", '', dirname(__FILE__)));

require_once(LULINROOT . '/install/install.inc.php');

foreach (Array('_GET', '_POST', '_COOKIE') as $_request) {
    foreach ($$_request as $_k => $_v)
        ${$_k} = RunMagicQuotes($_v);
}
require_once(LULINREQ . '/function.func.php');
require_once(LULINREQ . '/tool/time.tool.php');

if (file_exists($insLockfile)) {
    exit(" 全景生成精灵程序已安装！");
}

if (empty($step)) {
    $step = 2;
}
if ($step == 2) {
    $phpv = phpversion();
    $sp_os = PHP_OS;
    $sp_gd = gdversion();
    $sp_server = $_SERVER['SERVER_SOFTWARE'];
    $sp_host = (empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR']);
    $sp_name = $_SERVER['SERVER_NAME'];
    $sp_max_execution_time = ini_get('max_execution_time');
    $sp_allow_reference = (ini_get('allow_call_time_pass_reference') ? '<font color="green">[√]On</font>' : '<font color="red">[×]Off</font>');
    $sp_safe_mode = (ini_get('safe_mode') ? '<font color="red">[×]On</font>' : '<font color="green">[√]Off</font>');
    $sp_gd = ($sp_gd > 0 ? '<font color="green">[√]On</font>' : '<font color="red">[×]Off</font>');
    $sp_mysql = (function_exists('mysql_connect') ? '<font color="green">[√]On</font>' : '<font color="red">[×]Off</font>');

    if ($sp_mysql == '<font color=red>[×]Off</font>')
        $sp_mysql_err = TRUE;
    else
        $sp_mysql_err = FALSE;

    $sp_testdirs = array(
        '/require/*',
        '/data/*',
        '/install',
        '/uploads/*',
        '/putout/*',
        '/vrpano/*'
    );
    
    include('./template/step2.html');
    exit();
}else if ($step == 3) {
    if (!empty($_SERVER['REQUEST_URI'])){
        $scriptName = $_SERVER['REQUEST_URI'];
    }else{
        $scriptName = $_SERVER['PHP_SELF'];
    }
    $basepath = preg_replace("#\/install(.*)$#i", '', $scriptName);
    
    if (!empty($_SERVER['HTTP_HOST'])){
        $baseurl = 'http://' . $_SERVER['HTTP_HOST'];
    }else{
        $baseurl = "http://" . $_SERVER['SERVER_NAME'];
    }
    
    $rnd_cookieEncode = chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('a'), ord('z'))) . chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('a'), ord('z'))) . mt_rand(1000, 9999) . chr(mt_rand(ord('A'), ord('Z')));

    include('./template/step3.html');
    exit();
}else if ($step == 4) {
    if($debug == "111"){
        exit("安装不成功，请检查加密锁。");
    }
    $conn = mysql_connect($dbhost, $dbuser, $dbpwd) or die("<script type='text/javascript'>alert('数据库服务器或登录密码无效，\\n\\n无法连接数据库，请重新设定！');history.go(-1);</script>");
    mysql_query("CREATE DATABASE IF NOT EXISTS `" . $dbname . "`;", $conn);
    mysql_select_db($dbname) or die("<script type='text/javascript'>alert('选择数据库失败，可能是你没权限，请预先创建一个数据库！');history.go(-1);</script>");
    mysql_query("ALTER DATABASE `$dbname` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci", $conn);
    $rs = mysql_query("SELECT VERSION();", $conn);
    $row = mysql_fetch_array($rs);
    $mysqlVersions = explode('.', trim($row[0]));
    $mysqlVersion = $mysqlVersions[0] . "." . $mysqlVersions[1];
    mysql_query("SET NAMES '$dblang',character_set_client=binary,sql_mode='';", $conn);

    $fp1 = fopen(dirname(__FILE__) . "/config.cache.php", "r");
    $configStr1 = fread($fp1, filesize(dirname(__FILE__) . "/config.cache.php"));
    fclose($fp1);

    $fp2 = fopen(dirname(__FILE__) . "/setting.cache.php", "r");
    $configStr2 = fread($fp2, filesize(dirname(__FILE__) . "/setting.cache.php"));
    fclose($fp2);

    //config.cache.php
    $configStr1 = str_replace("~dbhost~", $dbhost, $configStr1);
    $configStr1 = str_replace("~dbname~", $dbname, $configStr1);
    $configStr1 = str_replace("~dbuser~", $dbuser, $configStr1);
    $configStr1 = str_replace("~dbpwd~", $dbpwd, $configStr1);
    $configStr1 = str_replace("~dbprefix~", $dbprefix, $configStr1);
    $configStr1 = str_replace("~dblang~", $dblang, $configStr1);
    $configStr1 = str_replace("~debug~", $debug, $configStr1);

    @chmod(LULINDATA, 0777);
    $fp3 = fopen(LULINDATA . "/config.php", "w") or die("<script>alert('写入配置失败，请检查../data目录是否可写入！');history.go(-1);</script>");
    fwrite($fp3, $configStr1);
    fclose($fp3);

    //setting.cache.php
    $cmspath = trim(preg_replace("#\/{1,}#", '/', $cmspath));
    if ($cmspath != '' && !preg_match("#^\/#", $cmspath))
        $cmspath = '/' . $cmspath;

    if ($cmspath == '')
        $indexUrl = '/';
    else
        $indexUrl = $cmspath;

    $configStr2 = str_replace("~baseurl~", $baseurl, $configStr2);
    $configStr2 = str_replace("~cmpath~", $cmspath, $configStr2);
    $configStr2 = str_replace("~cookieEncode~", $cookieencode, $configStr2);
    $configStr2 = str_replace("~webname~", $webname, $configStr2);
    $configStr2 = str_replace("~dblang~", $s_lang, $configStr2);

    $fp4 = fopen(LULINDATA . '/setting.php', 'w');
    fwrite($fp4, $configStr2);
    fclose($fp4);

    $fp5 = fopen(LULINDATA . '/setting.bak.php', 'w');
    fwrite($fp5, $configStr2);
    fclose($fp5);

    if ($mysqlVersion >= 4.1) {
        $sql4tmp = "ENGINE=MyISAM DEFAULT CHARSET=" . $dblang;
    }

    //创建数据表

    $query = '';
    $fp6 = fopen(dirname(__FILE__) . '/sql-dftables.txt', 'r');
    while (!feof($fp6)) {
        $line = rtrim(fgets($fp6, 1024));
        if (preg_match("#;$#", $line)) {
            $query .= $line . "\n";
            $query = str_replace('#@__', $dbprefix, $query);
            if ($mysqlVersion < 4.1) {
                $rs = mysql_query($query, $conn);
            } else {
                if (preg_match('#CREATE#i', $query)) {
                    $rs = mysql_query(preg_replace("#TYPE=MyISAM#i", $sql4tmp, $query), $conn);
                } else {
                    $rs = mysql_query($query, $conn);
                }
            }
            $query = '';
        } else if (!preg_match("#^(\/\/|--)#", $line)) {
            $query .= $line;
        }
    }
    fclose($fp6);

    //导入默认数据
    $query = '';
    $fp7 = fopen(dirname(__FILE__) . '/sql-dfdata.txt', 'r');
    while (!feof($fp7)) {
        $line = rtrim(fgets($fp7, 1024));
        if (preg_match("#;$#", $line)) {
            $query .= $line;
            $query = str_replace('#@__', $dbprefix, $query);
            if ($mysqlVersion < 4.1)
                $rs = mysql_query($query, $conn);
            else
                $rs = mysql_query(str_replace('#~lang~#', $dblang, $query), $conn);
            $query = '';
        } else if (!preg_match("#^(\/\/|--)#", $line)) {
            $query .= $line;
        }
    }
    fclose($fp7);

    $cquery = "Update `{$dbprefix}sysconfig` set value='{$baseurl}' where varname='cfg_basehost';";
    mysql_query($cquery, $conn);
    $cquery = "Update `{$dbprefix}sysconfig` set value='{$cmspath}' where varname='cfg_cmspath';";
    mysql_query($cquery, $conn);
    $cquery = "Update `{$dbprefix}sysconfig` set value='{$cookieencode}' where varname='cfg_cookie_encode';";
    mysql_query($cquery, $conn);
    $cquery = "Update `{$dbprefix}sysconfig` set value='{$webname}' where varname='cfg_webname';";
    mysql_query($cquery, $conn);

    //增加管理员帐号
    $adminquery = "INSERT INTO `{$dbprefix}admin` VALUES (1, 10, '$adminuser', '" . substr(md5($adminpwd), 5, 20) . "', 'admin', '', '', 0, '" . time() . "', '127.0.0.1');";
    mysql_query($adminquery, $conn);

    //锁定安装程序
    $fp = fopen($insLockfile, 'w');
    fwrite($fp, 'ok');
    fclose($fp);
    include('./template/step4.html');
    exit();
}




else if ($step == 10) {
    header("Pragma:no-cache\r\n");
    header("Cache-Control:no-cache\r\n");
    header("Expires:0\r\n");
    $conn = @mysql_connect($db_h, $db_u, $db_p);
    if ($conn) {
        echo "数据库连接成功！";
    } else {
        echo "数据库连接失败！";
    }
    @mysql_close($conn);
    exit();
}else if ($step == 11) {
    header("Pragma:no-cache\r\n");
    header("Cache-Control:no-cache\r\n");
    header("Expires:0\r\n");
    $conn = @mysql_connect($db_h, $db_u, $db_p);
    $info = @mysql_select_db($dbname, $conn);
    if($info){
        echo "数据库已经存在，系统将覆盖数据库！";
    }else{
        echo "数据库不存在,系统将自动创建！";
    }
    @mysql_close($conn);
    exit();
}
?>
