<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\ModelRouteCenter;
use Think\Model;

class DataEditRouteModel extends Model {
	protected $autoCheckFields =false;
	/** model 参数路由表 **/
	protected $dataModelArray= [
		'用户信息'=>'DataEditModel\UsersModel',
		'约会信息'=>'DataEditModel\DateModel',

		'广告修改'=>'Advertise\AdvertiseModel',
//		'约会限制'=>'DataEditModel\DateLimitModel',
		'约会好评'=>'DataEditModel\DateScoreModel',
		'私信管理'=>'DataEditModel\DateLetterModel',
	];

	/**
	 * @param $route
	 * @return mixed
	 * @For  根据参数引入路由,否则报错
     */
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