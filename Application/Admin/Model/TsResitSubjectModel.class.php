<?php
namespace Admin\Model;

use Think\Model;

class TsResitSubjectModel extends Model
{

    /**
     * 根据topid获取补考科目
     * topid:教师证1，人力资源61
     * @param $topid
     * @return mixed
     */
    public function getSubjectByTopid($topid)
    {
//        $course_package = M('course');
        $list = $this->where("rsu_topid={$topid} and rsu_status=1")->order("rsu_sort")->select();
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


