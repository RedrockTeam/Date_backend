<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\ModelRouteCenter;
use Think\Model;

class DataEditRouteModel extends Model {
	protected $autoCheckFields =false;
	protected $dataModelArray=array(
		'用户信息'=>'UsersModel',
		'约会信息'=>'DateModel',
	);

	public function returnTableInfo($route){
		$route = trim($route);
		$model = '\\Home\\Model\\DataEditModel\\'.$this->dataModelArray["$route"];
		$returnArr = new $model();
		return $returnArr->returnTableInfo();
	}

}