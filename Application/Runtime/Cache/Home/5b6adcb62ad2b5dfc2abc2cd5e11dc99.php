<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/Public/css/plugins/login/css/style.css" rel='stylesheet' type='text/css'/>

</head>
<body>

<!--SIGN UP-->
<h1>翰墨教育集团内部管理系统</h1>

<div class="login-form">


    <div class="clear"></div>
    <div class="avtar">
        <img src="/Public/css/plugins/login/img/avtar.png"/>
    </div>
    <form>
        <input type="text" class="text" name="username" value="Username" onfocus="this.value = '';"
               onblur="if (this.value == '') {this.value = 'Username';}">

        <div class="key">
            <input type="password" name="password" value="Password" onfocus="this.value = '';"
                   onblur="if (this.value == '') {this.value = 'Password';}">
        </div>
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