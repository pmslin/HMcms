<?php
namespace Admin\Controller;
use Think\Controller;
class SelfTestController extends BaseController {

    /**
     * 录入自考报名表页面
     */
    public function index(){

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
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
            $testPlaceModel=D('TestPlace');
//            $id=$post['place_city_id'];
            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
            $test_place=$place_city['place_name'].$place_area['place_name'];

            D()->startTrans(); //开启事务
            //上传考生照片
            $upload = new \Think\Upload();// 实例化上传类   开始
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Public/Uploads/'; // 设置附件上传目录    // 上传文件
            $info = $upload->uploadOne($_FILES['pic']); //pic为字段名
            if (!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            } else {// 上传成功
                $post['pic'] = $info['savepath'] . $info['savename'];  //上传成功，$data['pic'] pic为字段名  结束
            }

            $time=date("Y-m-d");
            $post['create_time']=$time;
            $post['test_place']=$test_place;
            $post['userid']=session('userid');
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

        $list=M('self_test as s')
            ->field('s.*,u.username')
            ->join('user AS u ON s.userid=u.id',left)
            ->where($map)->order('create_time desc')->select();
//        show_bug($list);
//        echo M()->_sql();
//        exit();

        foreach($list as $key => $value){
            $list[$key]['num']=$key+1;
            $list[$key]['ac']='<button class="layui-btn" onclick="detail('.$value['id'].')" >详情</button>';
//            array_push($list[$key],array('ac'=>'  <button class="layui-btn" onclick="detail({$vo.id})" >详情</button>'));
        }

        //导出excel
        if(!empty($get['exprot'])){

            for ($i = 0; $i < count($list); $i++) {
                $list[$i]=array(
                    'key'   =>$list[$i]['num'],
                    'name'  =>$list[$i]['name'],
                    'tel'   =>$list[$i]['tel'],
                    'test_time' =>$list[$i]['test_time'],
                    'under_major'    =>$list[$i]['under_major'],
                );

            }

            $name_co = "自考学生报名表";

            $title_arr = array('序号', '姓名','电话', '首次考试时间', '报考专业');

//            $time = date('Y-m-d', time());

            $title = "自考".$test_time."首次考试学生—";

            if ($list && count($list) > 0) {
                exportExcel($list, $title_arr, $title);
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
            $seach=D('teacher')->getStudentById($id);
            if($seach['userid'] != session('userid')){
                $this->error('这好像不是你的考生哦...');
            }
        }

        //自考学生详情
        $detail=D('SelfTest')->getStudentById($id);
        $this->assign('detail',$detail);

        //班型
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
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);

        //书本选择列表
        $book=D('book')->getBookByTopid(29);
        $this->assign('book',$book);

        //快递公司
        $delivery=M('delivery')->select();
        $this->assign('velivery',$delivery);

        //发书情况
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