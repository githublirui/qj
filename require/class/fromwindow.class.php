<?php


class fromwindow {
    var $title = '';
    var $formset = '';
    var $formend = '';
    var $formbox = '';
    
    function int($formaction="", $checkScript="", $formmethod="POST", $formname="myform"){
        $this->formset = '<form name="'.$formname.'" method="'.$formmethod.'" onSubmit="'.$checkScript.'" action="'.$formaction.'">';
        $this->formend = '</form>';
    }
    function addHidden($typestr,$valuestr){
        $this->formbox .= '<input type="hidden" name="'.$typestr.'" value="'.$valuestr.'" />';
    }
    function addTip($infostr,$textstr){
        $this->formbox .= '<tr class="tr_white" height="28" align="center"><td width="20%"><b>'.$infostr.'</b></td><td width="80%" align="left" class="td_p8">'.$textstr.'</td></tr>';
    }
    function addInput($infostr,$typestr,$namestr,$valuestr,$id){
        $this->formbox .= '<tr class="tr_white" height="28" align="center"><td width="20%"><b>'.$infostr.'</b></td><td width="80%" align="left" class="td_p8"><input id="'.$id.'" name="'.$namestr.'" type="'.$typestr.'" value="'.$valuestr.'" /></td></tr>';
    }




    function display(){
        echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>'.$this->title.'</title>
        <link href="style/common.css" rel="stylesheet" type="text/css"/></style>
    </head>
    <body>
        <div class="main">
            <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" style="background:#cfcfcf;">
                <tr class="td_title" height="34">
                    <td style="padding-left:10px;"><b>'.$this->title.'</b></td>
                </tr>
            </table>            
            <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" style="background:#cfcfcf; margin-top:4px">
                <tr class="td_title" height="28" align="center">
                    <td width="20%"><b>变量名称</b></td>
                    <td width="80%"><b>变量</b></td>
                </tr>
            '.$this->formset.$this->formbox.' 
            </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="1"  style="border:1px solid #cfcfcf;border-top:none;">
                <tr>
                    <td height="40" colspan="3">
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr>
                                <td width="11%">&nbsp;</td>
                                <td width="11%"><input type="submit" class="btn1" value="确定"/></td>
                                <td width="11%"><input type=button value="不理返回" name="btn1" class="btn1" onClick="javascript:history.go(-1);" /></td>
                                <td width="78%"><input type="button" class="btn1" value="重置" onClick="document.form1.reset()"/></td>
                                
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            '.$this->formend.'
        </div>
     </body>
</html>';
    }
}


?>
