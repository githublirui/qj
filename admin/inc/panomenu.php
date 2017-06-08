<?php
function panomenu($id,$n){
    global $cfg_cmspath;
    $panolist = array();
    array_push($panolist,array("name"=>"场景管理","url"=>"vrpano_scene.php"));
    array_push($panolist,array("name"=>"漫游界面","url"=>"vrpano_control.php"));
    array_push($panolist,array("name"=>"全局设置","url"=>"vrpano_edit.php"));
    array_push($panolist,array("name"=>"小地图","url"=>"vrpano_map.php"));
    array_push($panolist,array("name"=>"添加元素","url"=>"vrpano_ui.php"));
    array_push($panolist,array("name"=>"相册图集","url"=>"vrpano_photo.php"));

    $v = 1;
    $html = "";
    foreach ($panolist as $arr) {
        if($n==$v){
            $html .=  "<input type=\"button\" class=\"btn8\" value=\"{$arr['name']}\" />";
        }else{
            $html .=  "<input type=\"button\" class=\"btn7\" onclick=\"window.location.href='{$arr['url']}?id=$id'\" value=\"{$arr['name']}\" />";
        }        
        $v++;
    }
    $html .= "<input type=\"button\" class=\"btn9\" value=\"项目预览\" onclick=\"penoshow($id);\"/>\r\n";
    $html .= "<script language=\"javascript\" type=\"text/javascript\">\r\n";
    $html .= "function penoshow(n){\r\n";
    $html .= "window.open(\"{$cfg_cmspath}/vrpano/vrpano\"+n, \"vrpano\"+n);\r\n";
    $html .= "}\r\n";
    $html .= "</script>\r\n";
    return $html;
}
?>
