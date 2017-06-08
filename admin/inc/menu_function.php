<?php

require_once(dirname(__FILE__) . "/../config.php");
require_once(LULINREQ . "/class/mytag.class.php");

function creatMenuList($menuData,$topos='main'){
    $menuArray = array();
    $dtp = new MyTagParse();
    $dtp->SetNameSpace('menu','<','>');
    $dtp->LoadSource($menuData);
    $dtp2 = new MyTagParse();
    $dtp2->SetNameSpace('menu','<','>');
    foreach($dtp->CTags as $k=>$val){
        if($val->GetName()=='top' && ($val->GetAtt('rank')=='' || TestPurview($val->GetAtt('rank')) )){
            
            $num = $val->GetAtt('id');            
            $menuListTittle = $val->GetAtt('name');
            $menuImage = $val->GetAtt('icon');
            if($menuImage==""){
                $menuImage = "images/index/toolicon1.png";
            }
            $menuArray['list'][$num] .= "\r\n<div class=\"cubebox\">\r\n";
            $menuArray['list'][$num] .= "   \r\n<div class=\"cube_parent\">\r\n";
            $menuArray['list'][$num] .= "       \r\n<div class=\"icon\"><img src=\"$menuImage\" /></div>\r\n";
            $menuArray['list'][$num] .= "       \r\n<div class=\"icontitle\">$menuListTittle</div>\r\n";
            $menuArray['list'][$num] .= "   \r\n</div>\r\n";
            $menuArray['list'][$num] .= "   \r\n<div class=\"cube_child\">\r\n";
            $dtp2->LoadSource($val->InnerText);
            foreach($dtp2->CTags as $k2=>$val2){
                if($val2->GetName()=='item' && ($val2->GetAtt('rank')=='' || TestPurview($val2->GetAtt('rank')) )){
                    $menuArray['list'][$num] .= "       \r\n<div class=\"cube_chbox\"><a href=\"{$val2->GetAtt('link')}\" target=\"$topos\">{$val2->GetAtt('name')}</a></div>\r\n";
                }
            }
            $menuArray['list'][$num] .= "   \r\n</div>\r\n";
            $menuArray['list'][$num] .= "\r\n</div>\r\n";
        }
    }
    for($u=1;$u<= count($menuArray['list']);$u++){
        echo $menuArray['list'][$u];
    }    
}

?>
