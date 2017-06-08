<?php



//检查和注册外部提交的变量

function CheckRequest(&$val) {
    if (is_array($val)) {
        foreach ($val as $_k => $_v) {
            if ($_k == 'nvarname')
                continue;
            CheckRequest($_k);
            CheckRequest($val[$_k]);
        }
    } else {
        if (strlen($val) > 0 && preg_match('#^(cfg_|GLOBALS|_GET|_POST|_COOKIE)#', $val)) {
            exit('Request var not allow!');
        }
    }
}


CheckRequest($_REQUEST);

foreach (Array('_GET', '_POST', '_COOKIE') as $_request) {
    foreach ($$_request as $_k => $_v) {
        if ($_k == 'nvarname')
            ${$_k} = $_v;
        else
            ${$_k} = _RunMagicQuotes($_v);
    }
}
function _RunMagicQuotes(&$svar) {
    if (!get_magic_quotes_gpc()) {
        if (is_array($svar)) {
            foreach ($svar as $_k => $_v)
                $svar[$_k] = _RunMagicQuotes($_v);
        } else {
            if (strlen($svar) > 0 && preg_match('#^(cfg_|GLOBALS|_GET|_POST|_COOKIE)#', $svar)) {
                exit('Request var not allow!');
            }
            $svar = addslashes($svar);
        }
    }
    return $svar;
}

foreach ($_FILES as $_key => $_value) {

    $$_key = $_FILES[$_key]['tmp_name'] = str_replace("\\\\", "\\", $_FILES[$_key]['tmp_name']);
    ${$_key.'_name'} = $_FILES[$_key]['name'];
    ${$_key.'_type'} = $_FILES[$_key]['type'] = preg_replace('#[^0-9a-z\./]#i', '', $_FILES[$_key]['type']);
    ${$_key.'_size'} = $_FILES[$_key]['size'] = preg_replace('#[^0-9]#','',$_FILES[$_key]['size']);
}
?>
