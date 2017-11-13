<?php
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends BaseController {
    public function index(){
        //财务权限检测
        cost_check();

        //默认查最近一周的业绩
        $search=array();
        $search['date_b']=date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
        $search['date_e']=date("Y-m-d",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));
//        show_bug($search);
        $this->assign('search',$search);
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
        $map['num'] = array('neq','');

        if(!empty($start_time) || !empty($end_time)){
            $map['create_time']=array('between',array($start_time,$end_time));
        }



        $list=M('order')
            ->field('order.id,sum(order.some_cash) as count,u.username,u.bus_unit')
            ->join('user AS u ON order.user_id=u.id',left)
            ->where($map)
            ->group('user_id')
            ->order('count desc')
            ->select();

        $sum=array();
        foreach($list as $key => $value){
            $list[$key]['num']=$key+1;

        }

        //有数据才统计合计，不然没有数据时也统计合计的话合计会一列，database列表会出现异常
        if (count($list)>0){
            foreach ($list as $k=>$v){
                $sum['username']='<b style="font-size: 20px;">合计</b>';
                $sum['count'] += $v['count'];
                $sum['num']='';
                $sum['bus_unit']='';
            }
            array_push($list,$sum);
        }


        $this->ajaxReturn($list,'json');


    }
}