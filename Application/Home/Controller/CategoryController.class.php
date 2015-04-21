<?php
namespace Home\Controller;
use Home\Model\DateTypeModel;
use Think\Controller;
class CategoryController extends Controller {
    //获取约会种类
    public function date_type () {
        if(!IS_POST)
            $this->ajaxReturn('获取方式错误!');

        $type = new DateTypeModel();
        $data = $type->getType();
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}