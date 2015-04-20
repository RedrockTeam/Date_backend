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
        $data = [
            [
                'category_id' => '3',
                'showBox_id' => '1',
                'created_at' => '1429446317',
                'date_at' => '1429456317',
                'place' => '重邮宾馆',
                'condition' => '限男生',
                'title' => '来约炮!',
                'user_id' => '10086',
                'username' => 'lcl'
            ],
            [
                'category_id' => '2',
                'showBox_id' => '2',
                'created_at' => '1429446316',
                'date_at' => '1429456316',
                'place' => '重邮宾馆',
                'condition' => '限男生',
                'title' => '来约炮!',
                'user_id' => '10086',
                'username' => 'lcl'
            ],
            [
                'category_id' => '1',
                'showBox_id' => '3',
                'created_at' => '1429446315',
                'date_at' => '1429456315',
                'place' => '重邮宾馆',
                'condition' => '限男生',
                'title' => '来约炮!',
                'user_id' => '10086',
                'username' => 'lcl'
            ],
            [
//                'category_id' => '1',
//                'showBox_id' => '4',
//                'created_at' => '1429446314',
//                'date_at' => '1429456314',
//                'place' => '重邮宾馆',
//                'condition' => '限男生',
//                'title' => '来约炮!',
                'user_id' => '10086',
                'username' => 'lcl'
            ],
            [
                'category_id' => '2',
                'showBox_id' => '5',
                'created_at' => '1429446313',
                'date_at' => '1429456313',
                'place' => '重邮宾馆',
                'condition' => '限男生',
                'title' => '来约炮!',
                'user_id' => '10086',
                'username' => 'lcl'
            ]
        ];
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}