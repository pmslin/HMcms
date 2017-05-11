<?php
namespace Admin\Model;

use Think\Model;

class SendBookModel extends Model
{


    /**
     * 根据学生id获取已发书本
     */
    public function getSendBookBySdid($id,$topid){
        return M('send_book')->where('student_id=%d AND topcourse_id=%f AND info_status=1',$id,$topid)->select();
    }

    /**
     * 根据id删除发书记录
     */
    public function deleByid($id){
        $data['info_status']=99;
        return $this->where('id=%d',$id)->save($data);
    }

}


