<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\Tmp;
use Think\Model;

class DataTmpModel extends Model {
	protected $autoCheckFields = false;
	protected $tableInfo= [];
	protected $levelNeed=2;//默认 model 需要2级权限

	/**
	 * @return array
	 * @For  所有数据表母版
     */
	public  function returnTableInfo(){
		if(isset($this->levelNeed)){
			checkLevel($this->levelNeed);
		}
		return $this->tableInfo;
	}

	/**
	 * @For  联动函数,默认无操作,有需要就覆盖
     */
	public function dataChange(){

	}
}