$(document).ready(function(){
    //login登录拦截
    $("#login").on("submit", function () {
        var tel = $("#tel").val(),
            password = $("#password").val();
        $.ajax({
            type: "POST",
            url: "login/login",
            timeout: 3000,
            data: {
                tel: tel,
                password: password
            },
            success: function (data) {
                if (data.status == "success") {
                    // $("#msg").html('登陆中...');
                    layer.msg('登陆中...');
                    //var url="{:U('Admin/index/index')}";
                   //window.location.href="/index";
                    top.location.href = 'index';
                } else {
                    // $("#msg").html('账号或密码错误');
                    layer.msg('账号或密码错误');
                }
            },
            error: function () {
                // $("#msg").html('网络开小差，请稍后再试！');
                layer.msg('网络开小差，请稍后再试！');
            }
        });
        return false;
    });
});








