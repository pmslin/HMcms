<?php
namespace Admin\Controller;
use Think\Controller;
class GuideController extends BaseController {

    //录入导游证报名资料页面
    public function index(){
//        var_dump(session());
        //导游证课程、价格列表
        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(12);
        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);
//        var_dump($city);

//        //获取教师证课程
//        $course=D('Course')->getCourseByTopid(1);
//        $this->assign('course',$course);

        //获取导游证考试时间
        $testTime=D('ThTesttime')->getThTestTimeById(15);
        $this->assign('testTime',$testTime);
//        var_dump($testTime);

        $this->display();
    }


    /*
     * 导游证报名表提交
     */
    public function postfrom(){
        if(IS_POST){
            $post=I('post.');

//            show_bug($post);
//            exit();

            //查询出考区
            $testPlaceModel=D('TestPlace');
//            $id=$post['place_city_id'];
            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
            $test_place=$place_city['place_name'].$place_area['place_name'];

            D()->startTrans(); //开启事务
            //上传考生照片
            $upload = new \Think\Upload();// 实例化上传类   开始
            $upload->maxSize = 307200;// 设置附件上传大小
            $upload->exts = array('jpg');// 设置附件上传类型
            $upload->rootPath = './Public/Uploads/'; // 设置附件上传目录    // 上传文件
//            show_bug($_FILES['pic']);
//            show_bug($post['name'].'.jpg');exit();
            $info = $upload->uploadOne($_FILES['pic']); //pic为字段名
            if (!$info) {// 上传错误提示错误信息
//                $this->error($upload->getError());
                unset( $_POST['pic']);
            } else {// 上传成功
                $post['pic'] = $info['savepath'] . $info['savename'];  //上传成功，$data['pic'] pic为字段名  结束
            }

            $time=date("Y-m-d");
            $post['create_time']=$time;
            $post['test_place']=$test_place;
            $post['userid']=session('userid');
            //添加数据到teacher表
            $addResult=D('Guide')->add($post);

            //添加数据到order表
            $orderData['course_package_id']=$post['course_package'];
            $orderData['pay_status']=$post['pay_status'];
            $orderData['user_id']=session('userid');
            $orderData['create_time']=$time;
            $orderData['student_id']=$addResult;
            $orderData['course_package_topid']=12;   //标记为导游证
            //获取套餐价格和名称
            $course_package=D('CoursePackage')->getCourePackageById($post['course_package']);
            $orderData['course_name']=$course_package['name'];
            $orderData['course_price']=$course_package['price'];
            //已收费用，交齐直接记录课程总额，未交齐记录已交费用
            if($post['pay_status']==1){
                $orderData['some_cash']=$course_package['price'];
            }else{
                $orderData['some_cash']=$post['some_cash'];
            }
            $addOrder=D('Order')->add($orderData);  //add()


            if($addResult && $addOrder){
                D()->commit(); //事务提交
                $this->success('录入成功','index');
            }else{
                D()->rollback(); //事务回滚
                $this->error('录入失败');
            }
        }
//        print_r($_POST);
//        exit();
    }

    /**
     * 导游证列表页面
     */
    public function guideList(){
        //获取导游证考试时间，用于查询选择
        $testTime=D('ThTesttime')->getThTestTimeById(15);
        $this->assign('testTime',$testTime);
        $this->display();
    }


    /**
     * ajax获取教师证考生列表
     */
    public function getGuideList(){

        $get=I('get.');
        $test_time=$get['test_time'];
        $is_check=$get['is_check'];//是否核实

//        show_bug($get);

        //如果是招生老师，只显示自己招收的学生
        if(session('roleid')==3){
            $map['userid']=session('userid');
        }

        if( $test_time!=0 || !empty($get['exprot']) ){
            $map['test_time']=$test_time;
        }

        if( $test_time==0 && !empty($get['exprot']) ){
            unset($map['test_time']);
        }

        //是否核实
        if ($is_check>0){
            $map['g.is_check']=$is_check;
        }


        $map['g.status']=1;

        if(empty($get['exprot'])) {  //列表，把不需要的字段剔除
            $list=M('Guide as g')
                ->field('g.id,g.name,g.tel,g.create_time,g.test_time,g.pic,u.username')
                ->join('user AS u ON g.userid=u.id',left)
                ->where($map)->order('create_time desc')->select();
        }else{
            $list=M('Guide as g')
                ->field('g.*,u.username')
                ->join('user AS u ON g.userid=u.id',left)
                ->where($map)->order('create_time desc')->select();
        }
//        show_bug($list);
//        echo M()->_sql();
//        exit();

        foreach($list as $key => $value){
            $list[$key]['num']=$key+1;
            $list[$key]['ac']='<button class="layui-btn" onclick="detail('.$value['id'].')" >详情</button>';
            if (empty($value['pic'])){
                $list[$key]['msg']='照片未上传';
            }else{
                $list[$key]['msg']='';
            }
//            $list[$key]['delete']='<button class="layui-btn" onclick="delete('.$value['id'].')" >作废</button>';
//            array_push($list[$key],array('ac'=>'  <button class="layui-btn" onclick="detail({$vo.id})" >详情</button>'));
        }

        //导出excel和照片时，文件名字显示的考试时间
        if (empty($test_time)){
            $test_time=null;
        }

        //导出excel
        if(!empty($get['exprot'])){

            for ($i = 0; $i < count($list); $i++) {

                //性别
                if( $list[$i]['sex'] == 0 ){
                    $sex = '男';
                }else if ($list[$i]['sex'] == 1){
                    $sex= '女';
                }


                //是否在校，1是，0否
                if( $list[$i]['in_school'] == 0 ){
                    $in_school = '否';
                }else if ($list[$i]['in_school'] == 1){
                    $in_school= '是';
                }

                //学习形式，1普通全日制，2成人高考，3远程教育
//                if( $list[$i]['study_form'] == 1 ){
//                    $study_form = '普通全日制';
//                }else if ($list[$i]['study_form'] == 2){
//                    $study_form= '成人高考';
//                }else if ($list[$i]['study_form'] == 3){
//                    $study_form= '远程教育';
//                }

                //政治面貌
                if( $list[$i]['face'] == 1 ){
                    $face = '团员';
                }else if ($list[$i]['face'] == 2){
                    $face= '预备党员';
                }else if ($list[$i]['face'] == 3){
                    $face= '党员';
                }else if ($list[$i]['face'] == 4){
                    $face= '群众';
                }else if ($list[$i]['face'] == 5){
                    $face= '其他';
                }

                //学历层次
                if( $list[$i]['education'] == 1 ){
                    $education = '高中';
                }else if ($list[$i]['education'] == 2){
                    $education= '中专';
                }else if ($list[$i]['education'] == 3){
                    $education= '专科';
                }else if ($list[$i]['education'] == 4){
                    $education= '本科';
                }

                //单位性质
                if( $list[$i]['unit_property'] == 1 ){
                    $unit_property = '从业人员';
                }else if ($list[$i]['unit_property'] == 2){
                    $unit_property= '非从业人员';
                }else if ($list[$i]['unit_property'] == 3){
                    $unit_property= '在校生';
                }

                //考生类别
                if( $list[$i]['stu_category'] == 1 ){
                    $stu_category = '院校生';
                }else if ($list[$i]['stu_category'] == 2){
                    $stu_category= '社会青年';
                }else if ($list[$i]['stu_category'] == 3){
                    $stu_category= '旅行社职员';
                }else if ($list[$i]['stu_category'] == 4){
                    $stu_category= '香港(澳门)居民';
                }

                //申报语种
                if( $list[$i]['languages'] == 1 ){
                    $languages = '中文';
                }else if ($list[$i]['languages'] == 2){
                    $languages= '英文';
                }

                //报考类别
                if( $list[$i]['apply_category'] == 1 ){
                    $apply_category = '新报';
                }else if ($list[$i]['apply_category'] == 2){
                    $apply_category= '加考';
                }

                //套餐
                $course_package=D("CoursePackage")->getCourePackageById($list[$i]['course_package']);

                //业务员
                $user=D("user")->getUserById($list[$i]['userid']);


                //导出的数据
                $list[$i]=array(
                    'key'   =>$list[$i]['num'], //序号
                    'name'  =>$list[$i]['name'],    //姓名
                    'tel'   =>$list[$i]['tel'], //手机号码
                    'email'    =>$list[$i]['email'], //邮箱
                    'idcard'    =>$list[$i]['idcard'],  //身份证
                    'sex'   =>$sex,//性别
                    'nation'    =>$list[$i]['nation'], //民族
                    'face'    =>$face, //政治面貌
                    'education'    =>$education, //学历层次
                    'major'    =>$list[$i]['major'], //学习专业
//                    'in_school'    =>$in_school, //是否在校
                    'school'    =>$list[$i]['school'], //学校名称
                    'unit_property'    =>$unit_property, //单位性质
                    'stu_category'    =>$stu_category, //考生类别
                    'test_place'    =>$list[$i]['test_place'], //考区
                    'languages'    =>$languages,//申报语种
                    'apply_category'    =>$apply_category,//报考类别
                    'test_time'    =>$list[$i]['test_time'], //报考年份(考试时间)
                    'entrance_time'    =>$list[$i]['entrance_time'], //入学时间
                    'graduation_time'    =>$list[$i]['graduation_time'], //预计毕业时间
                    'unit'    =>$list[$i]['unit'], //所在单位
                    'course_package_name'    =>$course_package['name'],    //套餐
                    'emergency_contact' =>$list[$i]['emergency_contact'],    //紧急联系人
                    'emergency_tel' =>$list[$i]['emergency_tel'],    //紧急联系电话
                    'addressAndZip_code'    =>$list[$i]['address'].",".$list[$i]['zip_code'], //地址和邮编
                    'username'    =>$user['username'],    //业务员
                    'remarks' =>$list[$i]['remarks'],    //备注
                    'create_time' =>$list[$i]['create_time'],    //备注




//                    'birthday'    =>$list[$i]['birthday'], //出生日期
//                    'hukou_address'    =>$list[$i]['hukou_address'], //户籍所在地
//                    'interpersonal'    =>$list[$i]['interpersonal'], //人事关系所在省份
//                    'school_num'    =>$list[$i]['school_num'], //学校代码
//                    'study_form'    =>$study_form, //学习形式
//                    'college_class'    =>$list[$i]['college_class'], //院系班级
//                    'address'    =>$list[$i]['address'], //地址
//                    'zip_code'    =>$list[$i]['zip_code'], //邮编
//                    'test_time' =>$list[$i]['test_time'],//第一次笔试考试时间

                );

            }

            $name_co = "导游证学生报名表";

            $title_arr = array('序号', '姓名','手机号','QQ邮箱','身份证号','性别','民族', '政治面貌', '最高学历','学习专业',
                '院校全称','单位性质','考生类别', '考区', '申报语种','报考类别','报考年份','入学时间',
                '（预计）毕业时间','工作单位', '套餐', '紧急联系人','紧急联系人电话','通讯地址和邮编','业务员','备注','填表日期');

//            $time = date('Y-m-d', time());

            $title = "导游证".$test_time."首次考试学生—";

            if ($list && count($list) > 0) {
                exportExcel($list, $title_arr, $title);
            }else{
                $this->error('没有对应的数据');
            }
        }

        if (!empty($_GET['downImg'])){
            if ($list && count($list) > 0) {
                $this->downtest("导游证" . $test_time . "年首次考试学生照片.zip", $list);
            }else{
                $this->error('没有对应的数据');
            }
        }

        $this->ajaxReturn($list,'json');

//        $this->assign('list',$list);
//
//        $this->display();
    }


    /**
     * 导游证考生详情
     */
    public function guideStatusDetail(){
        $id=I('get.id');    //学生id

        if(session('roleid')==3){
            //如果是招生老师，根据学生id检测是否是该招生老师的学生
            $seach=D('guide')->getStudentById($id);
            if($seach['userid'] != session('userid')){
                $this->error('这好像不是你的考生哦...');
            }
        }

        //根据学生id获取学生详情
        $detail=D('guide')->getStudentById($id);
        $this->assign('detail',$detail);

        //根据学生报考的班型套餐id，获取套餐详情
        $course_package=D('CoursePackage')->getCourePackageById($detail['course_package']);
        $this->assign('course_package',$course_package);
//        show_bug($detail);
//        show_bug($course_package);

        //获取考试时间
        $testTime=D('ThTesttime')->getThTestTimeById(15);
        $this->assign('testTime',$testTime);
//
//        //获取教师证课程
//        $course=D('Course')->where("topid=1")->select();
//        $this->assign('course',$course);

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);

        //导游证书本选择列表
        $book=D('book')->getBookByTopid(54);
        $this->assign('book',$book);

        //快递公司
        $delivery=M('delivery')->select();
        $this->assign('velivery',$delivery);

        //发书情况，第二个参数是course_package的证书topid
        $send_book=D('SendBook')->getSendBookBySdid($detail['id'],12);
        $this->assign('send_book',$send_book);
//        show_bug($send_book);

        //导游证课程、价格列表
        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(12);
        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //缴费情况
        $order=D('order')->getOrderBystuidTopid($id,12);
        $this->assign('order',$order);
//        echo M()->_sql();
//        show_bug($order);


        $this->display();

    }

    /**
     * 修改学生报名表
     */
    public function savefrom(){

        //检测是否是教务提交，roleid=1和4的可以修改
        if(!in_array(session('roleid'),array(1,4))) {
            $this->error('没有修改权限');
        }

        $post=I('post.');
//        show_bug($_POST);
//        exit();
        if(!empty($post['place_area_id'])){
//            echo 1;
            //查询出考区
            $testPlaceModel=D('TestPlace');
//            $id=$post['place_city_id'];
            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
            $_POST['test_place']=$place_city['place_name'].$place_area['place_name'];
        }

        //上传考生照片
        $upload = new \Think\Upload();// 实例化上传类   开始
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/Uploads/'; // 设置附件上传目录    // 上传文件
        $info = $upload->uploadOne($_FILES['pic']); //pic为字段名
        if (!$info) {// 如果没有上传图片，则不修改图片
            unset( $_POST['pic']);
        }
        else {// 上传成功   则修改图片
            $_POST['pic'] = $info['savepath'] . $info['savename'];  //上传成功，$data['pic'] pic为字段名  结束
        }


        $teacherModel=M('guide');
        $teacherModel->create();
        $saveResult=$teacherModel->save();
        if($saveResult){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

}