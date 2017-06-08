<?php
//加密方式：phpjm加密，代码还原率100%。

//VIP会员:lirui1 您好,破解:phpjm加密,本次扣金币:5个,金币余额:0个,感谢您的支持.//此程序由【找源码】http://Www.ZhaoYuanMa.Com (VIP会员功能）在线逆向还原，QQ：7530782 
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
$findsql = "SELECT `id` FROM `#@__pano_scene` WHERE pid=$id";
$mydb->SetQuery($findsql);
$mydb->Execute("find");
$autorank = $mydb->GetTotalRow("find");
if($autorank<1){
    $autorank = 1;
}else{
    $autorank ++;
}

if ($dopost == "save") {    
    $psql = "SELECT * FROM `#@__pano_main` WHERE id = $pid";
    $prow = $mydb->getOne($psql);
    $basedir = LULINROOT . "/vrpano/" . $prow['filedir'];
    checkmakedir($basedir . "/images");

    $nsql = "SELECT `rank` FROM `#@__pano_scene` WHERE pid = $pid ORDER BY `rank` DESC";
    $mydb->SetQuery($nsql);
    $mydb->Execute("n");
    $nlength = $mydb->GetTotalRow("n");
    if ($nlength < 1) {
        $rank = 1;
    } else {
        $nrow = $mydb->GetOne($nsql);
        $rank = $nrow['rank'] + 1;
    }

    $imgdir = LULINROOT . "/vrpano/" . $prow['filedir'] . "/images/scene" . $rank;
    checkdeldir($imgdir);
    checkmakedir($imgdir);

    if ($type == "1") {
        copyimage(LULINROOT . $ballpano, $imgdir . "/pano.jpg", $prow['zip']);
    }else if ($type == "2"){
        copyimage(LULINROOT . $sixpano1, $imgdir . "/pano_front.jpg", $prow['zip']);
        copyimage(LULINROOT . $sixpano2, $imgdir . "/pano_back.jpg", $prow['zip']);
        copyimage(LULINROOT . $sixpano3, $imgdir . "/pano_left.jpg", $prow['zip']);
        copyimage(LULINROOT . $sixpano4, $imgdir . "/pano_right.jpg", $prow['zip']);
        copyimage(LULINROOT . $sixpano5, $imgdir . "/pano_up.jpg", $prow['zip']);
        copyimage(LULINROOT . $sixpano6, $imgdir . "/pano_down.jpg", $prow['zip']);
    }else if ($type == "3"){
        copy(LULINROOT . $pingpano, $imgdir . "/pano.jpg");
    }

    if ($thumb == "") {
        $thumbcode = 0;
    } else {
        copyimage(LULINROOT . $thumb, $imgdir . "/thumb.jpg", $prow['zip']);
        $thumbcode = 1;
    }
    if ($luopan == "") {
        $luopancode = 0;
    } else {
        rename(LULINROOT . $luopan, $imgdir . "/luopan.png");
        $luopancode = 1;
    }
    if ($soundfile != "") {
        $soundfiledir = LULINROOT . $soundfile;
        if (is_file($soundfiledir)) {
            $soundfilename = basename($soundfiledir);
            $newsoundfilename = reNameMe($soundfilename, "sound");
            rename($soundfiledir, $imgdir . "/" . $newsoundfilename);
            $soundfile = $newsoundfilename;
        }else{
            $soundfile = "";
            $opensound = 0;
        }
    } else {
        $opensound = 0;
    }
    if($opensound == 1){
        if(!is_file($basedir."/plugins/soundinterface.swf")){
            checkmakedir($basedir."/plugins");
            copy(LULINREQ."/vrpano/main/plugins/soundinterface.swf", $basedir."/plugins/soundinterface.swf");
            copy(LULINREQ."/vrpano/main/plugins/soundinterface.js", $basedir."/plugins/soundinterface.js");
            copy(LULINREQ."/vrpano/main/plugins/soundonoff.png", $basedir."/plugins/soundonoff.png");
        }
    }

    if ($openlensflare == 1) {
        if (!is_file($basedir . "/plugins/flares.jpg")) {
            checkmakedir($basedir . "/plugins");
            copy(LULINROOT . "/require/vrpano/main/lensflare/flares.jpg", $basedir . "/plugins/flares.jpg");
        }
    }

    $sql = "INSERT INTO `#@__pano_scene` (`pid`,`type`,`scenename`,`rank`,`thumb`,`luopan`,`openlensflare`,`ath`,`atv`, `flaresize` , `flareblind` , `flareblindcurve`,`opensound`,`soundfile`,`soundtimes`,`fov`,`hlookat`,`soundvalue`,`fovmin`,`fovmax`,`toplook`,`downlook`,`opencut`,`soundalign`,`soundx`,`soundy`)
                VALUES ($pid,$type,'$scenename',$rank,$thumbcode,$luopancode,$openlensflare,$ath,$atv,$flaresize,$flareblind,$flareblindcurve,$opensound,'$soundfile',$soundtimes,'$fov','$hlookat','$soundvalue','$fovmin','$fovmax','$toplook','$downlook',$opencut,$soundalign,$soundx,$soundy)";
    $mydb->ExecNoneQuery($sql);
    
    $newsql = "SELECT * FROM `#@__pano_scene` ORDER BY `id` DESC";
    $newrow = $mydb->getOne($newsql);
    $newid = $newrow['id'];
    Trace("&#20840;&#26223;&#22330;&#26223;&#28155;&#21152;&#25104;&#21151;&#65292;&#24320;&#22987;&#36716;&#25442;&#22270;&#29255;", "vrpano_scenemaker.php?id=$newid&type=1");
    exit();
}

require('template/vrpano_scene_add.htm');
?><?php
?>