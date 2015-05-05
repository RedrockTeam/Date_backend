<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*  所有的数据编辑和处理器
*/
namespace Home\Controller;
use Home\Controller\ManagementController;

class DateController extends ManagementController {

		public function index(){
			$this->set_info('Management:index','约约约信息表','约约约的所有数据信息');
		}
	
}