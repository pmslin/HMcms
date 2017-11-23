<?php
namespace Admin\Model;

use Think\Model;

class TsResitTimeModel extends Model
{
    /**
     * 根据top获取补考时间
     * topid:教师证1  人力资源6
     * */
    public function getResitTimeById($topid){
        return $this->where("rt_topid = %d AND rt_status = 1",$topid)->order('rt_sort')->select();
    }







}


