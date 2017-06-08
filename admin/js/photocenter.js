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