<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {

//    protected $tableName = 'user';

    /**
     * 根据用户id查找用户信息
     */
    public function getUserById($userid){
        return M('user')->where('id=%d',$userid)->find();
    }

    /**
     * 根据手机号码查找用户信息
     */
    public function getUserTelByTel($tel){
        return M('user')->where('tel=%d',$tel)->find();
    }

}


