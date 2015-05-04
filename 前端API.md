#前端API列表

method: POST

1. 获取广告位

		url: http://106.184.7.12:8002/index.php/home/banner

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

2. 获取约会类型

		url: http://106.184.7.12:8002/index.php/home/date_type
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

3.  获取约会列表
	
		url: http://106.184.7.12:8002/index.php/home/showBox	

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
				                "name": "大一"
				            },
				            {
				                "selectmodel": "1",
				                "name": "大二"
				            }
				        ]
				    }
				]

4. 获取个人(或他人)信息

		url: http://106.184.7.12:8002/index.php/home/userinfo
		post: { "id":1 } //如果验证通过, 就返回id对应信息, 否则返回错误信息
		return 
				错误:
					[
						"status": "403",
						"info": "权限不够"
					]
				成功:
					[
						"id": 1,
						"nickname": "sb",
						"head": "http://xxxxxxx/",
						"academy": "学院",
						"telephone": "123456789012345678",
						"qq": "123456789",
						"weixin": "xxxxxxx"
					]

5.  发布约会

		url: http://106.184.7.12:8002/index.php/home/createdate

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
				"grade_select_model": "", //1正选(默认), 2反选
			}

		