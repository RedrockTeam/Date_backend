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
        $users = new UsersModel();
        if($uid == $get_uid){
            $map['users.id'] = $uid;
            $data['data'] = $users->where($map)->join("LEFT JOIN academy ON users.academy = academy.id")->join("LEFT JOIN grade ON users.grade = grade.id")->field('users.id, head, signature, nickname, gender, grade.id as  grade_id, grade.name as grade, users.academy as academy_id, academy.name as academy, qq, weixin, telephone')->find();
            $data['info'] = '成功';
            $date = new DateModel();
            $data['data']['mydate'] = $date->getSao($uid);
            $data['status'] = 200;
            $this->ajaxReturn($data);
        }
        $userDate = new UserDateModel();
        if (!$userDate->joincheck($uid, $get_uid)){
            $data = [
                'data' => $users->getUserLittleInfo($get_uid),
                'info' => '成功',
                'status' => 200
            ];
            $this->ajaxReturn($data);
        }
        $data['data'] = $users->getUserInfo($get_uid);
        $data['info'] = '成功';
        $data['status'] = 200;
        $this->ajaxReturn($data);
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

    //修改个人资料
    public function editPerson () {//todo 性别怎么办!
        $input = I('post.');
        $uid = $input['uid'];
        if(trim($input['nickname'] == null)) {
            $data = [
                'info' => '昵称不能为空',
                'status' => 403
            ];
            $this->ajaxReturn($data);
        }
        if($input['qq'] == null && $input['telephone'] == null && $input['weixin'] == null) {
            $data = [
                'info' => '联系方式不能都为空',
                'status' => 403
            ];
            $this->ajaxReturn($data);
        }
        $map = [
            'id' => $uid,
        ];
        $data = [
            'nickname' => $input['nickname'],
            'signature' => trim($input['signature']),
            'qq' => $input['qq'],
            'telephone' => $input['telephone'],
            'weixin' => $input['weixin'],
        ];
        $gender = M('users')->where($map)->getField('gender');//检查性别是否已存在
        if($gender == null) {
            M('users')->where($map)->data(['gender' => $input['gender']])->save();
        }
        if(M('users')->where($map)->data($data)->save()) {
            $data = [
                'info' => '成功',
                'status' => 200
            ];
            $this->ajaxReturn($data);
        }
    }

}