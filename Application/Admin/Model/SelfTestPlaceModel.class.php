<?php
namespace Admin\Model;

use Think\Model;

class SelfTestPlaceModel extends Model
{
    /*
     * 根据id获取市/区
     * */
    public function getPalceNameById($id){
        return D('SelfTestPlace')->where("place_id=%f AND status=1",$id)->find();
    }




}


