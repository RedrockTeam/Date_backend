<?php
namespace Api\Controller;
use Api\Model\LetterModel;
use Think\Controller;
class LetterController extends BaseController {
    //获取私信
    public function getLetter () {
        $input = I('post.');
        $letter = new LetterModel();
        $info = $letter->letter($input['uid'], $input['page'], $input['size']);
        $common = new CommonController();
        foreach($info as $key => $v){
            $info[$key]['user_score'] = $common->credit($v['user_id']);
        }
        $data = [
            'data' => $info,
            'status' => 200,
            'info' => '请求成功',
            ];

        $this->ajaxReturn($data);
    }

    //获取一条私信
    public function getDetailLetter () {
        $input = I('post.');
        $letter = new LetterModel();
        $info = $letter->detailLetter($input['letter_id']);
        $common = new CommonController();
        foreach($info as $key => $v){
            $info[$key]['user_score'] = $common->credit($v['user_id']);
        }
        $data = [
            'data' => $info,
            'status' => 200,
            'info' => '请求成功',
        ];

        $this->ajaxReturn($data);
    }

    //检查是否有未读私信
    public function letterStatus () {
        $input = I('post.');
        $letter = new LetterModel();
        $data = [
            'status' => 200,
            'letter' => $letter->letterStatus($input['uid']),
        ];
        $this->ajaxReturn($data);

    }

    //私信方式接受/拒绝
    public function dateAction () {
        $input = I('post.');
        $common = new CommonController();
        $result = $common->dateAction($input['to_id'], $input['date_id'], $input['action']);
        $this->ajaxReturn($result);
    }
}