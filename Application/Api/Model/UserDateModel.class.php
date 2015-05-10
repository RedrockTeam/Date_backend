<?php
namespace Api\Model;
use Think\Model;

class UserDateModel extends Model {
    protected $trueTableName  = 'user_date';
    protected $_validate = array(
        array('date_id','number','必须是数字!'), //默认情况下用正则进行验证
        array('user_id','number','必须是数字!'), //默认情况下用正则进行验证
        array('status','number','必须是数字!'), //默认情况下用正则进行验证
    );
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

}