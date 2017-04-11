<?php
namespace Admin\Model;
use Think\Model;
class LoginModel extends Model {

    protected $tableName = 'user';

    /**
     * 登录验证
     * @param $login 登录信息
     * @return mixed
     */
    public function checkLogin($login) {
        $where['tel']=$login['tel'];
        $where['password']=$login['password'];
        $where['status']=1;
        $num=M('user')->where($where)->count();
        //检查密码是否正确
        if ($num>0) {
            $rs['status']='success';
        }
        return $rs;
    }
}


