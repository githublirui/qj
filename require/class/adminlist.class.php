<?php

require_once(LULINREQ . '/class/mytag.class.php');

class adminlist {

    var $sql = "";
    var $datalist = "datalist";
    var $pagelist = "pagelist";
    var $page = 0;
    var $page_total = 0;
    var $data_len = 10;
    var $data_total = 0;
    var $urlhead = '';
    var $ctag1;
    var $ctag2;

    function pushSql($sql) {
        $this->sql = $sql;
    }

    function getPage($numb) {
        if (empty($numb) || $numb == "") {
            $this->page = 0;
        } else {
            $this->page = $numb;
        }
    }

    function loadTemp($file) {
        $this->ctag1 = new MyTagParse();
        $this->ctag1->LoadTemplate($file);
        if ($this->ctag1->CTags) {
            $this->action();
        }
    }

    function action() {
        $this->ctag2 = new MyTagParse();
        $this->ctag2->SetNameSpace("field", "[", "]");
        foreach ($this->ctag1->CTags as $i => $val) {

            if ($val->GetName() == "datalist") {
                $this->data_len = $val->GetAtt("row");
                $dsql = new Mysql();
                $dsql->SetQuery($this->sql);
                $dsql->Execute();
                $this->data_total = $dsql->GetTotalRow();
                if ($this->data_total % $this->data_len == 0) {
                    $this->page_total = $this->data_total / $this->data_len;
                } else {
                    $this->page_total = ($this->data_total - ($this->data_total % $this->data_len)) / $this->data_len + 1;
                }
                if($this->page === "end"){
                    $this->page = $this->page_total - 1;
                }

                $this->ctag2->LoadSource($val->InnerText);

                $startpage = $this->page * $this->data_len;
                $dsql->SetQuery($this->sql . " LIMIT $startpage , {$this->data_len}");
                $dsql->Execute();

                $result = "";
                if ($this->ctag2->CTags) {
                    while ($row = $dsql->GetArray()) {
                        $row['page'] = $this->page;
                        foreach ($this->ctag2->CTags as $k => $val2) {
                            $this->ctag2->Assign($k, $row[$val2->GetName()]);
                        }
                        $result .= $this->ctag2->GetResult();
                    }
                }
                $val->IsReplace = TRUE;
                $val->TagValue = $result;
            }


            if ($val->GetName() == "pagelist") {
                $result = "";
                $thepage = $this->page + 1;
                $result .='<span class="page_text">共 ' . $this->page_total . ' 页，当前第 ' . $thepage . ' 页</span> ';

                if ($this->page_total > 1) {
                    global $Nowurl;
                    $this->setUrl($Nowurl);
                    if ($this->page != 0) {
                        $result .= '<a class="page_btn" href="' . $this->urlhead . 'page=0">首页</a> ';
                    } else {
                        $result .= '<span class="page_btnb">首页</span> ';
                    }

                    for ($i = 0; $i < $this->page_total; $i++) {
                        $ii = $i + 1;
                        if ($i == $this->page) {
                            $result .= '<span class="page_btnb">' . $ii . '</span> ';
                        } else {
                            $result .= '<a class="page_btn" href="' . $this->urlhead . 'page=' . $i . '">' . $ii . '</a> ';
                        }
                    }

                    $theend = $this->page_total - 1;
                    if ($this->page < $theend) {
                        $result .= '<a class="page_btn" href="' . $this->urlhead . 'page=' . $theend . '">尾页</a> ';
                    } else {
                        $result .= '<span class="page_btnb">尾页</span> ';
                    }
                }



                $val->IsReplace = TRUE;
                $val->TagValue = $result;
            }
        }
    }

    function setUrl($url) {
        $url1 = explode("?", $url);
        if ($url1[1] == "") {
            $this->urlhead = $url1[0] . "?";
        } else {
            $url2 = explode("&", $url1[1]);
            $this->urlhead = $url1[0] . "?";
            foreach ($url2 as $k => $val) {
                if (substr_count($val, "page") == 0) {
                    $this->urlhead .= $val . "&";
                }
            }
        }
    }

    function display() {
        $this->ctag1->display();
    }

}

?>
