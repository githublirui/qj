<?php
//加密方式：phpjm加密，代码还原率100%。

//VIP会员:lirui1 您好,破解:phpjm加密,本次扣金币:5个,金币余额:0个,感谢您的支持.//此程序由【找源码】http://Www.ZhaoYuanMa.Com (VIP会员功能）在线逆向还原，QQ：7530782 
?>
<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) . "/config.php");
require_once(LULINREQ . '/tool/file.tool.php');

if (empty($id) || $id == "") {
    Trace("&#27809;&#26377;&#33719;&#21462;&#21040;id", "-1");
}
$mydb = new MySql();
$sql = "SELECT * FROM `#@__pano_main` WHERE id=$id";
$row = $mydb->getOne($sql);

$scenesql = "SELECT *  FROM `#@__pano_scene` WHERE `pid`=$id";
$mydb->SetQuery($scenesql);
$mydb->Execute("scene");


$javascript = "";
$javascript .= "<script type=\"text/javascript\">\r\n";
$javascript .= "var id = $id;\r\n";
$javascript .= "var scene = new Array();\r\n";
$javascript .= "var showpic = new Array();\r\n";
$javascript .= "var uishowpic = new Array();\r\n";
$javascript .= "var smartspot = new Array();\r\n";
$javascript .= "var video = new Array();\r\n";
$javascript .= "var applevideo = new Array();\r\n";
$javascript .= "var applevideoimg = new Array();\r\n";
$javascript .= "var photo = new Array();\r\n";
$javascript .= "var cube = new Array();\r\n";
while ($scenerow = $mydb->GetArray("scene")) {
    $javascript .= "scene.push({$scenerow['id']});\r\n";
    $spotsql = "SELECT *  FROM `#@__pano_spot` WHERE `aid` = {$scenerow['id']}";
    $mydb->SetQuery($spotsql);
    $mydb->Execute("spot");
    while ($spotrow = $mydb->GetArray("spot")) {
        if ($spotrow['spottype'] == 3) {
            $javascript .= "smartspot.push('{$spotrow['smartspotpic']}');\r\n";
        }
        if ($spotrow['spottype'] == 4) {
            $javascript .= "video.push('{$spotrow['video']}');\r\n";
            if ($spotrow['openapplevideo'] == 1) {
                $javascript .= "applevideo.push('{$spotrow['applevideo']}');\r\n";
                $javascript .= "applevideoimg.push('{$spotrow['applevideoimg']}');\r\n";
            }
        }
        if ($spotrow['action'] == 2) {
            $javascript .= "showpic.push('{$spotrow['showpic']}');\r\n";
        }
    }
}
$uisql = "SELECT *  FROM `#@__pano_ui` WHERE `pid`=$id";
$mydb->SetQuery($uisql);
$mydb->Execute("ui");
while ($uirow = $mydb->GetArray("ui")) {
    if ($uirow['action'] == 2) {
        $javascript .= "uishowpic.push('{$uirow['showpic']}');\r\n";
    }
}

$photosql = "SELECT *  FROM `#@__pano_photo` WHERE `pid`=$id";
$mydb->SetQuery($photosql);
$mydb->Execute("photo");
while ($photorow = $mydb->GetArray("photo")) {
    $javascript .= "photo.push({$photorow['rank']});\r\n";
}

$cubesql = "SELECT *  FROM `#@__pano_cube` WHERE `pid`=$id";
$mydb->SetQuery($cubesql);
$mydb->Execute("cube");
while ($cuberow = $mydb->GetArray("cube")) {
    $javascript .= "cube.push({$cuberow['rank']});\r\n";
}

$javascript .= "</script>\r\n";
require('template/vrpano_maker.htm');
?><?php
?>