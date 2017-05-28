<?php
namespace Admin\Model;

use Think\Model;

class InserUnderModel extends Model
{
    /**
     * 根据学生id查找学生
     */
    public function getStudentById($id){
        return M('inser_under')->where('id=%d',$id)->find();
    }



}


