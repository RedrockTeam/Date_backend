<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Think\Controller;
class ManagementController extends Controller {
	private $pageTotal=3;
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
					  'src'=> U('home/DataEdit/index?table=用户信息'),
					  'name'=> '用户信息',
					),
					1=>array(
					  'src'=> U('home/management/index'),
					  'name'=> '表单',
					),
				),
			 ),
			 900=>array(
				'src'=> U('home/management/LOGOUT'),
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
		$loginUser =  checkLogin();
		$main_info=array($location,$des,$info);
		$packge=array(//基础路由
			'main_info'   	  => 	$main_info,
			'MODULE_NAME'	  => 	MODULE_NAME,
			'MODULE_PATH'     => 	__MODULE__,
			'CONTROLLER_NAME' => 	CONTROLLER_NAME,
			'CONTROLLE_PATH'  => 	__CONTROLLER__,
			'ACTION_NAME'     =>	 ACTION_NAME,
			'LOGOUT'		  =>	U('Home:Management/logout'),
			'SELF_URL'		  =>	__SELF__,
			'DATA_EDIT_URL'	  =>	U('Home:DataEdit/editData'),
		);
		
		$function = $this->getFunctionInfo();//功能模块路由
		$this->assign('loginUser',$loginUser);
		$this->packgeAssign($packge);
		$this->packgeAssign($function);
		$this->display($main_info[0]);
    }
    
	/*封装模板替换*/
	public function packgeAssign($packge=array()){
		foreach($packge as $key => $value){
			$this->assign($key,$value);
		}
	}

	/**
	 * @param $param
	 * @return array
	 * @For  检查post参数
     */
	public function  checkPost($param){
		$arr=array();
		foreach($param as $k => $v){
			if(isset($_POST["$v"])){
				$tmp = I('post.'.$v,'','');
				$arr[$v] = $tmp;
			}else{
				$this->error('参数错误!');

			}
		}

		return $arr;
	}

	public function logout(){//登出
		session(null);
		redirect(U('Home:Login/index'), 0, 'please to login ...');
	}

	public function packPage($table,$order,$field='',$where='',$mod=false){

		$User = D($table); // 实例化User对象
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list  = $User->field($field,$mod)->where($where)->order($order)->page($_GET['p'].','.$this->pageTotal)->select();
		$count = $User->where($where)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Page($count,$this->pageTotal);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出

		$dfield = $User->field($field,$mod)->find();
		$field =array();
		foreach($dfield as $key => $value){
			$field[] = $key;
		}

		session("table",$table);
		session("field",$field);
		session("mainKey",$order);
		session("backUrl",__SELF__);

		$this->assign('table_head',$field);
		$this->assign('main_key',$order);
		$this->assign('table_page',$show);// 赋值分页输出
		$this->assign('table_data',$list);// 赋值数据集
	}

	public function packFind($table,$where,$field){
		$data = D("$table")->field($field)->where($where)->find();
		return $data;
	}

	public function getSession($name){
		if($return = session($name) )	return $return;
		else $this->ajaxReturn(array('info'=>'参数错误!'));
	}
}