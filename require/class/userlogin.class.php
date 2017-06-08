<?php   if(!defined('LULINREQ')) exit('Request Error!');
session_start();
function TestPurview($n)
{
    $rs = FALSE;
    $purview = $GLOBALS['cuserLogin']->getPurview();
    if(preg_match('/admin_AllowAll/i',$purview))
    {
        return TRUE;
    }
    if($n=='')
    {
        return TRUE;
    }
    if(!isset($GLOBALS['groupRanks']))
    {
        $GLOBALS['groupRanks'] = explode(' ',$purview);
    }
    $ns = explode(',',$n);
    foreach($ns as $n)
    {
        //只要找到一个匹配的权限，即可认为用户有权访问此页面
        if($n=='')
        {
            continue;
        }
        if(in_array($n,$GLOBALS['groupRanks']))
        {
            $rs = TRUE; break;
        }
    }
    return $rs;
}

/**
 *  对权限检测后返回操作对话框
 *
 * @access    public
 * @param     string  $n  功能名称
 * @return    string
 */
function CheckPurview($n)
{
    if(!TestPurview($n))
    {
        Trace("对不起，你没有权限执行此操作！<br/><br/><a href='javascript:history.go(-1);'>点击此返回上一页&gt;&gt;</a>",'javascript:;');
        exit();
    }
}

/**
 *  是否没权限限制(超级管理员)
 *
 * @access    public
 * @param     string
 * @return    bool
 */
function TestAdmin()
{
    $purview = $GLOBALS['cuserLogin']->getPurview();
    if(preg_match('/admin_AllowAll/i',$purview))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

$LulinUserCatalogs = Array();

/**
 *  检测用户是否有权限操作某栏目
 *
 * @access    public
 * @param     int   $cid  频道id
 * @param     string   $msg  返回消息
 * @return    string
 */
function CheckCatalog($cid, $msg)
{
    global $cfg_admin_channel, $admin_catalogs;
    if($cfg_admin_channel=='all' || TestAdmin())
    {
        return TRUE;
    }
    if( !in_array($cid, $admin_catalogs) )
    {
        Trace(" $msg <br/><br/><a href='javascript:history.go(-1);'>点击此返回上一页&gt;&gt;</a>",'javascript:;');
        exit();
    }
    return TRUE;
}

/**
 *  发布文档临时附件信息缓存、发文档前先清空附件信息
 *  发布文档时涉及的附件保存到缓存里，完成后把它与文档关连
 *
 * @access    public
 * @param     string   $fid  文件ID
 * @param     string   $filename  文件名称
 * @return    void
 */
function AddMyAddon($fid, $filename)
{
    $cacheFile = LULINDATA.'/cache/addon-'.session_id().'.inc';
    if(!file_exists($cacheFile))
    {
        $fp = fopen($cacheFile, 'w');
        fwrite($fp, '<'.'?php'."\r\n");
        fwrite($fp, "\$myaddons = array();\r\n");
        fwrite($fp, "\$maNum = 0;\r\n");
        fclose($fp);
    }
    include($cacheFile);
    $fp = fopen($cacheFile, 'a');
    $arrPos = $maNum;
    $maNum++;
    fwrite($fp, "\$myaddons[\$maNum] = array('$fid', '$filename');\r\n");
    fwrite($fp, "\$maNum = $maNum;\r\n");
    fclose($fp);
}

/**
 *  清理附件，如果关连的文档ID，先把上一批附件传给这个文档ID
 *
 * @access    public
 * @param     string  $aid  文档ID
 * @param     string  $title  文档标题
 * @return    empty
 */
function ClearMyAddon($aid=0, $title='')
{
    global $dsql;
    $cacheFile = LULINDATA.'/cache/addon-'.session_id().'.inc';
    $_SESSION['bigfile_info'] = array();
    $_SESSION['file_info'] = array();
    if(!file_exists($cacheFile))
    {
        return ;
    }
}

/**
 * 登录类
 *
 * @package          userLogin
 * @subpackage       Libraries
 * @link             http://www.lulincms.com
 */
class userLogin
{
    var $userName = '';
    var $userPwd = '';
    var $userID = '';
    var $adminDir = '';
    var $userType = '';
    var $userChannel = '';
    var $userPurview = '';
    var $keepUserIDTag = 'lulin_admin_id';
    var $keepUserTypeTag = 'lulin_admin_type';
    var $keepUserChannelTag = 'lulin_admin_channel';
    var $keepUserNameTag = 'lulin_admin_name';
    var $keepUserPurviewTag = 'lulin_admin_purview';
    var $keepAdminStyleTag = 'lulin_admin_style';
    var $adminStyle = 'lulincms';

    //php5构造函数
    function __construct($admindir='')
    {
        global $admin_path;
        if(isset($_SESSION[$this->keepUserIDTag]))
        {
            $this->userID = $_SESSION[$this->keepUserIDTag];
            $this->userType = $_SESSION[$this->keepUserTypeTag];
            $this->userChannel = $_SESSION[$this->keepUserChannelTag];
            $this->userName = $_SESSION[$this->keepUserNameTag];
            $this->userPurview = $_SESSION[$this->keepUserPurviewTag];
            $this->adminStyle = $_SESSION[$this->keepAdminStyleTag];
        }

        if($admindir!='')
        {
            $this->adminDir = $admindir;
        }
        else
        {
            $this->adminDir = $admin_path;
        }
    }

    function userLogin($admindir='')
    {
        $this->__construct($admindir);
    }

    /**
     *  检验用户是否正确
     *
     * @access    public
     * @param     string    $username  用户名
     * @param     string    $userpwd  密码
     * @return    string
     */
    function checkUser($username, $userpwd)
    {
        global $dsql;

        //只允许用户名和密码用0-9,a-z,A-Z,'@','_','.','-'这些字符
        $this->userName = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $username);
        $this->userPwd = preg_replace("/[^0-9a-zA-Z_@!\.-]/", '', $userpwd);
        $pwd = substr(md5($this->userPwd), 5, 20);
        $dsql->SetQuery("SELECT admin.*,atype.purviews FROM `#@__admin` admin LEFT JOIN `#@__admintype` atype ON atype.rank=admin.usertype WHERE admin.userid LIKE '".$this->userName."' LIMIT 0,1");
        $dsql->Execute();
        $row = $dsql->GetObject();
        if(!isset($row->pwd))
        {
            return -1;
        }
        else if($pwd!=$row->pwd)
        {
            return -2;
        }
        else
        {
            $loginip = GetIP();
            $this->userID = $row->id;
            $this->userType = $row->usertype;
            $this->userChannel = $row->typeid;
            $this->userName = $row->uname;
            $this->userPurview = $row->purviews;
            $inquery = "UPDATE `#@__admin` SET loginip='$loginip',logintime='".time()."' WHERE id='".$row->id."'";
            $dsql->ExecuteNoneQuery($inquery);
            $sql = "UPDATE #@__member SET logintime=".time().", loginip='$loginip' WHERE mid=".$row->id;
            $dsql->ExecuteNoneQuery($sql);
            return 1;
        }
    }

    /**
     *  保持用户的会话状态
     *
     * @access    public
     * @return    int    成功返回 1 ，失败返回 -1
     */
    function keepUser()
    {
        if($this->userID != '' && $this->userType != '')
        {
            global $admincachefile,$adminstyle;
            if(empty($adminstyle)) $adminstyle = 'lulincms';

            $_SESSION[$this->keepUserIDTag] = $this->userID;

            $_SESSION[$this->keepUserTypeTag] = $this->userType;

            $_SESSION[$this->keepUserChannelTag] = $this->userChannel;

            $_SESSION[$this->keepUserNameTag] = $this->userName;

            $_SESSION[$this->keepUserPurviewTag] = $this->userPurview;

            $_SESSION[$this->keepAdminStyleTag] = $adminstyle;
            
            $this->ReWriteAdminChannel();
            
            return 1;
        }
        else
        {
            return -1;
        }
    }
    
    /**
     *  重写用户权限频道
     *
     * @access    public
     * @return    void
     */
    function ReWriteAdminChannel()
    {
        //$this->userChannel
        $cacheFile =    LULINDATA.'/cache/admincat_'.$this->userID.'.inc';
        //管理员管理的频道列表
        $typeid = trim($this->userChannel);
        if( empty($typeid) || $this->getUserType() >= 10 ) {
                $firstConfig = "\$cfg_admin_channel = 'all';\r\n\$admin_catalogs = array();\r\n";
        }
        else {
                $firstConfig = "\$cfg_admin_channel = 'array';\r\n";
        }
        $fp = fopen($cacheFile, 'w');
        fwrite($fp, '<'.'?php'."\r\n");
        fwrite($fp, $firstConfig);
        if( !empty($typeid) )
        {
             $typeids = explode(',', $typeid);
             $typeid = '';
             foreach($typeids as $tid)
             {
                     $typeid .= ( $typeid=='' ? GetSonIdsUL($tid) : ','.GetSonIdsUL($tid) );
             }
             $typeids = explode(',', $typeid);
             $typeidsnew = array_unique($typeids);
             $typeid = join(',', $typeidsnew);
             fwrite($fp, "\$admin_catalogs = array($typeid);\r\n");
        }
        fwrite($fp, '?'.'>');
        fclose($fp);
    }

    //
    /**
     *  结束用户的会话状态
     *
     * @access    public
     * @return    void
     */
    function exitUser()
    {
        ClearMyAddon();

        $_SESSION = array();
    }

    /**
     *  获得用户管理频道的值
     *
     * @access    public
     * @return    array
     */
    function getUserChannel()
    {
        if($this->userChannel != '')
        {
            return $this->userChannel;
        }
        else
        {
            return '';
        }
    }

    /**
     *  获得用户的权限值
     *
     * @access    public
     * @return    int
     */
    function getUserType()
    {
        if($this->userType != '')
        {
            return $this->userType;
        }
        else
        {
            return -1;
        }
    }

    /**
     *  获取用户权限值
     *
     * @access    public
     * @return    int
     */
    function getUserRank()
    {
        return $this->getUserType();
    }

    /**
     *  获得用户的ID
     *
     * @access    public
     * @return    int
     */
    function getUserID()
    {
        if($this->userID != '')
        {
            return $this->userID;
        }
        else
        {
            return -1;
        }
    }

    /**
     *  获得用户的笔名
     *
     * @access    public
     * @return    string
     */
    function getUserName()
    {
        if($this->userName != '')
        {
            return $this->userName;
        }
        else
        {
            return -1;
        }
    }

    /**
     *  用户权限表
     *
     * @access    public
     * @return    string
     */
    function getPurview()
    {
        return $this->userPurview;
    }
}

/**
 *  获得某id的所有下级id
 *
 * @access    public
 * @param     int   $id  栏目ID
 * @param     int   $channel  频道ID
 * @param     int   $addthis  是否加入当前这个栏目
 * @return    string
 */
function GetSonIdsUL($id, $channel=0, $addthis=TRUE)
{
    global $cfg_Cs;
    $GLOBALS['idArray'] = array();
    if( !is_array($cfg_Cs) )
    {
        require_once(DEDEDATA."/cache/inc_catalog_base.inc");
    }
    GetSonIdsLogicUL($id,$cfg_Cs,$channel,$addthis);
    $rquery = join(',', $GLOBALS['idArray']);
    return $rquery;
}

/**
 *  递归逻辑
 *
 * @access    public
 * @param     int  $id  栏目ID
 * @param     int  $sArr  缓存数组
 * @param     int   $channel  频道ID
 * @param     int   $addthis  是否加入当前这个栏目
 * @return    string
 */
function GetSonIdsLogicUL($id,$sArr,$channel=0,$addthis=FALSE)
{
    if($id!=0 && $addthis)
    {
        $GLOBALS['idArray'][$id] = $id;
    }
    foreach($sArr as $k=>$v)
    {
        if( $v[0]==$id && ($channel==0 || $v[1]==$channel ))
        {
            GetSonIdsLogicUL($k,$sArr,$channel,TRUE);
        }
    }
}