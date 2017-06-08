<?php
//加密方式：phpjm加密，代码还原率100%。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (VIP会员功能）在线逆向还原，QQ：7530782 
?>
<?php
if (md5($_SERVER['HTTP_HOST'])!='1fe1531c4d17a39ed78b467627488436'  or  md5(gethostbyname($_SERVER['SERVER_NAME']))!='253eddb99125d3128d5cae381160900b')
{
echo ("<script type='text/javascript'> alert('Passport Error!');history.go(-1);</script>");
}
require_once(dirname(__FILE__) . "/config.php");
require_once(dirname('vrpano_scene.php') . "/inc/panomenu.php");
require_once(LULINREQ . '/class/adminlist.class.php');
PutCookie("pano_scene_url", GetCurUrl(),time() + 3600,"/");
if (empty($id)) {
    Trace('<b>?#20146;&#65292;&#35835;&#19981;&#21040;$id?/b>&#19981;&#33021;&#20026;&#31354;&#65281;', "-1");
    exit();
}
$sql = "SELECT * FROM `#@__pano_scene` WHERE pid = $id ORDER BY `rank`";


if(empty ($page)){
    $page = 0;
}
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN . "/template/vrpano_scene.htm");
$dlist->display();

function cheaktype($n){
    if($n ==1 ){
        return "&#29699;&#24418;&#20840;&#26223;&#22270;";
    }else{
        return "&#31435;&#26041;&#20307;&#20840;&#26223;&#22270;";
    }
}

function hotsopt($sceneid){
    $mydbs = new MySql();
    $spotsql = "SELECT * FROM `#@__pano_spot` WHERE aid = $sceneid";
    $mydbs->SetQuery($spotsql);
    $mydbs->Execute("spot");
    $spotlen = $mydbs->GetTotalRow("spot");
    if(!$spotlen> 0){
        $spotlen = "&#26080;";
    }
    return $spotlen;
}
function checkthumb($sceneid){
    if($sceneid == 0){
        return "&#26080;";
    }else{
        return "&#26377;";
    }
    return $spotlen;
}
?><?php
?>