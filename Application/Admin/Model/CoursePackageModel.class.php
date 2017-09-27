<?php
namespace Admin\Model;

use Think\Model;

class CoursePackageModel extends Model
{

    /**
     * 根据topid获取课程套餐，价格
     * topid:教师证1，自考7，导游证12，普通话20，专插本23
     * @param $topid
     * @return mixed
     */
    public function searchCoursePackageByTopid($topid)
    {
        $course_package = M('course_package');
        $list = $course_package->where("topid={$topid} and status=1")->order("sort")->select();
        return $list;
    }

    /**
     * 根据名字获取套餐
     */
    public function getCourePackageByName($name){
        return M('course_package')->where('name=%d',$name)->find();
    }

    /**
     * 根据id获取套餐
     */
    public function getCourePackageById($id){
        return M('course_package')->where('id=%d',$id)->find();
    }

}


