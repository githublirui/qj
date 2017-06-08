
                <tr class="tr_white">
                    <td align="center">[field:rank /]</td>   
                    <td align="center">[field:scenename /]</td>   
                    <td align="center">[field:type function="cheaktype(@me)" /]</td>
                    <td align="center">[field:thumb function="checkthumb(@me)" /]</td>
                    <td align="center">[field:id function="hotsopt(@me)" /]</td>
                    <td align="center"><input type="button" class="btnup" onclick="window.location.href = 'vrpano_scenerank.php?id=[field:id/]&tp=up';" /><input type="button" class="btndown" onclick="window.location.href = 'vrpano_scenerank.php?id=[field:id/]&tp=down';" /></td>
                    <td align="center">

                        <input type="button" onclick="window.location.href = 'vrpano_scene_edit.php?id=[field:id /]';" value="场景设置" class="btn1"/>
                        <input type="button" onclick="window.location.href = 'vrpano_spot.php?id=[field:id /]';" value="热点管理" class="btn1"/>
                        <input type="button" onclick="lookscene('[field:id/]');" value="场景预览" class="btn1"/>
                        <input type="button" onclick="window.location.href = 'vrpano_scene_del.php?id=[field:id /]';" value="删除场景" class="btn1"/>
                    </td>
                </tr>
                