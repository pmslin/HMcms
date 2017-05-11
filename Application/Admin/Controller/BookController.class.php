<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\CommonController;

class bookController extends BaseController {

    /**
     * 发书
     */
    public function sendBook(){

        if(IS_POST){
            //权限检测
            book_check();

            $post=I('post.');
            $post['send_time']=date("Y-m-d");
            $add=M('send_book')->add($post);
            $add?$this->success('发书成功~') : $this->error('发书失败！');
        }
    }

    /**
     * 删除发书信息
     */
    public function deleteBook(){
        //权限检测
        book_check();

        $id=I('get.id');
        $dele=D('send_book')->deleByid($id);
        $dele?$this->success('删除成功~') : $this->error('删除失败！');

//        show_bug(I('get.id'));
    }
}