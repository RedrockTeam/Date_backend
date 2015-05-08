<?php
/**
 * Created by PhpStorm.
 * User: lzy
 * Date: 2015/5/6
 * Time: 17:15
 */

namespace Api\Controller;
use Api\Model\DateModel;
use Api\Model\UserDateModel;
use Think\Controller;
class CommonController extends BaseController{
    // 接收/拒绝 约会
    public function dateAction ($apply_user_id , $date_id, $operation) {
        $userdate = new UserDateModel();
        $row = $userdate->getRow($apply_user_id , $date_id);
        //检查约会记录是否存在
        if(!$row){
            $data = [
                "status" => 404,
				"info" => "没有这条约会记录"
            ];
           return $data;
        }
        $date = new DateModel();
        $date_row = $date->find($date_id);
        
        //检查约会人数
        if($date_row['sure_num'] >= $date_row['limit_num']){
            $data = [
                "status" => 403,
                "info" => "约会人数已满"
            ];
           return $data;
        }
        
        //检查约会是否超时
        if($date_row['date_time'] < time()){
            $data = [
                "status" => 403,
                "info" => "约会已过期"
            ];
            $map = [
                'user_id' => $apply_user_id,
                'date_id' => $date_id,
                'status' => 2
            ];
            $update = ['status' => 0];
            $userdate->where($map)->save($update);
           return $data;
        }
        
        //检查是否已接受/拒绝
        if($row['status'] != 2){
            $status = $row['status'] == 1? '接受':'拒绝';
            $data = [
                'status' => 403,
                'info' => '你已'.$status.'此条约会信息'
            ];
           return $data;
        }

        $op = [
            'status' => $operation
        ];
        $where = [
            'user_id' => $apply_user_id,
            'date_id' => $date_id
        ];
        $userdate->where($where)->save($op);
        $data = [
            'status' => 200,
            'info' => '成功'
        ];
        return $data;
    }

    //计算人的信誉度
    public static function credit ($uid) {
        $date = new DateModel();
        $map['user_id'] = $uid;
        $map['status'] = 1;//TODO date失败分数?
        return $date->where($map)->avg('score');
    }
}