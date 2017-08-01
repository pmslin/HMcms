<?php
namespace Admin\Controller;
use Think\Controller;
class SelfTestController extends BaseController {

    /**
     * 录入自考报名表页面
     */
    public function index(){

        //考区联动,遍历出市
        $city=D('SelfTestPlace')->where("topid=0")->select();
//        $this->assign('city',$city);

        //获取考试时间
        $testTime=D('ThTesttime')->getThTestTimeById(6);
//        $this->assign('testTime',$testTime);

        //获取自考课程套餐、价格列表
        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(7);
//        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //获取本科学院和专业
        $underSchool=D('UnderSchool')->getUnderShool();
        $underMajor=D('UnderMajor')->getUnderMajor();

        $array=array(
            'TeaCoursePackage'  =>$TeaCoursePackage,
            'city'          =>$city,
            'testTime'     =>$testTime,
            'underSchool'   =>$underSchool,
            'underMajor'   =>$underMajor,
        );
        $this->assign($array);

        $this->display();
    }


    /***
     * 自考报名表，表提交单
     */
    public function postfrom(){
        if(IS_POST){
            $post=I('post.');

//            show_bug($post);
//            exit();

            //查询出考区
            $testPlaceModel=D('SelfTestPlace');
//            $id=$post['place_city_id'];
            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
            $test_place=$place_city['place_name'].$place_area['place_name'];

            if (!empty($post['an_place_city_id'])){
                //查询出备选考区
                $an_place_city=$testPlaceModel->getPalceNameById($post['an_place_city_id']);
                $an_place_area=$testPlaceModel->getPalceNameById($post['an_place_area_id']);
                $an_test_place=$an_place_city['place_name'].$an_place_area['place_name'];
//                show_bug($an_place_city);exit();
                $post['an_test_place']=$an_test_place;  //备选考区
            }


            D()->startTrans(); //开启事务
            //上传考生照片
            $upload = new \Think\Upload();// 实例化上传类   开始
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Public/Uploads/'; // 设置附件上传目录    // 上传文件
            $info = $upload->uploadOne($_FILES['pic']); //pic为字段名
            if (!$info) {// 上传错误提示错误信息
//                $this->error($upload->getError());
                unset( $_POST['pic']);
            } else {// 上传成功
                $post['pic'] = $info['savepath'] . $info['savename'];  //上传成功，$data['pic'] pic为字段名  结束
            }

            $time=date("Y-m-d");
            $post['create_time']=$time;
            $post['test_place']=$test_place;    //考区
            $post['userid']=session('userid');
//            show_bug($post['under_major']);die();
            //获取报考专业编码和名称
            $underMajor=D('UnderMajor')->getUnderMajorByNum($post['under_major_num']);
//            show_bug($underMajor);die();
            $post['under_major']=$underMajor['name'];//专业名称
            $post['under_major_num']=$underMajor['number'];
            //添加数据到teacher表
            $addResult=D('self_test')->add($post);

            //添加数据到order表
            $orderData['course_package_id']=$post['course_package'];
            $orderData['pay_status']=$post['pay_status'];
            $orderData['user_id']=session('userid');
            $orderData['create_time']=$time;
            $orderData['student_id']=$addResult;
            $orderData['course_package_topid']=7;   //标记为自考
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

    //自考列表页面
    public function selfTestList(){
        //自考考试时间，用于查询选择
        $testTime=D('ThTesttime')->getThTestTimeById(6);
        $this->assign('testTime',$testTime);
        $this->display();
    }

    /*
  * ajax获取教师证考生列表
  */
    public function getSelfTestList(){

        $get=I('get.');
        $test_time=$get['test_time'];

//        show_bug($get);

        //如果是招生老师，只显示自己招收的学生
        if(session('roleid')==3){
            $map['userid']=session('userid');
        }

        if( $test_time!=0 || !empty($get['exprot']) ){
//            exit();
            $map['test_time']=$test_time;
        }

        if( $test_time==0 && !empty($get['exprot']) ){
//            echo 1;
//            exit();
            unset($map['test_time']);
        }

        $map['s.status']=1;

        if(empty($get['exprot'])) {  //列表，把不需要的字段剔除
            $list=M('self_test as s')
                ->field('s.id,s.name,s.tel,s.create_time,s.test_time,s.pic,u.username')
                ->join('user AS u ON s.userid=u.id',left)
                ->where($map)->order('create_time desc')->select();
        }else{
            $list=M('self_test as s')
                ->field('s.*,u.username')
                ->join('user AS u ON s.userid=u.id',left)
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

                //业务员
                $user=D("user")->getUserById($list[$i]['userid']);

                //套餐
                $course_package=D("CoursePackage")->getCourePackageById($list[$i]['course_package']);

                //已收金额
                $some_cash=D("Order")->getOrderBystuidTopid($list[$i]['id'],7);

                $list[$i]=array(
                    'key'   =>$list[$i]['num'], //序号
                    'test_time' =>$list[$i]['test_time'],   //首次考试时间
                    'under_major'    =>$list[$i]['under_major'],    //报考专业
                    'under_major_num'    =>$list[$i]['under_major_num'],    //专业编号
                    'name'  =>$list[$i]['name'],    //姓名
                    'sex'    =>$sex,    //性别
                    'test_place'    =>$list[$i]['test_place'],    //考区
                    'an_test_place'    =>$list[$i]['an_test_place'],    //备选考区
                    'test_num'    =>$list[$i]['test_num'],    //准考证号
                    'tel'   =>$list[$i]['tel'],   //联系电话
                    'idcard'    =>$list[$i]['idcard'],    //身份证号码
                    'college_major'    =>$list[$i]['college_major'],    //专科专业
                    'bus_unit'    =>$user['bus_unit'],    //业务部门
                    'username'    =>$user['username'],    //业务员
                    'college_school'=>$list[$i]['college_school'],        //所在单位（大专院校名称）
                    'course_package_name'    =>$course_package['name'],    //套餐
                    'some_cash'    =>$some_cash[0]['some_cash'],    //已缴金额
                    'qq'    =>$list[$i]['qq'],    //QQ
                    'emergency_contact' =>$list[$i]['emergency_contact'],    //紧急联系人
                    'emergency_tel' =>$list[$i]['emergency_tel'],    //紧急联系电话
                    'address'=>$list[$i]['address'],    //地址
                    'create_time'=>$list[$i]['create_time'],    //录入日期

                );

            }

            $name_co = "自考学生报名表";

            $title_arr = array('序号', '首次考试时间', '报考专业','专业编号', '姓名', '性别','考区','备选考区', '准考证号','联系电话',
                '身份证号码','专科专业','业务部门','业务员','所在单位','套餐','实收金额', 'QQ', '紧急联系人','紧急联系人电话','地址','录入日期');

//            $time = date('Y-m-d', time());

            //$title：excel文件名
            if (empty($test_time)){
                $title="所有自考考生——";
            }else{
                $title = "自考".$test_time."首次考试学生—";
            }

            if ($list && count($list) > 0) {
                exportExcel($list, $title_arr, $title);
            }else{
                $this->error('没有对应的数据');
            }
        }

        if (!empty($_GET['downImg'])){
            if ($list && count($list) > 0) {
                $this->downtest("自考" . $test_time . "首次考试学生照片.zip", $list);
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
     * 自考考生详情
     */
    public function selfTestStaDetail(){
        $id=I('get.id');    //学生id

        if(session('roleid')==3){
            //如果是招生老师，根据学生id检测是否是该招生老师的学生
            $seach=D('SelfTest')->getStudentById($id);
            if($seach['userid'] != session('userid')){
                $this->error('这好像不是你的考生哦...');
            }
        }

        ////根据学生id获取学生详情
        $detail=D('SelfTest')->getStudentById($id);
        $this->assign('detail',$detail);

        //根据学生报考的班型套餐id，获取班型套餐详情
        $course_package=D('CoursePackage')->getCourePackageById($detail['course_package']);
        $this->assign('course_package',$course_package);
//        show_bug($detail);
//        show_bug($course_package);

        //获取自考考试时间
        $testTime=D('ThTesttime')->getThTestTimeById(6);
        $this->assign('testTime',$testTime);

        //获取教师证课程
//        $course=D('Course')->where("topid=1")->select();
//        $this->assign('course',$course);

        //考区联动,遍历出市
        $city=D('SelfTestPlace')->where("topid=0")->select();
        $this->assign('city',$city);

        //自考书本选择列表
        $book=D('book')->getBookByTopid(29);
        $this->assign('book',$book);

        //快递公司
        $delivery=M('delivery')->select();
        $this->assign('velivery',$delivery);

        //发书情况，第二个参数是course_package的证书topid
        $send_book=D('SendBook')->getSendBookBySdid($detail['id'],7);
        $this->assign('send_book',$send_book);
//        show_bug($send_book);

        //缴费情况
        $order=D('order')->getOrderBystuidTopid($id,7);
        $this->assign('order',$order);

        //获取本科学院和专业
        $underSchool=D('UnderSchool')->getUnderShool();
        $underMajor=D('UnderMajor')->getUnderMajor();

        $array=array(
            'underSchool'   =>$underSchool,
            'underMajor'   =>$underMajor,
        );
        $this->assign($array);


        $this->display();

    }


    /**
     * 修改自考学生报名表
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
            $testPlaceModel=D('SelfTestPlace');
//            $id=$post['place_city_id'];
            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
            $_POST['test_place']=$place_city['place_name'].$place_area['place_name'];
        }

        if(!empty($post['an_place_area_id'])){
//            echo 1;
            //查询出备考考区
            $testPlaceModel=D('SelfTestPlace');
//            $id=$post['place_city_id'];
            $an_place_city=$testPlaceModel->getPalceNameById($post['an_place_city_id']);
            $an_place_area=$testPlaceModel->getPalceNameById($post['an_place_area_id']);
            $_POST['an_test_place']=$an_place_city['place_name'].$an_place_area['place_name'];
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

        //报考专业和编码
        //获取报考专业编码和名称
//        show_bug($post);die();
        $underMajor=D('UnderMajor')->getUnderMajorByNum($post['under_major_num']);
//            show_bug($underMajor);die();
        $_POST['under_major']=$underMajor['name'];//专业名称
        $_POST['under_major_num']=$underMajor['number'];


        $selfTestModel=M('self_test');
        $selfTestModel->create();
        $saveResult=$selfTestModel->save();
        if($saveResult){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
}