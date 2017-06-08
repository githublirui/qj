jQuery.fn.extend({
    uploader: function(type, script,cmspath) {
        $(this).click(function() {            
            if (type == "image") {
                window.open(cmspath + "/admin/uploader/main.php?tp=image&num=1&jsname="+script+"&cms="+cmspath, "uploader", 'height=250,width=420,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
            } else if (type == "audio") {
                window.open(cmspath + "/admin/uploader/main.php?tp=audio&num=1&jsname="+script+"&cms="+cmspath, "uploader", 'height=250,width=420,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
            }else if (type == "all") {
                window.open(cmspath + "/admin/uploader/main.php?tp=all&num=1&jsname="+script+"&cms="+cmspath, "uploader", 'height=200,width=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
            }else if (type == "video") {
                window.open(cmspath + "/admin/uploader/main.php?tp=video&num=1&jsname="+script+"&cms="+cmspath, "uploader", 'height=200,width=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
            } else if (type == "applevideo") {
                window.open(cmspath + "/admin/uploader/main.php?tp=applevideo&num=1&jsname="+script+"&cms="+cmspath, "uploader", 'height=200,width=400,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
            }else if (type == "images") {
                window.open(cmspath + "/admin/uploader/main.php?tp=image&num=10&jsname="+script+"&cms="+cmspath, "uploader", 'height=400,width=620,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');
            }else if (type == "images2") {
                window.open(cmspath + "/admin/uploader/main.php?tp=image&namecode=self&num=10&jsname="+script+"&cms="+cmspath, "uploader", 'height=400,width=620,toolbar=no,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');
            }
        });
    },
    addimgbox: function(data, name,cmspath) {
        var datas = data.split("|");
        for (i = 0; i < datas.length; i++) {
            var html = '';
            html += '<div class="photo_outer">';
            html += '<div class="photo_img"><img src="' + cmspath + datas[i] + '" onload="photoin(this,120,120)" /></div>';
            html += '<input type="hidden" name="' + name + '[]" value="' + datas[i] + '" />';
            html += '<div class="photo_btn">';
            html += '<input class="btn1" type="button" value="删除" onclick="$(this).delimgbox()" />';
            html += '<input class="btn1" type="button" style="margin-top:4px;" onclick="$(this).upimgbox()"  value="上移" />';
            html += '<input class="btn1" type="button" style="margin-top:4px;" onclick="$(this).downimgbox()" value="下移" />';
            html += '</div>';
            html += '</div>';
            $(this).append(html);
        }
    }, 
    editimgbox: function(data,name,cmspath) {
        if(data != ""){
            var datas = data.split("|");
            for (i = 0; i < datas.length; i++) {
                var html = '';
                html += '<div class="photo_outer">';
                html += '<div class="photo_img"><img src="' + cmspath + datas[i] + '" onload="photoin(this,120,120)" /></div>';
                html += '<input type="hidden" name="' + name + '[]" value="' + datas[i] + '" />';
                html += '<div class="photo_btn">';
                html += '<input class="btn1" type="button" onclick="$(this).delimgbox2(' + "'delimg'" + ')" value="删除" />';
                html += '<input class="btn1" type="button" style="margin-top:4px;" onclick="$(this).upimgbox()" value="上移" />';
                html += '<input class="btn1" type="button" style="margin-top:4px;" onclick="$(this).downimgbox()" value="下移" />';
                html += '</div>';
                html += '</div>';
                $(this).append(html);
            }
        }        
    }, 
    delimgbox: function() {
        var m = $(this).parent(".photo_btn").parent(".photo_outer");
        m.remove();
    }, 
    delimgbox2: function(inputname) {
        var m = $(this).parent(".photo_btn").parent(".photo_outer");
        var v = m.children("input").val();
        var nowv = $("#" + inputname).val();
        if (nowv == "") {
            $("#" + inputname).val(v);
        } else {
            $("#" + inputname).val(nowv + "|" + v);
        }
        m.remove();
    }, 
    upimgbox: function() {
        var m = $(this).parent(".photo_btn").parent(".photo_outer");
        var n = m.prevAll().length;
        if (n > 0) {
            var temp1 = m.html();
            var temp2 = m.prev().html();
            m.prev().html(temp1);
            m.html(temp2);
        }
    }, 
    downimgbox: function() {
        var m = $(this).parent(".photo_btn").parent(".photo_outer");
        var n = m.nextAll().length;
        if (n > 0) {
            var temp1 = m.html();
            var temp2 = m.next().html();
            m.next().html(temp1);
            m.html(temp2);
        }
    },
    addoneimgbox: function(data, name) {
        var datas = data.split("|");
        for (i = 0; i < datas.length; i++) {
            var html = '';
            html += '<div class="photo_outer one">';
            html += '<div class="photo_img"><img src="' + datas[i] + '" onload="photoin(this,120,120)" /></div>';
            html += '<input type="hidden" name="' + name + '[]" value="' + datas[i] + '" />';
            html += '</div>';
            $(this).append(html);
        }
    }
});
function closewin() {
    $("#winfacebox").hide();
}
