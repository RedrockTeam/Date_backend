<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\DataEditModel;
use Home\Model\Tmp\DataTmpModel;

class DateModel extends DataTmpModel {
	protected $autoCheckFields = false;
	protected $tableInfo= [
		'info' => ['title'=>'约会信息','detail'=>'在这里你可以修改所有用户约会详情'],
		'table'=>'date',
		'order' => 'date.id',
		'field' => 'date.id,users.nickname as 用户,title as 约会,date_type.type as  约会类型,date.content as 详情,date.place as  地点,date.limit_num as  人数上限,status_date.name as 约会状态',
		'join'=> [
			'users'=>' date.user_id = users.id ',
			'date_type'=>' date.date_type  =  date_type.id ',
			'status_date'=>'date.status = status_date.id',
		],
		'undo'=>['user_id'],
	];
}