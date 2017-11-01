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
            if ($course==='jsz') $model=M("teacher");
            if ($course==='zk') $model=M("self_test");
            if ($course==='dyz') $model=M("guide");
            if ($course==='pth') $model=M("mandarin");
            if ($course==='zcb') $model=M("inser_under");
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
            if ($course==='jsz') $model=M("teacher");
            if ($course==='zk') $model=M("self_test");
            if ($course==='dyz') $model=M("guide");
            if ($course==='pth') $model=M("mandarin");
            if ($course==='zcb') $model=M("inser_under");
            $save=$model->where('id=%d',$studentId)->setField('status','99');
            $save ? $this->success("报名表删除成功",'',100) : $this->error("报名表删除失败");
        }else{
            $this->error("删除姿势不对");
        }
    }

    //财务审核报名表
    public function audit(){
        if (IS_POST){
//            show_bug($_POST);exit();
            //权限判断，财务和超管有权限
            //检测是否是财务提交，roleid=1和5的可以修改
            if(!in_array(session('roleid'),array(1,5))) {
                $this->error('没有审核权限');
            }
            $post=I("post.");
            $course=$post['course_cat'];
            $studentId=$post['id'];
            if ($course==='jsz') $model=M("teacher");
            if ($course==='zk') $model=M("self_test");
            if ($course==='dyz') $model=M("guide");
            if ($course==='pth') $model=M("mandarin");
            if ($course==='zcb') $model=M("inser_under");
            $save=$model->where('id=%d',$studentId)->setField('is_audit','1'); //对应报名表is_audit字段改为已审核

            //记录到订单表

            $save ? $this->success("审核成功") : $this->error("审核失败");
        }else{
            $this->error("提交姿势不对");
        }
    }



}