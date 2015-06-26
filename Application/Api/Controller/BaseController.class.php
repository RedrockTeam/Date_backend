<?php
namespace Api\Controller;
use Api\Model\UsersModel;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        if (!IS_POST) {
            $data = [
                'info' => '获取方式错误',
                'status' => 405
            ];
            $this->ajaxReturn($data);
        }
        else {
            $input = I('post.');
            if(!$input['uid'] || !$input['token']) {
                $data = [
                    'info' => '参数错误',
                    'status' => 403
                ];
                $this->ajaxReturn($data);
            }
            $uid = $input['uid'];
            $token = $input['token'];
            if(!$this->auth($uid, $token)){
                $data = [
                    'info' => '你未登录或登录超时',
                    'status' => 401
                ];
                $this->ajaxReturn($data);
            }
        }
        header("Access-Control-Allow-Origin: *");
    }

    //todo 做个检测约会过期的函数, 更新date和user_date和letter表中的状态
    //todo Linux corn
    public function updateDate() {
        $condition1 = [
            'date_time' => ['LT', time()],
            'status' => 2,
            'sure_num' => ['exp', '< `limit_num`']
        ];
        $condition2 = [
            'date_time' => ['LT', time()],
            'status' => 2,
            'sure_num' => ['exp', '= `limit_num`']
        ];

        $date = new DateModel();

        $data = $date->where($condition1)->field('id')->select();
        foreach($data as $value) {
            $date_id[] = $value['id'];
        }

        $result1 = ['status' => 0];
        $result2 = ['status' => 1];
        $date->where($condition1)->save($result1);
        $date->where($condition2)->save($result2);
        if($date_id != null) {
            $userDate = new UserDateModel();
            $userDate->where(['date_id'=>['IN', $date_id], 'status'=>['NEQ', 0]])->save(['status'=>0]);
            $letter = new LetterModel();
            $letter->where(['date_id'=>['IN', $date_id], 'type'=>['NEQ', 0]])->save(['type'=>0]);
        }
    }


    //检查权限
    private function auth($uid, $token){
        $users = new UsersModel();
        return $users->checkAuth($uid, $token);
    }
}