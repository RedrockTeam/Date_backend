<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Home\Controller\ManagementController;

class DataEditController extends ManagementController {

		public function index(){
			$m = new \Home\Model\DataformModel();
			$set = $m->setCol(array('ID','Name','checkbox', 'select', 'file','txarea','as'))
				->addModelNum()->addModelDate()->addModelFontdata()->addModelCheckbox()
				->addModelSelect()->addModelFile()->addModelTextarea()->buildForm("home:DataEdit/edit");
			;
			//echo "<pro>$set</pro>";
			$this->assign('FormData',$set);
			$this->set_info('DataEdit:form','约约约信息表','约约约的所有数据信息');
		}
	
}