<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\CommonController;

class bookController extends BaseController {

    /**
     * 发书操作
     */
    public function sendBook(){

        if(IS_POST){
            //导游证和专插本和专升本不做限制
            if ($_POST['topcourse_id']!=12 && $_POST['topcourse_id']!=23 && $_POST['topcourse_id']!=7){
                //权限检测
                book_check();
            }


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

    }



}