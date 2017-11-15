<?php
namespace Admin\Controller;
use Think\Controller;
class InserUnderController extends BaseController {

    //录入专插本报名资料页面
    public function index(){
//        var_dump(session());
        //专插本课程、价格列表
        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(23);
        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);
//        var_dump($city);

        //获取专插本课程
        $course=D('Course')->getCourseByTopid(25);
        $this->assign('course',$course);

        //获取专插本考试时间
        $testTime=D('ThTesttime')->getThTestTimeById(23);
        $this->assign('testTime',$testTime);
//        var_dump($testTime);

        //获取专插本培训校区
        $campus=D('Campus')->getCampusByTopid(1);
        $this->assign('campus',$campus);
//        show_bug($campus);

        $this->display();
    }


    /*
     * 报名表提交
     */
    public function postfrom(){
        if(IS_POST){
            $post=I('post.');

//            show_bug($post);
//            exit();

            //查询出考区
//            $testPlaceModel=D('TestPlace');
////            $id=$post['place_city_id'];
//            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
//            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
//            $test_place=$place_city['place_name'].$place_area['place_name'];

            D()->startTrans(); //开启事务
            //上传考生照片
            $upload = new \Think\Upload();// 实例化上传类   开始
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Public/Uploads/'; // 设置附件上传目录    // 上传文件
            $info = $upload->uploadOne($_FILES['pic']); //pic为字段名
//            if (!$info) {// 上传错误提示错误信息
//                $this->error($upload->getError());
//            } else {// 上传成功
                $post['pic'] = $info['savepath'] . $info['savename'];  //上传成功，$data['pic'] pic为字段名  结束
//            }

            $time=date("Y-m-d");
            $post['create_time']=$time;
//            $post['test_place']=$test_place;
            $post['userid']=session('userid');
            //添加数据到报名数据表
            $addResult=D('inser_under')->add($post);

            //添加数据到order表
//            $orderData['course_package_id']=$post['course_package'];
//            $orderData['pay_status']=$post['pay_status'];
//            $orderData['user_id']=session('userid');
//            $orderData['create_time']=$time;
//            $orderData['student_id']=$addResult;
//            $orderData['course_package_topid']=23;   //标记为插本***==================
//            //获取套餐价格和名称
//            $course_package=D('CoursePackage')->getCourePackageById($post['course_package']);
//            $orderData['course_name']=$course_package['name'];
//            $orderData['course_price']=$course_package['price'];
//            //已收费用，交齐直接记录课程总额，未交齐记录已交费用
//            if($post['pay_status']==1){
//                $orderData['some_cash']=$course_package['price'];
//            }else{
//                $orderData['some_cash']=$post['some_cash'];
//            }
//            $addOrder=D('Order')->add($orderData);  //add()


            if($addResult){
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


    //列表页面
    public function inserUnderList(){
        //获取插本证考试时间，用于查询选择=============
        $testTime=D('ThTesttime')->getThTestTimeById(23);
        $this->assign('testTime',$testTime);
        $this->display();
    }

    /**
     * ajax获取教师证考生列表
     */
    public function getInserUnderList(){

        $get=I('get.');
        $test_time=$get['test_time'];
        $date_b=$get['date_b'];
        $date_e=empty($get['date_e'])?date("Y-m-d"):$get['date_e'];
        $is_check=$get['is_check'];//是否核实
        $is_bk=$get['is_bk'];//是否预报名
        $pay_date_b=$get['pay_date_b'];//缴费时间
        $pay_date_e=empty($get['pay_date_e'])?date("Y-m-d"):$get['pay_date_e'];//缴费时间
        $is_audit=$get['is_audit'];//是否审核
        $user_name=$get['user_name'];//业务员姓名
        $stundet_name=$get['stundet_name'];//学生姓名

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
        //报名日期查询
        if (!empty($date_b)){
            $map['i.create_time']=array('between',array($date_b,$date_e));
        }

        //是否核实
        if ($is_check>0){
            $map['i.is_check']=$is_check;
        }
        //是否预报名
        if ($is_bk>0){
            $map['i.is_bk']=$is_bk;
        }

        //缴费时间查询
        if (!empty($pay_date_b)){
            $map['o.create_time']=array('between',array($pay_date_b,$pay_date_e));
        }
        //是否审核
        if ($is_audit>0){
            $map['i.is_audit']=$is_audit;
        }
        //业务员姓名
        if ($user_name !='0'){
            $map['u.username']=array("like","%{$user_name}%");
        }
        //学生姓名
        if ($stundet_name !='0'){
            $map['i.name']=array("like","%{$stundet_name}%");
        }

        $map['i.status']=1;

        if(empty($get['exprot']) && empty($get['cost_exprot'])) {  //列表，把不需要的字段剔除
            $list=M('inser_under as i')
                ->field('i.id,i.name,i.tel,i.create_time,i.test_time,i.pic,u.username,i.idcard')
                ->join('user AS u ON i.userid=u.id',left)
                ->where($map)->order('create_time desc')->select();
        }elseif (isset($get['cost_exprot'])){  //财务导出excel
            $map['o.status']=1;
            $map['o.num']='zcb';
            $list=M()->table(array('order'=>'o'))
                ->field('i.name,o.some_cash,o.course_name,o.create_time as otime,i.pay_way,u.username,u.bus_unit,o.pay_status,i.proxy_remark')
                ->join('inser_under i ON i.id = o.student_id',"left")
                ->join('user u ON i.userid=u.id',"left")
                ->where($map)
                ->group("o.id")
                ->order('o.create_time DESC')
                ->select();
        } else{
            $list=M('inser_under as i')
                ->field('i.*,u.username')
                ->join('user AS u ON i.userid=u.id',left)
                ->where($map)->order('create_time DESC')->select();
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

        //导出财务excel
        if(!empty($get['cost_exprot'])){
            if ($list && count($list) > 0) {
                $this->cost_exprot($list,$pay_date_b,$pay_date_e,$map['o.num']);//导出财务excel
            }else{
                $this->error('没有对应的数据');
            }
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

                //是否师范专业，1是，0否
                if( $list[$i]['is_normal'] == 0 ){
                    $is_normal = '否';
                }else if ($list[$i]['is_normal'] == 1){
                    $is_normal= '是';
                }

                //是否在校，1是，0否
                if( $list[$i]['in_school'] == 0 ){
                    $in_school = '否';
                }else if ($list[$i]['in_school'] == 1){
                    $in_school= '是';
                }

                //学习形式，1普通全日制，2成人高考，3远程教育
                if( $list[$i]['study_form'] == 1 ){
                    $study_form = '普通全日制';
                }else if ($list[$i]['study_form'] == 2){
                    $study_form= '成人高考';
                }else if ($list[$i]['study_form'] == 3){
                    $study_form= '远程教育';
                }

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

                //报考类型名称
//                $course=D("Course")->getCoureById($list[$i]['course']);
                //班型套餐
                $course_package=D("CoursePackage")->getCourePackageById($list[$i]['course_package']);
                //培训校区
                $campus=D("Campus")->getCampusById($list[$i]['campus']);
                //业务员招生老师
                $user=D("user")->getUserById($list[$i]['userid']);

                //发书情况
                $send_book=D("SendBook")->getSendBookBySdid($list[$i]['id'],23);

                //是否发齐
                $send_status=D("SendBook")->getSendBookBySdidDesc($list[$i]['id'],23);
                if( $send_status[0]['send_status'] == 0 ){
                    $send_status = '未发齐';
                }else if ($send_status[0]['send_status'] == 1){
                    $send_status= '已发齐';
                }
//                show_bug($send_book);exit();

                //导出的数据
                $list[$i]=array(
                    'key'   =>$list[$i]['num'], //序号
                    'name'  =>$list[$i]['name'],    //姓名
                    'sex'   =>$sex,//性别
                    'idcard'    =>$list[$i]['idcard'],  //身份证号
                    'face'    =>$face, //政治面貌
                    'hometown'    =>$list[$i]['hometown'], //籍贯
                    'school'    =>$list[$i]['school'], //大专学校全称
                    'major'    =>$list[$i]['major'], //大专专业名称
                    'in_school'    =>$in_school, //是否在校
                    'tel'   =>$list[$i]['tel'], //手机号码
                    'qq'   =>$list[$i]['qq'], //手机号码
                    'wechar'   =>$list[$i]['wechar'], //微信号
//                    'email'    =>$list[$i]['email'], //邮箱
                    'test_time'    =>$list[$i]['test_time'], //考试年度
                    'course'    =>$list[$i]['course'], //报考类型名称
                    'course_package'    =>$course_package['name'], //班型套餐
                    'campus'    =>$campus['campus_name'], //培训校区
                    'user'    =>$user['username'], //招生老师
                    'emergency_contact'    =>$list[$i]['emergency_contact'], //紧急联系人
                    'emergency_tel'    =>$list[$i]['emergency_tel'], //紧急联系人电话
                    'remarks'    =>$list[$i]['remarks'], //备注
                    'book_name'    =>$send_book[0]['book_name'], //已发放的课本
                    'velivery_num'    =>$send_book[0]['velivery_num'], //快递单号
                    'send_time'    =>$send_book[0]['send_time'], //发放时间
                    'send_status'    =>$send_status, //是否发齐
                    'inser_school'    =>$list[$i]['inser_school'], //插本学校
                    'inser_major'    =>$list[$i]['inser_major'], //插本专业
                    'create_time'    =>$list[$i]['create_time'], //报名日期
                    'receive_address'    =>$list[$i]['receive_address'], //收件地址

                );

            }

            $name_co = "专插本学生报名表";

            $title_arr = array('序号', '姓名', '性别', '身份证号码', '政治面貌', '籍贯', '大专学校全称', '大专学校专业',
                '是否在校', '手机','QQ','微信号', '考试年度','报考类型名称','班型选择','培训校区选择','招生老师','紧急联系人','紧急联系电话',
                 '备注','已发放的课本','快递单号','发放时间','是否发齐','插本报考学校', '插本报考专业', '报名日期', '收件地址');

//            $time = date('Y-m-d', time());
            if (!empty($test_time)){
                $test_time=$test_time.'年';
            }else{
                $test_time="全部";
            }

            $title = "诺信教育专插本".$test_time."考生报名表—";

            if ($list && count($list) > 0) {
                exportExcel($list, $title_arr, $title);
            }else{
                $this->error('没有对应的数据');
            }
        }

         //导出考生照片
        if (!empty($_GET['downImg'])){
            if ($list && count($list) > 0) {
                $this->downtest("专插本" . $test_time . "首次考试学生照片.zip", $list);
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
     * 专插本考生详情
     */
    public function inserUnderStatusDetail(){
        $id=I('get.id');    //学生id

        if(session('roleid')==3){
            //如果是招生老师，根据学生id检测是否是该招生老师的学生
            $seach=D('InserUnder')->getStudentById($id);
            if($seach['userid'] != session('userid')){
                $this->error('这好像不是你的考生哦...');
            }
        }

        //根据学生id获取学生详情
        $detail=D('InserUnder')->getStudentById($id);
        $this->assign('detail',$detail);
//        show_bug($seach);

        $course_package=D('CoursePackage')->getCourePackageById($detail['course_package']);
        $this->assign('course_package',$course_package);
//        show_bug($detail);
//        show_bug($course_package);

        //获取专插本考试时间
        $testTime=D('ThTesttime')->getThTestTimeById(23);
        $this->assign('testTime',$testTime);

        //获取专插本课程
        $course=D('Course')->getCourseByTopid(25);
        $this->assign('course',$course);

        //该学生选择的校区
        $orgcampus=D('Campus')->getCampusById($detail['campus']);
        $this->assign('orgcampus',$orgcampus);
//        show_bug($orgcampus);
        //获取专插本培训校区
        $campus=D('Campus')->getCampusByTopid(1);
        $this->assign('campus',$campus);

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);

        //专插本书本选择列表 ====
        $book=D('book')->getBookByTopid(63);
        $this->assign('book',$book);

        //快递公司
        $delivery=M('delivery')->select();
        $this->assign('velivery',$delivery);

        //发书情况，第二个参数是course_package的证书topid
        $send_book=D('SendBook')->getSendBookBySdid($detail['id'],23);
        $this->assign('send_book',$send_book);
//        show_bug($send_book);

        //专插本课程、价格列表
        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(23);
        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //缴费情况
//        $order=D('order')->getOrderBystuidTopid($id,23);
        $order=D('order')->getOrderBystuidNum($id,"zcb");
        $this->assign('order',$order);
//        echo M()->_sql();
//        show_bug($order);


        $this->display();

    }

    /**
     * 修改专插本学生报名表
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


        $teacherModel=M('inser_under');
        $teacherModel->create();
        $saveResult=$teacherModel->save();
        if($saveResult){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
}