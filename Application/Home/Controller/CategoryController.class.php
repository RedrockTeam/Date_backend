<?php
namespace Home\Controller;
use Home\Model\DateTypeModel;
use Think\Controller;
class CategoryController extends Controller {
    //获取约会种类
    public function date_type () {
        $type = new DateTypeModel();
        $data = $type->getType();
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}