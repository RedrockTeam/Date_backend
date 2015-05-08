<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Home\Controller\ManagementController;

class DataEditController extends ManagementController {

		public function index(){
			$m = new \Home\Model\DataformModel('wx_user','wx_id');
			$data = D('wx_user')->select();
			$set = $m->setCol(array('wx_id','name','img_src', 'sex','a','b','c'))->setTableData($data)
				->addModelId('wx_id')->addModelDate('name')->addModelFontdata('img_src')->addModelCheckbox('sex')
				->addModelSelect('sex')->addModelFile('sex')->addModelTextarea('sex')->buildForm("home:DataEdit/edit");
			;
			//echo "<pro>$set</pro>";
			$this->assign('FormData',$set);
			$this->set_info('DataEdit:form','约约约信息表','约约约的所有数据信息');
		}
	
}