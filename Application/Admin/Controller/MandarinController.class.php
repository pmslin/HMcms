<?php
namespace Admin\Controller;
use Think\Controller;
class MandarinController extends BaseController {

    //录入普通话报名资料页面
    public function index(){
//        var_dump(session());
        //普通话课程、价格列表
//        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(12);
//        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);
//        var_dump($city);


        //获取普通话考试时间
//        $testTime=D('ThTesttime')->getThTestTimeById(15);
//        $this->assign('testTime',$testTime);
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
}