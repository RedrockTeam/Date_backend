<?php
/*
*  author:Orangw-W
*  Create By:2015.04.22
*/
namespace Home\Controller;
use Think\Controller;
class ManagementController extends Controller {
	private $pageTotal=15;
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
					  'src'=> U('home/DataEdit/index?table=约会信息'),
					  'name'=> '约会信息',
					),
				),
			 ),
			 9=>array(
				 'src'=> '',
				 'name'=> '广告管理',
				 'nextTag' =>array(//二级导航
					 0=>array(
						 'src'=> U('home/DataEdit/index?table=广告修改'),
						 'name'=> '广告修改',
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
		checkLevel(1);
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


	/**
	 * @param $tableInfo
	 * @For  自定义数据分页
	 */
	public function packPage($tableInfo){
		$nowPage = I('get.p','1');
		if(!$tableInfo['table'] || !$tableInfo['order'] ||  !$tableInfo['field'] ){$this->ajaxReturn(['info'=>'model 配置参数错误','status'=>'407']);}
		$table =  $tableInfo['table'];
		$order = $tableInfo['order'];

		if($tableInfo['where'] && $where=$tableInfo['where']);
		if($tableInfo['antiField'] && $mod=$tableInfo['antiField']);
		if($tableInfo['join'] && $join=$tableInfo['join']);

		$field = $tableInfo['field'];

		$User = D($table); // 实例化User对象

		if($where!=null) $User = $User->where($where);

		if(isset($join)){
			foreach($tableInfo['join'] as $k => $v){
				$User = $User->join(" `$k` ON $v ");
			}

		}


		$list = $User->field($field, $mod)->order($order)->page($nowPage. ',' . $this->pageTotal)->select();
		$count = $User->field($field, $mod)->count();// 查询满足要求的总记录数
		$dfield =  $list[0];

		$Page  = new \Think\Page($count,$this->pageTotal);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出


//		$fiedd =array();
//		foreach($dfield as $key => $value){
//			$fiedd["$value"] = $key;
//		}
////
//		print_r($field);
//		exit();
//		if(!$field){$field='*';}

		session("tableInfo",$tableInfo);
		session("field",$field);
		session("mainKey",$order);
		session("backUrl",__SELF__);

		$value = end(explode(".",$order));
		$this->assign('table_head',$dfield);
		$this->assign('main_key',$value);
		$this->assign('table_page',$show);// 赋值分页输出
		$this->assign('table_data',$list);// 赋值数据集*/
	}

	public function packFind($where){
		$tableInfo = $this->getSession('tableInfo');
		$table = $tableInfo['table'];

		$field = $this->getSession('field');

		$User = D("$table");
		if(isset($tableInfo['join'])){
			foreach($tableInfo['join'] as $k => $v){
				$User = $User->join(" `$k` ON $v ");

			}
		}
		$data = $User->fetchSql(false)->field($field)->where($where)->find();

		/*join*/

		$tmpField='';
		foreach($tableInfo['join'] as $k => $v){
			$tmp2 = (explode("=", str_replace(' ','',$v)));
			$tmp3 = explode('.',end($tmp2));
			$tmpField .= end($tmp2)." as ".$tmp3[0]." ,";
		}
		$tmpField = substr($tmpField,0,strlen($tmpField)-1);

		/**/
		$tmp1 = explode(",", $field);
		//$dataRegist=array();
		foreach($tmp1 as $k => $v){
			$tmp2 = (explode("as", $v));
			if(count($tmp2) == 2) {
				$dataRegist[] = trim($tmp2[0]);
				$tmp3 = explode(".", $tmp2[0]);
				if(!$tmp3[1]){$tmp3[1] = $tmp3[0];$tmp3[0] = $tableInfo['table'];}
				if($tmp3[0] !=$tableInfo['table'] ) {$fieldTmp[$k][trim($tmp3[0])]=trim($tmp3[1]);}
//				elseif(trim($tmp3[1])){$inputTmp[$k] = trim($tmp3[0]);print_r($tmp3);}
				else {$inputTmp[$k] = trim($tmp3[1]);}
			}
		}

//		echo "<pre>";print_r($inputTmp);echo "<pre>";
//		exit();

		$fUser = D($tableInfo['table']);
		if(isset($tableInfo['join'])){
			foreach($tableInfo['join'] as $k => $v){
				$fUser = $fUser->join(" `$k` ON $v ");
			}
		}
//		if($tmpField){
//			$fUser = $fUser->fetchSql(false)->field($tmpField);
//		}
		$fv = $fUser->fetchSql(false)->field($tmpField)->where($where)->find();
//		print_r($fv);
//		exit();

		foreach($fieldTmp as $k => $tmpF){
			foreach($fv as $k2 => $tmpfFv){

				if(array_keys($tmpF)[0]==$k2  ){
					$fv_t = explode(".", $dataRegist[$k-1]);

					if($fv_t[0]!= $tableInfo['table']) {
						$v    = $tableInfo['join'][$fv_t[0]];
						$tmp2 = (explode("=", str_replace(' ', '', $v)));
						$tmp3 = explode('.', end($tmp2));
						$tmp4 = explode('.', $tmp2[0]);


						$tmpF2 =array_pop($tmpF);
						$tds = D($fv_t[0])->field($tmp3[1].','.$tmpF2)->select();
						foreach($tds as $kt => $vt){
							$Vname= $vt[($tmp3[1])];
							$tdsTrans[$Vname] = $vt[$tmpF2];
						}
						$feResult["$k"]['option'] = $tdsTrans;
						$feResult["$k"]['field'] = $tmp4[1];
						$inputTmp[] = $tmp4[1];
						unset($tdsTrans);


					}
					$feResult["$k"]['value'] = $tmpfFv;
				}
			}
		}
//		echo "<pre>";print_r($tmpfFv);echo "<pre>";
//		exit();

		session('editField',$inputTmp);

		$this->assign('fieldTmp',$feResult);
		$this->assign('inputField',$inputTmp);
		$this->assign('field',$field);
		return $data;
	}

	public function getSession($name){
//		if($name=='field' || $name=='editField'){
//			return session($name);
//		}
		if($return = session($name) )	return $return;
		else{
			//exit($name);
			$this->ajaxReturn(array('info'=>'参数错误!'));
		}
	}
}