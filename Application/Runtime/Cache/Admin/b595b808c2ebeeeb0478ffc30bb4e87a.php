<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>翰墨内部管理系统</title>



    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/H/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Public/H/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/H/css/animate.min.css" rel="stylesheet">
    <link href="/Public/H/css/style.min.css?v=4.0.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header" style="height: 150px;">
                    <div class="dropdown profile-element">
                        <img alt="image" class="" style="padding-left: 20px;" width="140px" src="/Public/css/plugins/login/img/avtar.png" />
                    </div>
                    <div class="logo-element">翰墨教育集团
                    </div>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-edit"></i>
                        <span class="nav-label">录入报名表</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="teacher">教师证</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index_v3.html">导游证</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="输入需要查找的学生手机号 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="login/logout" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out" target=_top></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="teacher" frameborder="0" data-id="index_v2.html" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2017-2018 <a >翰墨教育集团</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->

<script src="/Public/H/js/jquery.min.js?v=2.1.4"></script>
<script src="/Public/H/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/Public/H/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Public/H/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/Public/H/js/plugins/layer/layer.min.js"></script>
<script src="/Public/H/js/hplus.min.js?v=4.0.0"></script>
<script type="text/javascript" src="/Public/H/js/contabs.min.js"></script>
<script src="/Public/H/js/plugins/pace/pace.min.js"></script>
</body>

</html>