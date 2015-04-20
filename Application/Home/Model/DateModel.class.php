<?php
namespace Home\Model;
use Think\Model;

class DateModel extends Model {
    protected $trueTableName  = 'date';
    //获取约会种类
    public function getInfo($order = 'created_at desc', $offset = 0, $limit = 10){
        $a = $this->join("JOIN user_date ON date.id = user_date.date_id")
                ->field('date.id as showbox_id, user_id, created_at, date_time as date_at, place, title, date_type, gender_limit')
                ->limit($offset, $limit)
                ->order($order)
                ->buildSql();
        $b = $this->table($a.'as a')
            ->join("JOIN users ON a.user_id = users.id")
            ->buildSql();
//        return $b;
        $c = $this->table($b.'as b')
            ->join("JOIN date_type ON b.date_type = date_type.id")
            ->field('showbox_id, user_id, created_at, date_at, place, title, date_type, date_type.id as category_id, gender_limit')
            ->select();
        foreach($c as $v){
            $map1['date_id'] = $v['showbox_id'];
            $map1['condition'] = 1;
            $grade_limit = M('date_limit')->where($map1)->join("JOIN grade ON date_limit.limit = grade.id")->field('selectmodel, name')->select();
            $map2['date_id'] = $v['showbox_id'];
            $map2['condition'] = 2;
            $academy_limit = M('date_limit')->where($map2)->join("JOIN academy ON date_limit.limit = academy.id")->field('selectmodel, name')->select();
            $v['academy_limit'] = $academy_limit;
            $v['grade_limit'] = $grade_limit;
            $data[] = $v;
        }
        return $data;

    }
}