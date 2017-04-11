<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>教师证学生报名表录入</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/H/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Public/H/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/H/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Public/H/css/animate.min.css" rel="stylesheet">
    <link href="/Public/H/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="/Public/magic-check/magic-check.css" rel="stylesheet">
    <link href="/Public/Validform/style.css" rel="stylesheet">



    <!--点提交新页面打开-->
    <!--<base target="_blank">-->



    <style>
        .laydate-icon {
            width: 242px;
            height: 30px;
        }
        .magic-radio + label,
        .magic-checkbox + label {
            display:inline;
        }
        .magic-checkbox:checked + label:before {
            border: #3e97eb;
            background: #2E8B57; }
    </style>

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">


    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>教师证报名表</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_basic.html#">选项1</a>
                            </li>
                            <li><a href="form_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <form  class="form-horizontal demoform"  action="<?php echo U('Admin/Teacher/postfrom');?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">姓名</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="name" datatype="*" >
                            </div>

                            <label class="col-sm-2 control-label">性别</label>

                            <div class="col-sm-3">
                                <select class="form-control m-b" name="sex">
                                    <option value="0">男</option>
                                    <option value="1">女</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">民族</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nation"  datatype="*">
                            </div>

                            <label class="col-sm-2 control-label">政治面貌</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="face"  datatype="*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机号码</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="tel"  datatype="m&*"  errormsg="请输入正确的手机号码">
                            </div>

                            <label class="col-sm-2 control-label">籍贯</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="hometown" datatype="*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">出生年月</label>

                            <div class="col-sm-3">
                                <div style="width:970px; margin:0px auto;">
                                    <input placeholder=" 请输入日期" class="laydate-icon" style=" width:242px; height:30px;"
                                           onclick="laydate()" name="birthday" datatype="*">
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">身份证号码</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="idcard" datatype="*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">户口所在地</label>

                            <div class="col-sm-3">
                                <input type="text" placeholder='___省___市___区（县）' class="form-control"
                                       name="hukou_address" datatype="*">
                            </div>

                            <label class="col-sm-2 control-label">QQ邮箱</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="email" datatype="e&*"  errormsg="请输入正确的邮箱">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">学校名称（在读）</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="school" datatype="*">
                            </div>

                            <label class="col-sm-2 control-label">学历层次</label>

                            <div class="col-sm-3 radio i-checks">
                                <label>
                                    <input type="radio" value="1" name="education" datatype="*" nullmsg="请选择学历层次"> <i></i> 大专</label>
                                <label>
                                    <input type="radio" value="2" name="education"> <i></i> 本科</label>
                                <label>
                                    <input type="radio" value="3" name="education"> <i></i> 研究生</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">院系班级</label>

                            <div class="col-sm-3">
                                <input type="text" placeholder='______院系______班级' class="form-control"
                                       name="college_class"  datatype="*">
                            </div>

                            <label class="col-sm-2 control-label">所在年级</label>

                            <div class="col-sm-4 radio i-checks">
                                <label>
                                    <input type="radio" value="1" name="grade"  datatype="*" nullmsg="请选择所在年级"> <i></i> 大一</label>
                                <label>
                                    <input type="radio" value="2" name="grade"> <i></i> 大二</label>
                                <label>
                                    <input type="radio" value="3" name="grade"> <i></i> 大三</label>
                                <label>
                                    <input type="radio" value="4" name="grade"> <i></i> 大四</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">专业名称</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="major" datatype="*">
                            </div>

                            <label class="col-sm-2 control-label">是否在校</label>

                            <div class="col-sm-1 radio i-checks">
                                <label>
                                    <input type="radio" value="1" name="in_school"  datatype="*" nullmsg="请选择是否在校"> <i></i> 是</label>
                                <label>
                                    <input type="radio" value="0" name="in_school"> <i></i> 否</label>
                            </div>

                            <label class="col-sm-2 control-label">是否全日制</label>

                            <div class="col-sm-1 radio i-checks">
                                <label>
                                    <input type="radio" value="1" name="full_time"  datatype="*" nullmsg="请选择是否全日制"> <i></i> 是</label>
                                <label>
                                    <input type="radio" value="0" name="full_time"> <i></i> 否</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">院校入学时间</label>

                            <div class="col-sm-3">
                                <div style="width:970px; margin:0px auto;">
                                    <input placeholder=" 请输入日期" class="laydate-icon" style=" width:242px; height:30px;"
                                           onclick="laydate()" name="entrance_time" datatype="*"  nullmsg="请选择院校入学时间">
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">预计毕业时间</label>

                            <div class="col-sm-3">
                                <div style="width:970px; margin:0px auto;">
                                    <input placeholder=" 请输入日期" class="laydate-icon" style=" width:242px; height:30px;"
                                           onclick="laydate()" name="graduation_time" datatype="*" nullmsg="请选择预计毕业时间">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">紧急联系人</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="emergency_contact" datatype="*">
                            </div>

                            <label class="col-sm-2 control-label">紧急联系人电话</label>

                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="emergency_tel" datatype="*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">本人联系地址</label>

                            <div class="col-sm-8">
                                <input type="text" placeholder='___市___区______' class="form-control" name="address" datatype="*">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">考区</label>

                            <div class="col-sm-3">
                                <!-- 城市 -->
                                <select  class="form-control m-b" name="place_city_id" id="city">
                                    <option>--请选择市--</option>
                                    <?php if(is_array($city)): foreach($city as $key=>$v): ?><option value="<?php echo ($v["place_id"]); ?>"  ><?php echo ($v["place_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                                <!-- 区县 -->
                                <select  class="form-control m-b" name="place_area_id" id="area">
                                    <option datatype="s" nullmsg="请选择考区"></option>
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">笔试考试时间</label>

                            <div class="col-sm-3">
                                <select class="form-control m-b" name="test_time">
                                    <option value="2017-3">2017年3月</option>
                                    <option value="2017-11">2017年11月</option>
                                    <option value="2018-3">2018年3月</option>
                                    <option value="2018-11">2018年11月</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">选择教的是</label>

                            <div class="col-sm-3">
                                <select class="form-control m-b" name="course">
                                    <?php if(is_array($course)): foreach($course as $key=>$vo): ?><option value="<?php echo ($vo["cousr_name"]); ?>"><?php echo ($vo["cousr_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>

                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">班型选择</label>

                            <div class="col-sm-10 form-group radio i-checks">
                                <?php if(is_array($TeaCoursePackage)): foreach($TeaCoursePackage as $key=>$vo): ?><label>
                                        <input type="radio" value="<?php echo ($vo["id"]); ?>" name="course_package"  datatype="*" nullmsg="请选择班型"> <i></i>
                                        <?php echo ($vo["name"]); ?></label><?php endforeach; endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">费用是否交齐</label>

                                <div class="col-sm-3 form-group radio">
                                    <input class="magic-checkbox" type="radio" name="pay_status" value="1" id="c1"  name="course_package"  datatype="*" nullmsg="请选择费用是否交齐">
                                    <label for="c1">已交齐</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <input class="magic-checkbox" type="radio" name="pay_status" value="0" id="c2">
                                    <label for="c2">未交齐</label>

                                </div>

                                <div class="col-sm-3" id="some_cash" style="display:none;">
                                    <input type="number" class="form-control"  placeholder='已收金额' name="some_cash" style="margin-left: -80px;" >
                                </div>
                        </div>


                        <div class="hr-line-dashed"></div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
                                <button class="btn btn-primary" type="submit" id="save">保存</button>
                            </div>
                        </div>





                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="/Public/H/js/jquery.min.js?v=2.1.4"></script>
<script src="/Public/H/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/Public/H/js/content.min.js?v=1.0.0"></script>
<script src="/Public/H/js/plugins/iCheck/icheck.min.js"></script>
<script src="/Public/laydate/laydate.js"></script>

<script src="/Public/Validform/Validform_v5.3.2_min.js"></script>





<script>
    //初始化Validform
    $(".demoform").Validform();

    //    $(document).ready(function(){
        $(document).ready(function () {
            $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",})
        });

        $("#save").click(function(){

        });

        //根据费用是否交齐，显示输入框
        $("input:radio[name='pay_status']").change(function (){
            var pay_status=$(this).val();
            if (pay_status==0){
                $("#some_cash").removeAttr("style","display:none;");
            }else {
                $("#some_cash").attr("style","display:none;");
            }
            //alert(pay_status);
        });

        //考区联动
        $('#city').change(function(){
            $.ajax({
               type:"post",
                url:"<?php echo U('TestPlace/postArea');?>",
                data:'place_id='+$('#city').val(),
                dataType:'json',
                success:function(data){
//                    console.log(data);
                    $("#area").html(data);
                }
            });
        });




//    });

    //提交确认
//    function sures()
//    {
//        if(confirm('确认提交？提交后不可修改。'))
//        {
//            return true;
//        }else{
//            return false;
//        }
//    }
</script>

</body>

</html>