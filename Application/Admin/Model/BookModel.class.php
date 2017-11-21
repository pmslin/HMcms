<?php
namespace Admin\Model;

use Think\Model;

class BookModel extends Model
{
    /**
     * 根据一级id，book_topid查询证书下的书本
     * 1教师证，29自考，54导游证，61普通话，63专插本
     */
    public function getBookByTopid($topid){
        return M('book')->where('book_topid=%d AND book_status=1',$topid)->order('book_sort,id asc')->select();
    }

    //根据课程编号查询证书下的书本
    public function getBookByNum($num){
        return M('book')->where("num='{$num}' AND book_status=1")->order('book_sort,id asc')->select();
    }




}


