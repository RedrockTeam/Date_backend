<?php
namespace Home\Model;
use Think\Model;

class DateeModel extends Model {
    protected $trueTableName  = 'date';
    //获取约会种类
    public function getinfo($order = 'time desc'){
        $this->join("JOIN user_date ON date.id = user_date.user_id")->join("JOIN users ON date.id = user_date.user_id")->join("JOIN date_type ON date.date_type = date_type.id")->order($order)->select();
        return $this->select();
    }
}