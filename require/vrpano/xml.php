<?php
require_once(LULINREQ ."/class/mytag.class.php");
$fang[1] = "lefttop";
$fang[2] = "top";
$fang[3] = "righttop";
$fang[4] = "left";
$fang[5] = "center";
$fang[6] = "right";
$fang[7] = "leftbottom";
$fang[8] = "bottom";
$fang[9] = "rightbottom";
$xml = "";
$xml .= '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
$xml .= '<krpano onstart="action(start);" >'."\r\n";
$xml .= "<skin_settings uishowpic=\"\" />\r\n";
if ($row['opentaocan'] == 1) {
$taocan = 1;
}else {
$taocan = 0;
}
$xml .= "<skin_settings openautonext=\"{$row['openautonext']}\" />\r\n";
if ($row['cursor'] != 0) {
$xml .= "<include url=\"%SWFPATH%/cursor/cursor.xml\" />\r\n";
}
if ($row['openipadrate'] != 0) {
$xml .= '<plugin name="skin_gyro" keep="true" url="%SWFPATH%/js/gyro.js" devices="html5+!firefox" enabled="false" camroll="true" friction="0" velastic="0" onavailable="if(device.fullscreensupport, if(device.mobile,add(layer[skin_btn_gyro].x,40),add(layer[skin_btn_gyro].x,20));); set(layer[skin_btn_gyro].visible,true);" />';
}
if ($row['openautorate'] != 0) {
$xml .= "<autorotate enabled=\"true\" waittime=\"{$row['autoratetime']}\" accel=\"{$row['autorateaddspeed']}\" speed=\"{$row['autoratespeed']}\" horizon=\"0\"/>\r\n";
}else {
$xml .= "<autorotate enabled=\"false\" waittime=\"{$row['autoratetime']}\" accel=\"{$row['autorateaddspeed']}\" speed=\"{$row['autoratespeed']}\" horizon=\"0\"/>\r\n";
}
$checkflaresql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = $id and `openlensflare` = 1";
$mydb->SetQuery($checkflaresql);
$mydb->Execute("flare");
$flarelen = $mydb->GetTotalRow("flare");
if ($flarelen >0) {
$xml .= '<lensflareset name="DEFAULT" url="%SWFPATH%/plugins/flares.jpg"/>'."\r\n";
}
$xml .= "<action name=\"start\">\r\n";
if ($row['openthumb'] == 1) {
$xml .= 'buildthumbs();'."\r\n";
}
$xml .= "delayedcall(autonexttimer,{$row['autonexttime']}, autonextscene(););\r\n";
if ($firstscene == "") {
$firstscene = "scene1";
}
$xml .= "loadscene($firstscene, null, MERGE);\r\n";
if ($row['openallmusic'] == 1) {
$xml .= "playsound(bgmusic, '%SWFPATH%/music/{$row['musicfile']}',{$row['musictimes']});set(sound[bgmusic].volume,{$row['musicvalue']});\r\n";
}
$xml .= "</action>\r\n";
$xml .= '<textstyle name="DEFAULT" effect="" bordercolor="0xF6F6F6" backgroundcolor="0xFEFEFE" background="True" edge="bottom" blendmode="NORMAL" alpha="0.8" fadeintime="0" fadetime="0" showtime="0.1" noclip="False" yoffset="-3" xoffset="0" textalign="none" origin="cursor" textcolor="0x000000" border="True" italic="False" bold="False" fontsize="12" font="Arial, Helvetica, sans-serif"/>'."\r\n";
$checksoundsql = "SELECT * FROM `#@__pano_scene` WHERE  `pid` = $id and `opensound` = 1";
$mydb->SetQuery($checksoundsql);
$mydb->Execute("sound");
$soundlen = $mydb->GetTotalRow("sound");
if ($soundlen >0 ||$row['openallmusic'] == 1) {
$xml .= '<plugin name="soundinterface" url="%SWFPATH%/plugins/soundinterface.swf" alturl="%SWFPATH%/plugins/soundinterface.js" volume="1" preload="true" keep="true" />'."\r\n";
}
if ($row['openallmusic'] == 1 ) {
$bgmusicalign = $fang[$row['musicalign']];
$xml .= "<plugin zorder=\"2000\"  name=\"backmusic\" keep=\"true\" url=\"%SWFPATH%/plugins/soundonoff.png\" align=\"$bgmusicalign\" x=\"{$row['musicx']}\" y=\"{$row['musicy']}\" alpha=\"1\" scale=\"0.5\" onhover=\"showtext('全局音效开关');\" ";
$xml .= "crop=\"0|0|50|50\" onloaded=\"if(ismobile,set(scale,1));\" onclick=\"pausesoundtoggle(bgmusic); switch(crop, 0|0|50|50, 0|50|50|50);\" />\r\n";
}
$xml .= '<layer name="introimage" url="%SWFPATH%introimage.png" alpha="0.8" align="center" onclick="hideintroimage();" keep="true" visible="true" />'."\r\n";
$xml .= '<action name="hideintroimage">if(layer[introimage].enabled,set(layer[introimage].enabled,false);tween(layer[introimage].alpha, 0.0, 0.5, default, removelayer(introimage)););</action>'."\r\n";
if ($row['openautonext'] == 1) {
$xml .= "<plugin zorder=\"20000\"  name=\"closeautonext\" keep=\"true\" url=\"%SWFPATH%/autonextclose.png\" align=\"top\" x=\"0\" y=\"10\" alpha=\"1\" scale=\"1\" ";
$xml .= "onclick=\"autonextchange();\" />\r\n";
}else {
$xml .= "<plugin zorder=\"20000\" visible=\"false\" name=\"closeautonext\" keep=\"true\" url=\"%SWFPATH%/autonextclose.png\" align=\"top\" x=\"0\" y=\"10\" alpha=\"1\" scale=\"1\" ";
$xml .= "onclick=\"autonextchange();\" />\r\n";
}
while ($scenerow = $mydb->GetArray("scene")) {
if ($scenerow['thumb'] == "1") {
$sceneimg = '%SWFPATH%/images/scene'.$scenerow['rank'] .'/thumb.jpg';
}else {
$sceneimg = '';
}
$scenestartscript = "";
$scenestartscript .= "thumb_start({$scenerow['rank']});";
$mapsql = "SELECT * FROM `#@__pano_map` WHERE id=$id";
$maprow = $mydb->getOne($mapsql);
if ($maprow['openmap'] == 1) {
$scenestartscript .= "action(startscene);";
}
if ($scenerow['type'] == 3) {
$scenestartscript .= "set(control.mousetype, drag2D);";
}else {
$curtp[1] = "moveto";
$curtp[2] = "drag2D";
$curtp[3] = "drag3D";
$ctpd = $row['cursortype'];
$ctpdn = $curtp[$ctpd];
$scenestartscript .= "set(control.mousetype, $ctpdn);";
}
$xml .= "<scene name=\"scene{$scenerow['rank']}\" scenetitle=\"{$scenerow['scenename']}\" thumburl=\"$sceneimg\" nowpic=\"\" onstart=\"$scenestartscript\" >\r\n";
$xml .= "<events onviewchange=\"if(view.vlookat GT {$scenerow['downlook']},set(view.vlookat,{$scenerow['downlook']}););if(view.vlookat LT -{$scenerow['toplook']},set(view.vlookat,-{$scenerow['toplook']}););\" />";
if ($scenerow['type'] == 1 ||$scenerow['type'] == 2) {
$xml .= "<view fovtype=\"MFOV\" fov=\"{$scenerow['fov']}\" hlookat=\"{$scenerow['hlookat']}\" fovmin=\"{$scenerow['fovmin']}\" fovmax=\"{$scenerow['fovmax']}\" limitview=\"range\" hlookatmin=\"-180\" hlookatmax=\"180\" vlookatmin=\"-90\" vlookatmax=\"90\" />\r\n";
}else {
$xml .= "<view limitview=\"auto\" maxpixelzoom=\"5\" />\r\n";
}
$xml .= '<preview url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/preview.jpg" />'."\r\n";
if ($scenerow['type'] == 1) {
$xml .= '<image type="SPHERE">'."\r\n";
$xml .= '<sphere url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano.jpg" />'."\r\n";
$xml .= '</image>'."\r\n";
}else if ($scenerow['type'] == 2) {
if ($scenerow['opencut'] == 0) {
$xml .= '<image type="CUBE"  progressive="false">'."\r\n";
$xml .= '<left url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano_left.jpg" />'."\r\n";
$xml .= '<front url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano_front.jpg" />'."\r\n";
$xml .= '<right url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano_right.jpg" />'."\r\n";
$xml .= '<back url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano_back.jpg" />'."\r\n";
$xml .= '<up url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano_up.jpg" />'."\r\n";
$xml .= '<down url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano_down.jpg" />'."\r\n";
$xml .= '<mobile>'."\r\n";
$xml .= '<left url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/mb_left.jpg" />'."\r\n";
$xml .= '<front url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/mb_front.jpg" />'."\r\n";
$xml .= '<right url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/mb_right.jpg" />'."\r\n";
$xml .= '<back url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/mb_back.jpg" />'."\r\n";
$xml .= '<up url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/mb_up.jpg" />'."\r\n";
$xml .= '<down url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/mb_down.jpg" />'."\r\n";
$xml .= '</mobile>'."\r\n";
$xml .= '<tablet>'."\r\n";
$xml .= '<left url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tb_left.jpg" />'."\r\n";
$xml .= '<front url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tb_front.jpg" />'."\r\n";
$xml .= '<right url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tb_right.jpg" />'."\r\n";
$xml .= '<back url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tb_back.jpg" />'."\r\n";
$xml .= '<up url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tb_up.jpg" />'."\r\n";
$xml .= '<down url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tb_down.jpg" />'."\r\n";
$xml .= '</tablet>'."\r\n";
$xml .= '</image>'."\r\n";
}else {
$xml .= '<image type="CUBE" multires="yes" progressive="false" tilesize="250">'."\r\n";
$file = LULINROOT ."/vrpano/vrpano$id/images/scene{$scenerow['rank']}/pano_up.jpg";
$imgdata = getimagesize($file);
$imgwidth = $imgdata[0];
$xml .= '<level tiledimagewidth="'.$imgwidth .'" tiledimageheight="'.$imgwidth .'">'."\r\n";
$xml .= '<cube url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tiles/pano_%s_%v_%u.jpg" />'."\r\n";
$xml .= '</level>'."\r\n";
$file = LULINROOT ."/vrpano/vrpano$id/images/scene{$scenerow['rank']}/tb_up.jpg";
$imgdata = getimagesize($file);
$imgwidth = $imgdata[0];
$xml .= '<level tiledimagewidth="'.$imgwidth .'" tiledimageheight="'.$imgwidth .'">'."\r\n";
$xml .= '<cube url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tiles/smallpano_%s_%v_%u.jpg" />'."\r\n";
$xml .= '</level>'."\r\n";
$file = LULINROOT ."/vrpano/vrpano$id/images/scene{$scenerow['rank']}/mb_up.jpg";
$imgdata = getimagesize($file);
$imgwidth = $imgdata[0];
$xml .= '<level tiledimagewidth="'.$imgwidth .'" tiledimageheight="'.$imgwidth .'">'."\r\n";
$xml .= '<cube url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/tiles/littlepano_%s_%v_%u.jpg" />'."\r\n";
$xml .= '</level>'."\r\n";
$xml .= '</image>'."\r\n";
}
}else if ($scenerow['type'] == 3) {
$xml .= '<image hfov="1.0">'."\r\n";
$xml .= '<cylinder url="%SWFPATH%/images/scene'.$scenerow['rank'] .'/pano.jpg" />'."\r\n";
$xml .= '</image>'."\r\n";
}
if ($scenerow['openlensflare'] == 1) {
$xml .= '<lensflare name="flare'.$scenerow['rank'] .'" ath="'.$scenerow['ath'] .'" atv="'.$scenerow['atv'] .'" set="DEFAULT" size="0.8" blind="0.6" blindcurve="4" keep="False" />'."\r\n";
}
if ($scenerow['opensound'] == 1) {
$soundalign = $fang[$scenerow['soundalign']];
$xml .= "<events name=\"sound{$scenerow['rank']}\" onnewpano=\"playsound(bgsnd{$scenerow['rank']}, '%SWFPATH%/images/scene{$scenerow['rank']}/{$scenerow['soundfile']}', {$scenerow['soundtimes']});set(sound[bgsnd{$scenerow['rank']}].volume,{$scenerow['soundvalue']});\"  onremovepano=\"stopsound(bgsnd{$scenerow['rank']});\" />\r\n";
$xml .= "<plugin name=\"snd{$scenerow['rank']}\" url=\"%SWFPATH%/plugins/soundonoff.png\" align=\"$soundalign\" x=\"{$scenerow['soundx']}\" y=\"{$scenerow['soundy']}\" alpha=\"0.25\" scale=\"0.5\" onover=\"tween(alpha,1);\" onout=\"tween(alpha,0.25);\" crop=\"0|0|50|50\" onloaded=\"if(isphone,set(scale,1));\" onclick=\"pausesoundtoggle(bgsnd{$scenerow['rank']}); switch(crop, 0|0|50|50, 0|50|50|50);\" onhover=\"showtext('场景音效开关');\" />\r\n";
}
if ($row['openluopan'] == 1) {
if ($scenerow['luopan'] != "") {
$xml .= "<plugin name=\"luoban{$scenerow['rank']}\" keep=\"false\" width=\"130\" height=\"130\"  zorder=\"0\" align=\"center\" edge=\"center\" url=\"%SWFPATH%/images/scene{$scenerow['rank']}/luopan.png\" alpha=\"1\"  handcursor=\"true\" enabled=\"true\" parent=\"luopanbox\" />\r\n";
$xml .= "<events  onviewchange= \"div(luopandu,get(view.hlookat),-1);sub(plugin[luoban{$scenerow['rank']}].rotate,-180, get(luopandu));\"/> ";
}
}
$addphotoarr = array();
$cubearr = array();
$animate = 0;
$spotsql = "SELECT spot.* FROM `#@__pano_spot` spot WHERE spot.aid = {$scenerow['id']}";
$mydb->SetQuery($spotsql);
$mydb->Execute("spot");
$spotautokey = 1;
while ($spotrow = $mydb->GetArray("spot")) {
$xml .= "<hotspot name=\"spot$spotautokey\" ";
$xml .= "devices=\"{$spotrow['devicetype']}\" ";
$onclickstring = "";
$onhoverstring = "";
$onoverstring = "";
$onoutstring = "";
if ($spotrow['openshowspotname'] == 1 &&$spotrow['action'] != 4 &&$spotrow['openinfo'] == 0) {
$onhoverstring .= "showtext('{$spotrow['title']}');";
}
if ($spotrow['openaction'] == 1) {
if ($spotrow['action'] == 1 &&$spotrow['panotarget'] != 0) {
if ($row['openipadrate'] == 0) {
$movetoxml = "moveto({$spotrow['spoth']},{$spotrow['spotv']},smooth());";
}else {
$movetoxml = '';
}
$rightscenesql = "SELECT `rank` FROM `#@__pano_scene` WHERE id={$spotrow['panotarget']}";
$rightscenerow = $mydb->getOne($rightscenesql);
if ($spotrow['spottype'] == 1) {
if ($spotrow['screenchange'] == 1) {
$onclickstring .= "ifnot(device.html5,moveto({$spotrow['spoth']},{$spotrow['spotv']},smooth());loadscene(scene{$rightscenerow['rank']}, view.vlookat={$spotrow['targetv']}&amp;view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,1));,{$movetoxml}loadscene(scene{$rightscenerow['rank']}, view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,1)););";
}else if ($spotrow['screenchange'] == 2) {
$onclickstring .= "ifnot(device.html5,moveto({$spotrow['spoth']},{$spotrow['spotv']},smooth());loadscene(scene{$rightscenerow['rank']}, view.vlookat={$spotrow['targetv']}&amp;view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,3));,{$movetoxml}loadscene(scene{$rightscenerow['rank']}, view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,3)););";
}
}else {
if ($spotrow['screenchange'] == 1) {
$onclickstring .= "ifnot(device.html5,loadscene(scene{$rightscenerow['rank']}, view.vlookat={$spotrow['targetv']}&amp;view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,1));,{$movetoxml}loadscene(scene{$rightscenerow['rank']}, view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,1)););";
}else if ($spotrow['screenchange'] == 2) {
$onclickstring .= "ifnot(device.html5,loadscene(scene{$rightscenerow['rank']}, view.vlookat={$spotrow['targetv']}&amp;view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,3));,{$movetoxml}loadscene(scene{$rightscenerow['rank']}, view.hlookat={$spotrow['targeth']}, MERGE,ZOOMBLEND(1,3)););";
}
}
}else if ($spotrow['action'] == 2 &&$spotrow['showpic'] != "") {
if ($spotrow['showpictype'] == 1) {
$onclickstring .= "ifnot(scene{$scenerow['rank']}.showpic === null , set(plugin[get(scene{$scenerow['rank']}.showpic)].y,-8000););set(scene{$scenerow['rank']}.showpic,showpic{$spotrow['id']});set(plugin[showpic{$spotrow['id']}].y,0);tween(plugin[showpic{$spotrow['id']}].alpha,1,0.1);";
}else if ($spotrow['showpictype'] == 2) {
$onoverstring .= "ifnot(scene{$scenerow['rank']}.showpic === null , set(plugin[get(scene{$scenerow['rank']}.showpic)].y,-8000););set(scene{$scenerow['rank']}.showpic,showpic{$spotrow['id']});set(plugin[showpic{$spotrow['id']}].y,0);tween(plugin[showpic{$spotrow['id']}].alpha,1,0.1);";
}
}else if ($spotrow['action'] == 3) {
$http = str_replace("&","&amp;",$spotrow['httplink']);
$onclickstring .= "openurl($http,_blank);";
}else if ($spotrow['action'] == 4) {
$onclickstring .= "if(flying == 0.0, flyout(););if(flying == 1.0, flyback(););";
}else if ($spotrow['action'] == 5) {
$onclickstring .= "set(layer[photo{$spotrow['photo']}].visible,true);";
}else if ($spotrow['action'] == 6) {
$cuberow = $mydb->getOne("SELECT * FROM `#@__pano_cube` WHERE `id`={$spotrow['cube']}");
$onclickstring .= "set(layer[cube{$cuberow['rank']}].visible,true);set(skin_settings.cube{$cuberow['rank']}_open,1);cube{$cuberow['rank']}next();";
}
}
if ($spotrow['openinfo'] == 1) {
$onhoverstring .= "set(hotspot[spot{$spotautokey}info].visible,true);";
}
if ($spotrow['spottype'] == 1) {
$spotstylesql = "SELECT * FROM `#@__pano_spotstyle` WHERE `id` = {$spotrow['spotstyle']}";
$spotstylerow = $mydb->getOne($spotstylesql);
$spotname = basename($spotstylerow['url']);
$xml .= "url=\"%SWFPATH%/spot/$spotname\" ";
$xml .= "ath=\"{$spotrow['spoth']}\" atv=\"{$spotrow['spotv']}\" ";
if ($spotstylerow['typeid'] == 3) {
$animate = 1;
$xml .= "crop=\"0|0|{$spotstylerow['framewidth']}|{$spotstylerow['frameheight']}\" ";
$lastframenum = $spotstylerow['lastframe'] -1;
$xml .= "framewidth=\"{$spotstylerow['framewidth']}\" frameheight=\"{$spotstylerow['frameheight']}\" frame=\"0\" framespeed=\"{$spotstylerow['speed']}\" frameoff=\"0\" lastframe=\"$lastframenum\" ";
if ($spotrow['openanimate'] == 0) {
$xml .= "onloaded=\"set(frameoff,0);hotspot_animate();\" ";
}else {
$onoverstring .= "set(frameoff,0);hotspot_animate(); ";
$onoutstring .= "set(frameoff,1); ";
}
}
$xml .= "onclick=\"$onclickstring\" ";
$xml .= "onhover=\"$onhoverstring\" ";
$xml .= "onover=\"$onoverstring\" ";
$xml .= "onout=\"$onoutstring\" ";
$xml .= "/>\r\n";
}else if ($spotrow['spottype'] == 2) {
$xml .= " fillcolor=\"0x{$spotrow['fillcolor']}\" fillcolorhover=\"0x{$spotrow['fillcolorhover']}\" fillalpha=\"{$spotrow['fillalpha']}\" fillalphahover=\"{$spotrow['fillalphahover']}\" borderwidth=\"{$spotrow['borderwidth']}\" borderwidthhover=\"{$spotrow['borderwidthhover']}\" bordercolor=\"0x{$spotrow['bordercolor']}\" bordercolorhover=\"0x{$spotrow['bordercolorhover']}\" borderalpha=\"{$spotrow['borderalpha']}\" borderalphahover=\"{$spotrow['borderalphahover']}\" ";
$xml .= "onclick=\"$onclickstring\" ";
$xml .= "onhover=\"$onhoverstring\" ";
$xml .= "onover=\"$onoverstring\" ";
$xml .= "onout=\"$onoutstring\" ";
$xml .= ">\r\n";
$spointarr = explode("&&",$spotrow['hotpoints']);
foreach ($spointarr as $pdata) {
$pdataarr = explode("||",$pdata);
$xml .= "<point ath=\"{$pdataarr[0]}\" atv=\"{$pdataarr[1]}\" />\r\n";
}
$xml .= "</hotspot>\r\n";
}else if ($spotrow['spottype'] == 3) {
$xml .= "url=\"%SWFPATH%/spot/{$spotrow['smartspotpic']}\" ";
$xml .= "capture=\"False\" enabled=\"True\" visible=\"True\" rotatewithview=\"False\" distorted=\"True\" smoothing=\"True\" ";
$xml .= "scale=\"{$spotrow['smartscale']}\" ";
$xml .= "atv=\"{$spotrow['smartatv']}\" ";
$xml .= "ath=\"{$spotrow['smartath']}\" ";
$xml .= "rz=\"{$spotrow['smartrz']}\" ";
$xml .= "ry=\"{$spotrow['smartry']}\" ";
$xml .= "rx=\"{$spotrow['smartrx']}\" ";
$xml .= "onclick=\"$onclickstring\" ";
$xml .= "onhover=\"$onhoverstring\" ";
$xml .= "onover=\"$onoverstring\" ";
$xml .= "onout=\"$onoutstring\" ";
$xml .= "/>\r\n";
}else if ($spotrow['spottype'] == 4) {
$onclickstring .= "if(ispaused,togglepause(););";
$xml .= "url=\"%SWFPATH%/plugins/videoplayer.swf\" alturl=\"%SWFPATH%/plugins/videoplayer.js\" ";
$xml .= "keep=\"false\" ath=\"{$spotrow['videoath']}\" atv=\"{$spotrow['videoatv']}\" scale=\"{$spotrow['videoscale']}\" volume=\"0.7\" ";
$xml .= "zoom=\"false\" distorted=\"true\" details=\"8\" flying=\"0\" edge=\"center\" ";
$xml .= "rx=\"{$spotrow['videorx']}\" ry=\"{$spotrow['videory']}\" rz=\"{$spotrow['videorz']}\" ";
$xml .= "width=\"{$spotrow['videowidth']}\" height=\"{$spotrow['videoheight']}\" ";
$xml .= "visible=\"true\" enabled=\"true\" alpha=\"1\" buffertime=\"0.1\" ";
$xml .= "directionalsound=\"true\" outofrangevolume=\"0\" range=\"110\" rangefalloff=\"1\" ";
$xml .= "iscomplete=\"false\" isvideoready=\"true\" loop=\"true\" ";
if($spotrow['openstartplay'] == 0){
$xml .= "pausedonstart=\"True\" ";
}else{
$xml .= "pausedonstart=\"False\" ";
}
$xml .= "updateeveryframe=\"true\" videourl=\"%SWFPATH%/video/{$spotrow['video']}\" ";
if ($spotrow['openapplevideo'] == 1) {
$xml .= "altvideourl=\"%SWFPATH%/video/{$spotrow['applevideo']}\" ";
$xml .= "posterurl=\"%SWFPATH%/video/{$spotrow['applevideoimg']}\" ";
}
if ($spotrow['openaction'] == 0) {
$onclickstring = "togglepause();";
$onhoverstring = "if(ispaused,showtext('点击播放');,showtext('点击暂停'););";
}
$xml .= "onclick=\"$onclickstring\" ";
$xml .= "onhover=\"$onhoverstring\" ";
$xml .= "onover=\"$onoverstring\" ";
$xml .= "onout=\"$onoutstring\" ";
$xml .= "/>\r\n";
}else {
$xml .= "/>\r\n";
}
if ($spotrow['openinfo'] == 1) {
$xml .= "<hotspot name=\"spot{$spotautokey}info\" ";
$xml .= "devices=\"{$spotrow['devicetype']}\" ";
$xml .= "url=\"%SWFPATH%/plugins/textfield.swf\" ";
if ($spotrow['spottype'] == 1) {
$xml .= "ath=\"{$spotrow['spoth']}\" atv=\"{$spotrow['spotv']}\" ";
}else if ($spotrow['spottype'] == 3) {
$xml .= "ath=\"{$spotrow['smartath']}\" atv=\"{$spotrow['smartatv']}\" ";
}
$xml .= "width=\"{$spotrow['infowidth']}\" height=\"50\" ";
$textinfo = str_replace("<","[",$spotrow['textinfo']);
$textinfo = str_replace(">","]",$textinfo);
$textinfo = str_replace('"',"'",$textinfo);
$xml .= "html=\"$textinfo\" ";
$xml .= "css=\"color:#333333; font-family:微软雅黑; font-size:14px; line-height:28px;\" textshadow=\"0\" visible=\"false\" ";
$xml .= "enabled=\"true\" background=\"true\" backgroundcolor=\"0xFFFFFF\" backgroundalpha=\"0.5\" border=\"true\" ox=\"20\" oy=\"-40\" ";
$xml .= "bordercolor=\"0xFFFFFF\" borderalpha=\"0.5\" borderwidth=\"5.0\" roundedge=\"5\" shadow=\"2\" shadowrange=\"2.0\" ";
$xml .= "shadowangle=\"45\" shadowcolor=\"0x000000\" shadowalpha=\"0.5\" ";
$xml .= "autoheight=\"true\" align=\"left\" edge=\"left\" onout=\"set(hotspot[spot{$spotautokey}info].visible,false);\" ";
$xml .= "/>\r\n";
}
if ($spotrow['action'] == 2 &&$spotrow['showpic'] != "") {
if ($spotrow['showpictype'] == 1) {
$xml .= "<plugin type=\"image\" name=\"showpic{$spotrow['id']}\" url=\"%SWFPATH%/showpic/{$spotrow['showpic']}\" zorder=\"1000\" alpha=\"1.0\" blendmode=\"NORMAL\" align=\"center\" edge=\"center\" x=\"0\" y=\"-80000\" width=\"\" height=\"\" scale=\"1\" smoothing=\"True\" visible=\"True\" enabled=\"True\" capture=\"False\" handcursor=\"True\" keep=\"False\" children=\"True\" preload=\"false\" scalechildren=\"True\" onclick=\"tween(alpha,0,0.1);tween(y,-80000);\" effect=\"glow(0x{$spotrow['showpicbordercolor']},{$spotrow['showpicborderalpha']},{$spotrow['showpicborderwidth']},100);\" />\r\n";
}else if ($spotrow['showpictype'] == 2) {
$xml .= "<plugin type=\"image\" name=\"showpic{$spotrow['id']}\" url=\"%SWFPATH%/showpic/{$spotrow['showpic']}\" zorder=\"1000\" alpha=\"1.0\" blendmode=\"NORMAL\" align=\"center\" edge=\"center\" x=\"0\" y=\"-80000\" width=\"\" height=\"\" scale=\"1\" smoothing=\"True\" visible=\"True\" enabled=\"True\" capture=\"False\" handcursor=\"True\" keep=\"False\" children=\"True\" preload=\"false\" scalechildren=\"True\" onout=\"tween(alpha,0,0.1);tween(y,-80000);\" effect=\"glow(0x{$spotrow['showpicbordercolor']},{$spotrow['showpicborderalpha']},{$spotrow['showpicborderwidth']},100);\" />\r\n";
}
}
if ($spotrow['cube'] != 0) {
if (!in_array($spotrow['cube'],$cubearr)) {
array_push($cubearr,$spotrow['cube']);
$xml .= '<include url="%SWFPATH%/cube/cube'.$cuberow['rank'] .'.xml" />'."\r\n";
}
}
if ($spotrow['photo'] != 0) {
if (array_search($spotrow['photo'],$addphotoarr) == null) {
$photosql = "SELECT * FROM `#@__pano_photo` WHERE `id`={$spotrow['photo']}";
$photorow = $mydb->getOne($photosql);
$imgdtp = new MyTagParse();
$imgdtp->SetNameSpace('lulin','{','}');
$imgdtp->LoadSource($photorow["imglist"]);
$photokey = 1;
$photourlarr = array();
if (is_array($imgdtp->CTags)) {
foreach ($imgdtp->CTags as $imgs =>$imgctag) {
if ($imgctag->GetName() == "imglist") {
$photourlarr[$photokey] = $imgctag->GetAtt("src");
$photokey++;
}
}
}
$photourlarrlen = count($photourlarr);
$photoallwidth = $photourlarrlen * 90 +5 * ($photourlarrlen -1);
if ($spotrow['action'] == 5 &&$spotrow['photo'] != "") {
$xml .= "<skin_settings photo{$spotrow['photo']}_id=\"1\" photo{$spotrow['photo']}_total=\"{$photourlarrlen}\" />\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}\" onloaded=\"photo{$spotrow['photo']}start();\" scalechildren=\"true\" visible=\"false\" enabled=\"True\" keep=\"false\" type=\"container\" bgcolor=\"0x000000\" bgalpha=\"0.7\" align=\"center\" width=\"700\" height=\"560\" x=\"0\" y=\"0\" zorder=\"1000\">\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_phototext\" keep=\"false\" type=\"container\" bgcolor=\"0x000000\" bgalpha=\"0\" align=\"top\" width=\"100%\" height=\"50\" x=\"0\" y=\"0\" zorder=\"1001\">\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_phototext_title\" url=\"%SWFPATH%/plugins/textfield.swf\" align=\"center\" edge=\"center\" width=\"95%\" height=\"32\" autoheight=\"true\" x=\"0\" y=\"0\" zorder=\"1002\" enabled=\"true\" background=\"false\" border=\"false\" html=\"{$photorow['title']}\" css=\"text-align:center; color:#FFFFFF; font-family:微软雅黑; font-size:16px;\" textshadow=\"0\" visible=\"true\" />\r\n";
$xml .= "</layer>\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_photoshow\" keep=\"false\" type=\"container\" bgcolor=\"0x000000\" bgalpha=\"0\" align=\"top\" width=\"100%\" height=\"400\" x=\"0\" y=\"50\" zorder=\"1001\">\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_photobox_left\" url=\"%SWFPATH%/photo/skin/mapleft.png\" align=\"left\"  edge=\"left\"  width=\"25\" height=\"42\" x=\"15\" y=\"0\" onclick=\"if(skin_settings.photo{$spotrow['photo']}_id GT 1,set(layer[photo{$spotrow['photo']}_photobox_img].width,);set(layer[photo{$spotrow['photo']}_photobox_img].height,);sub(skin_settings.photo{$spotrow['photo']}_id,1);txtadd(myimgname,photo{$spotrow['photo']}_thumbs_img,get(skin_settings.photo{$spotrow['photo']}_id));copy(myimgsrc,layer[get(myimgname)].url);set(layer[photo{$spotrow['photo']}_photobox_img].url,get(myimgsrc));copy(myimgx,layer[get(myimgname)].x);set(layer[photo{$spotrow['photo']}_thumbs_kuang].x,get(myimgx));)\"></layer>\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_photobox_right\" url=\"%SWFPATH%/photo/skin/mapright.png\" align=\"right\"  edge=\"right\"  width=\"25\" height=\"42\" x=\"15\" y=\"0\" onclick=\"if(skin_settings.photo{$spotrow['photo']}_id LT skin_settings.photo{$spotrow['photo']}_total,set(layer[photo{$spotrow['photo']}_photobox_img].width,);set(layer[photo{$spotrow['photo']}_photobox_img].height,);add(skin_settings.photo{$spotrow['photo']}_id,1);txtadd(myimgname,photo{$spotrow['photo']}_thumbs_img,get(skin_settings.photo{$spotrow['photo']}_id));copy(myimgsrc,layer[get(myimgname)].url);set(layer[photo{$spotrow['photo']}_photobox_img].url,get(myimgsrc));copy(myimgx,layer[get(myimgname)].x);set(layer[photo{$spotrow['photo']}_thumbs_kuang].x,get(myimgx));)\"></layer>\r\n";
$xml .= " <layer name=\"photo{$spotrow['photo']}_photobox_img\" url=\"%SWFPATH%/photo/photo{$photorow['rank']}/{$photourlarr[1]}\" align=\"center\"  edge=\"center\"  width=\"\" height=\"\" x=\"0\" y=\"0\" onloaded=\"div(mw,get(imagewidth),3);div(mh,get(imageheight),2);if(mw GT mh,if(imagewidth GT 600,set(width,600);,set(height,prop);set(width,get(imagewidth)););,set(width,prop);if(imageheight GT 400,set(height,400);,set(height,get(imageheight));););\"></layer>\r\n";
$xml .= "</layer>\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_photobox\" keep=\"false\" type=\"container\" bgcolor=\"0x000000\" bgalpha=\"0.5\" align=\"bottom\" width=\"700\" height=\"100\" x=\"0\" y=\"0\" zorder=\"1001\">\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_photoboxin\" keep=\"false\" type=\"container\" bgcolor=\"0x000000\" bgalpha=\"0\" align=\"center\" width=\"690\" height=\"100\" x=\"0\" y=\"0\" zorder=\"1001\">\r\n";
$xml .= "<layer name=\"photo{$spotrow['photo']}_photobox_scrollarea\" url=\"%SWFPATH%/plugins/scrollarea.swf\" alturl=\"%SWFPATH%/plugins/scrollarea.js\" direction=\"h\" align=\"center\" width=\"{$photoallwidth}\" height=\"100\" zorder=\"1005\" onloaded=\"setcenter(0,0);\">\r\n";
foreach ($photourlarr as $key =>$value) {
$thex = 95 * ($key -1);
$xml .= "<layer  name=\"photo{$spotrow['photo']}_thumbs_img{$key}\" url=\"%SWFPATH%/photo/photo{$photorow['rank']}/{$value}\" align=\"left\"  edge=\"left\"  width=\"90\" height=\"90\" x=\"{$thex}\" y=\"0\" onclick=\"set(layer[photo{$spotrow['photo']}_photobox_img].width,);set(layer[photo{$spotrow['photo']}_photobox_img].height,);set(layer[photo{$spotrow['photo']}_thumbs_kuang].x,get(x));set(skin_settings.photo{$spotrow['photo']}_id,$key);set(imgsrc,get(url));set(layer[photo{$spotrow['photo']}_photobox_img].url,get(imgsrc));\" onloaded=\"set(mw,get(imagewidth));set(mh,get(imageheight));if(mw GT mh,sub(mdex,get(mw),get(mh));div(mdex,2);txtadd(croptxt,get(mdex),|,0,|,get(mh),|,get(mh));set(crop,get(croptxt));,sub(mdex,get(mh),get(mw));div(mdex,2);txtadd(croptxt,0,|,get(mdex),|,get(mw),|,get(mw));set(crop,get(croptxt)););\"></layer>\r\n";
}
$xml .= "<layer  name=\"photo{$spotrow['photo']}_thumbs_kuang\" url=\"%SWFPATH%/photo/skin/kuang.png\" align=\"left\"  edge=\"left\"  width=\"90\" height=\"90\" x=\"0\" y=\"0\" zorder=\"1005\"></layer>\r\n";
$xml .= "</layer>\r\n";
$xml .= "</layer>\r\n";
$xml .= "</layer>\r\n";
$xml .= "<layer  name=\"photo{$spotrow['photo']}_photobox_close\" url=\"%SWFPATH%/photo/skin/x.png\" align=\"righttop\"  edge=\"righttop\"  width=\"30\" height=\"30\" x=\"-10\" y=\"-10\" onhover=\"showtext('点击关闭');\" onclick=\"set(layer[photo{$spotrow['photo']}].visible,false)\" zorder=\"1015\"/>\r\n";
$xml .= "</layer>\r\n";
$xml .="<action name=\"photo{$spotrow['photo']}start\">\r\n";
$xml .= "set(chax,1);set(chay,1);\r\n";
$xml .= "if(layer[photo{$spotrow['photo']}].width GT stagewidth,div(chax,stagewidth,740););\r\n";
$xml .= "if(layer[photo{$spotrow['photo']}].height GT stageheight,div(chay,stageheight,600););\r\n";
$xml .= "if(chax LT chay,set(layer[photo{$spotrow['photo']}].scale,get(chax));,set(layer[photo{$spotrow['photo']}].scale,get(chay)););\r\n";
$xml .= "</action>\r\n";
}
array_push($addphotoarr,$spotrow['photo']);
}
}
$spotautokey++;
}
if ($maprow['openmap'] == 1) {
if ($maprow['maptype'] == 1) {
$xml .= "<action name=\"startscene\">\r\n";
$xml .= "action(activatespot,scene{$scenerow['rank']},get(plugin[scene{$scenerow['rank']}].rote));\r\n";
$xml .= "</action>\r\n";
}else if ($maprow['maptype'] == 2) {
$xml .= "<action name=\"startscene\">\r\n";
if($scenerow['openmaps'] == 1){
$getmapsql = "SELECT * FROM `#@__pano_maps` WHERE id={$scenerow['mapsid']}";
$getmaprow = $mydb->getOne($getmapsql);
$xml .= "action(mapdo,scene{$scenerow['rank']},get(plugin[scene{$scenerow['rank']}].rote),{$scenerow['mapsid']});\r\n";
}else{
$xml .= "action(mapnone);\r\n";
}
$xml .= "</action>\r\n";
}
}else {
$xml .= "<action name=\"startscene\">\r\n";
$xml .= "</action>\r\n";
}
if ($animate == 1) {
$xml .= "<action name=\"hotspot_animate\">\r\n";
$xml .= "inc(frame,1,get(lastframe),0);\r\n";
$xml .= "mul(ypos,frame,frameheight);\r\n";
$xml .= "txtadd(crop,'0|',get(ypos),'|',get(framewidth),'|',get(frameheight));\r\n";
$xml .= "if(frameoff LT 1,\r\n";
$xml .= "delayedcall(get(framespeed), if(loaded, hotspot_animate() ) );\r\n";
$xml .= ");\r\n";
$xml .= "</action>\r\n";
}
$xml .= "</scene>\r\n";
}
$xml .= '<contextmenu fullscreen="true" enterfs="全屏" exitfs="退出全屏">'."\r\n";
if ($row['license'] != "") {
$licensearr = explode("&&",$row['license']);
foreach ($licensearr as $licensedata) {
$licenseresult = explode("|",$licensedata);
$xml .= '<item caption="'.$licenseresult[0] .'" ';
if ($licenseresult[1] != "") {
$httpurl = str_replace("&","&amp;",$licenseresult[1]);
$xml .= 'onclick="openurl('.$httpurl .',_blank);" ';
}
if ($licenseresult[2] == 1) {
$xml .= 'separator="true"';
}
$xml .= '/>'."\r\n";
}
}
$xml .= "<item caption=\"旋转开启/暂停\" onclick=\"action(autogochange);\" separator=\"true\" />\r\n";
$xml .= "<item caption=\"自动切换开启/暂停\" onclick=\"action(autonextchange);\"/>\r\n";
$xml .= '</contextmenu>'."\r\n";
$uisql = "SELECT * FROM `#@__pano_ui` WHERE `pid`= $id ORDER BY `id`";
$mydb->SetQuery($uisql);
$mydb->Execute("ui");
while ($uirow = $mydb->GetArray("ui")) {
if ($uirow['openui'] == 1) {
if ($uirow['uitype'] == 1) {
$xml .= "<plugin name=\"ui{$uirow['id']}\" url=\"%SWFPATH%/ui/{$uirow['imgfile']}\" ";
}else {
$xml .= "<plugin devices=\"flash\" name=\"ui{$uirow['id']}\" url=\"%SWFPATH%/plugins/videoplayer.swf\" alturl=\"%SWFPATH%/plugins/videoplayer.js\" ";
$xml .= "updateeveryframe=\"true\" videourl=\"%SWFPATH%/ui/{$uirow['videofile']}\" loop=\"True\" volume=\"0.7\" onhover=\"showtext('点击播放/暂停');\" onclick=\"togglepause();\" ";
}
$xml .= "zorder=\"{$uirow['uizorder']}\" alpha=\"{$uirow['uialpha']}\" align=\"{$fang[$uirow['uipos']]}\" x=\"{$uirow['uix']}\" y=\"{$uirow['uiy']}\" ox=\"0\" oy=\"0\" width=\"\" height=\"\" ";
$xml .= "scale=\"{$uirow['uiscale']}\" visible=\"True\" enabled=\"True\" capture=\"True\" keep=\"True\" showpic=\"\" ";
if ($uirow['openaction'] != 0 &&$uirow['uitype'] == 1) {
$uionclickstring = "";
$uionhoverstring = "";
$uionoverstring = "";
$uionoutstring = "";
if ($uirow['action'] == 1 &&$uirow['panotarget'] != 0) {
$uiscenesql = "SELECT `rank` FROM `#@__pano_scene` WHERE id={$uirow['panotarget']}";
$uiscenerow = $mydb->getOne($uiscenesql);
$uionclickstring .= "ifnot(device.html5,loadscene(scene{$uiscenerow['rank']}, view.vlookat={$uirow['targetv']}&amp;view.hlookat={$uirow['targeth']}, MERGE,ZOOMBLEND(1,3));,loadscene(scene{$uiscenerow['rank']}, view.hlookat={$uirow['targeth']}, MERGE,ZOOMBLEND(1,3)););";
}else if ($uirow['action'] == 2 &&$uirow['showpic'] != "") {
$uionclickstring .= "ifnot(uishowpic === null , set(plugin[get(uishowpic)].y,-8000););set(uishowpic,uishowpic{$uirow['id']});set(plugin[uishowpic{$uirow['id']}].y,0);tween(plugin[uishowpic{$uirow['id']}].alpha,1,0.1);";
}else if ($uirow['action'] == 3) {
$http = str_replace("&","&amp;",$uirow['httplink']);
$uionclickstring .= "openurl($http,_blank);";
}
$xml .= "onclick=\"$uionclickstring\" ";
$xml .= "onhover=\"$uionhoverstring\" ";
}else {
if ($uirow['uitype'] == 1) {
$xml .= "handcursor=\"False\" ";
}
}
$xml .= "/>\r\n";
if ($uirow['action'] == 2 &&$uirow['showpic'] != "") {
$xml .= "<plugin type=\"image\" name=\"uishowpic{$uirow['id']}\" url=\"%SWFPATH%/showpic/{$uirow['showpic']}\" zorder=\"1000\" alpha=\"1.0\" blendmode=\"NORMAL\" align=\"center\" edge=\"center\" x=\"0\" y=\"-8000\" width=\"\" height=\"\" scale=\"1\" smoothing=\"True\" visible=\"True\" enabled=\"True\" capture=\"False\" handcursor=\"True\" keep=\"True\" children=\"True\" preload=\"false\" scalechildren=\"True\" onclick=\"tween(alpha,0,0.1);tween(y,-8000);\" effect=\"glow(0x{$uirow['showpicbordercolor']},{$uirow['showpicborderalpha']},{$uirow['showpicborderwidth']},100);\" />\r\n";
}
}
}
if ($maprow['openmap'] == 1) {
if ($maprow['maptype'] == 1) {
$mapfile = LULINROOT ."/vrpano/vrpano".$id ."/map/".$maprow['mappic'];
$arr = getimagesize($mapfile);
$mapwidth = $arr[0];
$mapheight = $arr[1];
$mapalign = $fang[$maprow['mapbasepos']];
if ($maprow['openscale'] == 1) {
$mapwidthxiao = $mapwidth * $maprow['beforescale'];
$mapheightxiao = $mapheight * $maprow['beforescale'];
$mapwidthda = $mapwidth * $maprow['afterscale'];
$mapheightda = $mapheight * $maprow['afterscale'];
}else {
$mapwidthxiao = $mapwidth;
$mapheightxiao = $mapheight;
}
$xml .= "<plugin name=\"map\" url=\"%SWFPATH%/map/{$maprow['mappic']}\" keep=\"true\" align=\"$mapalign\" x=\"{$maprow['mapx']}\"  y=\"{$maprow['mapy']}\" handcursor=\"false\" scalechildren=\"true\" width=\"$mapwidthxiao\" height=\"$mapheightxiao\" ";
if ($maprow['openhide'] == 1) {
$xml .= "onover=\"tween(alpha,1);\" onout=\"tween(alpha,{$maprow['hideval']});\" alpha=\"{$maprow['hideval']}\" ";
}else {
$xml .= "alpha=\"{$maprow['alpha']}\" ";
}
if ($maprow['openscale'] == 1) {
$xml .= "onclick=\"action(openmap);\" ";
}
$xml .= "/>\r\n";
$mapscenesql = "SELECT * FROM `#@__pano_scene` WHERE `pid` = $id ORDER BY `rank`";
$mydb->SetQuery($mapscenesql);
$mydb->Execute("mapscene");
while ($mapscenerow = $mydb->GetArray("mapscene")) {
$xml .= "<plugin name=\"scene{$mapscenerow['rank']}\" url=\"%SWFPATH%/map/{$maprow['mappoint']}\" keep=\"true\" parent=\"map\" align=\"lefttop\" edge=\"center\" rote=\"{$mapscenerow['onemaprote']}\" zorder=\"2\" onclick=\"loadscene(scene{$mapscenerow['rank']}, null, MERGE, BLEND(1));\" ";
if ($mapscenerow['openonemap'] == 1) {
$xml .= "x=\"{$mapscenerow['onemapx']}\"  y=\"{$mapscenerow['onemapy']}\" ";
}else {
$xml .= "x=\"-500\"  y=\"-500\" ";
}
$xml .= "onhover=\"showtext('{$mapscenerow['scenename']}');\" ";
$xml .= "/>\r\n";
}
$xml .= "<plugin name=\"activespot\" url=\"%SWFPATH%/map/{$maprow['mappointactive']}\" keep=\"true\" align=\"center\" edge=\"center\" visible=\"false\" zorder=\"3\" />\r\n";
$xml .= "<plugin name=\"radar\" url=\"%SWFPATH%/plugins/radar.swf\" alturl=\"%SWFPATH%/plugins/radar.js\" zorder=\"1\" keep=\"true\" heading=\"0\" parent=\"map\" align=\"lefttop\" edge=\"center\" x=\"0\" y=\"0\" linecolor=\"0\" fillcolor=\"0x{$maprow['radarcolor']}\" scale=\"{$maprow['radarlength']}\" visible=\"false\" />\r\n";
if ($maprow['openscale'] == 1) {
$xml .= "<action name=\"openmap\">\r\n";
$xml .= "set(onclick,action(closemap););\r\n";
if ($maprow['openhide'] == 1) {
$xml .= "set(onover,);\r\n";
$xml .= "set(onout,);\r\n";
}
$xml .= "set(x,0);\r\n";
$xml .= "set(y,0);\r\n";
$xml .= "set(align,center);\r\n";
$xml .= "tween(width,$mapwidthda,distance($mapwidthda,0.1),easeoutquad);\r\n";
$xml .= "tween(height,$mapheightda,distance($mapheightda,0.1),easeoutquad);\r\n";
$xml .= "tween(alpha,{$maprow['alpha']});\r\n";
$xml .= "</action>\r\n";
$xml .= "<action name=\"closemap\">\r\n";
$xml .= "set(onclick,action(openmap););\r\n";
if ($maprow['openhide'] == 1) {
$xml .= "set(onover,tween(alpha,1););\r\n";
$xml .= "set(onout,tween(alpha,{$maprow['hideval']}););\r\n";
$xml .= "tween(alpha,{$maprow['hideval']});\r\n";
}else {
$xml .= "tween(alpha,{$maprow['alpha']});\r\n";
}
$xml .= "set(x,{$maprow['mapx']});\r\n";
$xml .= "set(y,{$maprow['mapy']});\r\n";
$xml .= "set(align,$mapalign);\r\n";
$xml .= "tween(width,$mapwidthxiao,distance($mapwidthda,0.1),easeoutquad);\r\n";
$xml .= "tween(height,$mapheightxiao,distance($mapheightda,0.1),easeoutquad);\r\n";
$xml .= "</action>\r\n";
}
$xml .= "<action name=\"activatespot\">\r\n";
$xml .= "set(plugin[activespot].parent, plugin[%1]);\r\n";
$xml .= "set(plugin[activespot].visible, true);\r\n";
$xml .= "copy(plugin[radar].x, plugin[%1].x);\r\n";
$xml .= "copy(plugin[radar].y, plugin[%1].y);\r\n";
$xml .= "set(plugin[radar].visible, true);\r\n";
$xml .= "set(plugin[radar].heading, %2);\r\n";
$xml .= "</action>\r\n";
}else if ($maprow['maptype'] == 2) {
$mapalign = $fang[$maprow['mapbasepos']];
$xml .= "<skin_settings map_nowmap=\"1\" />\r\n";
$xml .= "<plugin name=\"mapon\" visible=\"false\" keep=\"true\" url=\"%SWFPATH%/map/skin/mapon.png\" alpha=\"1\" align=\"$mapalign\"  edge=\"$mapalign\"  width=\"50\" height=\"50\" x=\"10\" y=\"10\" onclick=\"mapshow();\" onhover=\"showtext('显示地图');\" zorder=\"1005\"/>\r\n";
$xml .= "<style name=\"spot\" url=\"%SWFPATH%/map/{$maprow['mappoint']}\" align=\"lefttop\" edge=\"center\" />\r\n";
$xml .= "<style name=\"activespot\" url=\"%SWFPATH%/map/{$maprow['mappointactive']}\" align=\"lefttop\" edge=\"center\" />\r\n";
$xml .= "<plugin name=\"mapbox\" keep=\"true\" type=\"container\" bgcapture=\"true\" bgcolor=\"0x000000\" bgalpha=\"0.5\" align=\"$mapalign\" width=\"{$maprow['mapw']}\" height=\"{$maprow['maph']}\" x=\"{$maprow['mapx']}\" y=\"{$maprow['mapy']}\" zorder=\"1001\" />\r\n";
$xml .= "<plugin name=\"maptools\" parent=\"mapbox\" keep=\"true\" type=\"container\" bgcolor=\"0x000000\" bgalpha=\"0.5\" align=\"topleft\" width=\"100%\" height=\"30\" x=\"0\" y=\"0\" zorder=\"1001\" />\r\n";
$mapssql = "SELECT * FROM `#@__pano_maps` WHERE `pid`=$id ORDER BY `rank`";
$mydb->SetQuery($mapssql);
$mydb->Execute("mapssql");
$mapxml = "";
while ($mapsrow = $mydb->GetArray("mapssql")) {
if ($mapsrow['rank'] == 1) {
$mapv = "true";
}else {
$mapv = "false";
}
$xml .= "<plugin name=\"mapname{$mapsrow['rank']}\" parent=\"maptools\" keep=\"true\" url=\"%SWFPATH%/plugins/textfield.swf\" align=\"center\" edge=\"center\" width=\"100%\" height=\"26\" autoheight=\"true\" x=\"0\" y=\"0\" zorder=\"1001\" enabled=\"true\" background=\"false\" border=\"false\" html=\"{$mapsrow['title']}\" css=\"text-align:center; color:#FFFFFF; font-family:微软雅黑; font-size:14px; line-height:26px;\" textshadow=\"0\" visible=\"$mapv\"/>\r\n";
$mapfile = LULINROOT ."/vrpano/vrpano".$id ."/map/".$mapsrow['file'];
$arr = getimagesize($mapfile);
$mapwidth = $arr[0];
$mapheight = $arr[1];
$mapxml .= "<plugin name=\"scrollarea{$mapsrow['rank']}\" parent=\"mapmain\" keep=\"true\" url=\"%SWFPATH%/plugins/scrollarea.swf\" alturl=\"%SWFPATH%/plugins/scrollarea.js\" align=\"center\" width=\"$mapwidth\" height=\"$mapheight\" direction=\"all\" zorder=\"1003\" visible=\"$mapv\"/>\r\n";
$mapxml .= "<plugin name=\"map{$mapsrow['rank']}\" parent=\"scrollarea{$mapsrow['rank']}\" zorder=\"1003\" keep=\"true\" url=\"%SWFPATH%/map/{$mapsrow['file']}\" align=\"lefttop\"/>\r\n";
$mapsbabysql = "SELECT * FROM `#@__pano_scene` WHERE `pid`=$id and `mapsid`= {$mapsrow['rank']} ORDER BY `rank`";
$mydb->SetQuery($mapsbabysql);
$mydb->Execute("mapsbaby");
while ($mapsbabyrow = $mydb->GetArray("mapsbaby")) {
if ($mapsbabyrow['openmaps'] == 1) {
$mapxml .= "<plugin name=\"scene{$mapsbabyrow['rank']}\" parent=\"map{$mapsrow['rank']}\" keep=\"true\" style=\"spot\" x=\"{$mapsbabyrow['mapsx']}\" y=\"{$mapsbabyrow['mapsy']}\" rote=\"{$mapsbabyrow['mapsrote']}\" zorder=\"1003\" onclick=\"loadscene(scene{$mapsbabyrow['rank']},null,MERGE,BLEND(0.5));\" />\r\n";
}
}
}
$xml .= "<plugin name=\"mapclose\" parent=\"maptools\" visible=\"true\" keep=\"true\" url=\"%SWFPATH%/map/skin/x.png\" alpha=\"1\" align=\"right\"  edge=\"right\"  width=\"15\" height=\"15\" x=\"10\" y=\"0\" onclick=\"maphide();\" onhover=\"showtext('隐藏');\" zorder=\"1002\"/>\r\n";
if (substr_count($maprow['maph'],"%") >0) {
$mapbi = 0.01 * str_replace("%","",$maprow['maph']);
$xml .= "<plugin name=\"mapmain\" parent=\"mapbox\" type=\"container\" keep=\"true\" bgcolor=\"0x000000\" bgalpha=\"0\" align=\"bottom\" width=\"100%\" height=\"100%\" x=\"0\" y=\"0\" zorder=\"1001\" onloaded=\"mul(boxh,stageheight,$mapbi);sub(maph,get(boxh),30);set(height,get(maph));\" />\r\n";
}else {
$mapmainh = $maprow['maph'] -30;
$xml .= "<plugin name=\"mapmain\" parent=\"mapbox\" type=\"container\" keep=\"true\" bgcolor=\"0x000000\" bgalpha=\"0\" align=\"bottom\" width=\"100%\" height=\"$mapmainh\" x=\"0\" y=\"0\" zorder=\"1001\" />\r\n";
}
$xml .= $mapxml;
$xml .= "<plugin zorder=\"1004\" parent=\"scrollarea1\" name=\"radar\" url=\"%SWFPATH%/plugins/radar.swf\" alturl=\"%SWFPATH%/plugins/radar.js\" keep=\"true\" heading=\"0\" align=\"lefttop\" edge=\"center\" x=\"155\" y=\"188\" linecolor=\"0\" fillcolor=\"0x{$maprow['radarcolor']}\" scale=\"{$maprow['radarlength']}\" visible=\"false\" />\r\n";
$xml .= "<plugin name=\"activespot\" parent=\"map1\" keep=\"true\" style=\"activespot\" x=\"155\" y=\"188\" rote=\"0\" zorder=\"1005\" onclick=\"loadscene(scene1,null,MERGE,BLEND(0.5));\" />\r\n";
$xml .= "<action name=\"mapdo\">\r\n";
$xml .= "set(plugin[mapbox].visible,true);\r\n";
$xml .= "txtadd(oldmapname,\"scrollarea\",get(skin_settings.map_nowmap));\r\n";
$xml .= "txtadd(nowmapname,\"scrollarea\",%3);\r\n";
$xml .= "set(plugin[get(oldmapname)].visible,false);\r\n";
$xml .= "set(plugin[get(nowmapname)].visible,true);\r\n";
$xml .= "txtadd(oldmaptitle,\"mapname\",get(skin_settings.map_nowmap));\r\n";
$xml .= "txtadd(nowmaptitle,\"mapname\",%3);\r\n";
$xml .= "set(plugin[get(oldmaptitle)].visible,false);\r\n";
$xml .= "set(plugin[get(nowmaptitle)].visible,true);\r\n";
$xml .= "set(skin_settings.map_nowmap,%3);\r\n";
$xml .= "copy(plugin[radar].x, plugin[%1].x);\r\n";
$xml .= "copy(plugin[radar].y, plugin[%1].y);\r\n";
$xml .= "set(plugin[radar].parent, get(nowmapname));\r\n";
$xml .= "set(plugin[radar].visible, true);\r\n";
$xml .= "set(plugin[radar].heading, %2);\r\n";
$xml .= "copy(plugin[activespot].x, plugin[%1].x);\r\n";
$xml .= "copy(plugin[activespot].y, plugin[%1].y);\r\n";
$xml .= "set(plugin[activespot].parent, get(nowmapname));\r\n";
$xml .= "plugin[get(nowmapname)].scrolltocenter(get(plugin[%1].x),get(plugin[%1].y)) \r\n";
$xml .= "</action>\r\n";
$dexmap = $maprow['mapw'] -20;
$xml .= "<action name=\"maphide\">\r\n";
$xml .= "tween(plugin[mapbox].x,-$dexmap,0.3,default);\r\n";
$xml .= "tween(plugin[mapbox].alpha,0,0.3,default,set(plugin[mapon].visible,true););\r\n";
$xml .= "</action>\r\n";
$xml .= "<action name=\"mapshow\">\r\n";
$xml .= "tween(plugin[mapbox].x,0);\r\n";
$xml .= "tween(plugin[mapbox].alpha,1);\r\n";
$xml .= "set(plugin[mapon].visible,false);\r\n";
$xml .= "</action>\r\n";
$xml .= "<action name=\"mapnone\">\r\n";
$xml .= "set(plugin[mapbox].visible,false);\r\n";
$xml .= "</action>\r\n";
}
}
if ($row['openluopan'] == 1) {
$xml .= "<plugin name=\"luopanbox\" url=\"%SWFPATH%/luopan/none.png\" keep=\"true\" zorder=\"1\" children=\"false\" align=\"{$fang[$row['luopanalign']]}\" edge=\"center\" x=\"{$row['luopanx']}\" y=\"{$row['luopany']}\" scale=\"1\" scalechildren=\"true\" destscale=\"1.0\" alpha=\"1\" visible=\"true\" capture=\"true\" handcursor=\"true\" enabled=\"true\"/>\r\n";
$xml .= "<plugin name=\"luopan\" url=\"%SWFPATH%/luopan/kedu.png\" keep=\"true\" handcursor=\"false\" parent=\"luopanbox\" zorder=\"1\" alpha=\"1\"  y=\"0\" align=\"center\" mask=\"plugin[luopan_mask]\" visible=\"true\" enabled=\"false\"/>\r\n";
$xml .= "<plugin name=\"luopan_mask\" url=\"%SWFPATH%/luopan/luopan_mask.png\" keep=\"true\" zorder=\"4\" parent=\"luopanbox\" align=\"center\" blendmode=\"normal\" visible=\"false\" capture=\"false\" handcursor=\"true\" enabled=\"false\" />\r\n";
$xml .= "<plugin name=\"luopan_quan\" url=\"%SWFPATH%/luopan/quan.png\" alpha=\"1\" keep=\"true\" enabled=\"false\" visible=\"true\" parent=\"luopanbox\" zorder=\"4\" align=\"center\" capture=\"false\" handcursor=\"false\"/>\r\n";
$xml .= "<plugin name=\"luopan_hover\" url=\"%SWFPATH%/luopan/hover.png\" keep=\"true\" enabled=\"false\" visible=\"true\" parent=\"luopanbox\" zorder=\"3\" align=\"center\" capture=\"false\" handcursor=\"false\" mask=\"plugin[luopan_mask]\"/>\r\n";
$xml .= "<plugin name=\"luopan_v\" url=\"%SWFPATH%/luopan/luopanv.png\" keep=\"true\" enabled=\"false\" visible=\"true\" parent=\"luopanbox\" zorder=\"2\" align=\"top\" capture=\"false\" handcursor=\"false\" y=\"-37\" />\r\n";
$xml .= "<plugin name=\"luopan_bang\" url=\"%SWFPATH%/luopan/none.png\" keep=\"true\" zorder=\"8\" align=\"{$fang[$row['luopanalign']]}\" edge=\"center\" width=\"100\" height=\"100\" x=\"{$row['luopanx']}\" y=\"{$row['luopany']}\" handcursor=\"false\" alpha=\"1\" />\r\n";
$xml .= "<plugin name=\"luopan_bangdou\" url=\"%SWFPATH%/luopan/bang.png\" keep=\"true\" zorder=\"2\" align=\"center\" parent=\"luopan_bang\"  x=\"0\" y=\"0\" ondown=\"startluopanslider();\" onup=\"stopluopanslider();\"/>\r\n";
$xml .= "<action name=\"startluopanslider\">\r\n";
$xml .= "set(plugin[luopan_bangdou].backup_align, get(plugin[luopan_bangdou].align));\r\n";
$xml .= "set(plugin[luopan_bangdou].backup_edge,  get(plugin[luopan_bangdou].edge));\r\n";
$xml .= "plugin[luopan_bangdou].changeorigin(center,center);\r\n";
$xml .= "sub(mouse_x_offset, plugin[luopan_bangdou].x, mouse.x);\r\n";
$xml .= "sub(mouse_y_offset, plugin[luopan_bangdou].y, mouse.y);\r\n";
$xml .= "set(image_dragging,true);\r\n";
$xml .= "luopanslider();r\n";
$xml .= "</action>\r\n";
$xml .= "<action name=\"stopluopanslider\">\r\n";
$xml .= "set(image_dragging, false);\r\n";
$xml .= "set(plugin[luopan_bangdou].x, 0);\r\n";
$xml .= "set(plugin[luopan_bangdou].y, 0);\r\n";
$xml .= "</action>\r\n";
$xml .= "<action name=\"luopanslider\">\r\n";
$xml .= "if(image_dragging,\r\n";
$xml .= "add(ypos, mouse.y, mouse_y_offset);\r\n";
$xml .= "add(xpos, mouse.x, mouse_x_offset);\r\n";
$xml .= "if(ypos LT -35, set(ypos,-35));\r\n";
$xml .= "if(ypos GT 35, set(ypos,35));\r\n";
$xml .= "if(xpos LT -35, set(xpos,-35));\r\n";
$xml .= "if(xpos GT 35, set(xpos,35));\r\n";
$xml .= "copy(plugin[luopan_bangdou].y, ypos);\r\n";
$xml .= "copy(plugin[luopan_bangdou].x, xpos);\r\n";
$xml .= "setblend(get(val));\r\n";
$xml .= "div(ypos , ypos , 40);\r\n";
$xml .= "div(xpos , xpos , 15);\r\n";
$xml .= "add(valx, xpos , 0);\r\n";
$xml .= "add(valy, ypos , 0);\r\n";
$xml .= "add(view.vlookat , valy , get(view.vlookat) ); \r\n";
$xml .= "add(view.hlookat , valx , get(view.hlookat) );\r\n";
$xml .= "delayedcall(0.01, luopanslider() );\r\n";
$xml .= ",\r\n";
$xml .= "plugin[luopan_bangdou].changeorigin(get(plugin[luopan_bangdou].backup_align), get(plugin[luopan_bangdou].backup_edge));\r\n";
$xml .= ");\r\n";
$xml .= "</action>\r\n";
}
if ($row['openthumb'] == 1) {
$xml .= '<include url="%SWFPATH%/thumb/thumb.xml" />'."\r\n";
}
if ($row['opentaocan'] == 1) {
$xml .= '<include url="%SWFPATH%/thumb/thumb.xml" />'."\r\n";
}
$xml .= '<action name="prevscene">
		copy(sceneindex, scene[get(xml.scene)].index);
		sub(lastindex, scene.count, 1);
		dec(sceneindex, 1, 0, get(lastindex));
		loadscene(get(scene[get(sceneindex)].name), null, MERGE, BLEND(0.5));
	</action>
	
	<action name="nextscene">
		copy(sceneindex, scene[get(xml.scene)].index);
		sub(lastindex, scene.count, 1);
		inc(sceneindex, 1, get(lastindex), 0);
		loadscene(get(scene[get(sceneindex)].name), null, MERGE, BLEND(0.5));
	</action>'."\r\n";
$xml .= '<action name="autonextscene">
    if(skin_settings.openautonext == 1,
        nextscene();
        delayedcall(autonexttimer,'.$row['autonexttime'] .', autonextscene();
        );
    );
    </action>
    <action name="autonextchange">
    if(skin_settings.openautonext == 0,
        set(skin_settings.openautonext,1);
        set(autorotate.enabled,true);
        delayedcall(autonexttimer,'.$row['autonexttime'] .', autonextscene(););
        ,
        set(skin_settings.openautonext,0);
        stopdelayedcall(autonexttimer);
        set(plugin[closeautonext].visible,false);
    );
    </action>
    <action name="autogochange">
    if(autorotate.enabled == true,
    set(autorotate.enabled,false);,set(autorotate.enabled,true);
    );
    </action>
    '."\r\n";
$xml .= "<action name=\"flyout\">\r\n";
$xml .= "copy(backup_rx,rx);copy(backup_ry,ry);copy(backup_rz,rz);copy(backup_scale,scale);copy(backup_directionalsound,directionalsound);copy(backup_zorder,zorder);\r\n";
$xml .= "tween(rx, 0);tween(ry, 0);tween(rz, 0);tween(scale, 1.3);tween(flying, 1.0);set(directionalsound,false);set(zorder,100)\r\n";
$xml .= "</action>\r\n";
$xml .= "<action name=\"flyback\">\r\n";
$xml .= "tween(rx, get(backup_rx));tween(ry, get(backup_ry));tween(rz, get(backup_rz));\r\n";
$xml .= "tween(scale, get(backup_scale));tween(flying, 0.0);set(directionalsound,get(backup_directionalsound));set(zorder,get(backup_zorder));\r\n";
$xml .= "</action>\r\n";
if ($row['opencontrol'] == 1) {
$xml .= '<include url="%SWFPATH%/control/control.xml" />'."\r\n";
}
$xml .= '</krpano>'."\r\n";
?>