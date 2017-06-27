<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index(){

        $this->display1();
    }

    /***
     * 页面
     */
//    public function User(){
//
//        $this->display();
//    }


    /***
     * 生成账号
     */
    public function AddUser(){
        $deptModel=D('dept');
        if ($_POST){
            $post=I('post.');
            $userModel=D('user');
            $checkTel=$userModel->getUserTelByTel($post['tel']);
            echo M()->_sql();
            show_bug($post['tel']);exit();
            if (!empty($checkTel)){
                $msg['status']=99;
                $msg['msg']="手机号码重复了";
            }else{
//                show_bug($post);exit();
                $dept=$deptModel->getDeptById($post['dept']);
                $data['username']=$post['username'];
                $data['tel']=$post['tel'];
                $data['bus_unit']=$dept['dept_name'];
                $data['password']=md5('123456');
                $data['roleid']=$dept['roleid'];
                $data['createdtime']=time();
                $add=$userModel->add($data);
                if ($add>0){
                    $msg['status']=1;
                    $msg['msg']="添加账号成功";
                }
            }

        }else{
            $dept=D('dept')->getDept();
//            show_bug($dept);
            $this->assign('dept',$dept);
            $this->display();
        }

    }
}