<?php
namespace Api\Controller;
use Api\Model\CollectionModel;
use Api\Model\DateModel;
use Api\Model\UserDateModel;
use Api\Model\UsersModel;
use Think\Controller;
class PersonalController extends BaseController {
    //获取收藏约会
    public function getCollection () {
        $input = I('post.');
        $uid = $input['uid'];
        $collection = new CollectionModel();
        $data['data'] = $collection->getCollection($uid);
        $data['info'] = '成功';
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }

    //获取个人参加记录
    public function getJoin () {
        $input = I('post.');
        $uid = $input['uid'];
        $collection = new UserDateModel();
        $data['data'] = $collection->getPao($uid);
        $data['info'] = '成功';
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }

    //获取个人发起的记录
    public function getCreate () {
        $input = I('post.');
        $uid = $input['uid'];
        $date = new DateModel();
        $data['data'] = $date->getSao($uid);
        $data['info'] = '成功';
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }

    //获取个人信息
    public function getInfo () {
        $input = I('post.');
        $uid = $input['uid'];
        $get_uid = $input['get_uid'];
        $userDate = new UserDateModel();
        if (!$userDate->joincheck($uid, $get_uid)){
            $data = [
                'info' => '权限不够',
                'status' => 403
            ];
            $this->ajaxReturn($data);
        }
        $users = new UsersModel();
        $this->ajaxReturn($users->getUserInfo($get_uid));
    }

    //收藏约会
    public function collect ($uid, $date_id) {
        $collection = new CollectionModel();
        $date = [
            'date_id' => $date_id,
            'user_id' => $uid
        ];
        if($collection->data($date)->add()) {
            $data = [
                'info' => '成功',
                'status' => 200
            ];
            $this->ajaxReturn($data);
        }
        else{
            $data = [
                'info' => '网络错误!',
                'status' => 500
            ];
            $this->ajaxReturn($data);
        }
    }
}