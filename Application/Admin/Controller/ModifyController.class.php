<?php
namespace Admin\Controller;
use Think\Controller;
class ModifyController extends BaseController {
    public function index(){

        $this->display();
    }

    /**
     * 修改密码
     */
    public function ModifyPwd(){

//        show_bug(session());
        if($_POST){
            $post=I('post.');
            $oldpwd=md5($post['oldpwd']);
            $password=md5($post['password']);
            $confirm_password=md5($post['confirm_password']);
            $user=D('user')->getUserById(session('userid'));
            if($oldpwd != $user['password']){
                $this->error('输入的旧密码错误~');
            }else{
                $data['password']=$password;
                $save=M('user')->where('id=%d',session('userid'))->save($data);
                if($save){
                    $this->success('密码修改成功，下次请用新密码登陆~');
                }else{
                    $this->error('修改密码失败~');
                }
            }
            exit();
//            show_bug($user);
        }

        $this->display();
    }
}