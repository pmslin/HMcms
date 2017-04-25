<?php
namespace Admin\Model;

use Think\Model;

class TeacherModel extends Model
{
    /*
     * 根据学生id查找学生
     */
    public function getStudentById($id){
        return M('teacher')->where('id=%d',$id)->find();
    }



}


