<?php
namespace Api\Controller;
use Api\Model\LetterModel;
use Think\Controller;
class LetterController extends BaseController {
    //获取私信
    public function getLetter () {
        $input = I('post.');
        $letter = new LetterModel();
        $input['page'] = $input['page']? $input['page']:1;
        $input['size'] = $input['size']? $input['size']:50;//todo size
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
        if($input['user_agent'] == 'Android') {
            $map1 = [
                'letter.to' => $input['uid'],
                'letter.id' => $input['letter_id']
            ];
            $letter->where($map1)->save(['status'=>1]);
            $data = [
                'status' => 200,
                'info' => '请求成功',
            ];
            $this->ajaxReturn($data);
        }
        $info = $letter->detailLetter($input['uid'], $input['letter_id']);
        $common = new CommonController();
        $info['user_score'] = $common->credit($info['user_id']);
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
            'info' => '成功',
            'letter' => $letter->letterStatus($input['uid']),
        ];
        $this->ajaxReturn($data);

    }

    //私信方式接受/拒绝
    public function dateAction () {
        $input = I('post.');
        $common = new CommonController();
        $result = $common->dateAction($input['uid'], $input['to_id'], $input['date_id'], $input['action']);
        $this->ajaxReturn($result);
    }
}