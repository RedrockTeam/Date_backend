<?php
namespace Api\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        if (!IS_POST) {
            $data['info'] = '获取方式错误!';
            $data['status'] = 403;
            $this->ajaxReturn($data);
        }
        header("Access-Control-Allow-Origin: *");
    }
}