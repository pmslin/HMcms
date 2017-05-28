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



}


