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
    public function getRow($uid, $date_id){
        $map = [
            'date_id' => $date_id,
            'user_id' => $uid
        ];
        return $this->where($map)->find();
    }
}