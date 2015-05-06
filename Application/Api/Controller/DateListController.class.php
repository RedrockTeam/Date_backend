<?php
namespace Api\Controller;
use Api\Model\DateModel;
use Think\Controller;
class DateListController extends BaseController {
    //获取广告位广告
    public function getList () {
        $list = new DateModel();
        $data = $list->getInfo();
        $data['status'] = 200;
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}