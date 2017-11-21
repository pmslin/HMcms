<?php


namespace Admin\Controller;


class ResitController extends BaseController
{
    //录入补考信息
    public function addResit(){
        if($_POST){
            teacher_check();//检测是否有教务权限

            $scoreModel=M("resit","ts_");
            $scoreModel->create();
            $result = $scoreModel->add();
            $result ? $this->success("录入补考信息成功！") : $this->error("录入补考信息失败");
        }else{
            $this->error("录入姿势不对");
        }
    }


    //根据成绩表id删除补考信息
    public function deleteResit(){
        teacher_check();//检测是否有教务权限
        if (IS_GET){
            $result = D("TsResit")->deleResitById(I("get.id"));
//            echo M()->_sql();
//            exit();
            $result!==false ? $this->success("删除补考信息成功！") : $this->error("删除补考信息失败");
        }
    }

}