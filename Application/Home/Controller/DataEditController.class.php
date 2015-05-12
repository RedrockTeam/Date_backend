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
					$this->packPage('users','id','token','',true);
					$info = ['用户信息修改','所有用户数据信息'];
					break;

				default:
					$this->packPage('users','id','token','',true);
					$info = ['约约约信息表','约约约的所有数据信息'];
					break;

			}


			$this->set_info('DataEdit:tables',$info[0],$info[1]);
		}

		public function editData(){
			$post=I('post.');
			//$get=I('get.');
			print_r($_POST);
			$this->success('hahaha',$_POST['backUrl']);
		}
}