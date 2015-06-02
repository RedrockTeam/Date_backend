<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\DataEditModel;
use Home\Model\Tmp\DataTmpModel;

class UsersModel extends DataTmpModel {
	protected $autoCheckFields = false;
	protected $tableInfo= [
		'info' => ['title'=>'用户信息修改','detail'=>'在这里你可以修改所有用户数据信息'],
		'table'=>'users',
		'order' => 'users.id',
		'field' => 'users.id,stu_num as 学号,users.nickname as 账户名,grade.name as 年级,academy.name as 学院,signature as 签名,qq as QQ,weixin as 微信,telephone as 电话,head as 头像地址',
		'join'=> [
			'academy'=>' users.academy = academy.id ',
			'grade'=>' users.grade  =  grade.id ',
		],
	];

}