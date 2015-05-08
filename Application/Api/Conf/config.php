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
    /*
    ** mysql
    */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'date',    // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存

    /**
     * 允许模块列表
     */
    'DEFAULT_MODULE'       =>    'Api',  // 默认模块
    /**
     * 路由配置
     */
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES' => [
        //公共
        'public/banner' => 'Banner/Banner',//广告位
        //约会信息
        'date/datelist' => 'Date/getList',//约会列表
        'date/datetype' => 'Category/date_type',//约会类型
        'date/detaildate' => 'Date/getDetail',//具体的约会详情
        'date/create' => 'Date/createDate',//发布约会
        //私信模块
        'letter/getletter' => 'Letter/getLetter',
        'letter/letterstatus' => 'Letter/letterStatus',
        'letter/dateaction' => 'Letter/dateAction',

        //个人信息模块
        'person/collection' => 'Personal/getColletion',
        'person/join' => 'Personal/getJoin',
        'person/create' => 'Personal/getCreate',
    ],
);