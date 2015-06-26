<?php
namespace Api\Controller;
use Api\Model\AdvertiseModel;
use Think\Controller;
class BannerController extends Controller {
    //获取广告位广告
    public function Banner (){
        $ad = new AdvertiseModel();
        $data['data'] = $ad->getBanner();
        $data['status'] = 200;
        $data['info'] = '成功';
        $this->ajaxReturn($data);
    }

    //todo 做个检测约会过期的函数, 更新date和user_date和letter表中的状态
    //todo Linux corn
    public function updateDate() {
        $condition1 = [
            'date_time' => ['LT', time()],
            'status' => 2,
            'sure_num' => ['exp', '< `limit_num`']
        ];
        $condition2 = [
            'date_time' => ['LT', time()],
            'status' => 2,
            'sure_num' => ['exp', '= `limit_num`']
        ];

        $date = new DateModel();

        $data = $date->where($condition1)->field('id')->select();
        foreach($data as $value) {
            $date_id[] = $value['id'];
        }

        $result1 = ['status' => 0];
        $result2 = ['status' => 1];
        $date->where($condition1)->save($result1);
        $date->where($condition2)->save($result2);
        if($date_id != null) {
            $userDate = new UserDateModel();
            $userDate->where(['date_id'=>['IN', $date_id], 'status'=>['NEQ', 0]])->save(['status'=>0]);
            $letter = new LetterModel();
            $letter->where(['date_id'=>['IN', $date_id], 'type'=>['NEQ', 0]])->save(['type'=>0]);
        }
    }

}