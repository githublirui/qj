<?php
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>全景授权码管理</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 14px;
	color: #666666;
}
.td_p8 {padding-left: 8px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.leftfont {	font-size:12px;
	font-family: "宋体";
	color: #333333;
}

-->
</style>		<style type="text/css">
<!--
body {
 background-color: #FFFFFF;
}
-->
</style></head>

<body>
';
@session_start();
include("machine.php");
$pathb3="sn.txt";
if($version==1){$sncontent= @file_get_contentx($site_path2."/sn.txt");}else{$sncontent= @file_get_contents($site_path2."/sn.txt");}
$snum=explode(",",$sncontent);
$s1=$snum[0];
$s2=$snum[1];
$s3=$snum[2];
if(str_replace(",","",trim($_POST['s1'].",".$_POST['s2'].",".$_POST['s3'].","))){
$james=fopen($pathb3,"w");
if($_POST['s1']){$st1=$_POST['s1']."";}if($_POST['s2']){$st2=$_POST['s2'].",";}if($_POST['s3']){$st3=$_POST['s3'].",";}
fwrite($james,$st1.$st2.$st3);
fclose($james);
echo "<script>alert('授权码已写入！');location.href='sn.php';</script>";
}
;echo '






<table width="615" height="400" border="0" align="center" cellpadding="0" cellspacing="0" class="leftfont">
  <tr>
    <td width="10" align="right"><p>&nbsp;</p></td>
    <td width="429" align="center" valign="middle"><p class="td_p8">授权机器编码：
	';
$mac = new GetMacAddr(PHP_OS);
$macstr=$mac->mac_addr;
$macstr=str_replace("C","X",$macstr);
$macstr=str_replace("E","P",$macstr);
$macstr=str_replace("-","Y",$macstr);
;echo '	<label for="sn"></label>
	<input name="sn" type="text" id="sn" value="';echo  $macstr;;echo '" size="30" />
	<br/><br/>(复制并发送给店小二)
	</p>

      <span class="td_p8">
      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        
        <p>
          <label for="s1"></label>
        </p>

        
        
      </form>
      </span>
      <p>&nbsp;</p>
</td>
  </tr>
  ';
if($_SESSION['user']){
;echo '  ';};echo '</table>





';include("f.php");;echo '</body>
</html>
';
?>