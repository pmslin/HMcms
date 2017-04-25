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

    /*
     * 根据id获取套餐
     */
    public function getCourePackageById($id){
        return M('course_package')->where('id=%d',$id)->find();
    }

}


