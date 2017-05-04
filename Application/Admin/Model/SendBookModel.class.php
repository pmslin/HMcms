<?php
namespace Admin\Model;

use Think\Model;

class SendBookModel extends Model
{


    /*
     * 根据学生id获取已发书本
     */
    public function getSendBookBySdid($id){
        return M('send_book')->where('student_id=%d',$id)->select();
    }

    /*
     * 根据id删除发书记录
     */
    public function deleByid($id){
        return $this->where('id=%d',$id)->delete();
    }

}


