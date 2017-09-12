<?php
namespace Admin\Model;

use Think\Model;

class UnderMajorModel extends Model
{

    /***
     * 获取本科专业
     */
    public function getUnderMajor(){
        return M('under_major')->where('status = 1')->select();
    }

    /**
     * 根据专业编码获取专业信息
     */
    public function getUnderMajorByNum($num){
        return M('under_major')->where("number='$num' AND status=1")->find();
    }




}


