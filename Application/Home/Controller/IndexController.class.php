<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function pic () {
        $banner = new BannerController();
        $banner->Banner();
    }

    public function category () {
        $type = new CategoryController();
        $type->date_type();
    }

    public function showBox () {
        $list = new DateListController();
        $list->getList();
    }
}