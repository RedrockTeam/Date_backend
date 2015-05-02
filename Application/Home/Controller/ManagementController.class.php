<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Think\Controller;
class ManagementController extends Controller {

	private function getFunctionInfo(){//功能路由
		$function['function_info']=array(
		     0=>array(
				'src'=> U('home/management/index'),
				'name'=> '控制台',
			 ),
			 1=>array(
				'src'=> '',
				'name'=> '数据后台',
				'nextTag' =>array(//二级导航
					0=>array(
					  'src'=> U('home/date/index'),
					  'name'=> '约约约',
					),
					1=>array(
					  'src'=> U('home/management/index'),
					  'name'=> '表单',
					),
				),
			 ),
			 900=>array(
				'src'=> U('home/management/index'),
				'name'=> '退出登录',
			 ),
		);
		
		return $function;
	}
	
	public function index(){

		$this->set_info();
	}
	
	
	/*设置主模版基本信息 >> $location:路径 $des:模块 $info:说明信息 */
    public function set_info($location='index',$des='控制台',$info='版本信息处理'){
		//checkLogin();
		$main_info=array($location,$des,$info);
		$packge=array(//基础路由
			'main_info'   	  => 	$main_info,
			'MODULE_NAME'	  => 	MODULE_NAME,
			'MODULE_PATH'     => 	__MODULE__,
			'CONTROLLER_NAME' => 	CONTROLLER_NAME,
			'CONTROLLE_PATH'  => 	__CONTROLLER__,
			'ACTION_NAME'     =>	 ACTION_NAME,
		);
		
		$function = $this->getFunctionInfo();//功能模块路由
		$this->packgeAssign($packge);
		$this->packgeAssign($function);
		$this->display($main_info[0]);
    }
    
	/*封装模板替换*/
	private function packgeAssign($packge=array()){
		foreach($packge as $key => $value){
			$this->assign($key,$value);
		}
	}

}