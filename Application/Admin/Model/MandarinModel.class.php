<?php
namespace Admin\Model;

use Think\Model;

class MandarinModel extends Model
{
    /**
     * 根据学生id查找学生
     */
    public function getStudentById($id){
        return M('mandarin')->where('id=%d',$id)->find();
    }



}


