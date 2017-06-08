<?php
require_once(dirname(__FILE__) . "/../config.php");
$menuArray = array();

$menuList = '
    <menu:top id="1" name="小工具"  icon="images/index/toolicon1.png">
        <menu:item name="二维码生成" link="phpqrcode" target="main" rank="" />
		<menu:item name="颜色选择器" link="cl" target="main" rank="" />
    </menu:top>
';
	



if ($cuserLogin->getUserType() >= 10) {    
    $menuList .= '
    <menu:top id="2" name="管理员功能"  icon="images/index/toolicon2.png">
        <menu:item name="热点素材" link="vrpano_spot_style.php" target="main" rank="" />
        <menu:item name="核心参数" link="sys_info.php" target="main" rank="" />
        <menu:item name="账户管理" link="sys_admin_user.php" target="main" rank="" />
        <menu:item name="数据库备份" link="sys_data.php" target="main" rank="" />
        <menu:item name="数据库还原" link="sys_data_revert.php" target="main" rank="" />
        <menu:item name="在线文件" link="file_manage_main.php" target="main" rank="" />
    </menu:top>
    ';
}

?>