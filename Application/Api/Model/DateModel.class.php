<?php
namespace Api\Model;
use Think\Model;

class DateModel extends Model {
    protected $trueTableName  = 'date';
    //获取约会信息
    public function getInfo($type = '%', $order = 'date.created_at desc', $page = 1, $limit = 10){
        $where['date.date_type'] = array('LIKE', $type);
        $offset = ($page - 1) * $limit;
        $a = $this
                ->where($where)
                ->field('date.id as date_id, date.user_id, date.created_at as date_created_at, date_time as date_at, place, title, date_type, cost_model')
                ->limit($offset, $limit)
                ->order($order)
                ->buildSql();
        $b = $this->table($a.'as a')
            ->join("JOIN users ON a.user_id = users.id")
            ->buildSql();
        $c = $this->table($b.'as b')
            ->join("JOIN date_type ON b.date_type = date_type.id")
            ->field('b.nickname, b.head, b.gender, date_id, user_id, date_created_at as created_at, date_at, place, title, date_type, date_type.type as type, date_type.id as category_id, cost_model, b.signature')
            ->select();
        foreach($c as $v){
            $map1['date_id'] = $v['date_id'];
            $map1['condition'] = 1;
            $grade_limit = M('date_limit')->where($map1)->join("JOIN grade ON date_limit.limit = grade.id")->field('selectmodel, grade.id')->select();
//            $map2['date_id'] = $v['date_id'];
//            $map2['condition'] = 2;
//            $academy_limit = M('date_limit')->where($map2)->join("JOIN academy ON date_limit.limit = academy.id")->field('selectmodel, name')->select();
//            foreach($academy_limit as $va)
//            $v['academy_limit'][] = $va;
            if($grade_limit != null) {
                foreach ($grade_limit as $va)
                    $v['grade_limit'][] = $va['id'];
            }
            else{
                $v['grade_limit'] = [];
            }
            $data[] = $v;
        }
        return $data;
    }

    //获取约会详情
    public function getDetailInfo($uid, $date_id){
        $where['date.id'] = $date_id;
        $a = $this
            ->where($where)
            ->field('date.id as date_id, date.user_id, date.created_at as date_created_at, date_time as date_at, place, title, date_type, gender_limit, cost_model')
            ->buildSql();
        $b = $this->table($a.'as a')
            ->join("JOIN users ON a.user_id = users.id")
            ->buildSql();
        $c = $this->table($b.'as b')
            ->join("JOIN date_type ON b.date_type = date_type.id")
            ->field('b.nickname, b.head, b.gender, date_id, user_id, date_created_at as created_at, date_at, place, title, date_type, date_type.type as type, date_type.id as category_id, gender_limit, cost_model')
            ->select();
        foreach($c as $v){
            $map1['date_id'] = $v['date_id'];
            $map1['condition'] = 1;
            $grade_limit = M('date_limit')->where($map1)->join("JOIN grade ON date_limit.limit = grade.id")->field('selectmodel, grade.id')->select();
//            $map2['date_id'] = $v['date_id'];
//            $map2['condition'] = 2;
//            $academy_limit = M('date_limit')->where($map2)->join("JOIN academy ON date_limit.limit = academy.id")->field('selectmodel, name')->select();
//            $v['academy_limit'] = $academy_limit;
            if($grade_limit != null) {
                foreach ($grade_limit as $va)
                    $v['grade_limit'][] = $va['id'];
            }
            else{
                $v['grade_limit'] = [];
            }
            $data[] = $v;
        }
        $data[0]['collection_status'] = $this->getcCollectionStatus($uid, $date_id);
        $data[0]['apply_status'] = $this->getcCApplyStatus($uid, $date_id);
        return $data[0];
    }
    //获取收藏状态
    private function getcCollectionStatus($uid, $date_id) {
        $collection = new CollectionModel();
        $map = [
            'user_id' => $uid,
            'date_id' => $date_id,
        ];
        $num = $collection->where($map)->count();
        if($num > 0)
            return 1;
        else
            return 0;
    }
    //获取报名状态
    private function getcCApplyStatus($uid, $date_id) {
        $userDate = new UserDateModel();
        $map = [
            'user_id' => $uid,
            'date_id' => $date_id,
        ];
        $num = $userDate->where($map)->count();
        if($num > 0)
            return 1;
        else
            return 0;
    }
    //根据
    public function getRow ($date_id) {
        $map['id'] = $date_id;
        return $this->where($map)->find();
    }

    //获取某人发SAO记录
    public function getSao ($uid) {
        $map['date.user_id'] = $uid;
        return $this->where($map)->join("JOIN users ON date.user_id = users.id")->field('users.nickname, users.head, date.id as date_id, title, place, date_time, date.created_at, cost_model, status as date_status')->select();
    }
}