<?php
return array(
	//'配置项'=>'配置值'
    'URL_CASE_INSENSITIVE' => true,
    'SESSION_AUTO_START' => true,
    'SHOW_PAGE_TRACE'=>true,
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
        'public/academy' => 'Category/academy',//学院列表

        //约会信息
        'date/datelist' => 'Date/getList',//约会列表
        'date/datetype' => 'Category/date_type',//约会类型
        'date/detaildate' => 'Date/getDetail',//具体的约会详情
        'date/create' => 'Date/createDate',//发布约会
        'date/report' => 'Date/report', //报名约
        'date/dateperson' => 'Date/getDatePerson', //获取参与约会的人员
        'date/scoredate' => 'Date/scoreDate', //对约会评分

        //私信模块
        'letter/getletter' => 'Letter/getLetter',//获取私信
        'letter/letterstatus' => 'Letter/letterStatus',//查看未读私信数量
        'letter/dateaction' => 'Letter/dateAction',//私信中接受/拒绝约

        //个人信息模块
        'person/collect' => 'Personal/Collect',//收藏约会
        'person/collection' => 'Personal/getCollection',//获取个人收藏
        'person/join' => 'Personal/getJoin',//获取参加的约会
        'person/create' => 'Personal/getCreate',//获取发起的约会
        'person/userinfo' => 'Personal/getInfo',//获取用户信息
        'person/score' => 'Common/credit', //获取用户信用
        'person/editdata' => 'Personal/editPerson', //修改个人资料

        //不服打我啊
        'advice/advice' => 'AdviceController/getAdvice'//投诉

    ],
);