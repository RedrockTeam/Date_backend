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
//                    ->field('date_id, ') TODO 需要数据待定
                    ->select();
    }
}