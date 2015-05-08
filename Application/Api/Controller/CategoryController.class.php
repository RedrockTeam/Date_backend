<?php
namespace Api\Controller;
use Api\Model\DateTypeModel;
use Think\Controller;
class CategoryController extends BaseController {
    //获取约会种类
    public function date_type () {
        $type = new DateTypeModel();
        $data = $type->getType();
        $data['status'] = 200;
        $this->ajaxReturn($data);
    }
}