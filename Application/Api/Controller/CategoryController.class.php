<?php
namespace Api\Controller;
use Api\Model\DateTypeModel;
use Think\Controller;
class CategoryController extends Controller {
    //获取约会种类
    public function date_type () {
        $type = new DateTypeModel();
        $data['data'] = $type->getType();
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }

    //获取学院
    public function academy () {
        $data['data'] = M('academy')->select();
        $data['info'] = '成功';
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }
}