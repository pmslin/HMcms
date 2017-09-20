<?php
namespace Admin\Model;

use Think\Model;

class SendBookModel extends Model
{


    /**
     * 根据学生id获取已发书本
     * topid:教师证1，自考7，导游证12，普通话20，专插本23
     */
    public function getSendBookBySdid($id,$topid){
        $data=M('send_book s')->join('user u ON s.user_id = u.id')
            ->field('u.username,s.*')
            ->where('student_id=%d AND topcourse_id=%f AND info_status=1',$id,$topid)->select();
        return $data;
//        return M('send_book')->where('student_id=%d AND topcourse_id=%f AND info_status=1',$id,$topid)->select();
    }

    /**
     * 根据id删除发书记录
     */
    public function deleByid($id){
        $data['info_status']=99;
        return $this->where('id=%d',$id)->save($data);
    }



    /** 暂针对专插本导出excel显示是否发齐，取最后一条发齐情况显示。现在只导出条数据，导出发书情况功能有缺陷
     * 根据学生id获取已发书本
     * topid:教师证1，自考7，导游证12，普通话20，专插本23
     */
    public function getSendBookBySdidDesc($id,$topid){
        return M('send_book')->where('student_id=%d AND topcourse_id=%f AND info_status=1',$id,$topid)->order('id desc')->select();
    }

}


