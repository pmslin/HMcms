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





}


