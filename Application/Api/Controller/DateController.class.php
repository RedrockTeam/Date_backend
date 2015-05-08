<?php
namespace Api\Controller;
use Api\Model\DateLimitModel;
use Api\Model\DateModel;
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
        $data['user_score'] = CommonController::credit($uid);
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

        if (!$this->checkData($input['uid'])){
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
            'place' => $input['place'],
            'date_time' => $input['date_time'],
            'create_at' => time(),
            'gender_limit' => $input['gender_limit'],
            'apply_num' => 0,
            'sure_num' => 0,
            'limit_num' => 0,
            'score' => 0,
            'score_num' => 0,
            'status' => 2,
        ];
        $date = new DateModel();
        $id = $date->data($dateInfo)->add();
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

    //检查数据
    private function checkData ($input = []) {
        if(!$input)
            return false;
        if(!is_numeric($input['date_type'])) //约会类型id
            return false;
        if(mb_strlen($input['title']) > 10 || mb_strlen($input['title']) <= 0)//标题
            return false;
        if(mb_strlen($input['content']) > 25 || mb_strlen($input['content']) <= 0)//内容
            return false;
        if(mb_strlen($input['place']) > 25 || mb_strlen($input['place']) <= 0)//野战地点
            return false;
        if(!is_numeric($input['date_time']))//约炮时间
            return false;
        if(!is_numeric($input['date_people']) || $input['date_people'] > 100)//人数限制
            return false;
        if(!is_numeric($input['gender_limit']))//性别限制
            return false;
        if(!is_numeric($input['cost_model']))//花费模式
            return false;
        if($input['academy_limit'] != null && !is_numeric($input['academy_limit']))//学院限制
            return false;
        if($input['academy_select_model'] != null && !is_numeric($input['academy_select_model']))//学院限制的选择模式 1正 2反
            return false;
        if($input['grade_limit'] != null && !is_numeric($input['grade_limit']))//年级限制
            return false;
        if($input['grade_select_model'] != null && !is_numeric($input['grade_select_model']))//年级限制的选择模式
            return false;
        return true;
    }

    //检查发起约炮上限
    private function checkPaoNum ($uid) {
        $date = new DateModel();
        $map['user_id'] = $uid;
        $map['status'] = 2;
        $num = $date->where($map)->count();
        if( $num > 10)
            return false;
        return true;
    }
}