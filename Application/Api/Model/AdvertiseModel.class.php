<?php
namespace Api\Model;
use Think\Model;

class AdvertiseModel extends Model {
    protected $trueTableName  = 'advertise';
    //获取广告位广告
    public function getBanner(){
        return $this->where('status = 1')->field('url, src')->limit(3)->select();
    }
}