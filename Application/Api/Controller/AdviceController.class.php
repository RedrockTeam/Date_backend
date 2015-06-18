<?php
namespace Api\Controller;
use Think\Controller;

class AdviceController extends BaseController {
    //提意见
    public function getAdvice (){
      $input = I('post.');
        $advice = [
            'uid' => $input['uid'],
            'content' => $input['content'],
            'time' => time()
        ];
        if(M('advice')->add($advice)) {
            $data = [
                'info' => '成功',
                'status' => 200
            ];
            $this->ajaxReturn($data);
        }
        else {
            $data = [
                'info' => '失败',
                'status' => 500
            ];
            $this->ajaxReturn($data);
        }

    }
}