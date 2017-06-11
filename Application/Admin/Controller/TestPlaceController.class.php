<?php
namespace Admin\Controller;
use Think\Controller;
class TestPlaceController extends Controller {

    //考区联动
    public function postArea(){
        if(IS_POST){
            $post=I('post.');
            $palce_id=$post['place_id'];
            $area=D('TestPlace')->where(array('topid'=>$palce_id,'status=1'))->select();
            $opt='<option>--请选择区--</option>';
            foreach($area as $key=>$val){
                $opt .= "<option value='{$val['place_id']}'>{$val['place_name']}</option>";
            }

            $this->ajaxReturn($opt);
//            echo json_encode($opt);

        }
    }


    //自考考区联动
    public function postSelfTestArea(){
        if(IS_POST){
            $post=I('post.');
            $palce_id=$post['place_id'];
            $area=D('SelfTestPlace')->where(array('topid'=>$palce_id,'status=1'))->select();
            $opt='<option>--请选择区--</option>';
            foreach($area as $key=>$val){
                $opt .= "<option value='{$val['place_id']}'>{$val['place_name']}</option>";
            }

            $this->ajaxReturn($opt);
//            echo json_encode($opt);

        }
    }

    //自考备选考区联动
    public function postSelfTestAreaAn(){
//        show_bug($_POST);
        if(IS_POST){
            $post=I('post.');
            $palce_id=$post['place_id'];
            $area=D('SelfTestPlace')->where(array('topid'=>$palce_id,'status=1','alternative=1'))->select();
            $opt='<option>--请选择区--</option>';
            foreach($area as $key=>$val){
                $opt .= "<option value='{$val['place_id']}'>{$val['place_name']}</option>";
            }

            $this->ajaxReturn($opt);
//            echo json_encode($opt);

        }
    }

}