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

    public function postfrom(){
        if(IS_POST){
            $post=I('post.');

            $testPlaceModel=D('TestPlace');
//            $id=$post['place_city_id'];
            $place_city=$testPlaceModel->getPalceNameById($post['place_city_id']);
            $place_area=$testPlaceModel->getPalceNameById($post['place_area_id']);
            $test_place=$place_city['place_name'].$place_area['place_name'];



//            $post=array(
//                'create_time'   =>time(),
//                'test_place'    =>$test_place
//            );
            $post['create_time']=time();
            $post['test_place']=$test_place;
            $addResult=D('Teacher')->add($post);
            if($addResult){
                $this->success('录入成功','Teacher/index');
            }else{
                $this->error('录入失败');
            }
        }
//        print_r($_POST);
//        exit();
    }

    //考区联动
    public function ajax_palce(){
        if(IS_POST){

        }else{

        }


    }


}