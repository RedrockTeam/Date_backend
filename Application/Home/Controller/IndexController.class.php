<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	public function index(){
		$this->set_info();
	}
	
	
	/*设置主模版基本信息 >> $location:路径 $des:模块 $info:说明信息 */
    private function set_info($location='index',$des='控制台',$info='版本信息处理'){
		
		$main_info=array($location,$des,$info);
		
		$this->assign('main_info',$main_info);
		$this->assign('MODULE_NAME',MODULE_NAME);
		$this->assign('MODULE_PATH',__MODULE__ );
		$this->assign('CONTROLLER_NAME',CONTROLLER_NAME);
		$this->assign('CONTROLLE_PATH',__CONTROLLER__);
		$this->assign('ACTION_NAME',ACTION_NAME);
		$this->display($main_info[0]);
    }
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}