<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 2017/5/1
 * Time: 10:35
 */

/*
 *  发书权限检测，roleid=1和4的可以修改，1超管 4教务 6图书管理
 */
function book_check(){
    if(!in_array(session('roleid'),array(1,4,6))) {
        $this->error('没有操作权限');
    }
}