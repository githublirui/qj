
                <tr class="tr_white" align="center">
                    <td height="28">[field:id/]</td>
                    <td>[field:panoname/]</td>
                    <td>[field:sendtime function='MyDate("Y-m-d H:i:s", @me)'/]</td>
                    <td>
                        <input type="button" class="btn1" value="编辑" onclick="window.location.href='vrpano_scene.php?id=[field:id/]';"/>
                        <input type="button" class="btn1" value="删除" onclick="window.location.href='vrpano_del.php?id=[field:id/]';"/>
                        <input type="button" class="btn3" value="项目预览" onclick="penoshow('[field:id/]');"/>
                        <input type="button" class="btn3" value="输出文件" onclick="window.location.href='vrpano_maker.php?id=[field:id/]';"/>
                    </td>
                </tr>                
                