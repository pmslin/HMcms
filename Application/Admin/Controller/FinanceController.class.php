<?php
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends BaseController {
    public function index(){
        //财务权限检测
        cost_check();

        $this->display();
    }


    /**
     * 销售额报表
     */
    public function salesList(){
        //财务权限检测
        cost_check();

        $get=I('get.');
        $start_time=$get['start_time'];
        $end_time=$get['end_time'];

//        $map=array();
        $map['order.status']=1;

        if(!empty($start_time) || !empty($end_time)){
            $map['create_time']=array('between',array($start_time,$end_time));
        }



        $list=M('order')
            ->field('order.id,sum(order.some_cash) as count,u.username,order.course_name')
            ->join('user AS u ON order.user_id=u.id',left)
            ->where($map)
            ->group('user_id')
            ->select();

        foreach($list as $key => $value){
            $list[$key]['num']=$key+1;
//            $list[$key]['ac']='<button class="layui-btn" onclick="detail('.$value['id'].')" >详情</button>';
//            array_push($list[$key],array('ac'=>'  <button class="layui-btn" onclick="detail({$vo.id})" >详情</button>'));
        }


        $this->ajaxReturn($list,'json');


    }
}