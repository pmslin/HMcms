<?php
namespace Admin\Controller;
use Think\Controller;
class TestPlaceController extends Controller {

    public function postArea(){
        if(IS_POST){
            $post=I('post.');
            $palce_id=$post['place_id'];
            $area=D('TestPlace')->where(array('topid'=>$palce_id))->select();
            $opt='<option>--请选择区--</option>';
            foreach($area as $key=>$val){
                $opt .= "<option value='{$val['place_id']}'>{$val['place_name']}</option>";
            }

            $this->ajaxReturn($opt);
//            echo json_encode($opt);

        }
    }

}