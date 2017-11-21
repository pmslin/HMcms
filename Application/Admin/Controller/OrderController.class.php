<?php
namespace Admin\Controller;
use ClassesWithParents\D;
use Think\Controller;
class OrderController extends BaseController {
    public function index(){

        $this->display();
    }

    /**
     * 费用续缴(分期)/退费  记录操作
     */
    public function saveCost(){
        //权限检测,财务+超管
        cost_check();

        if($_POST){
            $post=I('post.');
            //证书编号， 因为缴费情况是公共页面模块，由js获取当前页面是哪个证书
            $course=$post['order_course_cat'];
            //从提交过来的证书编号，确定是哪个证书，操作哪个表 和 证书编号
            if ($course==='jsz'){
                $model=M("teacher");
                $num=1; //course_package表id
            }
            if ($course==='zk'){
                $model=M("self_test");
                $num=7;
            }
            if ($course==='dyz'){
                $model=M("guide");
                $num=12;
            }
            if ($course==='pth'){
                $model=M("mandarin");
                $num=20;
            }
            if ($course==='zcb'){
                $model=M("inser_under");
                $num=23;
            }
            if ($course==='hr'){
                $model=M("hr");
                $num=56;
            }

            $teacherInfo=$model->where('id=%d',$post['student_id'])->find();

            //记录到订单表
            $orderData['course_package_id']=$teacherInfo['course_package']; //套餐id
            $orderData['pay_status']=$post['pay_status']; //是否交齐
            $orderData['user_id']=$teacherInfo['userid']; //业务员id
            $orderData['create_time']=$post['create_time'];    //缴费时间
            $orderData['student_id']=$post['student_id'];   //学生id
            $orderData['course_package_topid']=$num;   //证书id
            $orderData['num']=$course;   //证书编号
            $orderData['periods']=$post['periods'];   //期数/退费
            //判断这次操作是不是退费，如果是退费标记为负数
            $orderData['some_cash'] = $post['periods']=="退费" ? -$post['some_cash'] : $post['some_cash'];
            //获取套餐价格和名称
            $course_package=D('CoursePackage')->getCourePackageById($teacherInfo['course_package']);
            $orderData['course_name']=$course_package['name'];
            $orderData['course_price']=$course_package['price'];

            $addOrder=D('Order')->add($orderData);  //增加数据到order表

            $addOrder?$this->success('缴费操作成功') : $this->error('续缴操作失败');
        }


    }

    /***
     * 删除交费记录
     */
    public function deleteOrder(){
        if (IS_GET){
            //权限检测,财务+超管
            cost_check();

            $orderId=I("get.id");
            $result=D("order")->deleteOrderByOrderId($orderId);
            $result?$this->success('删除成功') : $this->error('删除失败');
        }
    }


    /***
     * 订单列表页面
     */
    public function orderList(){

        $this->display();
    }



    /**
     * 获取订单列表
     */
    public function getOrderList(){
//        $teacherSql="SELECT * FROM `order` o LEFT JOIN teacher t ON o.user_id = t.id WHERE o. STATUS = 1 AND o.course_package_topid = 1";
//        $teacherList=M()->query($teacherSql);
        $teacherList = D("order")->getOrderBytable("teacher",1);
        $selfTestList = D("order")->getOrderBytable("self_test",7);
        $inserUnderList = D("order")->getOrderBytable("inser_under",23);
        $guideList = D("order")->getOrderBytable("guide",12);
        $mandarinList = D("order")->getOrderBytable("mandarin",20);
        $countList = array_merge($teacherList,$selfTestList,$inserUnderList,$guideList,$mandarinList);
//        $sort = array(
//            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
//            'field'     => 'create_time',       //排序字段
//        );
//        $arrSort = array();
//        foreach($countList AS $uniqid => $row){
//            foreach($row AS $key=>$value){
//                $arrSort[$key][$uniqid] = $value;
//            }
//        }
//        if($sort['direction']){
//            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $countList);
//        }
        $this->ajaxReturn($countList,'json');
        show_bug($countList);
        exit();



        $orderList=M("order")->where("status=1")->select();

        foreach ($orderList as $k=>$v){
            $num=$v['course_package_topid'];
            //从提交过来的证书编号，确定是哪个证书，操作哪个表 和 证书编号
            if ($num=1){
                $model=M("teacher");
                $tb="teacher";
            }
            if ($num=7){
                $model=M("self_test");
                $tb="self_test";
            }
            if ($num=12){
                $model=M("guide");
            }
            if ($num=20){
                $model=M("mandarin");
            }
            if ($num=23){
                $model=M("inser_under");
            }
        }

//        $formList=

        show_bug($orderList);
        exit();


        $sql="SELECT
                    o.*,t.name
                FROM
                    `order` o
                LEFT JOIN teacher t ON o.user_id = t.id AND o.course_package_topid = 1
                LEFT JOIN self_test st ON o.user_id = st.id AND o.course_package_topid = 7
                LEFT JOIN inser_under iu ON o.user_id = iu.id AND o.course_package_topid = 23
                LEFT JOIN guide g ON o.user_id = g.id AND o.course_package_topid = 12
                LEFT JOIN mandarin m ON o.user_id = m.id AND o.course_package_topid = 20
                WHERE o.`status`=1";
        $list=M()->query($sql);

        $teacherList=D("order")->getOrderByteaher();
        show_bug($teacherList);

    }

}