<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Home\Controller\ManagementController;

class DataEditController extends ManagementController {

		public function index(){

			$this->packPage('users','id','token','',true);
			$this->set_info('DataEdit:tables','约约约信息表','约约约的所有数据信息');
		}

		public function editData(){
			$post=I('post.');
			$get=I('get.');
			print_r($_POST);

		}
}