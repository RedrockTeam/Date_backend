<?php
namespace Api\Controller;
use Api\Model\AdvertiseModel;
use Think\Controller;
class BannerController extends BaseController {
    //获取广告位广告
    public function Banner ()
    {

        $ad = new AdvertiseModel();
        $data['data'] = $ad->getBanner();
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }
}