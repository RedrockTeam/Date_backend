<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Home\Controller\ManagementController;

class DataEditController extends ManagementController {

		public function index(){
			$table = I('get.table','用户信息');
			$model = new \Home\Model\DataEditRouteModel();
			$modelCenter = $model->returnTableInfo($table);

			$info = $modelCenter['info'];

			$this->packPage($modelCenter);
			$this->set_info('DataEdit:tables',$info['title'],$info['detail']);
		}

		public function editData(){
			$mainValue=I('post.mainValue');
			$mainKey = $this->getSession('mainKey');
			//print_r("$mainKey = '$mainValue'");
//			exit();
			$find = $this->packFind("$mainKey = '$mainValue'");

			$this->assign('data',$find);

			$value = end(explode(".",$mainKey));
			$this->assign('mainKey',$value);
			$this->assign('EDIT_URL',U('Home:DataEdit/edit'));
			$this->set_info('DataEdit:edit',"修改数据表($table)"," 主键(".$mainKey.') >> '.$mainValue);
		}

		public function edit(){
			$mainKey = $this->getSession('mainKey');
			$mainKey = end(explode(".",$mainKey));
			$backUrl = $this->getSession('backUrl');
			$editField	 = $this->getSession('editField');
			$editField[] = $mainKey;

			$tableInfo = $this->getSession('tableInfo');
			$table = $tableInfo['table'];
			$data = $this->checkPost($editField);
//			print_r($data);
//			EXIT();
			if($data["$mainKey"] == -1){
				$do='add';
				$info = '添加';
				unset($data["$mainKey"]);
			}else{
				$do='save';
				$info = '修改';
			}

			if($r = D("$table")->$do($data))	$this->success("$info 成功",$backUrl);
			else	$this->error("$info 失败:<br>未修改原值");

		}
}

