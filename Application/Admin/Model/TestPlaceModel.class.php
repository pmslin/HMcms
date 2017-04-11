<?php
namespace Admin\Model;

use Think\Model;

class TestPlaceModel extends Model
{
    /*
     * 根据id获取市/区
     * */
    public function getPalceNameById($id){
        return D('TestPlace')->where("place_id=%f",$id)->find();
    }




}


