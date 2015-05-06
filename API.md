#API列表

		method: POST

###个人信息模块

1. 获取个人(或他人)信息

		url: http://106.184.7.12:8002/index.php/api/person/userinfo
		post: { 
				"uid":1,
				"get_id":"需要获取的用户的uid",
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
						"academy": "学院",
						"telephone": "123456789012345678",
						"qq": "123456789",
						"weixin": "xxxxxxx",
						"status": "200"
					}

2. 修改个人资料

		url:  http://106.184.7.12:8002/index.php/api/person/editpersonalinfo

		post:
			{
				"uid": "",
				"nickname":"sb",
				"signature":"xxxxxx",
				"academy":"id",
				"grade": "id",
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

--------------
###私信模块
		

1.  获取私信

		url:  http://106.184.7.12:8002/index.php/api/letter/getletter

		post:
			{
				"uid": "",
				"token": "",
				"page": ""
			}

		return:
			{
				status : 200,
				info : "请求成功",
				data:{
					"0":{
						"user_id" : 123,
						"user_name" : "Lecion",
						"user_signature" : "个性签名",
						"user_avatar" : "http://****.jpg",	//用户头像
						"user_gender" : 2, 		//1是男，2是女
						"content" : "约了我的炮",
						"date_id" : 12,		//私信中活动的id，只针对系统发送的含有活动的私信
						"letter_status" : 1,	//私信状态，1 => 未读， 2 => 已读
						"user_date_status" : 2,	//用户和约会的状态,0 => 拒绝, 1 => 接受, 2 => 默认（未处理）
					},
					"1":{........}
				}
			}

2. 接受/拒绝约

		url:  http://106.184.7.12:8002/index.php/api/letter/dateaction

		post:
			{
				"uid": "",
				"token": "",
				"to_id":"接受,拒绝用户id",
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
				"info": "权限不够....."
			}

------------------------------------

###约会信息
1. 获取约会类型

		url: http://106.184.7.12:8002/index.php/api/date/date_type
		return:
				[
				    {
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
				    }
				]

2.  获取约会列表
	
		url: http://106.184.7.12:8002/index.php/api/date/showbox
		post:
		{
			"date_type": 0, //默认为0, 即所有约会类型
			"order": "", //.....
			"time": ""
		}	

		return
				[
				    {
				        "showbox_id": "3",
				        "user_id": "1",
				        "created_at": "1429446315",
				        "date_at": "1429456315",
				        "place": "重邮宾馆",
				        "title": "来约炮!",
				        "date_type": "1",
				        "category_id": "1",
				        "gender_limit": "1",
				        "academy_limit": [],
				        "grade_limit": []
				    },
				    {
				        "showbox_id": "2",
				        "user_id": "1",
				        "created_at": "1429446316",
				        "date_at": "1429456316",
				        "place": "重邮宾馆",
				        "title": "来约炮!",
				        "date_type": "2",
				        "category_id": "2",
				        "gender_limit": "1",
				        "academy_limit": [],
				        "grade_limit": []
				    },
				    {
				        "showbox_id": "1",
				        "user_id": "1",
				        "created_at": "1429446317",
				        "date_at": "1429456317",
				        "place": "重邮宾馆",
				        "title": "来约炮!",
				        "date_type": "3",
				        "category_id": "3",
				        "gender_limit": "1",
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
				                "name": "grade_id"
				            },
				            {
				                "selectmodel": "1",
				                "name": "grade_id"
				            }
				        ]
				    }
				]


3.  发布约会

		url: http://106.184.7.12:8002/index.php/api/date/createdate

		post: 
			{
				"date_type" : "约会类型id",
				"title": "xxxx(n字以内)",
				"introduce": "xxxxxxx",
				"date_time": "时间戳",
				"date_place": "约会地点",
				"date_people": "限制人数",
				"gender_limit": ""	//0不限, 1男, 2女
				"academy_limit": "", //学院限制
				"academy_select_model": "", //1正选(默认), 2反选
				"grade_limit": "", //年级限制
				"grade_select_model": "", //1正选(默认), 2反选,
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




9. 待定
