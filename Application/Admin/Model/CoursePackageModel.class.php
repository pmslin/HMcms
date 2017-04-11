<?php
namespace Admin\Model;

use Think\Model;

class CoursePackageModel extends Model
{

    public function searchCoursePackageByTopid($topid)
    {
        $course_package = M('course_package');
        $list = $course_package->where("topid={$topid}")->order("sort")->select();
        return $list;
    }

}


