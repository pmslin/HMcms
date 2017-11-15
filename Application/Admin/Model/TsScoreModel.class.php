<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 15:57
 */

namespace Admin\Model;


use Think\Model;

class TsScoreModel extends Model
{
    /***根据学生id和证书编号获取成绩
     * @param $studentId 学生id
     * @param $num 证书编号
     */
    public function getScoreBystuidNum($studentId,$num){
        return $this->where(" sc_studentid={$studentId} AND sc_test_num='{$num}' AND sc_status=1 ")->select();
    }


    /***根据成绩表id删除成绩
     * @param $id 成绩表id
     * @return bool
     */
    public function deleScoreById($id){
        return $this->where("sc_id=%d",$id)->save(array("sc_status"=>999));
    }

}