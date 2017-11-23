<?php
namespace Admin\Model;

use Think\Model;

class TsScoreSubjectModel extends Model
{

    /**
     * 根据topid获取记录分数的课程
     * topid:教师证1，人力资源61
     * @param $topid
     * @return mixed
     */
    public function getSubjectByTopid($topid)
    {
//        $course_package = M('course');
        $list = $this->where("scs_topid={$topid} and scs_status=1")->order("scs_sort")->select();
        return $list;
    }


//
//    /**
//     * 根据id获取套餐
//     */
//    public function getCoureById($id){
//        return $this->where('rsu_id=%d and rsu_status=1',$id)->find();
//    }



}


