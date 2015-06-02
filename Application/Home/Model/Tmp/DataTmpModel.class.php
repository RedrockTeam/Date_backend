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
	protected $levelNeed=2;

	public  function returnTableInfo(){
		if(isset($this->levelNeed)){
			checkLevel($this->levelNeed);
		}
		return $this->tableInfo;
	}

	public function dataChange(){

	}
}