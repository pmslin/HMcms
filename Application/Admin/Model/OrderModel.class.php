<?php
namespace Admin\Model;

use Think\Model;

class OrderModel extends Model
{

    /**
     * 根据学生id和证书topid获取订单信息
     * @param $studentId
     * @param $topid
     */
    public function getOrderBystuidTopid($studentId,$topid){
        return M('order')->where('student_id=%d AND course_package_topid=%f',$studentId,$topid)->select();
    }


    /**
     * 续缴操作
     * @param $id 订单id
     * @param $some_cash 续缴费用
     * @param $un_cash 未收费用
     * @param $pay_status 是否收齐
     * @return bool
     */
    public function saveCost($id,$some_cash,$pay_cash,$pay_status){
        $data['id']=$id;
        $data['some_cash']=$some_cash + $pay_cash ;
        $data['pay_status']=$pay_status;
        return M('order')->save($data);

    }



}


