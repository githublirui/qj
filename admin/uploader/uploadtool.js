function selectedClear(){
    $("#selected").html("");
}
function selectedone(imgname,imgsize){
    var html = '';
    html += '<div class="selectbox">';
    html += '<b>'+imgname+'</b><span>'+imgsize+'字节</span><span>可以上传</span> ';
    html += '</div>';
    $("#selected").html(html);
}
function noselectedone(imgname,imgsize){
    var html = '';
    html += '<div class="selectbox">';
    html += '<b class="r">'+imgname+'</b><span class="r">'+imgsize+'字节</span><span class="r">文件超过最大限制</span> ';
    html += '</div>';
    $("#selected").html(html);
}
function startUploadOneData(imgname){
    var html = '';
    html += '<div class="resultbox">';
    html += '<div class="imgbox"><img src="images/loading.gif" onload="photoin(this,60,60)" /></div>';
    html += '<div class="imginfo">';
    html += '<div class="imgtitle">' + imgname + '</div>';
    html += '<div class="imgdata"><div class="line" style="width: 0px;"></div></div>';
    html += '<div class="imgtxt">准备上传中...</div>';
    html += '</div>';
    html += '</div>';
    $("#result").html(html);
}
function uploadOneData(txt){
    txts = recheak(txt);
    $(".imgbox").children("img").attr("src",txts);
    $(".imgbox").children("img").attr("result",txt);  
    $(".imginfo").children(".imgdata").children(".line").css("width","100px");
    $(".imginfo").children(".imgtxt").html("上传完毕");
    selectedClear();
}
function oneUploading(oio){

    $(".imginfo").children(".imgdata").children(".line").css("width",oio+"px");        

    $("#subbox").show();
}


function selected(imgname,imgsize,num){
    var html = '';
    html += '<div class="selectbox" id="up'+num+'">';
    html += '<b>'+imgname+'</b><span>'+imgsize+'字节</span><span>可以上传</span> ';
    html += '</div>';
    $("#selected").append(html);
}
function selectedOver(imgname,imgsize,num){
    var html = '';
    html += '<div class="selectbox" id="up'+num+'">';
    html += '<b class="r">'+imgname+'</b><span class="r">'+imgsize+'字节</span><span class="r">文件超过最大限制</span> ';
    html += '</div>';
    $("#selected").append(html);
}

function startUploadData(imgname,num){    
    var html = '';
    html += '<div class="resultbox" id="res_' + num + '">';
    html += '<div class="imgbox"><img src="images/loading.gif" onload="photoin(this,60,60)" /></div>';
    html += '<div class="imginfo">';
    html += '<div class="imgtitle">' + imgname + '</div>';
    html += '<div class="imgdata"><div class="line" style="width: 0px;"></div></div>';
    html += '<div class="imgtxt">准备上传中...</div>';
    html += '</div>';
    html += '</div>';
    $("#result").append(html);
}

function uploadData(txt,id){    
    txts = recheak(txt);
    $("#res_"+id).children(".imgbox").children("img").attr("src",txts);  
    $("#res_"+id).children(".imgbox").children("img").attr("result",txt);  
    $("#res_"+id).children(".imginfo").children(".imgdata").children(".line").css("width","100px");
    $("#res_"+id).children(".imginfo").children(".imgtxt").html("上传完毕");
    $("#up"+id).remove();
}
function uploading(oio,id){
    $("#res_"+id).children(".imginfo").children(".imgdata").children(".line").css("width",oio+"px");
}
function upoverall(){
    $("#subbox").show();
}



// JavaScript Document
function photoin(myphoto,W,H){
    $(myphoto).removeAttr("width");
    $(myphoto).removeAttr("height");
    var px = myphoto.width;
    var py = myphoto.height;
    var nx;
    var ny;
    if(px / py > W / H){
        if(px>W){
            nx=W;
            ny=nx*(py/px);
        }else{
            nx = px;
            ny = py;
        }
    }else{
        if(py > H){
            ny=H;
            nx=ny*(px/py);
        }else{
            nx = px;
            ny = py;
        }
    }
    myphoto.width = nx;
    myphoto.height = ny;
    $(myphoto).css("marginLeft",(W-nx)/2);
    $(myphoto).css("marginTop",(H-ny)/2);
}
function photoout(myphoto,W,H){ 
    $(myphoto).removeAttr("width");
    $(myphoto).removeAttr("height");
    var px = myphoto.width;
    var py = myphoto.height;
    var nx;
    var ny;
    if(px / py > W / H){
        ny=H;
        nx=ny*(px/py);
    }else{
        nx=W;
        ny=nx*(py/px);
    }
    myphoto.width = nx;
    myphoto.height = ny;
    $(myphoto).css("marginLeft",(W-nx)/2);
    $(myphoto).css("marginTop",(H-ny)/2);
}

function recheak(url){
    var temp = url.split(".");
    var result = temp[1];
    if("mp3|wma".indexOf(result)>=0){
        return "images/audio.jpg";
    }
    else if("flv|swf|mp4|m4v".indexOf(result)>=0){
        return "images/video.jpg";
    }
    else{
        return cmspath + url;
    }
}