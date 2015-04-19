<?php
return array(
	//'配置项'=>'配置值'
    //'SHOW_PAGE_TRACE' =>true,
    'URL_MODEL'=>1,
    //显示调试日志
	//'SHOW_PAGE_TRACE'=>true,
    //路由对大小写不敏感
    'URL_CASE_INSENSITIVE'=>true,

    /*
     * 数据库配置
    */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'date', // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',    // 密码
    'DB_PORT'               =>  '3306',     // 端口
    //'DB_PREFIX'             =>  'hy_',    	// 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',
);