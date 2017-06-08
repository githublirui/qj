<?php
//加密方式：phpjm加密，代码还原率100%。

//VIP会员:lirui1 您好,破解:phpjm加密,本次扣金币:5个,金币余额:0个,感谢您的支持.//此程序由【找源码】http://Www.ZhaoYuanMa.Com (VIP会员功能）在线逆向还原，QQ：7530782 
?>
<?php @eval("//www.phpjiami.com 免费版本加密! "); ?><?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) . "/config.php");
require_once(LULINREQ . '/tool/file.tool.php');
require_once(dirname('vrpano_map.php') . "/inc/panomenu.php");
PutCookie("pano_map_url", GetCurUrl(), 3600, "/");

$mydb = new MySql();
$mainsql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$mainrow = $mydb->GetOne($mainsql);

$mapsql = "SELECT * FROM `#@__pano_map` WHERE `id`=$id";
$maprow = $mydb->GetOne($mapsql);

$basedir = LULINROOT . "/vrpano/vrpano" . $id;
$netbasedir = $cmspath . "/vrpano/vrpano" . $id;

if ($dopost == "save") {
    if ($openmap == 1) {
        checkmakedir($basedir . "/plugins");
        if (!is_file($basedir . "/plugins/radar.swf")) {
            copy(LULINREQ . "/vrpano/main/plugins/radar.swf", $basedir . "/plugins/radar.swf");
        }
        if (!is_file($basedir . "/plugins/radar.js")) {
            copy(LULINREQ . "/vrpano/main/plugins/radar.js", $basedir . "/plugins/radar.js");
        }
        if ($maptype == 2) {
            if(!is_dir($basedir."/map/span")){
                copydir(LULINREQ."/vrpano/main/map/skin", $basedir."/map/skin");
            }
            checkcopyfile(LULINREQ . "/vrpano/main/plugins/scrollarea.js", $basedir . "/plugins/scrollarea.js");
            checkcopyfile(LULINREQ . "/vrpano/main/plugins/scrollarea.swf", $basedir . "/plugins/scrollarea.swf");
            checkcopyfile(LULINREQ . "/vrpano/main/plugins/textfield.swf", $basedir . "/plugins/textfield.swf");
        }
    }

    if ($mappoint != $maprow['mappoint']) {
        if (is_file(LULINROOT . $mappoint)) {
            $mappointname = basename($mappoint);
            checkmakedir($basedir . "/map");
            checkdelfile($basedir . "/map/" . $maprow['mappoint']);
            rename(LULINROOT . $mappoint, $basedir . "/map/" . $mappointname);
            $mappoint = $mappointname;
        }
    }
    if ($mappointactive != $maprow['mappointactive']) {
        if (is_file(LULINROOT . $mappointactive)) {
            $mappointactivename = basename($mappointactive);
            checkmakedir($basedir . "/map");
            checkdelfile($basedir . "/map/" . $maprow['mappointactive']);
            rename(LULINROOT . $mappointactive, $basedir . "/map/" . $mappointactivename);
            $mappointactive = $mappointactivename;
        }
    }
    if ($mappic != $maprow['mappic']) {
        if (is_file(LULINROOT . $mappic)) {
            $mappicname = basename($mappic);
            checkmakedir($basedir . "/map");
            checkdelfile($basedir . "/map/" . $maprow['mappic']);
            rename(LULINROOT . $mappic, $basedir . "/map/" . $mappicname);
            $mappic = $mappicname;
        }
    }

    $editsql = "UPDATE `#@__pano_map` SET
            `openmap` = $openmap,
            `mappoint` = '$mappoint',
            `mappointactive` = '$mappointactive',
            `radarlength` = '$radarlength',
            `radarcolor` = '$radarcolor',
            `mappic` = '$mappic',
            `maptype` = '$maptype',
            `mapbasepos` = '$mapbasepos',
            `mapx` = '$mapx',
            `mapy` = '$mapy',
            `mapw` = '$mapw',
            `maph` = '$maph',
            `openscale` = '$openscale',
            `beforescale` = '$beforescale',
            `afterscale` = '$afterscale',
            `openhide` = '$openhide',
            `hideval` = '$hideval',
            `alpha` = '$alpha'
            WHERE id=$id";
    $mydb->DoNotBack($editsql);
    Trace("&#20462;&#25913;&#23436;&#27605;", "vrpano_map.php?id=$id");
    exit();
}

if (is_file($basedir . "/map/" . $maprow['mappoint'])) {
    $mappoint = $netbasedir . "/map/" . $maprow['mappoint'];
} else {
    checkmakedir($basedir . "/map");
    copy(LULINREQ . "/vrpano/main/map/mappoint.png", $basedir . "/map/mappoint.png");
    $mappoint = $netbasedir . "/map/mappoint.png";
}

if (is_file($basedir . "/map/" . $maprow['mappointactive'])) {
    $mappointactive = $netbasedir . "/map/" . $maprow['mappointactive'];
} else {
    checkmakedir($basedir . "/map");
    copy(LULINREQ . "/vrpano/main/map/mappointactive.png", $basedir . "/map/mappointactive.png");
    $mappointactive = $netbasedir . "/map/mappointactive.png";
}

if ($maprow['mappic'] == "") {
    $onemaphtml = "";
} else {
    $onemaphtml = "<img src=\"$netbasedir/map/{$maprow['mappic']}\" onload=\"photoin(this,120,120);\" />";
}

$showmpscript = "";
$showmpscript .= "<script type=\"text/javascript\">";
$showmpscript .= "showmp({$maprow['maptype']});";
$showmpscript .= "</script>";

$mapbassposscript = "";
$mapbassposscript .= "<script type=\"text/javascript\">";
$mapbassposscript .= "onetian({$maprow['mapbasepos']});";
$mapbassposscript .= "</script>";

$maps = "";
$mapssql = "SELECT * FROM `#@__pano_maps` WHERE `pid`=$id ORDER BY `rank`";
$mydb->SetQuery($mapssql);
$mydb->Execute("maps");
while ($mapsrow = $mydb->GetArray("maps")) {
    $maps .= "<div class=\"mapouter\">";
    $maps .= "<div class=\"map\"><span><img src=\"{$netbasedir}/map/{$mapsrow['file']}\" onload=\"photoin(this,140,140)\" /></span></div>";
    $maps .= "</div>";
}

require('template/vrpano_map.htm');
?><?php
?>