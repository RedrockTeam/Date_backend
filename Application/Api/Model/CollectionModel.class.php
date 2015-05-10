<?php
namespace Api\Model;
use Think\Model;

class CollectionModel extends Model {
    protected $trueTableName  = 'collection';
    //获取收藏列表
    public function getCollection($uid){
        $map['collection.user_id'] = $uid;
        return $this->where($map)
                    ->join('JOIN date ON collection.date_id = date.id')
                    ->join('JOIN users ON date.user_id = users.id')
                    ->field('date_id, date.user_id, date.status as date_status, head, signature, nickname, gender, title, date_time, created_at, cost_model, content, place, score')
                    ->select();
    }
}