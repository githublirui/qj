<?php
require_once(dirname(__FILE__) ."/config.php");
require_once(LULINREQ .'/class/adminlist.class.php');
CheckPurview('sys_Group');
if (empty($page))
$page = 0;
$sql = "Select rank,typename,system From `#@__admintype`";
$dlist = new adminlist();
$dlist->pushSql($sql);
$dlist->getPage($page);
$dlist->loadTemp(LULINADMIN ."/template/sys_group.htm");
$dlist->display();
?>