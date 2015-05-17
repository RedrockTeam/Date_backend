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
			switch($table){
				case  "用户信息" :
					/*表名,主键,字段,条件,字段是否反选*/
					$pack = ['users','id','token','',true];
					$info = ['用户信息修改','所有用户数据信息'];
					break;

				default:
					$pack = ['users','id','token','',true];
					$info = ['用户信息修改','所有用户数据信息'];
					break;

			}

			$this->packPage($pack[0],$pack[1],$pack[2],$pack[3],$pack[4]);
			$this->set_info('DataEdit:tables',$info[0],$info[1]);
		}

		public function editData(){
			$mainValue=I('post.mainValue');
			$mainKey = $this->getSession('mainKey');
			$field	 = $this->getSession('field');
			$table = $this->getSession('table');
			$find = $this->packFind($table,"$mainKey = '$mainValue'" , $field);
			$this->assign('data',$find);
			$this->assign('mainKey',$mainKey);
			$this->assign('EDIT_URL',U('Home:DataEdit/edit'));
			$this->set_info('DataEdit:edit',"修改数据表($table)"," 主键(".$mainKey.') >> '.$mainValue);
		}

		public function edit(){
			$mainKey = $this->getSession('mainKey');
			$backUrl = $this->getSession('backUrl');
			$field	 = $this->getSession('field');
			$table = $this->getSession('table');
			$data = $this->checkPost($field);
			if($data["$mainKey"] == -1){
				$do='add';
				$info = '添加';
				unset($data["$mainKey"]);
			}else{
				$do='save';
				$info = '修改';
			}

			if($r = D("$table")->$do($data))	$this->success("$info 成功:$r",$backUrl);
			else	$this->error("$info 失败:$r",$backUrl);

		}
}

