<?php
namespace Admin\Model;

use Think\Model;

class UnderSchoolModel extends Model
{

    /***
     * 获取本科学校列表
     */
    public function getUnderShool(){
        return M('under_school')->where('status = 1')->select();
    }





}


