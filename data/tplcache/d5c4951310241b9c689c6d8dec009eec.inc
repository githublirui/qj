
                <tr class="tr_white" align="center">
                    <td rowspan="2">[field:userid/]</td>
                    <td rowspan="2">[field:uname/]</td>
                    <td  height="30">[field:usertype/]</td>
                    <td  height="30">[field:typeid function="GetChannel(@me)"/]</td>
                    <td rowspan="2">
                        <input type="button" onclick="window.location.href='sys_admin_user_edit.php?id=[field:id/]&dopost=edit'" value="更改" class="btn1"/>
                        <input type="button" onclick="window.location.href='sys_admin_user_del.php?id=[field:id/]&userid=[field:userid/]&dopost=delete'" value="删除" class="btn1"/>
                    </td>
                </tr>
                <tr  class="tr_white">
                    <td colspan="2" height="30" align="center" bgcolor="#FFFFFF">
                        登录时间：[field:logintime function="GetDateTimeMk(@me)"/]　登录IP：[field:loginip/]
                    </td>
                </tr>
                