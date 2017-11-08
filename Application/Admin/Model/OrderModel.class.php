<?php
namespace Admin\Model;

use Think\Model;

class OrderModel extends Model
{

    /**
     * 根据学生id和证书topid获取订单信息
     * @param $studentId 学生id
     * @param $topid  course_package的主键id
     * topid:教师证1，自考7，导游证12，普通话20，专插本23
     */
    public function getOrderBystuidTopid($studentId,$topid){
        $data = M('order')
            ->where('student_id=%d AND course_package_topid=%f AND status=1',$studentId,$topid)
            ->order("create_time")
            ->select();
        $sum=array();
        foreach ($data as $k=>$v){
            $sum['periods']='合计';
            $sum['some_cash']+=$v['some_cash'];
        }
        array_push($data,$sum);
        return $data;
    }

    /***根据学生id和证书编号获取订单信息
     * @param $studentId 学生id
     * @param $num 课程编号
     * @return mixed
     */
    public function getOrderBystuidNum($studentId,$num){
        $data = M('order')
            ->where("student_id=%d AND num='{$num}' AND status=1",$studentId)
            ->order("create_time")
            ->select();
//        echo M()->_sql();
        $sum=array();
        foreach ($data as $k=>$v){
            $sum['periods']='合计';
            $sum['some_cash']+=$v['some_cash'];
        }
        array_push($data,$sum);
        return $data;
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

    /***根据交费记录id删除缴费记录
     * @param $orderId Order表主键
     * @return bool
     */
    public function deleteOrderByOrderId($orderId){
        $data['status']=99;
        return M("order")->where("id=%d",$orderId)->save($data);
    }


    /***订单表与报名表表名称和报名表id关联查询
     * @param $table 报名表 表名称
     * @param $topid 报名表 id
     * @return mixed
     */
    public function getOrderBytable($table,$topid){
        $sql="SELECT o.id as oid,o.*,t.id as tid,t.* FROM `order` o LEFT JOIN $table t ON o.user_id = t.id WHERE o. STATUS = 1 AND o.course_package_topid = $topid";
        $teacherList=M()->query($sql);
        return $teacherList;
    }




}


