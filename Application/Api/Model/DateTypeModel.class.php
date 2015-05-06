<?php
namespace Api\Model;
use Think\Model;

class DateTypeModel extends Model {
    protected $trueTableName  = 'date_type';
    //获取约会种类
    public function getType(){
        return $this->select();
    }
}