<?php
namespace Api\Controller;
use Api\Model\CollectionModel;
use Api\Model\DateModel;
use Api\Model\UserDateModel;
use Think\Controller;
class PersonalController extends BaseController {
    //获取收藏约会
    public function getColletion () {
        $input = I('post.');
        $uid = $input['uid'];
        $collection = new CollectionModel();
        $data = $collection->getCollection($uid);
        $this->ajaxReturn($data);
    }

    //获取个人参加记录
    public function getJoin () {
        $input = I('post.');
        $uid = $input['uid'];
        $collection = new UserDateModel();
        $data = $collection->getPao($uid);
        $this->ajaxReturn($data);
    }

    //获取个人发起的记录
    public function getCreate () {
        $input = I('post.');
        $uid = $input['uid'];
        $date = new DateModel();
        $data = $date->getSao($uid);
        $this->ajaxReturn($data);
    }
}