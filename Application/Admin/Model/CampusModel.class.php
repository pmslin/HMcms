<?php
namespace Admin\Model;

use Think\Model;

class CampusModel extends Model
{

    /**
     * 根据topid获取全部校区
     * topid:专插本1
     * @param $topid
     * @return mixed
     */
    public function getCampusByTopid($topid)
    {
        $campus = M('campus');
        $list = $campus->where("topid={$topid} and status=1")->order("sort")->select();
        return $list;
    }

    /**
     * 根据id获取校区
     */
    public function getCampusById($id){
        return M('campus')->where('id=%d and status=1',$id)->find();
    }



}


