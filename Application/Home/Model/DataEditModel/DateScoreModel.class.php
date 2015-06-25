<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\DataEditModel;
use Home\Model\Tmp\DataTmpModel;

class DateScoreModel extends DataTmpModel {
	protected $autoCheckFields = false;
	protected $tableInfo= [
		'info' => ['title'=>'评分系统','detail'=>'约会的评分系统'],
		'table'=>'user_date',
		'order' => 'user_date.id',
		'field' => 'user_date.id,
					date.id as 哪个约会,
					users.nickname as 评分对象,
					status_date.name as 显示状态,
					status_score.name as 评分状态
					',
		'join'=> [
			'users'=>' user_date.user_id = users.id ',
			'date'=>' user_date.date_id  =  date.id ',
			'status_date'=> 'user_date.status =  status_date.id',
			'status_score'=>'user_date.score_status = status_score.id'
		],
		'undo'=>['date_id','user_id'],
	];
}