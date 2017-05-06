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
        $get=I('get.');
        $start_time=$get['start_time'];
        $end_time=$get['end_time'];
//        show_bug($start_time);
//        show_bug($end_time);
        if(!empty($start_time) || !empty($end_time)){
            $map['create_time']=array('between',array($start_time,$end_time));
        }
//        show_bug($_GET);


        $list=M('order')
            ->field('order.id,sum(order.course_price) as count,u.username,order.course_name')
            ->join('user AS u ON order.user_id=u.id',left)
            ->where($map)
            ->group('user_id')
            ->select();

        foreach($list as $key => $value){
            $list[$key]['num']=$key+1;
            $list[$key]['ac']='<button class="layui-btn" onclick="detail('.$value['id'].')" >详情</button>';
//            array_push($list[$key],array('ac'=>'  <button class="layui-btn" onclick="detail({$vo.id})" >详情</button>'));
        }

        //2


//        echo M()->_sql();
//        show_bug($list);

        $this->ajaxReturn($list,'json');

//        $this->assign('list',$list);
//        $this->display();

    }
}