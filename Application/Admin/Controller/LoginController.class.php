<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    /*
     * 跳到登陆页面
     * */
    public function index(){
        if(session('username') != null || session('roleid') != null){
//            redirect('/admin/index',2,'正在跳转');
            $this->success("已登陆~");
        }else{
            $this->display();
        }

    }

    /*
     * 用户异步登陆功能
     * */
    public function login(){
        if(!$_POST){
            $this->display('index');
        }

        $result['status']='error';
        $user['tel']=I('tel',0);
        $user['password']=md5(I('password',0));
        $loginModel=D('Login');

        $data=$loginModel->checkLogin($user);
//        var_dump($data);
        if($data['status']=='success'){
            //根据电话号码查询出对应的用户信息
            $userResult=$loginModel->where("tel='%s'  AND status='1' ",array($user['tel']))->find();

            //记录最后登陆ip和时间
            $saveData=array(
                'id'=>$userResult['id'],
                'loginip'=>get_client_ip(),
                'logintime'=>time()
            );
            $saveResult=$loginModel->save($saveData);
//            print_r($saveResult);exit();

            //记录真实姓名和用户组session

//            var_dump($userResult);
            session('username',$userResult['username']);
            session('roleid',$userResult['roleid']);
//            $_SESSION['username']=$userResult['username'];
//            $_SESSION['roleid']=$userResult['roleid'];



            if($saveResult && $userResult){
                $result['status']='success';
            }

        }
        $this->ajaxReturn($result);
    }

    //退出登陆
    public function logout(){
        session(null);
        $this->success('成功退出登陆','/admin/login');

    }
}