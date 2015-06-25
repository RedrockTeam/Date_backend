<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Home\Controller\ManagementController;

class DataEditController extends ManagementController {

	/**
	 * @For  主页
     */
	public function index(){
			$table = I('get.table','用户信息');
			$model = new \Home\Model\ModelRouteCenter\DataEditRouteModel();
			$modelCenter = $model->returnTableInfo($table);

			$info = $modelCenter['info'];

			$this->packPage($modelCenter);
			$this->set_info('DataEdit:tables',$info['title'],$info['detail']);
		}

	/**
	 * @For  数据列表页
     */
	public function editData(){
			$table = session('tableInfo')['table'];
			$undo = session('tableInfo')['undo'];
			$mainValue=I('post.mainValue');
			$mainKey = $this->getSession('mainKey');

			$find = $this->packFind("$mainKey = '$mainValue'");
//			print_r($find);
//			exit();

			$this->assign('data',$find);

			$value = end(explode(".",$mainKey));
			$this->assign('mainKey',$value);
			$this->assign('undo',$undo);
			$this->assign('EDIT_URL',U('Home:DataEdit/edit'));
			$this->set_info('DataEdit:edit',"修改数据表($table)"," 主键(".$mainKey.') >> '.$mainValue);
	}

	/**
	 * @For  修改数据操作
     */
	public function edit(){
			$mainKey = $this->getSession('mainKey');
			$mainKey = end(explode(".",$mainKey));
			$backUrl = $this->getSession('backUrl');
			$editField	 = $this->getSession('editField');
			$editField[] = $mainKey;

			$tableInfo = $this->getSession('tableInfo');
			$table = $tableInfo['table'];
			$data = $this->checkPost($editField);

			if($data["$mainKey"] == -1){
				$do='add';
				$info = '添加';
				unset($data["$mainKey"]);
			}else{
				$do='save';
				$info = '修改';
			}

			if($r = D("$table")->$do($data)){
				/** 数据联动处理,暂未添加 */
				/** 联动 end **/
				$this->success("$info 成功",$backUrl);
			}else{$this->error("$info 失败:<br>未修改原值");}

	}
}

