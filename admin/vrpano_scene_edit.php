<?php
//加密方式：phpjm加密，代码还原率100%。

//VIP会员:lirui1 您好,破解:phpjm加密,本次扣金币:5个,金币余额:5个,感谢您的支持.//此程序由【找源码】http://Www.ZhaoYuanMa.Com (VIP会员功能）在线逆向还原，QQ：7530782 
?>
<?php @eval("//www.phpjiami.com 免费版本加密! "); ?><?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
//echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) . "/config.php");
require_once(LULINREQ . '/tool/file.tool.php');
$endurl = GetCookie("pano_scene_url");

$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_scene` WHERE id = $id";
$row = $mydb->GetOne($sql);
$basedir = LULINROOT . "/vrpano/vrpano" . $row['pid'];
$baseimgdir = $cfg_cmspath . "/vrpano/vrpano" . $row['pid'] . "/images/scene{$row['rank']}";
$imgdir = LULINROOT . "/vrpano/vrpano" . $row['pid'] . "/images/scene{$row['rank']}";

$psql = "SELECT * FROM `#@__pano_main` WHERE id = {$row['pid']}";
$prow = $mydb->getOne($psql);

if ($dopost == "save") {
    checkmakedir($imgdir);
    $panoedit = 0;
    if ($type == 1) {
        checkdelfile("$imgdir/pano_front.jpg");
        checkdelfile("$imgdir/pano_back.jpg");
        checkdelfile("$imgdir/pano_left.jpg");
        checkdelfile("$imgdir/pano_right.jpg");
        checkdelfile("$imgdir/pano_up.jpg");
        checkdelfile("$imgdir/pano_down.jpg");
        if ($ballpano != "#") {
            checkdelfile("$imgdir/pano.jpg");
            copyimage(LULINROOT . $ballpano, $imgdir . "/pano.jpg", $prow['zip']);
            $panoedit = 1;
        }
    } else if ($type == 2) {
        checkdelfile("$imgdir/pano.jpg");
        if ($sixpano1 != "#") {
            checkdelfile("$imgdir/pano_front.jpg");
            copyimage(LULINROOT . $sixpano1, $imgdir . "/pano_front.jpg", $prow['zip']);
        }
        if ($sixpano2 != "#") {
            checkdelfile("$imgdir/pano_back.jpg");
            copyimage(LULINROOT . $sixpano2, $imgdir . "/pano_back.jpg", $prow['zip']);
        }
        if ($sixpano3 != "#") {
            checkdelfile("$imgdir/pano_left.jpg");
            copyimage(LULINROOT . $sixpano3, $imgdir . "/pano_left.jpg", $prow['zip']);
        }
        if ($sixpano4 != "#") {
            checkdelfile("$imgdir/pano_right.jpg");
            copyimage(LULINROOT . $sixpano4, $imgdir . "/pano_right.jpg", $prow['zip']);
        }
        if ($sixpano5 != "#") {
            checkdelfile("$imgdir/pano_up.jpg");
            copyimage(LULINROOT . $sixpano5, $imgdir . "/pano_up.jpg", $prow['zip']);
        }
        if ($sixpano6 != "#") {
            checkdelfile("$imgdir/pano_down.jpg");
            copyimage(LULINROOT . $sixpano6, $imgdir . "/pano_down.jpg", $prow['zip']);
        }
        if ($sixpano1 != "#" || $sixpano2 != "#" || $sixpano3 != "#" || $sixpano4 != "#" || $sixpano5 != "#" || $sixpano6 != "#") {
            $panoedit = 1;
        }
    } else if ($type == 3) {
        checkdelfile("$imgdir/pano_front.jpg");
        checkdelfile("$imgdir/pano_back.jpg");
        checkdelfile("$imgdir/pano_left.jpg");
        checkdelfile("$imgdir/pano_right.jpg");
        checkdelfile("$imgdir/pano_up.jpg");
        checkdelfile("$imgdir/pano_down.jpg");
        if ($pingpano != "#") {
            checkdelfile("$imgdir/pano.jpg");
            copy(LULINROOT . $pingpano, $imgdir . "/pano.jpg");
            $panoedit = 1;
        }
    }
    if ($thumb == "#") {
        $thumbcode = 1;
    } else if ($thumb == "") {
        $thumbcode = 0;
        checkdelfile($imgdir . "/thumb.jpg");
    } else {
        checkdelfile($imgdir . "/thumb.jpg");
        copyimage(LULINROOT . $thumb, $imgdir . "/thumb.jpg", $prow['zip']);
        $thumbcode = 1;
    }
    if ($luopan == "#") {
        $luopancode = 1;
    } else if ($luopan == "") {
        $luopancode = 0;
        checkdelfile($imgdir . "/luopan.jpg");
    } else {
        checkdelfile($imgdir . "/luopan.jpg");
        rename(LULINROOT . $luopan, $imgdir . "/luopan.png");
        $luopancode = 1;
    }

    if ($openlensflare == 1) {
        if (!is_file($basedir . "/plugins/flares.jpg")) {
            checkmakedir($basedir . "/plugins");
            copy(LULINROOT . "/require/vrpano/main/lensflare/flares.jpg", $basedir . "/plugins/flares.jpg");
        }
    }

    if ($soundfile != "") {
        if ($soundfile != $row['soundfile']) {
            $soundfiledir = LULINROOT . $soundfile;
            if (is_file($soundfiledir)) {
                $soundfilename = basename($soundfiledir);
                $newsoundfilename = reNameMe($soundfilename, "sound");
                checkdelfile($imgdir . "/" . $newsoundfilename);
                rename($soundfiledir, $imgdir . "/" . $newsoundfilename);
                $soundfile = $newsoundfilename;
            } else {
                $soundfile = "";
                $opensound = 0;
            }
        } else {
            if (!is_file($imgdir . "/" . $row['soundfile'])) {
                $opensound = 0;
                $soundfile = "";
            }
        }
    } else {
        $opensound = 0;
    }
    if ($opensound == 1) {
        if (!is_file($basedir . "/plugins/soundinterface.swf")) {
            checkmakedir($basedir . "/plugins");
            copy(LULINREQ . "/vrpano/main/plugins/soundinterface.swf", $basedir . "/plugins/soundinterface.swf");
            copy(LULINREQ . "/vrpano/main/plugins/soundinterface.js", $basedir . "/plugins/soundinterface.js");
            copy(LULINREQ . "/vrpano/main/plugins/soundonoff.png", $basedir . "/plugins/soundonoff.png");
        }
    }

    $editsql = "UPDATE `#@__pano_scene` SET
            `scenename` = '$scenename',
            `type` = $type,
            `thumb` = $thumbcode,
            `luopan` = $luopancode,
            `openlensflare`  = $openlensflare,
            `ath` = $ath,
            `atv` = $atv,
            `flaresize` = $flaresize,
            `flareblind` = $flareblind,
            `flareblindcurve` = $flareblindcurve ,
            `opensound` = $opensound,
            `soundfile` = '$soundfile',
            `soundtimes` = '$soundtimes',
            `fov` = '$fov',
            `hlookat` = '$hlookat',
            `soundvalue` = '$soundvalue',
            `fovmin` = '$fovmin',
            `fovmax` = '$fovmax',
            `toplook` = '$toplook',
            `downlook` = '$downlook',
            `opencut` = $opencut,
            `soundalign` = $soundalign,
            `soundx`= $soundx,
            `soundy` = $soundy
            WHERE id=$id";
    $mydb->DoNotBack($editsql);
    if ($panoedit == 0) {
        if ($type == 2 && $opencut == 1 && $row['opencut'] == 0) {
            Trace("&#20999;&#29255;&#22788;&#29702;", "vrpano_cutpian.php?id=$id");
        } else {
            Trace("&#20462;&#25913;&#23436;&#27605;", $endurl);
        }
    } else {
        Trace("&#20840;&#26223;&#22330;&#26223;&#24050;&#32463;&#20462;&#25913;&#65292;&#24320;&#22987;&#36716;&#25442;&#22270;&#29255;", "vrpano_scenemaker.php?id=$id&type=1");
    }

    exit();
}

$typejavascript = "";
$ballhtml = "";
$sixhtml = "";
$pinghtml = "";
$typejavascript .= "<script type=\"text/javascript\">\r\n";
if ($row['type'] == 1) {
    $typejavascript .= "showbox(1);\r\n";
    $ballhtml .= "<div class=\"ballpic\"><img src=\"$baseimgdir/pano.jpg\" width=\"200\" height=\"100\" /></div>\r\n";
    $ballhtml .= "<input type=\"hidden\" name=\"ballpano\" value=\"#\" id=\"ballpano\"/>\r\n";
    $sixhtml .= "<div id=\"sixtp1\" class=\"sixpic\" style=\"background-position: 0px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp2\" class=\"sixpic\" style=\"background-position: -100px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp3\" class=\"sixpic\" style=\"background-position: -200px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp4\" class=\"sixpic\" style=\"background-position: -300px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp5\" class=\"sixpic\" style=\"background-position: -400px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp6\" class=\"sixpic\" style=\"background-position: -500px 0px;\"></div>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano1\" id=\"sixpano1\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano2\" id=\"sixpano2\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano3\" id=\"sixpano3\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano4\" id=\"sixpano4\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano5\" id=\"sixpano5\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano6\" id=\"sixpano6\"/>\r\n";
    $pinghtml .= "<div class=\"pingpic\"></div>\r\n";
    $pinghtml .= "<input type=\"hidden\" name=\"pingpano\" id=\"pingpano\"/>\r\n";
} else if ($row['type'] == 2) {
    $typejavascript .= "showbox(2);\r\n";
    $ballhtml .= "<div class=\"ballpic\"></div>\r\n";
    $ballhtml .= "<input type=\"hidden\" name=\"ballpano\" id=\"ballpano\"/>\r\n";
    $sixhtml .= "<div id=\"sixtp1\" class=\"sixpic\" style=\"background-position: 0px 0px;\"><img src=\"$baseimgdir/pano_front.jpg\" width=\"100\" height=\"100\" /></div>\r\n";
    $sixhtml .= "<div id=\"sixtp2\" class=\"sixpic\" style=\"background-position: -100px 0px;\"><img src=\"$baseimgdir/pano_back.jpg\" width=\"100\" height=\"100\" /></div>\r\n";
    $sixhtml .= "<div id=\"sixtp3\" class=\"sixpic\" style=\"background-position: -200px 0px;\"><img src=\"$baseimgdir/pano_left.jpg\" width=\"100\" height=\"100\" /></div>\r\n";
    $sixhtml .= "<div id=\"sixtp4\" class=\"sixpic\" style=\"background-position: -300px 0px;\"><img src=\"$baseimgdir/pano_right.jpg\" width=\"100\" height=\"100\" /></div>\r\n";
    $sixhtml .= "<div id=\"sixtp5\" class=\"sixpic\" style=\"background-position: -400px 0px;\"><img src=\"$baseimgdir/pano_up.jpg\" width=\"100\" height=\"100\" /></div>\r\n";
    $sixhtml .= "<div id=\"sixtp6\" class=\"sixpic\" style=\"background-position: -500px 0px;\"><img src=\"$baseimgdir/pano_down.jpg\" width=\"100\" height=\"100\" /></div>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano1\" value=\"#\" id=\"sixpano1\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano2\" value=\"#\" id=\"sixpano2\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano3\" value=\"#\" id=\"sixpano3\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano4\" value=\"#\" id=\"sixpano4\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano5\" value=\"#\" id=\"sixpano5\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano6\" value=\"#\" id=\"sixpano6\"/>\r\n";
    $pinghtml .= "<div class=\"pingpic\"></div>\r\n";
    $pinghtml .= "<input type=\"hidden\" name=\"pingpano\" id=\"pingpano\"/>\r\n";
} else if ($row['type'] == 3) {
    $typejavascript .= "showbox(3);\r\n";
    $ballhtml .= "<div class=\"ballpic\"></div>\r\n";
    $ballhtml .= "<input type=\"hidden\" name=\"ballpano\" id=\"ballpano\"/>\r\n";
    $sixhtml .= "<div id=\"sixtp1\" class=\"sixpic\" style=\"background-position: 0px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp2\" class=\"sixpic\" style=\"background-position: -100px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp3\" class=\"sixpic\" style=\"background-position: -200px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp4\" class=\"sixpic\" style=\"background-position: -300px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp5\" class=\"sixpic\" style=\"background-position: -400px 0px;\"></div>\r\n";
    $sixhtml .= "<div id=\"sixtp6\" class=\"sixpic\" style=\"background-position: -500px 0px;\"></div>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano1\" id=\"sixpano1\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano2\" id=\"sixpano2\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano3\" id=\"sixpano3\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano4\" id=\"sixpano4\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano5\" id=\"sixpano5\"/>\r\n";
    $sixhtml .= "<input type=\"hidden\" name=\"sixpano6\" id=\"sixpano6\"/>\r\n";
    $pinghtml .= "<div class=\"pingpic\"><img src=\"$baseimgdir/pano.jpg\" width=\"200\" height=\"100\" /></div>\r\n";
    $pinghtml .= "<input type=\"hidden\" name=\"pingpano\"  value=\"#\" id=\"pingpano\"/>\r\n";
}
$typejavascript .= "</script>\r\n";

$thumbhtml = "";
if ($row['thumb'] == 1) {
    $thumbhtml .= "<div class=\"thumbbox\" id=\"thumbbox\"><img src=\"$baseimgdir/thumb.jpg\" onload=\"photoin(this,100,100)\" /></div>\r\n";
    $thumbhtml .= "<input id=\"thumb\" name=\"thumb\" type=\"hidden\" value=\"#\" />\r\n";
} else {
    $thumbhtml .= "<div class=\"thumbbox\" id=\"thumbbox\"></div>\r\n";
    $thumbhtml .= "<input id=\"thumb\" name=\"thumb\" type=\"hidden\" value=\"\" />\r\n";
}

$luopanhtml = "";
if ($row['luopan'] == 1) {
    $luopanhtml .= "<div class=\"luopanbox\" id=\"luopanbox\"><img src=\"$baseimgdir/luopan.png\" onload=\"photoin(this,100,100)\" /></div>\r\n";
    $luopanhtml .= "<input id=\"luopan\" name=\"luopan\" type=\"hidden\" value=\"#\" />\r\n";
} else {
    $luopanhtml .= "<div class=\"luopanbox\" id=\"luopanbox\"></div>\r\n";
    $luopanhtml .= "<input id=\"luopan\" name=\"luopan\" type=\"hidden\" value=\"\" />\r\n";
}


require('template/vrpano_scene_edit.htm');
?><?php
?>