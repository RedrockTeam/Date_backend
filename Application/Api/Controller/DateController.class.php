<?php
namespace Api\Controller;
use Api\Model\DateLimitModel;
use Api\Model\DateModel;
use Api\Model\UserDateModel;
use Api\Model\UsersModel;
use Think\Controller;
class DateController extends BaseController {
    //获取约会列表
    public function getList () {
        $list = new DateModel();
        $input = I('post.');
        $type = $input['date_type'];
        if($type == 0)
            $type = '%';
        $data['data'] = $list->getInfo($type);
        $data['status'] = 200;
        $data['info'] = '成功';
        $this->ajaxReturn($data);
    }

    //获取约详情
    public function getDetail () {
        $input = I('post.');
        $list = new DateModel();
        $uid = $input['uid'];
        $date_id = $input['date_id'];
        $data = $list->getDetailInfo($date_id);
        $common = new CommonController();
        $data['user_score'] = $common->credit($uid);
        $this->ajaxReturn($data);
    }

    //发起约炮
    public function createDate () {
        $input = I('post.');
        if (!$this->checkData($input)){
            $data = [
                'status' => '403',
                'info' => '参数错误'
            ];
            $this->ajaxReturn($data);
        }

        if (!$this->checkPaoNum($input['uid'])){
            $data = [
                'status' => '403',
                'info' => '超过同时约上限'
            ];
            $this->ajaxReturn($data);
        }

        $dateInfo = [
            'user_id' => $input['uid'],
            'title' => $input['title'],
            'date_type' => $input['date_type'],
            'cost_model' => $input['cost_model'],
            'content' => $input['content'],
            'place' => $input['date_place'],
            'date_time' => $input['date_time'],
            'created_at' => time(),
            'gender_limit' => $input['gender_limit'],
            'apply_num' => 0,
            'sure_num' => 0,
            'limit_num' => 0,
            'score' => 0,
            'scored_num' => 0,
            'status' => 2,
        ];
        $date = new DateModel();
        $id = $date->add($dateInfo);
        if( ($input['academy_limit'] && $input['academy_select_model']) || ($input['grade_limit'] && $input['grade_select_model']) ){
           $limit = new DateLimitModel();
            $date_id = $id['id'];
            if($input['academy_limit'] && $input['academy_select_model']){
                foreach($input['academy_limit'] as $v){
                    $academy = [
                        'date_id' => $date_id,
                        'selectmodel' => $input['academy_select_model'],
                        'condition' => 2,
                        'limit' => $v,
                    ];
                    $limit->data($academy)->add();
                }
            }
            if($input['grade_limit'] && $input['grade_select_model']){
                foreach($input['grade_limit'] as $v){
                    $grade = [
                        'date_id' => $date_id,
                        'selectmodel' => $input['grade_select_model'],
                        'condition' => 2,
                        'limit' => $v,
                    ];
                    $limit->data($grade)->add();
                }
            }
        }
        $data = [
            'status' => 200,
            'info' => '成功'
        ];
        $this->ajaxReturn($data);
    }

    //报名约炮
    public function report () {
        $input = I('post.');
        $uid = $input['uid'];
        $date_id = $input['date_id'];
        if($date_id == null) {
            $data = [
                'info' => '参数错误',
                'status' => '403'
            ];
            $this->ajaxReturn($data);
        }

        $userDate = new UserDateModel();
        //检查是否是本人 1
        if(!$this->checkSelf($uid, $date_id)){
            $data = [
                'info' => '你不能约自己!',
                'status' => '403'
            ];
            $this->ajaxReturn($data);
        }
        //检查是否约过 2
        if(!$userDate->joined($uid, $date_id)) {
            $data = [
                'info' => '你已经约过了',
                'status' => '403'
            ];
            $this->ajaxReturn($data);
        }
        //检查约超时 3
        if(!$this->checkTime($date_id)) {
            $data = [
                'info' => '该约会已结束',
                'status' => '403'
            ];
            $this->ajaxReturn($data);
        }
        //检查同时约炮上限 4
        if(!$this->checkReportNum($uid)) {
            $data = [
                'info' => '你已经到达同时约的上限了',
                'status' => '403'
            ];
            $this->ajaxReturn($data);
        }
        //检查限制条件, 学院, 年级, 性别 5
        if(!$this->checkConditions($uid, $date_id)) {
                $data = [
                    'info' => '你不符合限制条件',
                    'status' => '403'
                ];
                $this->ajaxReturn($data);
        }
        //插入数据 6
        $date = [
                'date_id' => $date_id,
                'user_id' => $uid,
                'time' => time(),
                'status' => 2,
                'score_status' => 0,
        ];
        if($this->insertPao($date)){
            $data = [
                'info' => '成功',
                'status' => '200'
            ];
            $this->ajaxReturn($data);
        }
        else{
            $data = [
                'info' => '网络错误',
                'status' => '500'
            ];
            $this->ajaxReturn($data);
        }
    }

    //查看某个约会的参与人员
    public function getDatePerson () {
        $input = I('post.');
        $date_id = $input['date_id'];
        $usreDate = new UserDateModel();
        $data['data'] = $usreDate->datePerson($date_id);
        $data['info'] = '成功';
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }

    //对约炮评分
    public function scoreDate () {
        $input = I('post.');
        $date = new DateModel();
        if($input['score'] > 5 || $input['score'] < 0) {
            $info = [
                'info' => '评分有误',
                'status' => 403
            ];
            $this->ajaxReturn($info);
        }
        $userDate = new UserDateModel();
        $map0 = [
            'date_id' => $input['date_id'],
            'user_id' => $input['uid'],
        ];
        $score_status = $userDate->where($map0)->getField('score_status');
        if($score_status != 0) {
            $info = [
                'info' => '你已评过次约会',
                'status' => 403
            ];
            $this->ajaxReturn($info);
        }
        $map['id'] = $input['date_id'];
        $map['status'] = ['NEQ', 2];
        $date_info = $date->where($map)->find();
        if($date_info == null) {
            $info = [
                'info' => '此条约会不存在或未结束',
                'status' => 403
            ];
            $this->ajaxReturn($info);
        }
        $new_score = ($date_info['scored_num'] * $date_info['score'] + $input['score']) / ($date_info['scored_num'] + 1);
        $data = [
            'scored_num' => $date_info['scored_num'] + 1,
            'score' => $new_score
        ];
        if($date->where($map)->data($data)->save()) {
            $userDate->where($map0)->data(['score_status' => 1])->save();
            $info = [
                'info' => '成功',
                'status' => 200
            ];
            $this->ajaxReturn($info);
        }
        else {
            $info = [
                'info' => '网络错误',
                'status' => 500
            ];
            $this->ajaxReturn($info);
        }

    }

    //检查本人
    private function checkSelf ($uid, $date_id) {
        $map['id'] = $date_id;
        $info = M('date')->where($map)->find();
        if($info['user_id'] == $uid)
            return false;
        return true;
    }

    //检查数据
    private function checkData ($input = []) {
        if(!$input)
            return false;
        if(!is_numeric($input['date_type'])) //约会类型id
            return false;
        if(mb_strlen($input['title']) > 15 || mb_strlen($input['title']) <= 0)//标题
            return false;
        if(mb_strlen($input['content']) > 100 || mb_strlen($input['content']) <= 0)//内容
            return false;
        if(mb_strlen($input['date_place']) > 15 || mb_strlen($input['date_place']) <= 0)//野战地点
            return false;
        if(!is_numeric($input['date_time']))//约炮时间
            return false;
        if(!is_numeric($input['date_people']) || $input['date_people'] > 100)//人数限制
            return false;
        if(!is_numeric($input['gender_limit']))//性别限制
            return false;
        if(!is_numeric($input['cost_model']))//花费模式
            return false;
        if($input['academy_select_model']){
            if($input['academy_limit'] == null)//学院限制
                return false;
            if($input['academy_select_model'] != null && !is_numeric($input['academy_select_model']))//学院限制的选择模式 1正 2反
                return false;
        }
        if($input['grade_select_model']) {
            if ($input['grade_limit'] == null)//年级限制
                return false;
            if ($input['grade_select_model'] != null && !is_numeric($input['grade_select_model']))//年级限制的选择模式
                return false;
        }
        return true;
    }

    //检查发起约炮上限
    private function checkPaoNum ($uid) {
        $date = new DateModel();
        $map['user_id'] = $uid;
        $map['status'] = 2;
        $num = $date->where($map)->count();
        if( $num > 5)
            return false;
        return true;
    }

    private function checkTime($date_id){
        $map['id'] = $date_id;
        $info = M('date')->where($map)->find();
        if($info['date_time'] < time())
            return false;
        return true;
    }
    //检查同时约炮上限
    private function checkReportNum ($uid) {
        $userDate = new UserDateModel();
        $map = [
            'user_id' => $uid,
            'status' => 2
        ];
        $num = $userDate->where($map)->count();
        if($num > 10)
            return false;
        return true;
    }

    //检查约炮符合条件
    private function checkConditions ($uid, $date_id) {
        $users = new UsersModel();
        $info = $users->getUserInfo($uid);
        $gender = $info['gender'];
        $academy = $info['academy_id'];
        $grade = $info['grade'];

        $date = new DateModel();
        $date_map['id'] = $date_id;
        $date_info = $date->where($date_map)->find();
        if($date_info['gender_limit'] == 0){

        }
        else{
            if($gender != $date_info['gender_limit'])
                return false;
        }
        $date_limit = new DateLimitModel();
        //判断年级
        if(!$this->checkGrade($grade, $date_id, $date_limit))
            return false;
        //判断学院
        if(!$this->checkAcademy($academy, $date_id, $date_limit))
            return false;

        return true;
    }

    private function checkGrade ($grade, $date_id, $date_limit) {
        /**
         * TODO 先判断正选反选, 再遍历, 逻辑目测没问题
         */
        //判断年级

        $limit_map1 = [
            'date_id' => $date_id,
            'condition' => 1 //1判断年级
        ];
        $limit1 = $date_limit->where($limit_map1)->select();
        if($limit1){
            switch($limit1[0]['selectmodel']){
                case 1: //正选
                    foreach($limit1 as $v){
                        if($v['limit'] == $grade) {
                            return true;
                        }
                    }
                    return false;
                case 2: //反选
                    foreach($limit1 as $v){
                        if($v['limit'] == $grade)
                            return false;
                    }
                    return true;
                default:
                    return false;
            }
        }
        else
            return true;
    }
    //判断学院
    private function checkAcademy ($academy, $date_id, $date_limit) {

        $limit_map2 = [
            'date_id' => $date_id,
            'condition' => 2 //1判断年级
        ];
        $limit2 = $date_limit->where($limit_map2)->select();
        if($limit2) {
            switch ($limit2[0]['selectmodel']) {
                case 1: //正选
                    foreach ($limit2 as $v) {
                        if ($v['limit'] == $academy)
                        return true;
                    }
                    return false;
                case 2: //反选
                    foreach ($limit2 as $v) {
                        if ($v['limit'] == $academy)
                            return false;
                    }
                    return true;
                default:
                    return false;
            }
        }
        else
            return true;
    }
    //插入报名约炮记录
    private function insertPao ($data) {
        $userDate = new UserDateModel();
        if($userDate->data($data)->add())
            return true;
        else
            return false;
    }

}