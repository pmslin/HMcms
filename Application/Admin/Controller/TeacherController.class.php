<?php
namespace Admin\Controller;
use Think\Controller;
class TeacherController extends BaseController {



    //录入教师证报名资料页面
    public function index(){
//        var_dump(session());
        //教师证课程、价格列表
        $TeaCoursePackage=D('CoursePackage')->searchCoursePackageByTopid(1);
        $this->assign('TeaCoursePackage',$TeaCoursePackage);

        //考区联动,遍历出市
        $city=D('TestPlace')->where("topid=0")->select();
        $this->assign('city',$city);
//        var_dump($city);

        //课程
        $course=D('Course')->where("topid=1")->select();
        $this->assign('course',$course);
//        var_dump($course);

        $this->display();
    }

    /*
     * 教师证报名表提交
     */
    public function postfrom(){
        if(IS_POST){
            $post=I('post.');

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

            $time=time();
            $post['create_time']=$time;
            $post['test_place']=$test_place;
            $post['userid']=session('userid');
            //添加数据到teacher表
            $addResult=D('Teacher')->add($post);

            //添加数据到order表
            $orderData['course_package_id']=$post['course_package'];
            $orderData['pay_status']=$post['pay_status'];
            $orderData['some_cash']=$post['some_cash'];
            $orderData['user_id']=session('userid');
            $orderData['create_time']=$time;
            $orderData['student_id']=$addResult;
            $orderData['course_package_topid']=1;
            $addOrder=D('Order')->add($orderData);


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


    //教师证考生列表
    public function teacherList(){

        $list=D('Teacher')->select();
        $this->assign('list',$list);

        $this->display();
    }

    //考区联动
//    public function ajax_palce(){
//        if(IS_POST){
//
//        }else{
//
//        }
//
//
//    }


}