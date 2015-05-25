#API列表
		method: POST

		//测试用户信息, public的接口不需要验证身份信息

		uid: 1 -> token:   nasdfnldssdaf  ;
		uid: 2 -> token:  cdsagrebvfra ;

###个人信息模块

1. 获取个人(或他人)信息

		url: http://106.184.7.12:8002/index.php/api/person/userinfo
		post: { 
				"uid":1,
				"get_uid":"需要获取的用户的uid",
				"token":""
			  } //如果验证通过, 就返回id对应信息, 否则返回错误信息
		return 
				错误:
					{
						"status": "403",
						"info": "权限不够"
					}
				成功:
					{
						"id": 1,
						"nickname": "sb",
						"head": "http://xxxxxxx/",
						gender : "", 
						grade : "",
						"academy": "学院",
						"telephone": "123456789012345678",
						"qq": "123456789",
						"weixin": "xxxxxxx",
						"status": "200"
					}

2. 修改个人资料
        
        //没写...
		url:  http://106.184.7.12:8002/index.php/api/person/editpersonalinfo

		post:
			{
				"uid": "",
				"nickname":"sb",
				"signature":"xxxxxx",
				"telephone": "",
				"qq": "",
				"weixin": "",
				"token": ""
			}

		return:
			{
				"status": "200",
				"info": "成功"
			}
3. 取个人收藏列表

            url:  http://106.184.7.12:8002/index.php/api/person/collection
            post: {
            uid:"",
            token:""
            }
            return {
                [
                data:{
                    "date_id": "1",
                    "user_id": "1",
                    "date_status": "2",
                    "head": "http:\/\/106.184.7.12:8002\/Public\/head.jpg",
                    "signature": "i'm db",
                    "nickname": "刘晨凌",
                    "gender": "2",
                    "title": "来约炮!",
                    "date_time": "1529456317",
                    "created_at": "1429446317",
                    "cost_model": "1",
                    "content": "test",
                    "place": "重邮宾馆",
                    "score": "0"
                    }
                 ],
                "info": "成功",
                "status": 200
            }
4. 取个人参加记录

                    url:  http://106.184.7.12:8002/index.php/api/person/join
                    post: 
                    {
                        uid:"",
                        token:""
                    }
                    return:
                    [
                       "data": [
                            {
                            "date_id": "1",
                            "user_id": "1",
                            "time": "1429446317",
                            "user_status": "1",
                            "date_status": "2",
                            "head": "http:\/\/106.184.7.12:8002\/Public\/head.jpg",
                            "signature": "i'm db",
                            "nickname": "刘晨凌",
                            "gender": "2",
                            "title": "来约炮!",
                            "date_time": "1529456317",
                            "created_at": "1429446317",
                            "cost_model": "1",
                            "content": "test",
                            "place": "重邮宾馆",
                            "score": "0"
                            }
                        ],
                    "info": "成功",
                    "status": 200
                    ]
5. 取个人发起记录

        url:  http://106.184.7.12:8002/index.php/api/person/create
        post: 
        {
            uid:"",
            token:""
        }
        return: 
            
               [
               data:[
               {
               "id": "1",
               "user_id": "1",
               "title": "来约炮!",
               "date_type": "3",
               "cost_model": "1",
               "content": "test",
               "place": "重邮宾馆",
               "date_time": "1529456317",
               "created_at": "1429446317",
               "apply_num": "0",
               "sure_num": "0",
               "limit_num": "1",
               "gender_limit": "1",
               "score": "0",
               "scored_num": "0",
               "status": "2",
               "stu_num": "2013211000",
               "head": "http:\/\/106.184.7.12:8002\/Public\/head.jpg",
               "signature": "i'm db",
               "nickname": "刘晨凌",
               "gender": "2",
               "grade": "2",
               "academy": "1",
               "qq": null,
               "weixin": null,
               "telephone": null,
               "token": "1"
               }],
               "info":"成功",
               "status":200
               ]
                
6. 收藏约会

		url:  http://106.184.7.12:8002/index.php/api/person/collect
        
        		post:
        			{
        				"uid": "",
        				"date_id":"",
        				"token": "",
        			}
        			
        return
        
                            {
            				"status": 200,
            				"info":"成功"
            			}
        
--------------

###私信模块

1.  获取私信

		url:  http://106.184.7.12:8002/index.php/api/letter/getletter

		post:
			{
				"uid": "",
				"token": "",
				"page": "",
				"size":""
			}

		return:
			{
				status : 200,
				info : "请求成功",
				data:{
					{
					    "letter" : 1,
					    "letter_type": 1, //1带接受/拒绝, 2不是
						"user_id" : 123,
						"user_name" : "Lecion",
						"user_score": "",
						"user_signature" : "个性签名",
						"user_avatar" : "http://****.jpg",	//用户头像
						"user_gender" : 2, 		//1是男，2是女
						"content" : "约了我的炮",
						"date_id" : 12,		//私信中活动的id，只针对系统发送的含有活动的私信
						"letter_status" : 1,	//私信状态，1 => 未读， 2 => 已读
						"user_date_status" : 2,	//用户和约会的状态,0 => 拒绝, 1 => 接受, 2 => 默认（未处理）
					},
					{
                        "letter" : 2,
                        "user_id" : 123,
                        "user_name" : "Lecion",
                        "user_signature" : "个性签名",
                        "user_avatar" : "http://****.jpg",	//用户头像
                        "user_gender" : 2, 		//1是男，2是女
                        "content" : "约了我的炮",
                        "date_id" : 12,		//私信中活动的id，只针对系统发送的含有活动的私信
                        "letter_status" : 1,	//私信状态，1 => 未读， 2 => 已读
                        "user_date_status" : 2,	//用户和约会的状态,0 => 拒绝, 1 => 接受, 2 => 默认（未处理）
                    }
				}
			}

2. 接受/拒绝约

		url:  http://106.184.7.12:8002/index.php/api/letter/dateaction

		post:
			{
				"uid": "",
				"token": "",
				"to_id":"接受/拒绝用户id",
				"date_id":"",
				"action":""//用户和约会的状态,0 => 拒绝, 1 => 接受, 2 => 默认（未处理）
			}

		return:
			成功:
			{
				"status": 200,
				"info":"成功"
			}
			错误
			{
				"status": 403,
				"info": "权限不够"
			}
			{
            	"status": 404,
            	"info": "没有这条约会记录"
            }
3. 私信通知

        url: http://106.184.7.12:8002/index.php/api/letter/letterstatus
        
        post:
        {
            "uid": "",
            "token": ""
        }
        return:
                {
                    'status' => 200,
                    'letter' => 4//未读私信数量
                };
------------------------------------

###约会信息
1. 获取约会类型

		url: http://106.184.7.12:8002/index.php/api/date/datetype
		return:
				[
				    data:[{
				        "id": "1",
				        "type": "吃饭"
				    },
				    {
				        "id": "2",
				        "type": "打牌"
				    },
				    {
				        "id": "3",
				        "type": "约炮"
				    }],
				    status:200
				]

2.  获取约会列表
	
		url: http://106.184.7.12:8002/index.php/api/date/datelist
		post:
		{
			"date_type": 0, //默认为0, 即所有约会类型
			"page": ,//页码
            "size": ,//每页显示条数
			"order": "", //1 order by created_at desc; 2 待定...
		}	

		return
				{
                    "data": [
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "4",
                            "user_id": "1",
                            "content": "test",
                            "created_at": "1429446314",
                            "date_at": "1429456314",
                            "place": "重邮宾馆",
                            "title": "来约炮!",
                            "date_type": "1",
                            "type": "吃饭",
                            "people_limit": "1",
                            "category_id": "1",
                            "gender_limit": "0",
                            "cost_model": "1",
                            "signature": "i'm db"
                        },
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "26",
                            "user_id": "1",
                            "content": "test1",
                            "created_at": "1431434132",
                            "date_at": "1431429313",
                            "place": "menkou",
                            "title": "test",
                            "date_type": "1",
                            "type": "吃饭",
                            "people_limit": "0",
                            "category_id": "1",
                            "gender_limit": "0",
                            "cost_model": "1",
                            "signature": "i'm db"
                        },
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "25",
                            "user_id": "1",
                            "content": "test1",
                            "created_at": "1431434102",
                            "date_at": "1431429313",
                            "place": "menkou",
                            "title": "test",
                            "date_type": "1",
                            "type": "吃饭",
                            "people_limit": "0",
                            "category_id": "1",
                            "gender_limit": "0",
                            "cost_model": "1",
                            "signature": "i'm db"
                        },
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "3",
                            "user_id": "1",
                            "content": "test",
                            "created_at": "1429446315",
                            "date_at": "1429456315",
                            "place": "重邮宾馆",
                            "title": "来约炮!",
                            "date_type": "1",
                            "type": "吃饭",
                            "people_limit": "1",
                            "category_id": "1",
                            "gender_limit": "1",
                            "cost_model": "1",
                            "signature": "i'm db"
                        },
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "5",
                            "user_id": "1",
                            "content": "test",
                            "created_at": "1429446313",
                            "date_at": "1429456313",
                            "place": "重邮宾馆",
                            "title": "来约炮!",
                            "date_type": "2",
                            "type": "打牌",
                            "people_limit": "1",
                            "category_id": "2",
                            "gender_limit": "2",
                            "cost_model": "1",
                            "signature": "i'm db"
                        },
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "2",
                            "user_id": "1",
                            "content": "test",
                            "created_at": "1429446316",
                            "date_at": "1529456316",
                            "place": "重邮宾馆",
                            "title": "来约炮!",
                            "date_type": "2",
                            "type": "打牌",
                            "people_limit": "1",
                            "category_id": "2",
                            "gender_limit": "1",
                            "cost_model": "1",
                            "signature": "i'm db"
                        },
                        {
                            "nickname": "刘晨凌",
                            "head": "http://106.184.7.12:8002/Public/head.jpg",
                            "gender": "2",
                            "date_id": "1",
                            "user_id": "1",
                            "content": "test",
                            "created_at": "1429446317",
                            "date_at": "1529456317",
                            "place": "重邮宾馆",
                            "title": "来约炮!",
                            "date_type": "3",
                            "type": "约炮",
                            "people_limit": "1",
                            "category_id": "3",
                            "gender_limit": "0",
                            "cost_model": "1",
                            "signature": "i'm db",
                            "grade_limit": [
                                "大一",
                                "大二"
                            ]
                        }
                    ],
                    "status": 200,
                    "info": "成功"
                }


3.  发布约会

		url: http://106.184.7.12:8002/index.php/api/date/createdate

		post: 
			{
				"date_type" : "约会类型id",
				"title": "xxxx(n字以内)",
				"content": "xxxxxxx",
				"date_time": "时间戳",
				"date_place": "约会地点",
				"date_people": "限制人数",
				"gender_limit": ""	//0不限, 1男, 2女
				"academy_limit": "", //学院限制
				"academy_select_model": "", //1正选(默认), 2反选
				"grade_limit": "", //年级限制
				"grade_select_model": "", //1正选(默认), 2反选,
				"cost_model": "", int 看ER图
				"uid": "",
				"token": ""
			}

		return:
		错误:
			{
				"status": "403",
				"info":  "错误信息", //超过每日约上限, 参数非法, 等等...
			}
		成功:
			{
				"status":"200",
				"info": "发布成功"
			}
4. 取约会详情
        url: http://106.184.7.12:8002/index.php/api/date/detaildate
        
        post: 
        			{
        				"date_id" : "约会id",
        				"uid": "",
        				"token": ""
        			}
        retrun: 
                  {
                  "nickname": "刘晨凌",
                  "head": "http:\/\/106.184.7.12:8002\/Public\/head.jpg",
                  "gender": "2",
                  "date_id": "1",
                  "user_id": "1",
                  "created_at": "1429446317",
                  "date_at": "1529456317",
                  "place": "重邮宾馆",
                  "title": "来约炮!",
                  "date_type": "3",
                  "type": "约炮",
                  "category_id": "3",
                  "people_limit": "1",//人数限制
                  "gender_limit": "1",
                  "cost_model": "1",
                  "academy_limit": [
                  {
                  "selectmodel": "2",
                  "name": "计算机"
                  },
                  {
                  "selectmodel": "2",
                  "name": "传媒"
                  }
                  ],
                  "grade_limit": [
                  {
                  "selectmodel": "1",
                  "name": "大一"
                  },
                  {
                  "selectmodel": "1",
                  "name": "大二"
                  }
                  ],
                  "user_score": null //int, null暂无评分记录
                  }
5. 报名约会
             
             url: http://106.184.7.12:8002/index.php/api/date/report
             
             post:
             {
                uid:"",
                token:"",
                date_id:""
             }
             
             return:
             {
                info:"成功";
                status:"200"
             }
6. 取约会报名人员

               url: http://106.184.7.12:8002/index.php/api/date/report
                            
                            post:
                            {
                               uid:"",
                               token:"",
                               date_id:""
                            }
                            
                            return:
                            {
                                data:""
                               info:"成功";
                               status:"200"
                            }
                            
7. 评价约会

                url: http://106.184.7.12:8002/index.php/api/date/report
                            
                            post:
                            {
                               uid:"",
                               token:"",
                               date_id:"",
                               'score':""// 0 <= x <= 5 .....
                            }
                            
                            return:
                            {
                               info:"成功"; //error info
                               status:"200" //403 500
                            }
    
----------------------------	
###公共

1. 获取广告位

		url: http://106.184.7.12:8002/index.php/api/public/banner

		return:
			 [
				{
					"url": "https://www.baidu.com", //赞助商链接
					"src": "http://106.184.7.12:8002/Public/test.jpg" //banner地址
			    },
			    {
			        "url": "http://www.pornhub.com",
			        "src": "http://106.184.7.12:8002/Public/test1.jpg"
			    },
			    {
					"url": "http://www.taobao.com",
					"src":"http://106.184.7.12:8002/Public/test3.jpg"
			    }
			]

2. 获取学院列表

        url: http://106.184.7.12:8002/index.php/api/public/academy
        
        		return:
        			 {
                     "data": [
                     {
                     "id": "1",
                     "name": "计算机"
                     },
                     {
                     "id": "2",
                     "name": "传媒"
                     },
                     {
                     "id": "3",
                     "name": "通信"
                     }
                     ],
                     "info": "成功",
                     "status": 200
                     }
                     
                     
9. 待定
