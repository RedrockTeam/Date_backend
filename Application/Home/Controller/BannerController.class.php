<?php
namespace Home\Controller;
use Home\Model\AdvertiseModel;
use Think\Controller;
class BannerController extends Controller {
    //获取广告位广告
    public function Banner () {
        if(!IS_POST)
            $this->ajaxReturn('获取方式错误!');

        $ad = new AdvertiseModel();
        $data = $ad->getBanner();
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}