<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>系统登陆</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/Public/css/plugins/login/css/style.css" rel='stylesheet' type='text/css'/>
    <script src="/Public/js/jquery.min.js"></script>
    <script src="/Public/js/plugins/js/login.js"></script>

</head>

<style>
    #msg{color: crimson; }
</style>

<body>

<!--SIGN UP-->
<h1>翰墨教育集团内部管理系统</h1>

<div class="login-form">


    <div class="clear"></div>
    <div class="avtar">
        <img src="/Public/css/plugins/login/img/avtar.png"/>
    </div>
    <form id="login" action=""  method="post" name="login">
        <input type="text" id="tel" class="text" name="tel"  required="required"  placeholder='请输入手机号码'>

        <div class="key">
            <input type="password" id="password" name="password" required="required"  placeholder='请输入密码'>
        </div>
       <div id="msg"></div>
        <br>
        <div class="signin">
            <input type="submit" value="登陆">
        </div>
    </form>
</div>
<div class="copy-rights">
    <p>翰墨教育集团</p>
</div>

</body>
</html>