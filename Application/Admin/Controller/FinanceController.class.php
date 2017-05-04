<?php
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends BaseController {
    public function index(){

        $this->display();
    }


    /*
     * 销售额报表
     */
    public function salesList(){
        $map['create_time']=array('between','2017-04-31,2017-05-05');
        $list=M('order')
            ->field('order.id,sum(order.course_price) as count,u.username')
            ->join('user AS u ON order.user_id=u.id',left)
//            ->where($map)
            ->group('user_id')
            ->select();
//        echo M()->_sql();
//        show_bug($list);

        $this->assign('list',$list);
//
        $this->display();

    }
}