<?php
/**
 * Created by PhpStorm.
 * User: lzy
 * Date: 2015/5/6
 * Time: 17:15
 */

namespace Api\Controller;
use Api\Model\DateModel;
use Api\Model\LetterModel;
use Api\Model\UserDateModel;
use Think\Controller;
class CommonController extends BaseController{
    //todo 做个检测约会过期的函数, 更新date和user_date和letter表中的状态
    private function updateDate() {
        $condition = ['date_time' => ['']];
        $result = [];
    }


    // 接收/拒绝 约会
    public function dateAction ($uid, $apply_user_id, $date_id, $operation) {
        $userdate = new UserDateModel();
        $row = $userdate->getRow($apply_user_id , $date_id);
        //检查约会记录是否存在
        if(!$row){
            $data = [
                "status" => 409,
				"info" => "没有这条约会记录"
            ];
           return $data;
        }
        $date = new DateModel();
        $date_row = $date->find($date_id);
        
        //检查约会人数
        if($date_row['sure_num'] >= $date_row['limit_num']){
            $data = [
                "status" => 409,
                "info" => "约会人数已满"
            ];
           return $data;
        }
        
        //检查约会是否超时
        if($date_row['date_time'] < time()){
            $data = [
                "status" => 409,
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
                'status' => 409,
                'info' => '你已'.$status.'此条约会信息'
            ];
           return $data;
        }

        //更改letter表中的约会状态
        $letter_where = [
            'date_id' => $date_id,
            'from' => $apply_user_id,
            'to' => $uid
        ];
        $letter = new LetterModel();
        $letter->where($letter_where)->save(['type' => $operation]);

        //更改user_date表中的约会状态
        $op = [
            'status' => $operation
        ];
        $where = [
            'user_id' => $apply_user_id,
            'date_id' => $date_id
        ];
        $userdate->where($where)->save($op);
        $map1 = ['id' => $date_id];
        if($operation == 1)
            $date->where($map1)->setInc('sure_num');
        $data = [
            'status' => 200,
            'info' => '成功'
        ];
        $result = $userdate->where($where)->find();
        $this->insertAction($operation, $result['date_id'], $uid, $apply_user_id);//发起人向申请人发送私信
        return $data;
    }

    //发起人向申请人发送私信
    private function insertAction($operation, $result, $uid, $apply_user_id) {
        $status = $operation == 1? '接受':'拒绝';
        $letter = new LetterModel();
        $data = [
            'date_id' => $result,
            'from' => $uid,
            'to'   => $apply_user_id,
            'content'=> $status.'你的约',
            'time' => time(),
            'status' => 0,
            'type' => $operation
        ];
        $letter->add($data);
    }

    //计算人的信誉度
    public function credit ($uid = null) {
        $date = new DateModel();
        $uid = $uid != null ? $uid : I('post.search_uid');
        $map['user_id'] = $uid;
        $map['status'] = ['NEQ', 2];
        return $date->where($map)->avg('score');
    }

    public function uploadImg() {
//        if($stream = fopen("php://input", 'r')) {
//          $img = stream_get_contents($stream);
//            fclose($stream);
//
//        }//流

        $input = I('post.');//为前端上传做准备
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     'Public/uploads/'; // 设置附件上传根目录
        // 上传文件
        $info   =   $upload->upload();
        if(! $info) {// 上传错误提示错误信息
            $data = [
                'info' =>  $upload->getError(),
                'status' => 409,
            ];
            $this->ajaxReturn($data);
        }
        else {// 上传成功
            foreach($info as $file) {
                $path = UPLOAD_PATH . $file['savepath'] . $file['savename'];
            }
            $map = ['id' => $input['uid']];
            $save = ['head' => $path];
            M('users')->where($map)->save($save);
            $data = [
                'info' => '成功',
                'path' => $path,
                'status' => 200,
            ];
            $this->ajaxReturn($data);
        }
    }
}