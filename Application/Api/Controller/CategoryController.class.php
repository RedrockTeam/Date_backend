<?php
namespace Api\Controller;
use Api\Model\DateTypeModel;
use Think\Controller;
class CategoryController extends Controller {
    //获取约会种类
    public function date_type () {
        if (!IS_POST) {
            $data['info'] = '获取方式错误!';
            $data['status'] = 403;
            $this->ajaxReturn($data);
        }
        $type = new DateTypeModel();
        $data = $type->getType();
        $data['status'] = 200;
        header("Access-Control-Allow-Origin: *");
        $this->ajaxReturn($data);
    }
}