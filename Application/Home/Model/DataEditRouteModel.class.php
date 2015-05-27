<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model;
use Think\Model;

class DataEditRouteModel extends Model {
	protected $autoCheckFields =false;
	protected $dataModelArray=array(
		'用户信息'=>'UsersModel',
	);

	public function returnTableInfo($route){
		$route = trim($route);
		$model = '\\home\\model\\'.$this->dataModelArray["$route"];
		$returnArr = new $model();
		return $returnArr->returnTableInfo();
	}

}