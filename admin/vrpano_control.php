<?php
//加密方式：phpjm加密，代码还原率100%。

//VIP会员:lirui1 您好,破解:phpjm加密,本次扣金币:5个,金币余额:5个,感谢您的支持.//此程序由【找源码】http://Www.ZhaoYuanMa.Com (VIP会员功能）在线逆向还原，QQ：7530782 
?>
<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) . "/config.php");
require_once(LULINREQ . '/tool/file.tool.php');
require_once(dirname(__FILE__) . "/inc/panomenu.php");
$endurl = GetCookie("pano_url");

$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_main` WHERE `id`=$id";
$row = $mydb->GetOne($sql);

if ($dopost == "save") {
    if($opentaocan == 1){
        $openthumb = 0;
        $opencontrol = 0;
    }
    
    $thefile = "vrpano" . $id;

    $fang[1] = "lefttop";
    $fang[2] = "top";
    $fang[3] = "righttop";
    $fang[4] = "left";
    $fang[5] = "center";
    $fang[6] = "right";
    $fang[7] = "leftbottom";
    $fang[8] = "bottom";
    $fang[9] = "rightbottom";

    if ($openthumb == 1) {
        if ($thumbtype != $row['thumbtype'] || $thumbwidth != $row['thumbwidth'] || $thumbheight != $row['thumbheight'] || $thumbx != $row['thumbx'] || $thumby != $row['thumby'] || $thumbpos != $row['thumbpos']) {
            checkdeldir(LULINROOT . "/vrpano/$thefile" . "/thumb");
        }
        if (!is_file(LULINROOT . "/vrpano/$thefile" . "/thumb/thumb.xml")) {
            checkmakedir(LULINROOT . "/vrpano/$thefile" . "/thumb");
            copydir(LULINREQ . "/vrpano/main/thumb/" . $thumbtype, LULINROOT . "/vrpano/$thefile" . "/thumb");
            $xmlfilestring = file_get_contents(LULINROOT . "/vrpano/$thefile" . "/thumb/thumb.xml");
            $xmlfilestring = str_replace("#width#", $thumbwidth, $xmlfilestring);
            $xmlfilestring = str_replace("#height#", $thumbheight, $xmlfilestring);
            $xmlfilestring = str_replace("#x#", $thumbx, $xmlfilestring);
            $xmlfilestring = str_replace("#y#", $thumby, $xmlfilestring);
            $xmlfilestring = str_replace("#thumbpos#", $fang[$thumbpos], $xmlfilestring);
            if ($thumbpos == 7 || $thumbpos == 8 || $thumbpos == 9) {
                $xmlfilestring = str_replace("#zf#", "-", $xmlfilestring);
                $xmlfilestring = str_replace("#fz#", "", $xmlfilestring);
                $xmlfilestring = str_replace("#zp#", "bottom", $xmlfilestring);
                $xmlfilestring = str_replace("#fp#", "top", $xmlfilestring);
            } else {
                $xmlfilestring = str_replace("#zf#", "", $xmlfilestring);
                $xmlfilestring = str_replace("#fz#", "-", $xmlfilestring);
                $xmlfilestring = str_replace("#zp#", "top", $xmlfilestring);
                $xmlfilestring = str_replace("#fp#", "bottom", $xmlfilestring);
            }
            $xmlfile = fopen(LULINROOT . "/vrpano/$thefile" . "/thumb/thumb.xml", "w");
            fwrite($xmlfile, $xmlfilestring);
        }
    } else {
        checkdeldir(LULINROOT . "/vrpano/$thefile" . "/thumb");
    }

    if ($opencontrol == 1) {
        if ($controltype != $row['controltype'] || $controlpos != $row['controlpos'] || $controlx != $row['controlx'] || $controly != $row['controly']) {
            checkdeldir(LULINROOT . "/vrpano/$thefile" . "/control");
        }
        if (!is_file(LULINROOT . "/vrpano/$thefile" . "/control/control.xml")) {
            checkmakedir(LULINROOT . "/vrpano/$thefile" . "/control");
            copydir(LULINREQ . "/vrpano/main/control/" . $controltype, LULINROOT . "/vrpano/$thefile" . "/control");
            $xmlfilestring = file_get_contents(LULINROOT . "/vrpano/$thefile" . "/control/control.xml");
            $xmlfilestring = str_replace("#controlpos#", $fang[$controlpos], $xmlfilestring);
            $xmlfilestring = str_replace("#x#", $controlx, $xmlfilestring);
            $xmlfilestring = str_replace("#y#", $controly, $xmlfilestring);
            if ($controlpos == 7 || $controlpos == 8 || $controlpos == 9) {
                $xmlfilestring = str_replace("#zf#", "-", $xmlfilestring);
                $xmlfilestring = str_replace("#fz#", "", $xmlfilestring);
                $xmlfilestring = str_replace("#zp#", "bottom", $xmlfilestring);
                $xmlfilestring = str_replace("#fp#", "top", $xmlfilestring);
            } else {
                $xmlfilestring = str_replace("#zf#", "", $xmlfilestring);
                $xmlfilestring = str_replace("#fz#", "-", $xmlfilestring);
                $xmlfilestring = str_replace("#zp#", "top", $xmlfilestring);
                $xmlfilestring = str_replace("#fp#", "bottom", $xmlfilestring);
            }
            $xmlfile = fopen(LULINROOT . "/vrpano/$thefile" . "/control/control.xml", "w");
            fwrite($xmlfile, $xmlfilestring);
        }
    }
    
    if($opentaocan == 1){
        if ($taocantype != $row['taocantype']) {
            checkdeldir(LULINROOT . "/vrpano/$thefile" . "/thumb");
        }
        checkdeldir(LULINROOT . "/vrpano/$thefile" . "/thumb");
        if (!is_file(LULINROOT . "/vrpano/$thefile" . "/thumb/thumb.xml")) {
            checkmakedir(LULINROOT . "/vrpano/$thefile" . "/thumb");
            copydir(LULINREQ . "/vrpano/main/taocan/" . $taocantype, LULINROOT . "/vrpano/$thefile" . "/thumb");
            $xmlfilestring = file_get_contents(LULINROOT . "/vrpano/$thefile" . "/thumb/thumb.xml");
            $xmlfilestring = str_replace("#width#", $taocanwidth, $xmlfilestring);
            $xmlfilestring = str_replace("#height#", $taocanheight, $xmlfilestring);
           
            
            $xmlfile = fopen(LULINROOT . "/vrpano/$thefile" . "/thumb/thumb.xml", "w");
            fwrite($xmlfile, $xmlfilestring);
        }
    }

    $editsql = "UPDATE `#@__pano_main` SET 
            `openthumb` = $openthumb,
            `thumbtype` = $thumbtype,
            `thumbwidth` = $thumbwidth,
            `thumbheight` = $thumbheight,
            `thumbx` = $thumbx,
            `thumby` = $thumby,
            `thumbpos` = $thumbpos,
            `opencontrol` = $opencontrol,
            `controltype` = $controltype,
            `controlpos` = $controlpos,
            `controlx` = $controlx,
            `controly` = $controly,
            `opentaocan` = $opentaocan,
            `taocantype` = '$taocantype',
            `taocanwidth` = '$taocanwidth',
            `taocanheight` = '$taocanheight'
            WHERE `id`=$id";
    $mydb->DoNotBack($editsql);
    Trace("&#20462;&#25913;&#23436;&#25104;&#65281;", "vrpano_control.php?id=$id");
    exit();
}

$thumbsql = "SELECT * FROM `#@__thumbtype` ORDER BY `id`";
$mydb->SetQuery($thumbsql);
$mydb->Execute("thumb");
$thumbtypehtml = "";

while ($thumbrow = $mydb->GetArray("thumb")) {
    if ($row['thumbtype'] == $thumbrow['id']) {
        $checkme = "checked = 'checked'";
    } else {
        $checkme = "";
    }
    $thumbtypehtml .= "<input type=\"radio\" name=\"thumbtype\" value=\"{$thumbrow['id']}\" $checkme />";
    $thumbtypehtml .= $thumbrow['title'] . "<br/>";
}
$thumbposscript = "";
$thumbposscript .= "<script type=\"text/javascript\">";
$thumbposscript .= "onetian({$row['thumbpos']});";
$thumbposscript .= "</script>";

$controlsql = "SELECT * FROM `#@__controltype` ORDER BY `id`";
$mydb->SetQuery($controlsql);
$mydb->Execute("control");
$controltypehtml = "";
while ($controlrow = $mydb->GetArray("control")) {
    if ($row['controltype'] == $controlrow['id']) {
        $checkme = "checked = 'checked'";
    } else {
        $checkme = "";
    }
    $controltypehtml .= "<input type=\"radio\" name=\"controltype\" title=\"{$controlrow['info']}\" value=\"{$controlrow['id']}\" $checkme />";
    $controltypehtml .= $controlrow['controlname'] . "<br/>";
}
$controlposscript = "";
$controlposscript .= "<script type=\"text/javascript\">";
$controlposscript .= "onecontrol({$row['controlpos']});";
$controlposscript .= "</script>";


$taocansql = "SELECT * FROM `#@__taocan` ORDER BY `id`";
$mydb->SetQuery($taocansql);
$mydb->Execute("taocan");
$taocanhtml = "";
while ($taocanrow = $mydb->GetArray("taocan")) {
    if ($row['taocantype'] == $taocanrow['id']) {
        $checkme = "checked = 'checked'";
    } else {
        $checkme = "";
    }
    $taocanhtml .= "<input type=\"radio\" name=\"taocantype\" title=\"{$taocanrow['info']}\" value=\"{$taocanrow['id']}\" $checkme />";
    $taocanhtml .= $taocanrow['title'] . "<br/>";
}

require('template/vrpano_control.htm');
?><?php
?>