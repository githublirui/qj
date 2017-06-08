<?php
require_once(dirname(__FILE__) . "/../../config.php");
if($type == 1){
    $key = "data=$type|$pic";
}else{
    $key = "data=$type|$f|$b|$l|$r|$u|$d";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>获取初始方向</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css"> 
            html {height: 100%;overflow: hidden;}
            #vrpano {height: 100%;}
            body {height: 100%;margin: 0;padding: 0;background-color: #fff;}
        </style>
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript">
            function back(h,v){
                $("#hlookat", opener.document).val(h);
                window.close();
            }
        </script>
    </head>
    <body>
        <div id="vrpano">
        </div>
        <script type="text/javascript" src="<?php echo $cmspath; ?>/require/vrpano/main/js/swfkrpano.js"></script>
        <script type="text/javascript">
            embedpano({swf: "<?php echo $cmspath; ?>/require/vrpano/main/krpano.swf", xml: "autoxml.php?<?php echo $key; ?>", target: "vrpano", html5: "auto", passQueryParameters: true, wmode: "transparent"});
        </script>
    </body>
</html>
