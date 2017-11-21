<?php
namespace Admin\Model;

use Think\Model;

class CourseModel extends Model
{

    /**
     * 根据topid获取课程
     * topid:教师证1，专插本25
     * @param $topid
     * @return mixed
     */
    public function getCourseByTopid($topid)
    {
        $course_package = M('course');
        $list = $course_package->where("topid={$topid} and status=1")->order("sort")->select();
        return $list;
    }

    //根据课程num获取课程
    public function getCourseByNum($num)
    {
        $course_package = M('course');
        $list = $course_package->where("num='{$num}' and status=1")->order("sort")->select();
        return $list;
    }

    /**
     * 根据id获取套餐
     */
    public function getCoureById($id){
        return M('course')->where('id=%d and status=1',$id)->find();
    }



}


