<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model;
use Think\Model;

class UsersModel extends Model {
	protected $autoCheckFields = false;
	protected $tableInfo= [
		'info' => ['title'=>'用户信息修改','detail'=>'在这里你可以修改所有用户数据信息'],
		'table'=>'users',
		'order' => 'users.id',
		'field' => 'users.id, grade.id as 成绩Id,users.nickname as 账户Id,grade.name as 年级,academy.name as 学院',
		'join'=> [
			'academy'=>' users.academy = academy.id ',
			'grade'=>' users.grade  =  grade.id ',
		],
	];

	public  function returnTableInfo(){
		return $this->tableInfo;
	}

}