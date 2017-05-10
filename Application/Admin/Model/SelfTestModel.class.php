<?php
namespace Admin\Model;

use Think\Model;

class SelfTestModel extends Model
{
    /**
     * 根据学生id查找学生
     */
    public function getStudentById($id){
        return $this->where('id=%d',$id)->find();
    }



}


