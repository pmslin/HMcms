<?php
namespace Admin\Controller;
use Think\Controller;
class ComController extends BaseController {

    //核实信息
    public function check(){
        if (IS_POST){
//            show_bug($_POST);exit();
            //权限判断，教务和超管有权限
            //检测是否是教务提交，roleid=1和4的可以修改
            if(!in_array(session('roleid'),array(1,4))) {
                $this->error('没有核实资料权限');
            }
            $post=I("post.");
            $course=$post['course_cat'];
            $studentId=$post['id'];
            //从提交过来的证书编号，确定是哪个证书，操作哪个表
            if ($course==='jsz') $model=M("teacher");
            if ($course==='zk') $model=M("self_test");
            if ($course==='dyz') $model=M("guide");
            if ($course==='pth') $model=M("mandarin");
            if ($course==='zcb') $model=M("inser_under");
            if ($course==='hr') $model=M("hr");
            $save=$model->where('id=%d',$studentId)->setField('is_check','1');
            $save ? $this->success("资料核实成功") : $this->error("资料核实失败");
        }else{
            $this->error("提交姿势不对");
        }

    }

    //删除报名表
    public function delete(){
        if (IS_POST){
//            show_bug($_POST);exit();
            //权限判断，教务和超管有权限
            //检测是否是教务提交，roleid=1和4的可以修改
            if(!in_array(session('roleid'),array(1,4))) {
                $this->error('没有删除权限');
            }
            $post=I("post.");
            $course=$post['course_cat'];
            $studentId=$post['id'];
            //从提交过来的证书编号，确定是哪个证书，操作哪个表
            if ($course==='jsz') $model=M("teacher");
            if ($course==='zk') $model=M("self_test");
            if ($course==='dyz') $model=M("guide");
            if ($course==='pth') $model=M("mandarin");
            if ($course==='zcb') $model=M("inser_under");
            if ($course==='hr') $model=M("hr");
            $save=$model->where('id=%d',$studentId)->setField('status','99');
            $save ? $this->success("报名表删除成功",'',100) : $this->error("报名表删除失败");
        }else{
            $this->error("删除姿势不对");
        }
    }

    //财务审核报名表
    public function audit(){
        if (IS_POST){
//            show_bug($_POST);
//            exit();
            //权限判断，财务和超管有权限
            //检测是否是财务提交，roleid=1和5的可以修改
            if(!in_array(session('roleid'),array(1,5))) {
                $this->error('没有审核权限');
            }
            $post=I("post.");
            $course=$post['course_cat'];
            $studentId=$post['id'];
            //从提交过来的证书编号，确定是哪个证书，操作哪个表
            if ($course==='jsz') $model=M("teacher");
            if ($course==='zk') $model=M("self_test");
            if ($course==='dyz') $model=M("guide");
            if ($course==='pth') $model=M("mandarin");
            if ($course==='zcb') $model=M("inser_under");
            if ($course==='hr') $model=M("hr");

            D()->startTrans(); //开启事务
            //审核报名表。对应报名表is_audit字段改为已审核
            $save=$model->where('id=%d',$studentId)->setField('is_audit','1');

            $teacherInfo=$model->where('id=%d',$studentId)->find();
            if ($post['pay_status']==1){
                $pay_status="一次性交齐";
            }else{
                $pay_status="预报名";
            }

            //记录到订单表
            $orderData['course_package_id']=$post['course_package']; //套餐id
            $orderData['periods']=$pay_status; //期数
            $orderData['pay_status']=$post['pay_status']; //是否交齐
            $orderData['user_id']=$teacherInfo['userid']; //业务员id
            $orderData['create_time']=$post['pay_time'];    //缴费时间
            $orderData['student_id']=$post['id'];   //学生id
            $orderData['course_package_topid']=$post['topcourse_id'];   //证书id
            $orderData['num']=$post['course_cat'];   //证书编号
            $orderData['some_cash']=$post['some_cash'];   //已收金额
            //获取套餐价格和名称
            $course_package=D('CoursePackage')->getCourePackageById($post['course_package']);
            $orderData['course_name']=$course_package['name'];
            $orderData['course_price']=$course_package['price'];

//            show_bug($orderData);exit();

            $addOrder=D('Order')->add($orderData);  //增加数据到order表

            if($save && $addOrder){
                D()->commit(); //事务提交
                $this->success('审核成功');
            }else{
                D()->rollback(); //事务回滚
                $this->error('审核失败');
            }

//            $save ? $this->success("审核成功") : $this->error("审核失败");
        }else{
            $this->error("提交姿势不对");
        }
    }



}