<?php
namespace Admin\Model;

use Think\Model;

class ThTesttimeModel extends Model
{
    /**
     * 根据top获取考试时间
     * topid:教师证1，自考6，导游证15，普通话19，专插本23
     * */
    public function getThTestTimeById($topid){
        return M('ThTesttime')->where("thtt_topid = %d AND thtt_status = 1",$topid)->order('thtt_sort')->select();
    }


    //根据证书编号获取考试时间
//    public function getThTestTimeByNum($num){
//        return M('ThTesttime')->where("num = '{$num}' AND thtt_status = 1")->order('thtt_sort')->select();
//    }




}


