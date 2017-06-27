<?php
namespace Admin\Model;

use Think\Model;

class DeptModel extends Model
{
    /**
     * 获取部门
     */
    public function getDept(){
        return M('dept')->select();
    }

    /**
     * 根据id获取部门信息
     */
    public function getDeptById($id){
        return M('dept')->where('id=%d',$id)->find();
    }







}


