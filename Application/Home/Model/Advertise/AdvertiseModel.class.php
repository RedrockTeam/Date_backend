<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\Advertise;
use Home\Model\Tmp\DataTmpModel;

class AdvertiseModel extends DataTmpModel {
	protected $autoCheckFields = false;
	protected $tableInfo= [
		'info' => ['title'=>'广告修改','detail'=>'添加/修改广告'],
		'table'=>'advertise',
		'order' => 'advertise.id',
		'field' => 'advertise.id,advertise.url as  跳转链接,advertise.src as 图片地址,status_advertise.status_name as 广告状态',
		'join'=> [
			'status_advertise'=>' advertise.status = status_advertise.status_id',
		]
	];
}