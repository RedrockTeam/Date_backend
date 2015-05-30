<?php
namespace Api\Controller;
use Api\Model\UsersModel;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        if (!IS_POST) {
            $data = [
                'info' => '获取方式错误',
                'status' => 403
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
                    'status' => 403
                ];
                $this->ajaxReturn($data);
            }
        }
        header("Access-Control-Allow-Origin: *");
    }

    //检查权限
    private function auth($uid, $token){
        $users = new UsersModel();
        return $users->checkAuth($uid, $token);
    }
}