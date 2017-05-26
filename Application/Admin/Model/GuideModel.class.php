<?php
namespace Admin\Model;

use Think\Model;

class GuideModel extends Model
{
    /**
     * 根据学生id查找学生
     */
    public function getStudentById($id){
        return M('guide')->where('id=%d',$id)->find();
    }



}


