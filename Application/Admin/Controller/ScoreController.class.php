<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 15:55
 */

namespace Admin\Controller;


class ScoreController extends BaseController
{
    //新增考试成绩
    public function addScore(){
        if($_POST){
            teacher_check();//检测是否有教务权限

            $scoreModel=M("score","ts_");
            $scoreModel->create();
            $result = $scoreModel->add();
            $result ? $this->success("录入成功！") : $this->error("录入失败");
        }else{
            $this->error("录入姿势");
        }
    }


    //根据成绩表id删除成绩
    public function deleteScore(){
        teacher_check();//检测是否有教务权限
        if (IS_GET){
            $result = D("TsScore")->deleScoreById(I("get.id"));
            $result ? $this->success("删除成功！") : $this->error("删除失败");
        }
    }

}