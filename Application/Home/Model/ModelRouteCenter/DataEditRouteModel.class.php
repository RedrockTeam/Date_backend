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
		'用户信息'=>'DataEditModel\UsersModel',
		'约会信息'=>'DataEditModel\DateModel',

		'广告修改'=>'Advertise\AdvertiseModel',
	);

	public function returnTableInfo($route){
		$route = trim($route);
		if(isset($this->dataModelArray["$route"])) {
			$route = $this->dataModelArray["$route"];
			$model     = '\\Home\\Model\\' . $route;
			$returnArr = new $model();

			return $returnArr->returnTableInfo();
		}
	}

}