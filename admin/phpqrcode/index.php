<?php
include "phpqrcode.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>二维码在线生成-中文二维码</title>
<meta name="keywords" content="中文二维码,二维码生成,二维码制作,手机二维码" />
<meta name="description" content="在线中文/英文二维码生成工具。" />
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<!--
制作:阿里(Ali727)
博客：http://www.ali727.com/
演示：http://www.ali727.com/files/code/
版本：V1.1
-->

<body>
<div id="all">
   <div id="title">二维码在线生成</div>
<div id="left"><form id="iform" name="iform" method="post" action=""><textarea name="content" id="content"><?php echo $_POST['content']; ?></textarea><br />
<div id="now">
<p>
请输入网页链接或内容，<input name="go" type="submit" id="go" onclick="" value="马上生成" />
<input name="done" type="hidden" value="done" />
</p>
</div>
</form>
</div>

<div id="right">
<div class="code">
<?php 
if ($_POST['done']){
   if($_POST['content']){
	$c = $_POST['content'];

	$len = strlen($c);
	   if ($len <= 360){
	    $file = fopen("t.txt","r+");
	    flock($file,LOCK_EX);
	      if($file) {
	       $get_file = fgetss($file);
	       $t = $get_file+1;
	       $file2 = fopen("t.txt","w+");
	       fwrite($file2,$t);	
	       }
	    flock($file,LOCK_UN);
	    fclose($file);
	    fclose($file2);
	
	   QRcode::png($c, 'png/'.$t.'.png');	
	   $sc = urlencode($c);
	   echo '<img src="png/'.$t.'.png" /><br />'.$c; 
	   }
	   else {
	     echo '亲！信息量过大。';
	   }	
    }
    else {
     echo '亲！你没有输入内容。';
    }
}	
else {
  echo '二维码将会出现在这里。';
}
	?>
	</div>
</div>
</div>
<div style="display:none" class="clear"></div>
<div style="display:none" id="footer">&copy; 2010-2012 www.Ali727.com V1.1 <a href="http://www.ali727.com/files/code-v1.1.zip" target="_blank">下载</a></div>
<!--<script type="text/javascript" src="http://www.ali727.com/files/tongji.js"></script>-->		
</body>
</html>
