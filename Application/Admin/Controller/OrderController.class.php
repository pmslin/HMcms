<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends BaseController {
    public function index(){

        $this->display();
    }

    /**
     * 费用续缴操作
     */
    public function saveCost(){
        //权限检测
        cost_check();

//        show_bug($_POST);
//        exit();

        if($_POST){
            $post=I('post.');
            $id=$post['order_id'];
            $some_cash=$post['some_cash'];
            $pay_cash=$post['pay_cash'];
            $pay_status=$post['pay_status'];

            $save=D('order')->saveCost($id, $some_cash, $pay_cash, $pay_status);
            $save?$this->success('续缴操作成功~') : $this->error('续缴操作失败~');
        }


    }
}