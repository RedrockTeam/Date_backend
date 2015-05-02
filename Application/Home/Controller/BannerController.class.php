<?php
namespace Home\Controller;
use Home\Model\AdvertiseModel;
use Think\Controller;
class BannerController extends Controller {
    //获取广告位广告
    public function Banner ()
    {
        if (!IS_POST) {
            $data['info'] = '获取方式错误!';
            $data['status'] = 403;
            $this->ajaxReturn($data);
        }
        $ad = new AdvertiseModel();
        $data = $ad->getBanner();
        $data['status'] = 200;
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}