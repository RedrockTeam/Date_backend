<?php
/*
 *  By:Orange-W
 *  自定义数据表
*/
namespace Home\Model\ManagementNav;

class ManagementNavModel  {
	protected $autoCheckFields = false;
	private $pageTotal=15;//数据分页页数

	public function returnTotalPage(){
		return $this->pageTotal;
	}


	/**
	 * @return mixed
	 * @For  侧导航栏路由表
     */
	public function returnNavigation(){//功能路由
		$Navigation['function_info']=array(
			0=>array(
				'src'=> U('home/management/index'),
				'name'=> '控制台',
			),
			1=>array(
				'src'=> '',
				'name'=> '数据后台',
				'nextTag' =>array(//二级导航
					0=>array(
						'src'=> U('home/DataEdit/index?table=用户信息'),
						'name'=> '用户信息',
					),
					1=>array(
						'src'=> U('home/DataEdit/index?table=约会信息'),
						'name'=> '约会信息',
					),
					/*2=>array(
						'src'=> U('home/DataEdit/index?table=约会限制'),
						'name'=> '约会限制',
					),*/
					3=>array(
						'src'=> U('home/DataEdit/index?table=约会好评'),
						'name'=> '约会好评',
					),//m->m
					4=>array(
						'src'=> U('home/DataEdit/index?table=私信管理'),
						'name'=> '私信管理',
					),

				),
			),
			9=>array(
				'src'=> '',
				'name'=> '广告管理',
				'nextTag' =>array(//二级导航
					0=>array(
						'src'=> U('home/DataEdit/index?table=广告修改'),
						'name'=> '广告修改',
					),
				),
			),
			900=>array(
				'src'=> U('home/management/LOGOUT'),
				'name'=> '退出登录',
			),
		);

		return $Navigation;
	}
}