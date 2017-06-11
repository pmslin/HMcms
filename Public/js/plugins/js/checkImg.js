function photoCheck(format,size,width,height) {
//图片上传过滤
    var file = document.getElementById("imgurl").value;
    format=format;
    if (!format.test(file)) {
        layer.alert("图片类型必须是.jpg格式！", {icon: 2});
        $("#imgurl").val(""); //清空不合规的照片
        $("#imgShow").attr("src",""); //情况图片预览
        // $("#error").html("图片类型必须是.jpeg,jpg,png中的一种!");
        return false;

    }
// alert(size);
    var maxsize = 1 * 1024 * size;//size kb
    var errMsg = "上传的照片不能超过"+size+"kb！";
    var tipMsg = "您的浏览器暂不支持计算上传文件的大小。";

    try {
        var obj_file = document.getElementById("imgurl");
        filesize = obj_file.files[0].size;

        if (filesize > maxsize) {
            layer.alert(errMsg, {icon: 2});
            $("#imgurl").val("");
            $("#imgShow").attr("src","");
            // $("#error").html("文件不能大于300KB！");
            return false;
        }
    } catch (e) {
        alert(e);
    }
    // alert(width);

    getWH("imgurl",width,height);
    // if (aa==undefined){
    //     layer.msg("图片尺寸不符");
    //     $("#imgurl").val("");
    //     return false;
    // }
    // alert(aa);
    // if(wd==false){
    //     layer.alert("图片尺寸不符");
    // }


    filePath = getObjectURL(obj_file.files[0]);

    $("#imgShow").attr("src", filePath);
    // console.log(filePath);

    layer.msg("照片通过！");

// if(window.confirm('特别提示：  上传成功后将无法修改信息,你确定要提交吗？')){
//                  return true;
//               }else{
//                  return false;
//              }
}

//获取图片路径，显示图片
function getObjectURL(file) {
    var url = null;
    // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
    if (window.createObjectURL != undefined) { // basic
        url = window.createObjectURL(file);
    } else if (window.URL != undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file);
    } else if (window.webkitURL != undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file);
    }
    return url;
}

//判断图片尺寸
function getWH(id,width,height){
    var MyTest = document.getElementById(id).files[0];
    var reader = new FileReader();
    reader.readAsDataURL(MyTest);
    reader.onload = function(theFile) {
        var image = new Image();
        image.src = theFile.target.result;
        image.onload = function() {
            if (this.width!=width && this.height!=height) {
                //
                layer.alert("图片规格不符!", {icon: 2});
                $("#imgurl").val("");
                $("#imgShow").attr("src","");
                return false;

            }
            // 　　alert("图片的宽度为"+this.width+",长度为"+this.height);
        };
    };
    // return result;
}


//图片点击大小变化
$(function () {
    $("#imgShow").click(function () {
        var width = $(this).width();
        if (width == 50) {
            $(this).width(285);
//                $(this).height(300);
        }
        else {
            $(this).width(50);
//                $(this).height(150);
        }
    });
});