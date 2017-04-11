<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function _initialize(){

        if(session('username') == null || session('roleid') == null){
            $this->error("登陆超时，请再次登陆~",'/admin/login');
        }
    }
}