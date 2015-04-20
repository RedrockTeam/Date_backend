<?php
namespace Home\Controller;
use Home\Model\AdvertiseModel;
use Home\Model\DateModel;
use Org\Util\Date;
use Think\Controller;
class DateListController extends Controller {
    //获取广告位广告
    public function getList () {
        $list = new DateModel();
        $data = $list->getInfo();
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}