<?php
return array(
	//'配置项'=>'配置值'
    'URL_CASE_INSENSITIVE' => true,
    'SESSION_AUTO_START' => true,
    'URL_MODEL'          => '3',
    'DEFAULT_CHARSET'    =>  'utf-8',
    //'SESSION_PREFIX'        =>  'date_', // session 前缀
    'COOKIE_EXPIRE'         =>  0,    // Cookie有效期
    'COOKIE_DOMAIN'         =>  '',      // Cookie有效域名
    'COOKIE_PATH'           =>  '/',     // Cookie路径
    'SESSION_OPTIONS' => array('use_only_cookies'=>0,'use_trans_sid'=>1),
    'LAYOUT_ON'=>true,
    /*
    ** mysql
    */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'redrock_wx_game15',    // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '495871401',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存

    /**
     * 允许模块列表
     */
    'DEFAULT_MODULE'       =>    'Home',  // 默认模块
    'DEFAULT_CONTROLLER'       =>    'Management',  // 默认模块
/**/
    /**
     * 路由配置
     */
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES' => [
        'banner' => 'Banner/Banner',
        'showBox' => 'DateList/getList',
        'dateType' => 'Category/date_type',

    ],
);