<?php
namespace Api\Model;
use Think\Model;

class UserDateModel extends Model {
    protected $trueTableName  = 'user_date';
    //获取这条约会记录
    public function getRow ($uid, $date_id) {
        $map = [
            'date_id' => $date_id,
            'user_id' => $uid
        ];
        return $this->where($map)->find();
    }

    //获取某人约炮记录
    public function getPao ($uid) {
        $map = [
            'user_date.user_id' => $uid
        ];
        return $this->where($map)
            ->join("JOIN users ON user_date.user_id = users.id")
            ->join("JOIN date ON user_date.date_id = date.id")
            ->field('date_id, date.user_id, time, user_date.status as user_status, date.status as date_status, head, signature, nickname, gender, title, date_time, created_at, cost_model, content, place, score')
            ->select();
    }
    //检查是否已经约过
    public function joined ($uid, $date_id) {
        $map = [
            'user_id' => $uid,
            'date_id' => $date_id
        ];
        $count = $this->where($map)->count();
        if($count > 0)
            return false;
        else
            return true;
    }
    //查看某人是否成功约炮
    public function joincheck($uid, $get_uid) {
        $map = [
            'date.user_id' => $uid,
            'user_date.user_id' => $get_uid,
            'user_date.status' => 1
        ];
        $num = $this->where($map)->join('JOIN date ON user_date.date_id = date.id')->count();
        if($num > 0)
            return true;
        else
            return false;
    }

    //获取当前约已报名人
    public function datePerson ($date_id) {
        $map['date_id'] = $date_id;
        return $this->where($map)
            ->join('JOIN users ON user_date.user_id = users.id')
            ->field('users.id as user_id, user_date.date_id, nickname, gender, signature, head')
            ->select();
    }

}