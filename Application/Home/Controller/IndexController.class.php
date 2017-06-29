<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        redirect('admin/login'); //域名直接进入时，跳转到登陆页面
    }
}