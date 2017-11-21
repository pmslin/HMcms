<?php
namespace Admin\Model;

use Think\Model;

class HrModel extends Model
{
    /**
     * 根据学生id查找学生
     */
    public function getStudentById($id){
        return M('hr')->where('id=%d',$id)->find();
    }



}


