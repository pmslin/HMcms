<?php

namespace Admin\Model;


use Think\Model;

class TsResitModel extends Model
{
    /***根据学生id和证书编号获取补考信息
     * @param $studentId 学生id
     * @param $num 证书编号
     */
    public function getResitBystuidNum($studentId,$num){
        return $this->where(" re_studentid={$studentId} AND re_test_num='{$num}' AND re_status=1 ")->select();
    }


    /***根据成绩表id删除补考信息
     * @param $id 补考信息表id
     * @return bool
     */
    public function deleResitById($id){
        return $this->where("re_id=%d",$id)->save(array("re_status"=>999));
    }

}