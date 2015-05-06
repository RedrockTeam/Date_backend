<?php
namespace Api\Controller;
use Api\Model\DateModel;
use Think\Controller;
class DateListController extends Controller {
    //获取广告位广告
    public function getList () {
        if (!IS_POST) {
            $data['info'] = '获取方式错误!';
            $data['status'] = 403;
            $this->ajaxReturn($data);
        }
        $list = new DateModel();
        $data = $list->getInfo();
        $data['status'] = 200;
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}