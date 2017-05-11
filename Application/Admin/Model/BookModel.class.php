<?php
namespace Admin\Model;

use Think\Model;

class BookModel extends Model
{
    /**
     * 根据一级id，book_topid查询证书下的书本
     * 1教师证，29自考
     */
    public function getBookByTopid($topid){
        return M('book')->where('book_topid=%d',$topid)->select();
    }




}


