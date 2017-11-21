<?php

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
            $result ? $this->success("成绩录入成功！") : $this->error("成绩录入失败");
        }else{
            $this->error("录入姿势不对");
        }
    }


    //根据成绩表id删除成绩
    public function deleteScore(){
        teacher_check();//检测是否有教务权限
        if (IS_GET){
            $result = D("TsScore")->deleScoreById(I("get.id"));
            $result!==false ? $this->success("成绩删除成功！") : $this->error("成绩删除失败");
        }
    }

}