<?php

if (!defined('LULINREQ'))
    exit();

if (!function_exists('mkdirAll')) {

    function mkdirAll($truepath) {
        if (strstr($truepath, LULINROOT) != 0) {
            return FALSE;
            exit();
        }
        $patharr = explode(LULINROOT, $truepath);
        $path = $patharr[1];
        $filetag = explode("/", $path);
        $temp = LULINROOT . "/";
        for ($i = 1; $i < (count($filetag) - 1); $i++) {
            $temp.= $filetag[$i] . "/";
            if (is_dir($temp) == FALSE) {
                mkdir($temp);
            }
        }
    }

}

if (!function_exists('reNameMe')) {

    function reNameMe($name, $string) {
        $arr = explode(".", $name);
        return $string . "." . $arr[1];
    }

}
if (!function_exists('deldir')) {

    function deldir($dir) {
        //先删除目录下的文件：
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }

        closedir($dh);
        //删除当前文件夹：
        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('checkmakedir')) {

    function checkmakedir($dir) {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
    }

}

if (!function_exists('checkdelfile')) {

    function checkdelfile($file) {
        if (is_file($file)) {
            unlink($file);
        }
    }

}

if (!function_exists('checkdeldir')) {

    function checkdeldir($dir) {
        if (is_dir($dir)) {
            deldir($dir);
        }
    }

}

if (!function_exists('checkcopyfile')) {
    function checkcopyfile($old, $new){
        if(!is_file($new)){
            copy($old, $new);
        }
    }
}

if (!function_exists('copyimage')) {

    function copyimage($oldimg, $newimg, $k) {
        checkdelfile($newimg);
        $arr = getimagesize($oldimg);
        $width = $arr[0];
        $height = $arr[1];
        $oldtype = $arr[2];
        $testpicture = imagecreatetruecolor($width, $height);
        if ($oldtype == 1) {
            $gettestimg = @imagecreatefromgif($oldimg);
        } else if ($oldtype == 2) {
            $gettestimg = @imagecreatefromjpeg($oldimg);
        } else {
            $gettestimg = @imagecreatefrompng($oldimg);
        }
        imagecopy($testpicture, $gettestimg, 0, 0, 0, 0, $width, $height);
        if (imagejpeg($testpicture, $newimg, $k)) {
            unlink($oldimg);
        }
    }

}



if (!function_exists('copydir')) {

    function copydir($src, $dst) {  // 原目录，复制到的目录
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    copydir($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        } closedir($dir);
    }

}


if (!function_exists('copytheimage')) {

    function copytheimage($oldimg, $newimg,$w,$h,$k) {        
        checkdelfile($newimg);
        $arr = getimagesize($oldimg);
        $width = $arr[0];
        $height = $arr[1];
        $oldtype = $arr[2];
        if($w>$width){
            $w = $width;
        }
        if($h>$height){
            $h = $height;
        }
        $testpicture = imagecreatetruecolor($w, $h);
        if ($oldtype == 1) {
            $gettestimg = imagecreatefromgif($oldimg);
        } else if ($oldtype == 2) {
            $gettestimg = imagecreatefromjpeg($oldimg);
        } else {
            $gettestimg = imagecreatefrompng($oldimg);
        }        
        imagecopyresized($testpicture, $gettestimg, 0, 0, 0, 0, $w, $h, $width, $height);
        imagejpeg($testpicture, $newimg, $k);
    }

}

if (!function_exists('copyscaleimage')) {

    function copyscaleimage($oldimg, $newimg,$w,$h,$k) {        
        checkdelfile($newimg);
        $arr = getimagesize($oldimg);
        $width = $arr[0];
        $height = $arr[1];
        $oldtype = $arr[2];
        $bili = $width/$height;
        $newbili = $w/$h;
        if($bili>$newbili){
            if($w>$width){
                $w = $width;
            }
            $h = $w/$bili;
        }else{
            if($h>$height){
                $h = $height;                
            }
            $w = $h*$bili;
        }

        $testpicture = imagecreatetruecolor($w, $h);
        if ($oldtype == 1) {
            $gettestimg = imagecreatefromgif($oldimg);
        } else if ($oldtype == 2) {
            $gettestimg = imagecreatefromjpeg($oldimg);
        } else {
            $gettestimg = imagecreatefrompng($oldimg);
        }        
        imagecopyresized($testpicture, $gettestimg, 0, 0, 0, 0, $w, $h, $width, $height);
        imagejpeg($testpicture, $newimg, $k);
    }

}
?>