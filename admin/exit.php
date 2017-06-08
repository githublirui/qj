<?php
require_once(dirname(__FILE__).'/../require/function.inc.php');
require_once(LULINREQ.'/class/userlogin.class.php');
$cuserLogin = new userLogin();
$cuserLogin->exitUser();
header('location:index.php');
?>