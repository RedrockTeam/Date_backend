<?php
namespace Api\Controller;
use Api\Model\LetterModel;
use Think\Controller;
class LetterController extends BaseController {
    //获取私信
    public function getLetter (){
        $data = I('post.');
        $letter = new LetterModel();
        $data = [
            'data' => $letter->letter($data['uid'], $data['page'], $data['size']),
            'status' => 200,
            'info' => '请求成功',
            ];
        $this->ajaxReturn($data);
    }
}