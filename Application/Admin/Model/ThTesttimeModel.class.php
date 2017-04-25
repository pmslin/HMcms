<?php
namespace Admin\Model;

use Think\Model;

class ThTesttimeModel extends Model
{
    /*
     * 获取教师证考试时间
     * */
    public function getThTestTimeById(){
        return M('ThTesttime')->where("thtt_status = 1")->order('thtt_sort')->select();
    }




}


