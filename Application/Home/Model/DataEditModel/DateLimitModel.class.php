<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\DataEditModel;
use Home\Model\Tmp\DataTmpModel;

class DateLimitModel extends DataTmpModel {
	protected $autoCheckFields = false;
	protected $tableInfo= [
		'info' => ['title'=>'约会限制','detail'=>'在这里你可以修改所有约会限制'],
		'table'=>'date_limit',
		'order' => 'date_limit.id',
		'field' => 'date_limit.id,date.id as 约会编号,
		 			grade.name 	as 年级限制',
		'join'=> [
			'date'=>'date_limit.date_id = date.id ',
			'grade'=> 'date_limit.limit = grade.id ',
//			'user' => users.nickname  as 用户,
		],
		'undo'=>['user_id'],
	];
}