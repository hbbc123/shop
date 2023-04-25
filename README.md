# 接口名称:获取大频道分类

接口地址:/index/index/index

请求方式:get

请求参数:

| begin | 从哪一条开始获取     |
| ----- | -------------------- |
| limit | 获取多少条           |
|       | 不传参数表示获取全部 |

成功返回内容：

```
{"category_parent_id":1,
"category_parent_title":"男装",
"category_parent_img":"\/category_parent\/q.jpg"
}
```

失败返回内容:无



# 接口名称:获取首页下拉商品列表

接口地址:/index/index/indexcmm

请求方式:get

请求参数:

| begin | 从哪一条开始获取   |
| ----- | ------------------ |
| limit | 获取多少条  默认10 |
|       |                    |

成功返回内容：

```
{"category_parent_id":1,
"category_parent_title":"男装",
"category_parent_img":"\/category_parent\/q.jpg"
}
```

失败返回内容:无









# 接口名称:获取搜索热词

接口地址:/index/index/ hot_word

请求方式:get

请求参数:

| begin | 从哪一条开始获取     |
| ----- | -------------------- |
| limit | 获取多少条           |
|       | 不传参数表示获取全部 |

成功返回内容：

```
{

​    "category_son_id": 618, //类别ID

​    "category_parent_id": 11, //父频道ID

​    "category_son_title": "验钞/点钞机",//频道名称

​    "category_son_img": "/commodity_img/5a169fdbN8670f3ed.jpg", //频道img

​    "category_son_lei": 65,//子频道ID

​    "hot": 1  //1为热门

}
```

失败返回内容:无

 

 

 

# 接口名称:获取平台频道(子频道->类别) 

接口地址:/index/index/ broadside

请求方式:get

请求参数:无

成功返回内容：

```
data:{

    category_parent_id: 1 //大频道ID

    category_parent_img: null  //大频道IMG

    category_parent_title: "男装" //大频道名称

    data:{

    category_parent_id: 1 //大频道ID

    category_son_son_id: 2 //子频道ID

    category_son_son_title: "男士内搭"//子频道名称

    category_son_son_img:null//子频道IMG

    ​      data:{
            category_parent_id: 1 //大频道ID
            category_son_id: 10 //类别ID
            category_son_img: "/commodity_img/5ac47fffNe7a93aca.jpg"  //类img
            category_son_lei: 2 //子频道ID
            category_son_title: "短袖T恤"  //类别名称
            hot: 1   //1为热度类别
            category_son_activity_img:null //活动IMG
    ​           }

            } 

}
```

失败返回内容:无

 

 

 

 

# 接口名称:获取网站banner 

接口地址:/index/index/ broadside

请求方式:get

请求参数:无

成功返回内容：

```
data:{
    banner:[{ //所在区域  轮播图（主要）
    app_home_id: 1
    app_home_weight: 0  //0=主要  2=次要 3=列表     所展示内容的图片
    chang_id: 1 //传入的ID
    data: {
            id: 1
            imgs: ['/shop_banner_img/Snipaste_2023-01-12_15-20-39.jpg']  //展示图片
            index_img: "/shop_banner_img/Snipaste_2023-01-12_15-20-39.jpg"
            shop_name: "欧水电费专卖店" 
            }
    msg: "店铺首页"  //提示所需跳转的类别
    type: 3 // 1平台频道 2平台子类 3店铺首页 4商品 5平台子类中类别
    }]  
    
    
    banner_min:[ //所在区域  次轮播图（次主要）
    [{
        app_home_id: 3
        app_home_weight: 1
        chang_id: 2
        data: {
        id: 2
        imgs: [ "/commodity_info_img/d4f85cb79a13db81.jpg"
                "/commodity_info_img/Snipaste_2023-01-12_11-03-33.jpg"]  //所要展示的图片
        videos: null
        }
        msg: "商品"
        type: 4
    }]
    ]
    list:[???]

}
```

失败返回内容:无









# 接口名称:获取秒杀内容

接口地址:/index/index/ seckill

请求方式:get

请求参数:无   limit 默认2

成功返回内容：

```
data:[[
{
    "send_time": "2023-01-15 16:52:12", //秒杀开始时间
    "commodity_num": 1000,  //秒杀数量总数量
    "commodity_num_sheng": 1,  //已销售数量
    "end_time": "2023-01-15 22:52:15", //秒杀结束时间
    "commodity_info_title": "欧 郎 格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男			长袖T恤打底衫",  //商品名
    "commodity_info_data": {  //商品类型
        "title": "选择尺码",
        "data": [
            {
                "name": "S",
                "money": 99,
                "num": 55
            },
        ]
    },
    "commodity_info_activity": {//活动商品类型  活动价格在此显示
        "title": "选择尺码",
        "data": [
            {
                "name": "S",  //类型名称
                "money": 55, //价格
                "num": 55//数量
            },
        ]
    },
    "imgs": [  //商品IMG
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
    ],
    "videos": [//商品video
        "/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"
    ],
    "activity_title": "爆款直降" //活动名称
}
]]
```





# 接口名称:获取特价，新品,好店,优惠券展示内容

接口地址:/index/index/ plate

请求方式:get

请求参数:

| limit | int  | 获取多少条（不传表示获取4条）                  |
| ----- | ---- | ---------------------------------------------- |
| day   | int  | 表示获取上架day天内的新品（不传表示获取7天内） |

成功返回内容：

```
{
    "special": [ //特价商品
        {
            "imgs": [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"
            ],
            "commodity_info_data": {//正常价格
                "title": "选择尺码",
                "data": [
                    {
                        "name": "S",
                        "money": 99,
                        "num": 55
                    },
                ]
            },
            "commodity_info_activity": {//活动价格
                "title": "选择尺码",
                "data": [
                    {
                        "name": "XL",
                        "money": 99,//活动价格
                        "num": 55 //活动库存
                    }
                ]
            },
            "commodity_info_title": "欧 郎 格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫"
        }
    ],
    "newproduct": [ //新品
        {
            "imgs": [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            ],
            "commodity_info_data": {
                "title": "选择尺码",
                "data": [
                    {
                        "name": "S",
                        "money": 99,
                        "num": 55
                    },
                ]
            },
            "commodity_info_activity": { //如果为null则表示为没有活动价格
                "title": "选择尺码",
                "data": [
                    {
                        "name": "S",
                        "money": 99,
                        "num": 55
                    },
                ]
            },
            "commodity_info_title": "欧 郎 格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
            "commodity_type_id": 1,
            "store_commodity_sum": 998
        },
    ],
    "goodshoop": [//好店
        {
            "shop_id": 1,
            "index_img": "/shop_banner_img/Snipaste_2023-01-12_15-20-39.jpg", //所展示图片
            "attention": 123456  //关注人数
        },
    ],
    "ticket": [//优惠券
        {
            "discount_id": 1,
            "type": 0,
            "shop_id": null,
            "man_money": "100.00", //使用金额
            "jian_money": "20.00", //优惠金额
            "ze_kou": null,
            "portion_tf": 1,
            "discount_info": "全频道满100减20",//优惠券说明
            "sen_time": "2023-01-17 18:50:27",//开始时间
            "end_time": "2023-01-28 18:50:31", //结束时间
            "superposition": 1,
            "repetition": 1,
            "discount_title": "满100元可用",  //名称
            "msg": "全频道券",  //优惠券类别
            "img": "/commodity_img/5ac47fffNe7a93aca.jpg"//所展示图片
        },
    ]
}
```

 



# 接口名称:店铺页top通用内容

接口地址:/index/index/ commodityinfo

请求方式:get

请求参数:

| id   | int  | 商品ID |
| ---- | ---- | ------ |
|      |      |        |

成功返回内容：



```
{
    "channel": [ //店铺频道
        {
            "shop_category_title": "男子专区",
            "shop_category_id": 1,
            "type": 0,
            "son": [
                {
                    "shop_category_title": "运动鞋",
                    "shop_category_id": 1,
                    "type": 1
                },
                {
                    "shop_category_title": "T恤",
                    "shop_category_id": 2,
                    "type": 1
                }
            ]
        },
    ],
    "shop_hard": [  //店铺力推商品
        {
            "shop_category_SON": "T恤",
            "imgs": [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            ],
            "brand": "欧 郎 格",
            "commodity_info_id": 1
        },
    ],
    "shop_hot": [  //候选搜索词
        {
            "category_son_title": "短袖T恤",
            "category_son_id": 10
        },
    ],

}
```





# 接口名称:商品详情页数据

接口地址:/index/index/ getgoos

请求方式:get

请求参数:s

| id      | int  | 商品ID         |
| ------- | ---- | -------------- |
| user_id | int  | 用户ID(可不传) |

成功返回内容：

```
{
    "commodity": {  //商品选择类别
        "store_commodity_id": 1,
        "store_id": 1,
        "store_commodity_sum": 998, //商品销量
        "vip": "0.95", //会员95折
        "store_commodity_data": {
            "name": "颜色",
            "data": [
                {
                    "name": "金色",
                    "commodity_info_id": 2,//商品ID
                    "img": {
                        "imgs": [
                            "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
                        ]
                    }
                },
            ]
        },
        "store_channel_id": 2,
        "freight_money": 0,
        "ze": "0.98",
        "store_commodity_state": 0,
        "good_store": 0,  //0=好店  
        "store_commodity_grade": null
    },
    "channel": [//店铺频道
        {
            "shop_category_title": "男子专区",
            "shop_category_id": 1,
            "type": 0,
            "son": [
                {
                    "shop_category_title": "运动鞋",
                    "shop_category_id": 1,
                    "type": 1
                },
                {
                    "shop_category_title": "T恤",
                    "shop_category_id": 2,
                    "type": 1
                }
            ]
        },
    ],
    "site": {  //商品路由地址
        "category_parent_title": "男装",
        "category_son_son_title": "男士内搭",
        "category_son_title": "短袖T恤",
        "category_son_id": 10,
        "brand": "欧 郎 格"
    },
    "recommend": [  //存放相似商品
        [
            {
                "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
                "imgs": [
                    "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
                ],
                "commodity_info_data": {
                    "title": "选择尺码",
                    "data": [
                        {
                            "name": "S",
                            "money": 99,
                            "num": 55
                        },
                    ]
                },
                "activity_tf": 0,
                "commodity_info_id": 1,
                "commodity_info_activity": ""
            },
        ]
    ],
    "shop_info": {  //店铺信息
        "shop_img": "/shop_banner_img/Snipaste_2023-01-12_15-20-39.jpg",  //店铺LOGO
        "shop_name": "欧水电费水电费水电费水电费专卖店",  //店铺名称
        "shop_id": 1,  //店铺ID
        "logistics_score": "9.2",  //物流评分
        "after_score": "9.1", //售后服务
        "service_score": "7.8"//商品评分
    },
    "discount": [ //存放商品优惠券
        {
            "discount_id": 4,
            "type":  1, // 0=全频道  -2=运费   其他=店铺  优惠券
            "shop_id": 1, //店铺ID
            "man_money": "200.00",//使用条件
            "jian_money": "40.00",//优惠内容
            "ze_kou": null,//折扣
            "portion_tf": 1,  //0=全部商品  1=部分商品
            "discount_info": "仅可购买欧适当旗舰店部分商品",
            "sen_time": "2023-01-11 19:00:34",  //开始时间
            "end_time": "2023-07-29 19:00:36",//结束时间
            "superposition": 1,  //是否叠加 0=是 1=否
            "repetition": 1,//是否能重复领取 0=是 1=否
            "discount_title": //"优惠券名称"
        },
    ],
    "commoditychange": {
        "commodity_info_id": 1,
        "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
        "commodity_info_brief": null,  //存放商品规格数据
        "commodity_info_data": {
            "title": "选择尺码",  //商品选择
            "data": [
                {
                    "name": "S",//名称
                    "money": 99,//价格
                    "num": 55 //数量
                },
            ]
        },
        "commodity_info_activity": "", //存放活动价格
        "imgs": [
            [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            ]
        ],
        "shop_id": 1,
        "brand": "欧 郎 格",
        "activity_title": "",//活动名称
        "commodity_info_state_time": "2023-01-13 18:28:08",
        "videos": [
            "/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"
        ],
        "commodity_info_activity_sent_time": null, //活动价格使用时间
        "commodity_info_activity_end_time": null,  //活动价格结束时间
        "activity_tf": 0   //是否处于活动时段 0=是  1=否
    },
    "comment_number": 0,
    "shop_like": {
        "shop_id": 1,
        "shop_like": true
    }
}
```







# 接口名称:获取搜索候选关键字

接口地址:/index/index/ candidate

请求方式:get

请求参数:

| value | string | 关键字 |
| ----- | ------ | ------ |
|       |        |        |

成功返回内容：

```
[
    {
        "title": "小米13 "
    },
    {
        "title": "小米手机专卖店"
    }
]
```





# 接口名称:获取商品评论分类计数数据

接口地址:/index/index/ commoditynum

请求方式:get

请求参数:

| id      | int     | 商品ID                        |
| ------- | ------- | ----------------------------- |
| present | Boolean | true为只统计当前商品 否则反之 |

成功返回内容：

```
{
    "all": 2, //全部评论（数量）
    "img": 2, //晒图
    "video": 2,//视频评论
    "good": 1,//好评
    "middle": 1,//中评
    "difference": 0,//差评
    "add": 0 //追评
}
```







# 接口名称:获取商品评论

接口地址:/index/index/ commoditytitle

请求方式:get

请求参数:

| id      | int     | 商品ID                                                |
| ------- | ------- | ----------------------------------------------------- |
| present | Boolean | true为当前商品评论 否则反之                           |
| order   | int     | 0 为默认排序 1为时间排序                              |
| select  | int     | 0=全部评论 1=晒图 2=视频 3=追评 4=好评  5=中评 6=差评 |
| limit   | int     | 取多少条数据                                          |
| offset  | int     | 从第多少条开始取数据                                  |
| user_id | int     | 不传 表示用户暂时没有登录                             |

成功返回内容：

```
{
    "commodity_comment_parent_id": 1,  //评论ID
    "commodity_type_id": 1,   //商类ID
    "indent_id": 1,  //订单ID
    "commodity_comment_parent_send_time": "2023-02-02 17:38:41", //评论时间
    "commodity_comment_parent_title": "哈哈哈", //评论标题
    "commodity_comment_parent_info": "真的好",  //评论内容
    "commodity_comment_parent_img": [  //评论图片
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
    ],
    "user_id": 1,  //评论用户ID
    "commodity_comment_parent_grader": 4,  //评论好评度
    "commodity_comment_parent_like": 10,   //评论点赞数
    "commodity_comment_parent_trample": 0, //评论踩数
    "commodity_comment_parent_info_add": "fghfghfgh", //追评内容
    "commodity_comment_parent_info_add_time": "2023-02-05 21:37:20", //追评时间
    "commodity_comment_parent_video": [
        "/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"  //评论视频
    ],
    "commodity_comment_parent_info_add_img": null,  //追评图片
    "commodity_comment_parent_info_add_video": null, //追评视频
    "commodity_comment_parent_info_add_like": null,//追评点赞
    "commodity_info_id": 1,  //商品ID
    "nickname": "水博超",  //评论用户名
    "headimg": "/user_img/123.jpeg",  //评论用户名头像
    "vip": 1,  //1=vip 反之
    "type": {  //用户购买商品类型
        "name": "金色",
        "son": {
            "name": "s码",
            "money": 99
        }
    },
    "change_user_id": 1,  //当前用户ID
    "commodity_comment_like_id": 1, //点赞ID
    "user_like": 1, //1=点赞 反之
    "replysum": 1  //评论回复条数
}
```









# 接口名称:获取商品评论回复

接口地址:/index/index/ getcomment

请求方式:get

请求参数:

| id      | int  | 商品ID                                          |
| ------- | ---- | ----------------------------------------------- |
| order   | int  | 0 为默认排序 1为时间排序                        |
| user_id | int  | 传入当前用户的ID（可不传 表示用户暂时没有登录） |

成功返回内容：

```
{
    "commodity_comment_son_id": 1,   //回复ID
    "commodity_comment_parent_id": 1,//评论ID
    "commodity_comment_son_user_id": 2, //回复用户的ID
    "commodity_comment_son_target_id": 1,//回复目标用户的ID
    "commodity_comment_son_title": "hhh电饭锅",  //回复内容
    "commodity_comment_son_send_time": "2023-02-04 20:35:17", //回复时间
    "commodity_comment_son_like": 0,  //点赞数
    "commodity_comment_son_trample": 0,  //踩数
    "user_id": 2, //回复用户的ID
    "user_headimg": "/user_img/123.jpeg", //回复用户的头像
    "user_nickname": "杨弘文",  //回复用户的昵称
    "target_user_id": 1,  //目标用户的ID
    "target_user_headimg": "/user_img/123.jpeg",  //目标用户的头像
    "target_user_nickname": "水博超",  //目标用户的昵称
    "tf_id": 1,  //0=评论类型  1=回复类型  此处统一返回1
    "commodity_comment_like_id": 1, //用户点赞表ID
    "user_like": 1  //用户是否点赞 1=是 0=否
}
```





# 接口名称:获取商品问答

接口地址:/index/index/ questions

请求方式:get

请求参数:

| id     | int  | 商品ID                     |
| ------ | ---- | -------------------------- |
| order  | int  | 0 为时间倒序   1为时间正序 |
| limit  | int  | 取多少条数据               |
| offset | int  | 从第多少条开始取数据       |

成功返回内容：

```
[
{
    "commodity_issue_id": 1, //评论ID
    "store_commodity_id": 1,  //商类ID  商类(把多个商品归为一类)
    "commodity_issue_title": "质量怎么样",
    "send_time": "2023-02-01 13:09:14",//发送时间
    "user_id": 1, //用户ID
    "i": 1,
    "nickname": "水博超",  //用户昵称
    "headimg": "/user_img/123.jpeg",  //用户头像
    "children": [
        {
            "commodity_issue_son_id": 1, //回复ID
            "commodity_issue_id": 1, //评论ID
            "target_id": 1,  //目标用户ID (为提问者ID)
            "user_id": 2,   //回复用户的ID 
            "commodity_issue_son_info": "挺好的",
            "commodity_issue_son_like": 0,  //点赞数
            "commodity_issue_son_trample": 0, //踩数
            "send_time": "2023-02-02 13:10:01",//发送时间
            "i": 2,
            "tf_id":1  //如果该字段为空则表示没有点赞
            "nickname": "杨弘文"  //昵称
        },
    ],
    "show_tf": false
}
]
```







# 接口名称:获取商品问答点赞

接口地址:/index/index/ questionslike

请求方式:post

请求参数:

| commodity_issue_son_id | int  | 问答回复ID    |
| ---------------------- | ---- | ------------- |
| type                   | int  | 0=点赞 1=取消 |

成功返回内容：





# 接口名称:获取店铺首页数据

接口地址:/index/index/ shopindex

请求方式:get

请求参数:

| shop_id | int  | 店铺ID |
| ------- | ---- | ------ |
|         |      |        |

成功返回内容：

```
{
    "banner": [ //轮播图
        {
            "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
            "commodite_info_target": [
                "耐磨",
                "实用",
                "潮流"
            ],
            shop_category_id：1  //店铺(大小)频道ID   使用其他接口时 传入字段type 0=大频道  1=子频
            "activity_tf": 0,
            "commodity_info_data": {
                "title": "选择尺码",
                "data": [
                    {
                        "name": "S",
                        "money": 99,
                        "num": 55
                    },

                ]
            },
            "commodity_info_activity": "",
            "imgs": [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",

            ],
            "msg": "店铺商品"
        }
    ],
    "banner_info": [
        {
            "shop_category_title": "男子专区",
            "shop_category_activity_img": "/shop_banner_img/a595cd9c23ef0db4.jpg",
            "shop_category_parent_brief": [
                "潮流",
                "时尚",
                "百搭"
            ],
            "msg": "店铺大频道"
        },
    ],
    "shop_hard": [ //力推商品
     
        {
            "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
            "commodite_info_target": [
                "耐磨",
                "实用",
                "潮流"
            ],
            "activity_tf": 0,
            "commodity_info_data": {
                "title": "选择尺码",
                "data": [
                    {
                        "name": "S",
                        "money": 99,
                        "num": 55
                    },
                ]
            },
            "commodity_info_activity": "",
            "imgs": [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            ]
        }
    ]
}
```







# 接口名称:获取店铺分类

接口地址:/index/index/ shopcate

请求方式:get

请求参数:

| id   | int  | 店铺ID |
| ---- | ---- | ------ |
|      |      |        |

成功返回内容：

```
[
    {
        "shop_category_title": "男子专区",  //店铺大频道
        "shop_category_id": 1,  //店铺(大小)频道ID   使用其他接口时 传入字段type 0=大频道  1=子频道
        "son": [
            {
                "shop_category_title": "运动鞋",  //店铺子频道
                "shop_category_id": 1 
            },
        ],
        "judge": true //用于前端判断是否折叠列表字段
    },
    {
        "shop_category_title": "女子专区",
        "shop_category_id": 3,
        "son": [
        ],
        "judge": false
    }
]
```





# 接口名称:获取店铺分类商品列表

接口地址:/index/index/ shopcminfo

请求方式:get

请求参数:

| id      | int  | 店铺ID                                                       |
| ------- | ---- | ------------------------------------------------------------ |
| type    | int  | -1=全部店铺商品    0=店铺大频道商品    1=店铺子频道1         |
| gory_id | int  | 当type=0或type=1时传入子频道ID                (当type=-1时可不传) |

成功返回内容：

```
[
    {
        "commodity_info_id": 1,
        "commodity_type_id": 1,
        "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
        "activity_tf": 0,
        "commodity_info_data": {
            "title": "选择尺码",
            "data": [
                {
                    "name": "S",
                    "money": 99,
                    "num": 55
                },
            ]
        },
        "commodity_info_activity": "",
        "imgs": [
            "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        ],
        "commodity_info_state_time": "2023-01-13 18:28:08",
        "store_commodity_grade": "0.80",
        "store_commodity_sum": 998,
        "key": 0,
        "comment_num": 2,
        "shop_id": 1
    },
]
```





# 接口名称:获取搜索商品列表

接口地址:/index/index/platformgoods

请求方式:get

请求参数:

| name      | strting  | 搜索名称                        |
| --------- | -------- | ------------------------------- |
| time      | datetime | 上市时间(选) 在指定日期之内(选) |
| brand     | string   | 品牌(选)                        |
| min_price | int      | 最低价（选 ）                   |
| max_price | int      | 最高价（选 ）                   |
| order     | int      | 0=价格升序 1=价格降序 (选)      |
| limit     | int      | 取多少条数据                    |
| offset    | lint     | 从第多少条数据开始取            |

成功返回内容：

```
{
    "commodity_info_id": 2,
    "commodity_type_id": 1,
    "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
    "money": "99",
    "imgs": [
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
    ],
    "commodity_info_state_time": "2023-01-17 18:28:12",
    "brand": "欧 郎 格",
    "comment_sum": null
}
```





















# 接口名称:获取搜索商品品牌（广告商品,商品路由）

接口地址:/index/index/platformgoodslogo

请求方式:get

请求参数:

| name | strting | 搜索名称 |
| ---- | ------- | -------- |
|      |         |          |

成功返回内容：

```
{
    "router": {//路由路径
        "name": "男士内搭", 
        "child": {
            "name": "男士内搭",
            "child": [
                {
                    "name": "短袖T恤"
                },
            ]
        }
    },
    "hot": [//广告商品
        {
            "commodity_info_id": 1,
            "commodity_type_id": 1,
            "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
            "money": "99",
            "imgs": [
                "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            ],
            "commodity_info_state_time": "2023-01-13 18:28:08",
            "brand": "欧 郎 格",
            "comment_sum": 2
        },

    ]
}
```





# 接口名称:用户登录

接口地址:/index/index/enter

请求方式:get

请求参数:

| bank     | string | 账号 |
| -------- | ------ | ---- |
| password | string | 密码 |

成功返回内容

```
{"code":200,
"data":{
		"user_id":1,"nickname":"水博超",//用户昵称
        "introduce":null,//用户介绍
        "sex":"女",//用户性别
        "signature":null,//用户个性签名
        "headimg":"\/user_img\/123.jpeg",//用户头像
        "iphone":13467771234,//用户手机号
        "vip":1, //1=vip 0=反之
        "password":"~~~~"},
"msg":"登录成功"}
```

失败返回内容：

```
{"code":200,"data":[],"msg":"密码错误"}
```



# 接口名称:cookie登录

接口地址:/index/index/judgeenter

请求方式:get

请求参数: 无参数  axios发送请求设置允许携带cookie

成功返回内容

```
{"code":200,
"data":{
		"user_id":1,"nickname":"水博超",//用户昵称
        "introduce":null,//用户介绍
        "sex":"女",//用户性别
        "signature":null,//用户个性签名
        "headimg":"\/user_img\/123.jpeg",//用户头像
        "iphone":13467771234,//用户手机号
        "vip":1, //1=vip 0=反之
        "password":"~~~~"},
"msg":"用户已登录"}
```

失败返回内容：

```
{"code":200,"data":false,"msg":"用户未登录"}
```





# 接口名称:获取简略购物车信息

接口地址:/index/index/getcar

请求方式:get

请求参数: 无参数  axios发送请求设置允许携带cookie

成功返回内容

```
[
    {
        "commodity_collect_id": 1,
        "user_id": 1, //用户ID
        "type": "S",//已选择商品类型
        "sum": 1,//已选择商品数量
        "commodity_id": 1, 
        "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
        "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "commodity_info_id": 1,//商品ID
        "info": "~~~",
        "commodity_info_state": 0,//0=在售  1=下架
        "money": 99, //价格
        "num": 55  //商品数量用于判断
    },
]
```





# 接口名称:获取详细购物车信息

接口地址:/index/index/carinfo

请求方式:get

请求参数: 无参数  axios发送请求设置允许携带cookie

成功返回内容

```
{
    "code": 200,
    "data": {
        "2": {
            "shop_id": 2,//店铺ID
            "data": [
                {
                    "commodity_collect_id": 3,//购物车ID
                    "user_id": 1,
                    "type": "8GB+128GB",
                    "sum": 1,//商品数量
                    "commodity_id": 6,
                    "input": 0,// 0=商品已勾选 1=反之
                    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长",
                    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg",
                    "commodity_info_id": 6,
                    "info": {
                        "title": "选择版本",
                        "data": [
                            {
                                "name": "8GB+128GB",
                                "money": 4599,
                                "num": 55
                            },
                            {
                                "name": "8GB+256GB",
                                "money": 4899,
                                "num": 55
                            }
                        ]
                    },
                    "commodity_info_state": 0,
                    "shop_id": 2,//店铺ID
                    "category_son_id_one": 243,
                    "commodity_type_id": 3,
                    "store_commodity_id": 3,
                    "vip": null, //vip折扣
                    "money": 4599,//价格
                    "num": 55  //库存
                    "sss":456//单品优惠后价格
                    "yuan":5656//单品的原价格
                }
            ],
            "input": 0,//0=店铺商品全选   1=反之
            "shop_name": "小米手机专卖店",
            "show": false,
            "discount": [
                {
                    "discount_id": 1, //优惠券ID
                    "type": 0,
                    "shop_id": null,
                    "man_money": "100.00",
                    "jian_money": "20.00",
                    "ze_kou": null,
                    "portion_tf": 1,
                    "discount_info": "全频道满100减20",
                    "sen_time": "2023-01-17 18:50:27",
                    "end_time": "2023-04-22 18:50:31",
                    "superposition": 1,
                    "repetition": 1,
                    "discount_title": "满100元可用",
                    "tf": 0, // -1=未领取 0=已领取  1=已使用 2=已过期
                    "msg": "已领取优惠券"
                },

            ]
        }
    },
    "sum": "21",//总商品数量
    "msg": "获取成功",
    "rate": 5398.92,//优惠后价格
    "yx": 21,//已选择商品数量
    "initial": 6480,//原价
    "all_input": 0 // 0=购物车全选
    "already":[]//已使用的优惠券
}
```







# 接口名称:领取优惠券

接口地址:/index/index/drawdiscount

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名      | 类型 | 是否必须 | 说明     |
| ----------- | ---- | -------- | -------- |
| discount_id | int  | T        | 优惠券ID |

成功返回内容

```
{"code":200,"data":true,"msg":"添加成功"}
```

失败返回内容

```
{"code":200,"data":false,"msg":"参数错误"}
{"code":200,"data":false,"msg":"用户未登录"}
{"code":200,"data":false,"msg":"添加失败"}
{"code":200,"data":false,"msg":"该优惠券不存在或已过期"}
```





# 接口名称:修改购物车数据

接口地址:/index/index/changecar

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型  | 是否必须              | 说明                                                       |
| ------ | ----- | --------------------- | ---------------------------------------------------------- |
| type   | int   | T                     | 0=勾选商品  1=取消勾选商品  2=删除所选商品  3=修改商品数量 |
| data   | array | T 当type=3数组长度为1 | 所操作购物车ID    commodity_collect_id                     |
| info   | int   | 当type=3则填          | 所修改的数量                                               |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":200,"data":false,"msg":"参数错误"}
{"code":200,"data":false,"msg":"用户未登录"}
{"code":200,"data":false,"msg":"添加失败"}
```





# 接口名称:添加商品到购物车

接口地址:/index/index/addcar

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名            | 类型   | 是否必须 | 说明                                    |
| ----------------- | ------ | -------- | --------------------------------------- |
| name              | string | F        | 选择商品类型名称 例 8+12G  不传自动选择 |
| sum               | int    | T        | 商品数量                                |
| commodity_info_id | int    | T        | 商品ID                                  |

成功返回内容

```
{"code":200,"data":ture,"msg":"添加成功"}
```

失败返回内容

```
{"code":200,"data":false,"msg":"参数错误"}
{"code":200,"data":false,"msg":"用户未登录"}
{"code":200,"data":false,"msg":"添加失败"}
```



# 接口名称:获取购物车商品数量

接口地址:/index/index/countcar

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

成功返回内容

```
{"code":200,"data":11,"msg":"获取成功"}
```

失败返回内容

```
{"code":200,"data":false,"msg":"购物车为空"}
{"code":200,"data":false,"msg":"用户未登录"}
```





# 接口名称:获取购物车已选商品数量

接口地址:/index/index/countcar

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

成功返回内容

```
{"code":200,"data":11,//已选商品数量 "msg":"获取成功"}
```

失败返回内容

```
{"code":200,"data":false,"msg":"购物车为空"}
{"code":200,"data":false,"msg":"用户未登录"}
```







# 接口名称:收货地址操作

接口地址:/index/index/changesite

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名      | 类型   | 是否必须          | 说明                                              |
| ----------- | ------ | ----------------- | ------------------------------------------------- |
| type        | string | T                 | 0=设置默认地址 2=编辑地址  3=添加地址  4=删除地址 |
| site_id     | int    | T  当type=3则不填 | 地址ID                                            |
| consignee   | string | F                 | 收货人                                            |
| site_region | string | F                 | 地址                                              |
| site_info   | string | F                 | 详细地址                                          |
| site_iphone | string | F                 | 手机号                                            |
| default_tf  | string | T 当type=3时必填  | 0=设置为默认地址  1=反之                          |

成功返回内容

```
{"code":200,"data":ture,"msg":"添加成功"}
```

失败返回内容

```
{"code":200,"data":false,"msg":"参数错误"}
{"code":200,"data":false,"msg":"用户未登录"}
{"code":200,"data":false,"msg":"添加失败"}
```







# 接口名称:提交商品订单

接口地址:/index/index/submitform

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名      | 类型   | 是否必须 | 说明           |
| ----------- | ------ | -------- | -------------- |
| character   | string | T        | 支付密码       |
| site_id     | int    | T        | 使用的地址ID   |
| discount_id | array  | F        | 使用的优惠券ID |
| integral    | int    | F        | 使用的积分数量 |

成功返回内容

```
{"code":200,"data":ture,"msg":"支付成功"}
```

失败返回内容

```
{"code":205,"data":false,"msg":"支付密码不正确请重新输入"}
{"code":204,"data":false,"msg":"账户积分不足"}
{"code":203,"data":false,"msg":"账户余额不足请充值"}
{"code":202,"data":false,"msg":"参数错误"}
{"code":206,"data":false,"msg":"用户未登录"}
```







# 接口名称:商品评论回复

接口地址:/index/index/replycomments

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名         | 类型 | 是否必须 | 说明       |
| -------------- | ---- | -------- | ---------- |
|                |      |          |            |
| target_user_id | int  | T        | 目标用户ID |
| parent_id      | int  | T        | 评论ID     |
| info           | int  | T        | 发送内容   |

成功返回内容

```
{"code":200,"data":ture,"msg":"回复成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:商品评论回复点赞

接口地址:/index/index/replycommentslike

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明              |
| ------ | ---- | -------- | ----------------- |
| type   | int  | T        | 0=评论   1=回复   |
| id     | int  | T        | 评论ID 或者回复ID |
| like   | int  | T        | 0=点赞 1=取消     |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取用户主页数据

接口地址:/index/index/userindex

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

成功返回内容

```
{
    "user_indent": [ //最近两笔商品订单
        {
            "indent_id": 41,
            "user_id": 1,
            "send_time": "2023-03-02 18:28:23",
            "pay_time": "2023-03-02 18:28:23",
            "pattern": 0,
            "freight": "0.00",
            "promotion": "0.00",
            "cash": "0.00",
            "vip_z": "0.00",
            "expressage_id": null,
            "state": 0,
            "site_id": 1,
            "sum": 1,
            "type": {
                "name": "",
                "son": {
                    "name": "S",
                    "moeny": 19
                }
            },
            "discounts": null,
            "evaluate_tf": 0,
            "indent_sum": "19.00",
            "cmm_id": 4,
            "commodity_info_id": 4,
            "imgs": "/commodity_info_img/d4f85cb79a13db81.jpg",
            "commodity_info_title": "阿迪达斯（adidas）夹克女运动羊羔毛拼接休闲外套长"
        },
    ],
    "user_indent_p_sum": 14,  //未评价订单数量
    "dai_sum": 14,//待发货订单数量
    "yi_cmm_sum": 0,
    "tui_sum": 0, //退换售后数量
    
    "user_cmm_info": [//获取常购商品
        {
            "cmm_id": 1,
            "commodity_info_id": 1,
            "commodity_info_id_change": 1,
            "commodity_type_id": 1,
            "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
            "money": "99",
            "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            "shop_id": 1,
            "commodity_info_state_time": "2023-01-13 18:28:08",
            "brand": "欧 郎 格"
        },

    ],
    "questions": [//邀请问答
        {
            "cmm_id": 1,
            "commodity_issue_id": 1,
            "store_commodity_id": 1,
            "commodity_issue_title": "质量怎么样",
            "send_time": "2023-02-01 13:09:14",
            "user_id": 1,
            "commodity_info_id": 1,
            "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            "nickname": "水博超",
            "hui_sum": 2
        },
    ],
    "vip_cmm": [//vip价格商品
        {
            "store_commodity_id": 1,
            "vip": "0.95",
            "commodity_info_id": 2,//商品ID
            "commodity_info_id_change": 2,
            "commodity_type_id": 1,
            "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
            "money": "99",
            "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
            "shop_id": 1,
            "commodity_info_state_time": "2023-01-17 18:28:12",
            "brand": "欧 郎 格"
        },
    ],
    "user_info": {//用户信息
        "user_id": 1,
        "nickname": "水博超",
        "introduce": null,
        "sex": "女",
        "signature": null,
        "headimg": "/user_img/123.jpeg",//头像
        "iphone": 13467771234, 
        "vip": 1, // 1=vip  0=反之
        "honourable": 1000,  //京享值
        "money_id": 1,
        "small_money": "62072.60",//余额
        "red_packet": "9127.00",
        "integral": "64993",//积分
        "change_user_id": 1,
        "discount_sum": 2,
        "shop_like_sum": 1,
        "change_change_user_id": 1
    }
}
```

失败返回内容

```
{"code":200,"data":false,"msg":"用户未登录"}
```





# 接口名称:获取用户订单

接口地址:/index/index/usermenu

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型     | 是否必须 | 说明                 |
| ------ | -------- | -------- | -------------------- |
| time   | datetime | T        | 在指定日期之内的订单 |

成功返回内容

```
{
    "indent_id": 42,//订单ID
    "user_id": 1,
    "send_time": "2023-03-03 09:46:28",//订单事件
    "pay_time": "2023-03-03 09:46:28",
    "pattern": 0,
    "freight": "0.00",
    "promotion": "0.00",
    "cash": "0.00",
    
commodity_comment_parent_info_add_time: null   //订单追评时间  为空则表示没有追评
commodity_comment_parent_send_time: null //订单评论时间  为空则表示没有论
    "vip_z": "4.95",//vip 优惠的价钱
    "expressage_id": null,
    "state": 0,// 0=待发货 1=已发货 2=完成 3=退货申请中 4=退货申请同意 5=用户已发货 6=商家已收货 7=驳回 8=退款中 9=完成 10=驳回
    "site_id": 1,//地址ID
    "sum": 1,//订单数量
    "type": {
        "name": "白色",//选择类型
        "son": {
            "name": "S",
            "moeny": 99
        }
    },
    "discounts": null,//商品优惠价格
    "evaluate_tf": 0,  //0=未评论  1=已评论
    "indent_sum": "94.05",//需支付价格
    "cmm_id": 1,
    "integral": null,
    "commodity_info_id": 1,//商品ID
    "shop_id": 1,
    commodity_comment_parent_info_add_time: null   //订单追评时间  为空则表示没有追评
commodity_comment_parent_send_time: null //订单评论时间  为空则表示没有论
    "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
    "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
    "shop_name": "欧水电费水电费水电费水电费专卖店",
    "consignee": "张水电费" //收货人
}
```







# 接口名称:发表商品评论

接口地址:/index/index/makecomments

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明                 |
| --------- | ---- | -------- | -------------------- |
| synthesis | int  | T        | 综合评分 1=5分       |
| manner    | int  | T        | 服务态度评分         |
| logistics | int  | T        | 物流评分             |
| commodity | int  | T        | 商品频分             |
| indent_id | int  | T        | 订单ID               |
| speech    | int  | T        | 评论                 |
| file      | file | F        | 文件(只能是图片视频) |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取待追评订单

接口地址:/index/index/additionalreview

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型     | 是否必须 | 说明                 |
| ------ | -------- | -------- | -------------------- |
| time   | datetime | T        | 在指定日期之内的订单 |

成功返回内容 

```
{
    "indent_id": 42,//订单ID
    "user_id": 1,
    "send_time": "2023-03-03 09:46:28",//订单事件
    "pay_time": "2023-03-03 09:46:28",
    "pattern": 0,
    "freight": "0.00",
    "promotion": "0.00",
    "cash": "0.00",
    "vip_z": "4.95",//vip 优惠的价钱
    "expressage_id": null,
    "state": 0,//0=待发货 1=已发货 2=完成 2=退货申请中 4=退货申请同意 5=已发货 6=商家已收货 7=驳回 8=退款中 9=完成 10=退款驳回
    "site_id": 1,//地址ID
    "sum": 1,//订单数量
    "type": {
        "name": "白色",//选择类型
        "son": {
            "name": "S",
            "moeny": 99
        }
    },
    "discounts": null,//商品优惠价格
    "evaluate_tf": 0,
    "indent_sum": "94.05",//需支付价格
    "cmm_id": 1,
    "integral": null,
    "commodity_info_id": 1,//商品ID
    "shop_id": 1,
    "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
    "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
    "shop_name": "欧水电费水电费水电费水电费专卖店",
    "consignee": "张水电费" //收货人
}
```











# 接口名称:追加商品评论

接口地址:/index/index/addmakecomments

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型   | 是否必须 | 说明                         |
| --------- | ------ | -------- | ---------------------------- |
| file      | file   | F        | 上传的文件(只能是图片或视频) |
| indent_id | int    | T        | 订单ID                       |
| speech    | string | T        | 追评内容                     |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:关注店铺

接口地址:/index/index/likeshop

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名   | 类型 | 是否必须 | 说明                    |
| -------- | ---- | -------- | ----------------------- |
| store_id | int  | T        | 只传店铺ID    关注/取关 |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:商品提问

接口地址:/index/index/cmmaddquiz

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型   | 是否必须 | 说明     |
| ------ | ------ | -------- | -------- |
| id     | int    | T        | 商品ID   |
| speech | string | T        | 提问内容 |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取用户关注店铺及店铺商品

接口地址:/index/index/userlikeshop

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
| 无     |      |          |      |

成功返回内容

```
{"code":200,"data":ture,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取用户所有的优惠券

接口地址:/index/index/userdiscount

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
| 无     |      |          |      |

成功返回内容

```
{
    "discount_id": 1,//优惠券ID
    "type": 0,
    "shop_id": null,
    "man_money": "100.00",
    "jian_money": "20.00",
    "ze_kou": null,
    "portion_tf": 1,
    "discount_info": "全频道满100减20",
    "sen_time": "2023-01-17 18:50:27",
    "end_time": "2023-04-22 18:50:31",
    "superposition": 1,
    "repetition": 1,
    "discount_title": "满100元可用"
     "discount_state":0   //状态 0=未使用 1=已使用 2=已过期
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取平台优惠券

接口地址:/index/index/appdiscount

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名             | 类型 | 是否必须 | 说明         |
| ------------------ | ---- | -------- | ------------ |
| category_parent_id | int  | F        | 平台大频道ID |

成功返回内容

```
{
    "discount_id": 1,//优惠券ID
    "type": 0,
    "shop_id": null,
    "man_money": "100.00",
    "jian_money": "20.00",
    "ze_kou": null,
    "portion_tf": 1,
    "discount_info": "全频道满100减20",
    "sen_time": "2023-01-17 18:50:27",
    "end_time": "2023-04-22 18:50:31",
    "superposition": 1,
    "repetition": 1,
    "discount_title": "满100元可用"
     "discount_state":0   //状态 0=未使用 1=已使用 2=已过期
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```









# 接口名称:获取我的 商品问答及回复（不显示点赞）

接口地址:/index/index/answers

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                                               |
| ------ | ---- | -------- | -------------------------------------------------- |
| type   | int  | T        | 0=获取我的提问  1=获取我的回答  2=获取邀请提问问题 |

成功返回内容

```
{
    "commodity_issue_id": 1,
    "store_commodity_id": 1,
    "commodity_issue_title": "质量怎么样",//提问
    "send_time": "2023-02-01 13:09:14",
    "user_id": 1,
    "i": 1,
    "nickname": "水博超",
    "imgs": "",
    "commodity_type_id": 1,
    "show": false,
    "img": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
    "childer": [//提问回复
        {
            "commodity_issue_son_id": 1, //回复ID
            "commodity_issue_id": 1,//提问ID
            "target_id": 1,//回复目标用户ID
            "user_id": 2,//发送回复的用户ID
            "commodity_issue_son_info": "挺好的",
            "commodity_issue_son_like": 0,//点赞
            "commodity_issue_son_trample": 0,
            "send_time": "2023-02-02 13:10:01",//时间
            "i": 2,
            "nickname": "杨弘文"
        },
    ]
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取用户收货地址

接口地址:/index/index/accounts

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
|        |      |          |      |

成功返回内容

```
[
    {
        "site_id": 1,//地址ID
        "user_id": 1,
        "consignee": "张水电费", //收货人姓名
        "site_region": "湖北省武汉市新洲区",
        "site_info": "哈哈街道哈哈哈小区",
        "default_tf": 0, //0=默认地址
        "site_iphone": 177544009999
    },
    {
        "site_id": 2,
        "user_id": 1,
        "consignee": "李四",
        "site_region": "湖北省武汉市硚口区",
        "site_info": "顶点街道哈哈哈小区",
        "default_tf": 1,
        "site_iphone": 1761765099
    }
]
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:回复商品问答

接口地址:/index/index/replyquiz

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名             | 类型   | 是否必须 | 说明       |
| ------------------ | ------ | -------- | ---------- |
| commodity_issue_id | int    | T        | 提问ID     |
| target_user_id     | int    | T        | 目标用户ID |
| speech             | string | T        | 回复内容   |

成功返回内容

```
{"code":200,"data":true,"msg":"发表成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取余额明细

接口地址:/index/index/remaining

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型     | 是否必须 | 说明                                |      |
| ------ | -------- | -------- | ----------------------------------- | ---- |
| time   | datatime | F        | 获取指定日期之后的数据 不传获取全部 |      |

成功返回内容

```
{
    "id": 3,
    "moeny": "100.00",
    "time": "2023-03-03 16:36:55",
    "tf": 0, //0=转入   1=转出
    "type": 0 //0=充值渠道  1=订单渠道
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:删除用户优惠券

接口地址:/index/index/deldiscount

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名           | 类型 | 是否必须 | 说明                             |      |
| ---------------- | ---- | -------- | -------------------------------- | ---- |
| user_discount_id | int  | T        | 已领取的优惠券ID 不是discount_id |      |

成功返回内容

```
{"code":200,"data":true,"msg":"删除成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```











# 接口名称:获取积分明细

接口地址:/index/index/userintegral

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型     | 是否必须 | 说明                                |      |
| ------ | -------- | -------- | ----------------------------------- | ---- |
| time   | datatime | F        | 获取指定日期之后的数据 不传获取全部 |      |

成功返回内容

```
jie_sum: 1001  //积分抵扣的总和
my_integral: "64447" //用户积分
rework: 2148  //购物返现积分
cmm_sum: 2  //使用积分的订单数
comment: 240  //评价返现积分
[
    {
        "money": "501.00",
        "time": "2023-03-08 15:52:23",
        "z": 0, //0=支出  1=收入
        "msg": "购买商品积分支出"
    },
    {
        "money": "500.00",
        "time": "2023-03-08 15:52:23",
        "z": 1,
        "msg": "购买商品积分收入"
    },
    {
        "money": "50.00",
        "time": "2023-03-04 14:07:44",
        "z": 1,
        "msg": "评价商品积分收入"
    },
]
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:商品收货

接口地址:/index/index/receiving

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明   |      |
| --------- | ---- | -------- | ------ | ---- |
| indent_id | int  | T        | 订单ID |      |

成功返回内容

```
{"code":200,"data":true,"msg":"收货成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取 可以退换货商品列表

接口地址:/index/index/sales

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |      |
| ------ | ---- | -------- | ---- | ---- |
|        |      |          |      |      |

成功返回内容

```
{
    "send_time": "2023-03-08 19:30:28",//下单时间
    "cmm_id": 6,//商品ID
    "indent_id": 50, //订单ID
    "commodity_info_id": 6, //商品ID
    "shop_id": 2,//店铺ID
    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg", //商品图片
    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长"
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取可以订单退换货商商品详细信息（申请订单退换货页）

接口地址:/index/index/salesinfo

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明   |      |
| --------- | ---- | -------- | ------ | ---- |
| indent_id | int  | T        | 订单ID |      |

成功返回内容

```
{
    "send_time": "2023-03-08 17:39:02", //订单时间
    "cmm_id": 6,
    "indent_id": 46,//订单ID
    "indent_sum": "4599.00",
    "site_id": 2,
    "sum": 1,
    "commodity_info_id": 6,//商品ID
    "shop_id": 2,//店铺ID
    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg",
    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长",
    "user_id": 1,
    "consignee": "李四",//收货人
    "site_region": "湖北省武汉市硚口区", //收货地址
    "site_info": "顶点街道哈哈哈小区",
    "default_tf": 1,
    "site_iphone": 1761765099 //收货电话
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:提交退款退货申请

接口地址:/index/index/addsales

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名     | 类型   | 是否必须 | 说明                                           |      |
| ---------- | ------ | -------- | ---------------------------------------------- | ---- |
| indent_id  | int    | T        | 订单ID                                         |      |
| sale_money | float  | T        | 退款/退货金额  （原价减去积分优惠 优惠券优惠） |      |
| user_info  | string | T        | 用户退款详细说明                               |      |
| user_title | string | T        | 用户退款/退货  说明                            |      |
| shop_id    | int    | T        | 店铺ID                                         |      |
| file       | file   | F        | 用户反馈的图片或者视频                         |      |
| type       | int    | T        | 0=退货  1=退款                                 |      |

成功返回内容

```
{
    "send_time": "2023-03-08 19:30:28",//下单时间爱你
    "cmm_id": 6,//商品ID
    "indent_id": 50, //订单ID
    "commodity_info_id": 6, //商品ID
    "shop_id": 2,//店铺ID
    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg", //商品图片
    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长"
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```









# 接口名称:获取  申请退换货的商品列表

接口地址:/index/index/returnlist

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型     | 是否必须 | 说明                       |      |
| ------ | -------- | -------- | -------------------------- | ---- |
| time   | datatime | F        | 取时间之内的数据           |      |
| type   | int      | F        | 0=全部  1=已完成  2=待处理 |      |

成功返回内容

```
{
    "send_time": "2023-03-08 19:30:28",//下单时间
    "cmm_id": 6,//商品ID
    "indent_id": 50, //订单ID
    "commodity_info_id": 6, //商品ID
    "shop_id": 2,//店铺ID
    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg", //商品图片
    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长"
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取 申请订单退换货处理详情

接口地址:/index/index/returnlistinfo

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明   |      |
| --------- | ---- | -------- | ------ | ---- |
| indent_id | int  | T        | 订单ID |      |

成功返回内容

```
{
    "send_time": "2023-03-08 19:30:28",//下单时间
    "cmm_id": 6,//商品ID
    "indent_id": 50, //订单ID
    "commodity_info_id": 6, //商品ID
    "shop_id": 2,//店铺ID
    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg", //商品图片
    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长"
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:退货/退款 修改状态

接口地址:/index/index/delivergoods

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明                                                         |      |
| --------- | ---- | -------- | ------------------------------------------------------------ | ---- |
| indent_id | int  | T        | 订单ID                                                       |      |
| state     | int  | T        | 5=用户已发货  4=退货申请同意  6=商家已收货 7=退货申请驳回  9=退款申请同意   10=退款申请驳回    -1=删除售后单   1=商家已发货 |      |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取 订单详情信息

接口地址:/index/index/waybinfo

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明   |      |
| --------- | ---- | -------- | ------ | ---- |
| indent_id | int  | T        | 订单ID |      |

成功返回内容

```
{
    "indent_id": 50,
    "user_id": 1,
    "send_time": "2023-03-08 19:30:28",
    "pay_time": "2023-03-08 19:30:28",
    "pattern": 0,
    "freight": "0.00",
    "promotion": "0.00",
    "cash": "500.00",
    "vip_z": "0.00",
    "expressage_id": null,
    "state": 5,
    "site_id": 1,
    "sum": 1,
    "type": {
        "name": "黑色",
        "son": {
            "name": "8GB+128GB",
            "moeny": 4599
        }
    },
    "discounts": null,
    "evaluate_tf": 1,
    "indent_sum": "4599.00",
    "cmm_id": 6,
    "integral": 46, //订单获取的积分
    "sale_id": 1,
    "commodity_info_id": 6,
    "shop_id": 2,
    "imgs": "/commodity_info_img/e7d7f61ca8d1d5ca.jpg",
    "commodity_info_title": "小米13 徕卡光学镜头 第二代骁龙8处理器 超窄边屏幕 120Hz高刷 67W快充长",
    "shop_name": "小米手机专卖店",
    "consignee": "张水电费",
    "site_region": "湖北省武汉市新洲区",
    "site_info": "哈哈街道哈哈哈小区",
    "default_tf": 0,
    "site_iphone": 177544009999,
    "commodity_comment_parent_id": 9,
    "commodity_comment_parent_send_time": "2023-03-08 19:41:00",
    "commodity_comment_parent_info_add_time": null,
    "change_indent_id": 50
}
```

失败返回内容

```
{"code":404,"data":false,"msg":"用户未登录"}
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取特价商品

接口地址:/index/index/channelsale

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名             | 类型 | 是否必须 | 说明                             |      |
| ------------------ | ---- | -------- | -------------------------------- | ---- |
| category_parent_id | int  | F        | 频道ID  不传获取全部频道分类商品 |      |
| offset             | int  | F        | 从第几条数据开始取   默认0       |      |
| limit              | int  | F        | 取多少条数据  默认20             |      |

成功返回内容

```
{
    "commodity_info_id": 2,  //商品ID
    "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
    "shop_id": 1,
    "money": "99",
    "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:获取新品首发

接口地址:/index/index/newproduct

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名             | 类型 | 是否必须 | 说明                             |      |
| ------------------ | ---- | -------- | -------------------------------- | ---- |
| category_parent_id | int  | F        | 频道ID  不传获取全部频道分类商品 |      |
| offset             | int  | F        | 从第几条数据开始取   默认0       |      |
| limit              | int  | F        | 取多少条数据  默认20             |      |

成功返回内容

```
{
    "commodity_info_id": 2,  //商品ID
    "commodity_info_title": "欧郎格（OU LANG GE）【纯棉2件装】长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫",
    "shop_id": 1,
    "money": "99",
    "imgs": "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:商家账号登录

接口地址:/index/index/shopadminenter

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名   | 类型 | 是否必须 | 说明   |      |
| -------- | ---- | -------- | ------ | ---- |
| username | int  | T        | 用户名 |      |
| password | int  | T        | 密码   |      |

成功返回内容

```
{"code":200,"data":false,"msg":"登录成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```





# 接口名称:商家账号登录（cookie）

接口地址:/index/index/shopadminentercookie

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |      |
| ------ | ---- | -------- | ---- | ---- |
| 无参数 |      |          |      |      |

成功返回内容

```
{
    "code": 200,
    "root": "0", //用户权限
    "bank": "1", //用户ID
    "data": [ //页面路由
        {
            "shop_member_root_id": 1,
            "site": "/shopviews/Statistics",
            "r_root": 2,
            "s_root": 2,
            "shop_id": 1,
            "root_name": "店铺统计"
        },
    ],
    "shop_name": "欧水电费水电费水电费水电费专卖店",//店铺名称
    "user_name": "水博超", //用户名
    "shop_id": "1", //店铺ID
    "msg": "登录成功"
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取商家统计数据

接口地址:/index/index/shopstatistics

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |      |
| ------ | ---- | -------- | ---- | ---- |
| 无参数 |      |          |      |      |

成功返回内容

```
{
    "shop_id": 1,  //店铺ID
    "attention": 123457,/关注人数
    "user_score": "9.0",//用户评价
    "logistics_score": "9.2",//物流评价
    "after_score": "9.1",//售后评价
    "service_score": "7.8",//商品评分
    "shop_money": "789555.00",//店铺余额
    "shop_jf": "12345",//店铺积分
    "shop_id_change": 1,
    "change_shop_id": 1,
    "money": "123456.00",//平台托管金额
    "jf": "12345.00",//平台托管积分
    "xiao_zong": 11,//销售商品总数
    "xiao_sum": "2726.20",//销售商品总金额
    "change_change_shop_id": 1,
    "shang_sum": 2,//上架商品数量
    "s_id": 1,
    "xia_sum": 1,//下架商品数量
    "tui_zong": 1,//已退货退款商品总数
    "tui_sum": "1330.75",//已退货退款商品总金额
    "change_change_shop_id_id": 1,
    "dai_zong": null, //待退货商品总数量
    "dai_sum": null,//待退货商品总金额
    "change_change_shop_id_id_id": null
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```











# 接口名称:获取商家图表统计数据

接口地址:/index/index/echartsshop

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                                        |
| ------ | ---- | -------- | ------------------------------------------- |
| day    | int  | F        | 获取day天之内的销量/金额  退款数/金额  数据 |

成功返回内容

```
{
    "xzong": [//销量
        0,
        1,
        0,
        1,
        2,
        0,
        1
    ],
    "xsum": [//销售金额
        0,
        "14.00",
        0,
        "0.00",
        "1375.75",
        0,
        "13.00"
    ],
    "tzong": [//退款总数
        0,
        0,
        0,
        0,
        0,
        1,
        0
    ],
    "tsum": [//退款总数
        0,
        0,
        0,
        0,
        0,
        "1330.75",
        0
    ]
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取商家全部订单

接口地址:/index/index/shopindentall

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                  |
| ------ | ---- | -------- | --------------------- |
| limit  | int  | F        | 每次取出条数  默认20  |
| offset | int  | F        | 从第几条开始取  默认0 |

成功返回内容

```
{
    "indent_id": 13,
    "user_id": 1,
    "send_time": "2023-03-14 14:17:14",
    "pay_time": "2023-02-28 14:17:14",
    "pattern": 0,
    "freight": "0.00",
    "promotion": "80.00",
    "cash": "0.00",
    "vip_z": "74.25",
    "expressage_id": null,
    "state": 3,
    "site_id": 1,
    "sum": 15,
    "type": {
        "name": "白色",
        "son": {
            "name": "S",
            "moeny": 99
        }
    },
    "discounts": null,
    "evaluate_tf": 0,
    "indent_sum": "13.00",
    "cmm_id": 1,
    "integral": 500,
    "sale_id": 6,
    "nickname": "水博超",
    "consignee": "张水电费",
    "site_region": "湖北省武汉市新洲区",
    "site_info": "哈哈街道哈哈哈小区",
    "default_tf": 0,
    "site_iphone": 177544009999,
    "key": 13,
    "typename": "白色  S",
    "yuanmoney": 1485
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取商家全部商品

接口地址:/index/index/shopcmm

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                  |
| ------ | ---- | -------- | --------------------- |
| limit  | int  | F        | 每次取出条数  默认20  |
| offset | int  | F        | 从第几条开始取  默认0 |

成功返回内容

```
{
    "commodity_info_id": 1,
    "category_son_id_one": 10,
    "commodity_info_title": "欧郎格 长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫水电费",
    "commodity_info_brief": [
        {
            "name": "包装",
            "son": [
                {
                    "name": "衣服*1"
                }
            ]
        }
    ],
    "imgs": [
        "/commodity_info_img/Snipaste_2023-01-11_22-18-47.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "/commodity_info_img/16789673121366736896.jpeg",
        "/commodity_info_img/16789690192077890510.jpg"
    ],
    "videos": [
        "/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4",
        "/commodity_info_img/16789682231549671009.mp4"
    ],
    "commodity_type_id": 1,
    "commodity_info_data": {
        "title": "选择尺码",
        "data": [
            {
                "name": "S",
                "money": 99,
                "num": 55
            },
        ]
    },
    "commodity_info_activity": {
        "title": "选择尺码",
        "data": [
            {
                "name": "S",
                "money": 45,
                "num": 55
            },
        ]
    },
    "commodity_info_activity_sent_time": "2023-03-16 19:47:24",
    "commodity_info_activity_end_time": "2023-03-31 19:47:26",
    "shop_channel_id": 2,
    "brand": "欧 郎 格是",
    "shop_id": 1,
    "commodity_info_state": 0,
    "activity_title": "新品首发",
    "commodity_info_state_time": "2023-03-12 18:28:12",
    "commodity_info_img": [
        "/commodity_info_img/d4f85cb79a13db81.jpg",
        "/commodity_info_img/Snipaste_2023-01-12_11-03-33.jpg",
        "/commodity_info_img/16789682231825616219.jpg"
    ],
    "commodite_info_target": [
        "耐磨",
        "实用",
        "潮流",
        "高颜值"
    ],
    "shop_category_title": "男子专区",
    "shop_category_SON": "T恤",
    "shop_category_id": 2,
    "key": 1,
    "activity_tf": 1
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:修改添加商品

接口地址:/index/index/updateshopcmm

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名                            | 类型        | 是否必须      | 说明                              | 示例                                                         |
| --------------------------------- | ----------- | ------------- | --------------------------------- | ------------------------------------------------------------ |
| commodity_info_id                 | int         | T             | 商品ID                            | 1                                                            |
| activity_title                    | string      | F             | 活动名称                          | 新品上架                                                     |
| brand                             | string      | F（type=1 T） | 品牌                              | 欧 郎 格                                                     |
| commodite_info_target             | arrayJSON   | F             | 标签                              | [<br/>    "耐磨",<br/>    "实用",<br/>    "潮流",<br/>    "sdfsdfsdf"<br/>] |
| commodity_info_activity           | object JSON | F             | 活动价格库存类型（不可以改变key） | {<br/>    "title": "请选择大小"(string),<br/>    "data": [<br/>        {<br/>            "name": "S码",(string)<br/>            "money": "99",(float)<br/>            "num": "100"(float)<br/>        }<br/>    ]<br/>} |
| commodity_info_data               | object JSON | F（type=1 T） | 平时价格库存活动类型              | 同上                                                         |
| commodity_info_activity_sent_time | datetime    | F             | 活动开始时间                      | 2023-03-16 00:00:00                                          |
| commodity_info_activity_end_time  | datetime    | F             | 活动结束时间                      | 同上                                                         |
| del_imgs                          | arrayJSON   | F             | 删除原商品展示图片                | [0,3,4]//存放删除索引                                        |
| del_videos                        | arrayJSON   | F             | 删除原商品展示视频                | 同上                                                         |
| del_commodity_info_img            | arrayJSON   | F             | 删除原商品详情图片                | 同上                                                         |
| shop_category_id                  | int         | F（type=1 T） | 修改所属店铺频道                  | 1                                                            |
| category_son_id                   | int         | F（type=1 T） | 修改所属平台频道                  | 2                                                            |
| commodity_info_state              | int         | F（type=1 T） | 商品是否降价                      | 0=上架 1=下架                                                |
| add_imgs                          | file        | F（type=1 T） | 添加商品展示图片                  |                                                              |
| add_videos                        | file        | F             | 添加商品展示视频                  |                                                              |
| add_commodity_info_img            | file        | F             | 添加商品详情图片                  |                                                              |
| commodity_info_brief              | object JSON | F             | 包装清单（不可改变key）           | [<br/>    {<br/>        "name": "包装",<br/>        "son": [<br/>            {<br/>                "name": "衣服*1"<br/>            },<br/>            {<br/>                "name": "卫衣"<br/>            },<br/>   ] |
| commodity_info_title              | string      | F（type=1 T） | 商品名称                          |                                                              |
| type                              | int         | T             | 0=修改商品  1=添加商品            |                                                              |

成功返回内容

```

```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```





# 接口名称:获取商家商类

接口地址:/index/index/getstorecommodity

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                  |
| ------ | ---- | -------- | --------------------- |
| limit  | int  | F        | 每次取出条数  默认20  |
| offset | int  | F        | 从第几条开始取  默认0 |

成功返回内容

```
{
    "store_commodity_id": 1,
    "store_id": 1,
    "store_commodity_sum": 998,
    "vip": "0.95",
    "store_commodity_data": {
        "name": "颜色",
        "data": [
            {
                "name": "金色",
                "commodity_info_id": 2
            },
            {
                "name": "白色",
                "commodity_info_id": 1
            }
        ]
    },
    "store_channel_id": 2,
    "freight_money": 0,
    "ze": "0.98",
    "store_commodity_state": 0,
    "good_store": 0,
    "store_commodity_grade": "0.80",
    "childer": [ //所属商品ID
        1,
        2
    ],
   
}

[//店铺频道ID
    {
        "label": "男子专区",
        "value": 1, //大频道ID
        "children": [
            {
                "label": "运动鞋",
                "value": 1 //子频道ID
            },
            {
                "label": "T恤",
                "value": 2
            }
        ]
    },
    {
        "label": "女子专区",
        "value": 3,
        "children": [
            {
                "label": "上衣",
                "value": 3
            },
            {
                "label": "裙子",
                "value": 5
            }
        ]
    }
]

[//店铺所有的商品ID
    {
        "value": 1,//子频道ID
        "label": 1
    },
    {
        "value": 2,
        "label": 2
    },
    {
        "value": 4,
        "label": 4
    },
    {
        "value": 8,
        "label": 8
    }
]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:修改新增商类

接口地址:/index/index/upadstorecommodity

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名               | 类型   | 是否必须      | 说明           | 示例                                                         |
| -------------------- | ------ | ------------- | -------------- | ------------------------------------------------------------ |
| store_commodity_id   | int    | T（type=1 F） | 商类ID         |                                                              |
| store_commodity_data | object | F（type=1 T） |                | {<br/>    "name": "颜色",<br/>    "data": [<br/>        {<br/>            "name": "金色",<br/>            "commodity_info_id": 2<br/>        },<br/>        {<br/>            "name": "白色",<br/>            "commodity_info_id": 1<br/>        }<br/>    ]<br/>} |
| vip                  | float  | F             | vip折扣        | 0.5                                                          |
| ze                   | float  | F             | 商品折扣       | 0.4                                                          |
| type                 | int    | T             | 0=修改 1=新增  |                                                              |
| store_channel_id     | int    | F（type=1 T） | 所在店铺频道ID |                                                              |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取店铺频道

接口地址:/index/index/getcommodity

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
|        |      |          |      |

成功返回内容

```
{
    "label": "男子专区s",
    "value": 1,  //店铺频道ID
    "shop_category_activity_img": "/shop_category_img/16790527591717570375.jpeg",
    "shop_category_parent_brief": [
        "潮流",
        "时尚",
        "百搭"
    ],
    "children": [
        {
            "label": "运动鞋s",
            "value": 1,//店铺频道ID
            "shop_category_img": "/shop_category_img/1679052759619824776.jpeg",
            "shop_category_activity_img_son": "/shop_category_img/16790527781451820458.jpg",
            "shop_category_son_brief": [
                "耐磨",
                "实用",
                "潮流"
            ]
        },
  
    ]
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```









# 接口名称:修改新增店铺频道

接口地址:/index/index/upaddshopcheel

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名                    | 类型        | 是否必须            | 说明                                                         |                                                              |
| ------------------------- | ----------- | ------------------- | ------------------------------------------------------------ | ------------------------------------------------------------ |
| value                     | int         | T(当type=1时则不传) | 大频道ID                                                     |                                                              |
| big_name                  | string      | F                   | 大频道名称                                                   |                                                              |
| big_target                | array  JSON | F                   | 大频道标签                                                   | formData.append(`big_target`, JSON.stringify(val))           |
| old_son_name_index        | array       | F                   | 存放要修改名称标签的子频道ID      须配合old_son_name      old_son_target）使用       三者不能空缺 | formData.append(`old_son_name_index[]`, val)                 |
| old_son_name              | array       | F                   | 存放修改的子频道名称（须配合old_son_name_index）使用         | formData.append(`old_son_name[]`, val)                       |
| old_son_target            | array       | F                   | 存放修改子频道标签（须配合old_son_name_index）使用           | formData.append(`old_son_target`[], JSON.stringify(val))     |
| update_img_index          | array       | F                   | 存放要修改展示图片的子频道ID   需配合update_img使用   两者不能空缺 | formData.append(`update_img_index[]`,val)                    |
| update_img                | file        | F                   | 存放要修改展示图片file文件      需配合update_img_index使用   两者不能空缺 | formData.append('update_img[]', val)                         |
| update_img_activity_index | array       | F                   | 存放要修改活动图片的子频道ID   需配合update_img_activity使用   两者不能空缺 | formData.append(`update_img_activity_index[]`,val)           |
| update_img_activity       | file        | F                   | 存放修改子频道活动图片file文件      需配合update_img_activity_index使用   两者不能空缺 | formData.append('update_img_activity[]', val.img_obj)        |
| add_name                  | array       | F                   | 存放新增子频道名称 （如果要新增子频道则以下参数必不能少）    | formData.append('add_name[]', val)                           |
| add_img_activity          | file        | F                   | 存放新增子频道活动图片                                       | formData.append('add_img_activity[]', val.img_obj)           |
| add_img                   | file        | F                   | 存放新增子频道展示图片                                       | formData.append('add_img[]', val.img_obj)                    |
| add_brief                 | array  JSON | F                   | 存放新增子频道标签                                           | formData.append(`add_brief`[], JSON.stringify(val))          |
| type                      | int         | T                   | 0=修改   1=新增                                              | 当为新增时必须添加一个子频道  只用传入大频道所有参数   和添加子频道所有参数 |

成功返回内容

```

```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```



# 接口名称:获取店铺首页

接口地址:/index/index/getshophome

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
|        |      |          |      |

成功返回内容

```
{
    "code": 200,
    "channel": [ //店铺频道列表 可搭配ant cascader 级联选择使用
        {
            "value": 0,
            "label": "大频道",
            "children": [
                {
                    "label": "男子专区s",
                    "value": 1
                },
            ]
        },
        {
            "value": 1,  //频道ID
            "label": "子频道",
            "children": [
                {
                    "label": "运动鞋s",
                    "value": 1 //频道ID
                },
            ]
        },
        {
            "value": 2,
            "label": "商品",
            "children": [
                {
                    "value": 1,//商品ID
                    "label": 1
                },
            ]
        }
    ],
    "commodity": [//店铺商品ID列表  可搭配ant select  下拉选择使用
        {
            "value": 1,//商品ID
            "label": 1
        },

    ],
    "data": [ //店铺首页数据
        {
            "banner": [//轮播图
                {
                    "type": 0,
                    "name": "男子专区s",
                    "key": [
                        0,  //0=大频道  1=子频道  2=商品
                        1  //频道ID
                    ]
                },

            ],
            "banner_min": [//次要
                {
                    "type": 0,
                    "name": "男子专区s",
                    "key": [
                        0,
                        1
                    ]
                },
            ],
            "banner_info": [//详情
                {
                    "type": 0,
                    "name": "男子专区s",
                    "key": [
                        0,
                        1
                    ]
                },
            ],
            "shop_hard": [ //大图商品ID
                1,
                2
            ]
        }
    ],
    "msg": "操作成功"
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```









# 接口名称:设置店铺首页

接口地址:/index/index/setshophome

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型  | 是否必须 | 说明                                                         |
| ------ | ----- | -------- | ------------------------------------------------------------ |
| data   | array | T        | 无论修改哪个板块都要传全部板块数据                           |
|        |       |          | 示例                                                         |
|        |       |          | [[],[],[],[]] 第一个放banner数据  第二个放banner_min数据 第三个放banner_info  第四个放shop_hard数据 |
|        |       |          | [  [    [1,2]   [2,1]   ],[],[],[]  ]   第二层数组也就是每个板块中的数据存放 getshophome接口data中的key 数据存放形式为数组 |
|        |       |          |                                                              |

例子

```
[ //最外层数组用于包裹不同板块的数据
    [//每一个板块要存放的数据  banner
        [
            0,//0=大频道  1=子频道  2=商品
            1 //ID 频道对应频道ID  商品对应商品ID
        ],
    ],
    [//每一个板块要存放的数据 banner_min
        [
            0,
            1
        ],
    ],
    [//每一个板块要存放的数据  banner_info  
        [
            0,
            1
        ],
    ],
    [//每一个板块要存放的数据  shop_hard   
        1,//存放的是商品ID
        2
    ]
]
```

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取店铺所有优惠券

接口地址:/index/index/getshopdiscount

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
|        |      |          |      |

成功返回内容

```
[  //commodity 存放店铺商品ID
    {
        "value": 1,
        "label": 1
    },
    {
        "value": 2,
        "label": 2
    },
]

[
    {
        "discount_id": 13,//优惠券ID
        "type": -1,//-1=店铺优惠券
        "shop_id": 1,//店铺ID
        "man_money": "2000.00",
        "jian_money": "100.00",
        "ze_kou": null,
        "portion_tf": 0,  //0=部分商品  1=全部商品
        "discount_info": "水电费",
        "sen_time": "2023-03-20 00:00:00",
        "end_time": "2023-03-25 13:01:33",
        "superposition": 0,
        "repetition": 1,
        "discount_title": "阿斯蒂芬",
        "son": [ //存放部分商品的ID
            {
                "value": "4",
                "label": "4"
            },
            {
                "value": "8",
                "label": "8"
            }
        ]
    },
]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```









# 接口名称:修改新增店铺优惠券

接口地址:/index/index/setshopdiscount

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名         | 类型     | 是否必须 | 说明                                                         |
| -------------- | -------- | -------- | ------------------------------------------------------------ |
| type           | int      | T        | 0=修改  1=新增                                               |
| discount_info  | string   | F        | 优惠券说明 type=1必填                                        |
| discount_title | string   | F        | 优惠券名称 type=1必填                                        |
| end_time       | datetime | F        | 优惠券结束时间 type=1必填                                    |
| sen_time       | datetime | F        | 优惠券开始时间 type=1必填                                    |
| portion_tf     | int      | F        | 0=部分商品         type=1必填                                |
| jian_money     | float    | F        | 优惠内容 小于1时表示打折 反之为减金额   type=1必填           |
| son            | array    | F        | 修改portion_tf=0时 必填  存放商品ID     type=1必填  为覆盖式 |
| discount_id    | int      | T        | type=1不填   优惠券ID                                        |
|                |          |          |                                                              |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取店铺权限

接口地址:/index/index/getshoproot

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
|        |      |          |      |

成功返回内容

```
[
    {
        "shop_member_root_id": 1,  //权限ID
        "site": "/shopviews/Statistics",//路由地址	
        "r_root": 2,//可以查看权限	  0=所有者  1=管理员  2=客服
        "s_root": 2,//可以编辑新增权限
        "shop_id": 1, //店铺ID
        "root_name": "店铺统计",//路由名
        "show": false
    },
]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:修改店铺权限

接口地址:/index/index/setshoproot

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名              | 类型 | 是否必须 | 说明                               |
| ------------------- | ---- | -------- | ---------------------------------- |
| shop_member_root_id | int  | T        | 权限ID                             |
| s_root              | int  | T        | 编辑权限  0=所有者 1=管理员 2=客服 |
| r_root              | int  | T        | 路由查看权限                       |
|                     |      |          |                                    |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```





# 接口名称:获取店铺成员

接口地址:/index/index/getshopjue

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明 |
| ------ | ---- | -------- | ---- |
|        |      |          |      |

成功返回内容

```
[
    {
        "shop_member_id": 8,
        "shop_id": 1,
        "shop_post": 0,// 0=所有者 1=管理员  2=客服
        "user_id": 1,//用户ID
        "user_id_change": 1,
        "nickname": "水博超",
        "show": false
    },
]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```





# 接口名称:新增修改添加店铺成员

接口地址:/index/index/setshopjue

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型 | 是否必须 | 说明                  |
| --------- | ---- | -------- | --------------------- |
| type      | int  | T        | 0=修改 1=删除  2=添加 |
| user_id   | int  | T        | 用户ID                |
| shop_post | int  | T        | 权限 1=管理员  2=客服 |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取店铺秒杀商品

接口地址:/index/index/getshopseckill

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

成功返回内容

```
[
    {
        "value": 2,//秒杀ID
        "label": "2023-03-20 16:52:12——2023-03-31 23:08:17",//活动时间
        "show": 0,
        "cmm": [//存放用户秒杀商品
            {
                "seckill_time_info_id": 4,
                "seckill_time_id": 2,
                "commodity_info_id": 2,//商品ID
                "commodity_num": 22,
                "commodity_num_sheng": 2,
                "shop_id": 1
            },
            {
                "seckill_time_info_id": 5,
                "seckill_time_id": 2,
                "commodity_info_id": 4,
                "commodity_num": 10,
                "commodity_num_sheng": 1,
                "shop_id": 1
            }
        ]
    },

]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```









# 接口名称:修改店铺秒杀商品

接口地址:/index/index/setshopseckill

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名          | 类型  | 是否必须 | 说明                          |
| --------------- | ----- | -------- | ----------------------------- |
| seckill_time_id | int   | T        | 秒杀ID                        |
| info            | array | T        | 数组用于存放商品ID 覆盖式写入 |
|                 |       |          |                               |

成功返回内容

```
[
    {
        "value": 2,//秒杀ID
        "label": "2023-03-20 16:52:12——2023-03-31 23:08:17",//活动时间
        "show": 0,
        "cmm": [//存放用户秒杀商品
            {
                "seckill_time_info_id": 4,
                "seckill_time_id": 2,
                "commodity_info_id": 2,//商品ID
                "commodity_num": 22,
                "commodity_num_sheng": 2,
                "shop_id": 1
            },
            {
                "seckill_time_info_id": 5,
                "seckill_time_id": 2,
                "commodity_info_id": 4,
                "commodity_num": 10,
                "commodity_num_sheng": 1,
                "shop_id": 1
            }
        ]
    },

]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:获取店铺信息

接口地址:/index/index/getshopinfo

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

成功返回内容

```
[
    {
        "value": 2,//秒杀ID
        "label": "2023-03-20 16:52:12——2023-03-31 23:08:17",//活动时间
        "show": 0,
        "cmm": [//存放用户秒杀商品
            {
                "seckill_time_info_id": 4,
                "seckill_time_id": 2,
                "commodity_info_id": 2,//商品ID
                "commodity_num": 22,
                "commodity_num_sheng": 2,
                "shop_id": 1
            },
            {
                "seckill_time_info_id": 5,
                "seckill_time_id": 2,
                "commodity_info_id": 4,
                "commodity_num": 10,
                "commodity_num_sheng": 1,
                "shop_id": 1
            }
        ]
    },

]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







# 接口名称:修改店铺信息

接口地址:/index/index/setshopinfo

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名    | 类型   | 是否必须 | 说明                                      |
| --------- | ------ | -------- | ----------------------------------------- |
| shop_type | int    | F        | 频道大频道ID                              |
| site      | string | F        | 店铺所在地址                              |
| logo      | file   | F        | file文件   formData.append('logo[]', img) |

成功返回内容

```
[
    {
        "value": 2,//秒杀ID
        "label": "2023-03-20 16:52:12——2023-03-31 23:08:17",//活动时间
        "show": 0,
        "cmm": [//存放用户秒杀商品
            {
                "seckill_time_info_id": 4,
                "seckill_time_id": 2,
                "commodity_info_id": 2,//商品ID
                "commodity_num": 22,
                "commodity_num_sheng": 2,
                "shop_id": 1
            },
            {
                "seckill_time_info_id": 5,
                "seckill_time_id": 2,
                "commodity_info_id": 4,
                "commodity_num": 10,
                "commodity_num_sheng": 1,
                "shop_id": 1
            }
        ]
    },
]
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```







```
 serve = new WebSocket('ws://192.168.150.129:250');  //建立连接
 serve.onmessage = FnMessage;  //监听消息  接收的消息放在data字段中 是json格式  要转
 
 //每次向服务器发送数据都是JSON序列化之后的数据  必传对象 必须有constructor属性名  data属性名
 serve.send(JSON.stringify({ constructor: 1, data: { user_id: 1, shop_id: 1 } }));
 
```





# 接口名称s:获取店铺的聊天列表

请求参数:  data  为 对象下列为data对象中的传递参数

| 参数    | 类型 | 说明                           |
| ------- | ---- | ------------------------------ |
| user_id | INT  | 用户ID(店铺客服及以上成员的ID) |
| shop_id | INT  | 店铺ID                         |

示例:serve.send(JSON.stringify({ constructor: 1, data: { user_id: 1, shop_id: 1 } }));

返回内容

```
type: 2
[
    { 
        "user_id": 200,  //用户ID	
        "read_tf": 1,  //  1=有未读消息  0=无
        "user_change_id": 200, 
        "nickname": "苗嘉熙", //用户昵称
        "headimg": "/user_img/123.jpeg"//用户头像
    },
    {
        "user_id": 300,
        "read_tf": 1,
        "user_change_id": 300,
        "nickname": "华弘文",
        "headimg": "/user_img/123.jpeg"
    }
]
```







# 接口名称s:获取店铺与客户聊天的详细内容

请求参数:  data  为 对象 下列为data对象中的传递参数

| 参数    | 类型 | 说明                   |
| ------- | ---- | ---------------------- |
| user_id | INT  | 客户ID                 |
| shop_id | INT  | 店铺ID                 |
| type    | INT  | 0=店铺获取  1=用户获取 |

示例:serve.send(JSON.stringify({ constructor: 2, data: { user_id: 200, shop_id: 1 } }));

返回内容

```
type: 3
[
    {
        "service_info_id": 1, //消息ID
        "shop_id": 1,
        "both": 0,
        "service_info": "士大夫十分", //内容
        "fujian": { //附件
            "type": "video",
            "url": "/commodity_info_img/1679278416401111179.mp4"
        },
        "user_id": 200,
        "service_id": 1,
        "send_time": "2023-03-21 16:10:05",
        "read_tf": 0,
        "service_user_id": 1,
        "service_nickname": "水博超",
        "service_headimg": "/user_img/123.jpeg",  //客服图片
        "user_user_id": 200,//客户ID
        "user_nickname": "苗嘉熙",
        "user_headimg": "/user_img/123.jpeg"
    },

]
```







# 接口名称:发送聊天内容

接口地址:/index/index/setserveinfo

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名   | 类型   | 是否必须 | 说明                                      |
| -------- | ------ | -------- | ----------------------------------------- |
| shop_id  | int    | T        | 店铺ID                                    |
| info     | string | F        | 发送内容                                  |
| file[]   | file   | F        | file文件   formData.append('file[]', img) |
| user_id  | int    | T        | 用户ID                                    |
| both     | int    | T        | 0=店铺发送  1=客户发送                    |
| serve_id | int    | F        | 客服ID  当both=0必填                      |

成功返回内容

```
{
"code":405,
"data":false,// 判断对方是否在线
"msg":"参数错误"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
{"code":406,"data":false,"msg":"该用户不是商家"}
```





# 接口名称s:获取客户的聊天列表

请求参数:  data  为 对象下列为data对象中的传递参数

| 参数    | 类型 | 说明                           |
| ------- | ---- | ------------------------------ |
| user_id | INT  | 用户ID(店铺客服及以上成员的ID) |

示例:serve.send(JSON.stringify({ constructor: 3, data: { user_id: 1 } }));

返回内容

```
type: 4
{
    "user_id": 200,
    "read_tf": false,
    "shop_id": 1,
    "shop_img": "/shop_category_img/1679379888556041172.jpeg",
    "shop_name": "欧水电费水电费水电费水电费专卖店"
}
```









# 接口名称s:通知服务器改变用户的聊天列表

请求参数:  data  为 对象 下列为data对象中的传递参数

| 参数    | 类型 | 说明   |
| ------- | ---- | ------ |
| user_id | INT  | 用户ID |
|         |      |        |

示例:serve.send(JSON.stringify({ constructor:4, data: { user_id: 200, shop_id: 1 } }));

返回内容

```

```







# 接口名称s:通知服务器改变店铺的聊天列表

请求参数:  data  为 对象 下列为data对象中的传递参数

| 参数    | 类型 | 说明   |
| ------- | ---- | ------ |
| shop_id | INT  | 店铺ID |
|         |      |        |

示例:serve.send(JSON.stringify({ constructor:5, data: { user_id: 200, shop_id: 1 } }));

返回内容

```

```









# 接口名称:用于客户聊天列表添加店铺

接口地址:/index/index/inquireshop

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名  | 类型 | 是否必须 | 说明   |
| ------- | ---- | -------- | ------ |
| shop_id | int  | T        | 店铺ID |

成功返回内容失败返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:微信获取用户openid

接口地址:/index/index/wxcode

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                |
| ------ | ---- | -------- | ------------------- |
| code   | int  | T        | wx.login 返回的code |

成功返回内容失败返回内容

```

openid: "oKZPC5X_b-6mw2Ks6qNrPgHaRtJ8"
session_key: "LRFJorM3oh75dXantIDyYg=="
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:微信用户登录

接口地址:/index/index/wxenter

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型   | 是否必须 | 说明                                            |
| ------ | ------ | -------- | ----------------------------------------------- |
| openid | string | T        | wxcode  返回的openid   只有绑定了手机号才能登录 |

成功返回内容失败返回内容

```

```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```



# 接口名称:微信用户绑定账号

接口地址:/index/index/wxbind

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型   | 是否必须 | 说明               |
| ------ | ------ | -------- | ------------------ |
| iphone | string | T        | 用户绑定的手机号   |
| openid | string | T        | wxcode返回的openid |

成功返回内容失败返回内容

```

```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:逛逛文章获取

接口地址:/index/index/ggindex

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名                   | 类型 | 是否必须 | 说明                         |
| ------------------------ | ---- | -------- | ---------------------------- |
| stroll_channel_parent_id | int  | F        | 逛逛频道ID  默认获取所有     |
| order                    | int  | F        | 0=时间倒序(默认) 1=正序      |
| limit                    | int  | F        | 获取多少条 (默认10)          |
| offset                   | int  | F        | 从第几条数据开始获取 (默认0) |

成功返回内容失败返回内容

```
{
    "stroll_index_id": 3,
    "stroll_index_img": [
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-47.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg",
        "/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"
    ],
    "stroll_index_title": "的双方各申达股份",
    "stroll_index_info": "dfgdf的双方各",
    "store_commodity_id": 1, //文章ID	
    "stroll_index_channel": "1",//频道ID
    "stroll_index_send_time": "2023-04-04 08:46:54",
    "stroll_index_like": 0,//点赞数	
    "stroll_index_collect": 0,//收藏数
    "user_id": 7,
    "stroll_index_video": [
        "/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"
    ],
    "stroll_index_topic": 3,//话题ID
    "nickname": "云雪松",
    "stroll_channel_son_id": 3,
    "stroll_channel_son_title": "法国恢复规划" //话题名称
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:逛逛频道获取

接口地址:/index/index/ggchannel

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

成功返回内容失败返回内容

```
{
    "stroll_channel_parent_id": 1,//频道ID
    "stroll_channel_parent_title": "家电"
}
```



失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```



# 接口名称:逛逛文章查看次数自增

接口地址:/index/index/addggindex

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名          | 类型 | 是否必须 | 说明       |
| --------------- | ---- | -------- | ---------- |
| stroll_index_id | int  | T        | 逛逛文章ID |

成功返回内容

```

```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:逛逛文章详情

接口地址:/index/index/ggindeinfo

请求方式:GET

请求参数:   axios发送请求设置允许携带cookie

| 参数名          | 类型 | 是否必须 | 说明        |
| --------------- | ---- | -------- | ----------- |
| stroll_index_id | int  | F        | 逛逛 文章ID |

成功返回内容

```
childer:{//评论
[

    change_id: 1
    childer: [//评论回复
        {
			change_id: 1
            headimg: "/user_img/123.jpeg" //回复用户头像
            nickname: "水博超"  
            stroll_comment_parent_id: 1
            stroll_comment_son_fujian: null
            stroll_comment_son_id: 1  //回复ID
            stroll_comment_son_info: "所发生的费"  //回复内容
            stroll_comment_son_like: 0  //点赞数
            stroll_comment_son_send_time: "2023-04-04 15:40:11"
            taget_user_id: 1 //回复目标用户ID
            target_headimg: "/user_img/123.jpeg"
            target_id: 1
            target_nickname: "水博超"  //回复目标用户昵称
            type: 1
            user_id: 1
            user_stroll_comment_like_id: 2 //不为空则表示已点赞
			
        }
    ]
    headimg: "/user_img/123.jpeg"  //评论用户的头像
    nickname: "水博超"  //评论用户
    stroll_comment_parent_fujian: null
    stroll_comment_parent_id: 1 //评论ID
    stroll_comment_parent_info: "单方事故水电费g" 
    stroll_comment_parent_like: 0  //评论点赞数
    stroll_comment_parent_send_time: "2023-04-03 15:34:26"
    stroll_index_id: 1  //文章ID
    type: 0
    user_id: 1  //评论用户ID
    user_stroll_comment_like_id: 1 //不为空则表示已点赞
]

}

stroll_fans_id:1//不为空则表示已关注该文章作者
headimg: "/user_img/123.jpeg" //文章 作者头像
look_sum: 48  //文章查看次数
my_collect: 1  //不为空则表示已收藏
my_id: 1  
my_like: 1   //不为空则表示已点赞
my_my_id: 1
nickname: "杨醉波"
store_commodity_id: 1
stroll_channel_son_id: 1
stroll_channel_son_title: "红烧豆腐" //话题
stroll_index_channel: "5"//频道ID
stroll_index_collect: 0//收藏数
stroll_index_id: 1 //文章ID
stroll_index_img: "["/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg","/commodity_info_img/Snipaste_2023-01-11_22-18-47.jpg","/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg","/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg","/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"]"
stroll_index_info: "手动阀手动阀"  //文章内容
stroll_index_like: 0  //点赞数
stroll_index_send_time: "2023-04-04 08:35:40"
stroll_index_title: "手动阀手动阀"
stroll_index_topic: 1 //话题ID
stroll_index_video: "["/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"]"
user_id: 5
user_id_change: 5
cmm { //商品详情
            brand: "欧 郎 格是"
            commodity_info_id: 1
            commodity_info_id_change: 1
            commodity_info_state_time: "2023-03-12 18:28:12"
            commodity_info_title: "欧郎格 长袖T恤男夏季新款男士t恤长袖宽松男长袖T恤打底衫水电费"
            commodity_type_id: 1
            imgs: (6) ["/commodity_info_img/Snipaste_2023-01-11_22-18-47.jpg"]
            money: "99"
            shop_id: 1
}
```

失败返回内容







# 接口名称:逛逛文章收藏

接口地址:/index/index/changeggcollect

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名          | 类型 | 是否必须 | 说明        |
| --------------- | ---- | -------- | ----------- |
| stroll_index_id | int  | T        | 逛逛 文章ID |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:逛逛用户关注

接口地址:/index/index/changegguser

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名  | 类型 | 是否必须 | 说明   |
| ------- | ---- | -------- | ------ |
| user_id | int  | T        | 用户ID |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```



# 接口名称:逛逛点赞

接口地址:/index/index/changegglike

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名          | 类型 | 是否必须    | 说明                                 |
| --------------- | ---- | ----------- | ------------------------------------ |
| type            | int  | T           | 0=文章点赞   1=评论点赞   2=回复点赞 |
| stroll_index_id | int  | type=0=T    | 文章ID                               |
| change_id       | int  | type=1,2 =T | type=1为评论ID   type=2为回复ID      |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:逛逛文章评论

接口地址:/index/index/pggindex

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名          | 类型   | 是否必须   | 说明                                                         |
| --------------- | ------ | ---------- | ------------------------------------------------------------ |
| type            | int    | T          | 0=文章评论   1=评论回复   2=回复 回复                        |
| stroll_index_id | int    | type=0=T   | 评论文章时  传入文章ID                                       |
| change_id       | int    | type=1,2=T | type=1传入评论的stroll_comment_parent_id                                        type=2传入回复的stroll_comment_son_id |
| content         | string | T          | 评论内容                                                     |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:逛逛话题详情

接口地址:/index/index/gghua

请求方式:get

请求参数:   axios发送请求设置允许携带cookie

| 参数名                | 类型 | 是否必须 | 说明   |
| --------------------- | ---- | -------- | ------ |
| stroll_channel_son_id | int  | T        | 话题ID |

成功返回内容

```
{
data: {look_sum: "225" //话题浏览次数, participation: 6//话题参与次数}
stroll_channel_son_id: 1//话题ID
stroll_channel_son_img: "/user_img/123.jpeg"  //话题图片
stroll_channel_son_info: "水电费水电费水电费胜多负少打发斯蒂芬水电费"  //话题简介
stroll_channel_son_title: "红烧豆腐"  //话题名称
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```



# 接口名称:逛逛话题文章

接口地址:/index/index/gghuainfo

请求方式:get

请求参数:   axios发送请求设置允许携带cookie

| 参数名                | 类型 | 是否必须 | 说明                         |
| --------------------- | ---- | -------- | ---------------------------- |
| stroll_channel_son_id | int  | T        | 话题ID                       |
| offset                | int  | F        | 从哪一条开始获取             |
| limit                 | int  | F        | 取多少条                     |
| order                 | int  | F        | 0=热门排序(默认)  1=时间排序 |

成功返回内容

```
headimg: "/user_img/123.jpeg"
look_sum: 87
nickname: "杨醉波"
store_commodity_id: 1
stroll_channel_son_id: 1  //话题ID
stroll_channel_son_title: "红烧豆腐"  //话题名称
stroll_index_channel: "5"
stroll_index_collect: 0
stroll_index_id: 1
stroll_index_img:["/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"]
stroll_index_info: "手动阀手动阀"//内容
stroll_index_like: 1
stroll_index_send_time: "2023-04-04 08:35:40"//发送时间
stroll_index_title: "手动阀手动阀"
stroll_index_topic: 1  //话题ID
stroll_index_video: ["/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"]
user_id: 5  //发表文章用户ID
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```



# 接口名称:微信上传文件（通用）

接口地址:/index/index/addggfile

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                                     |
| ------ | ---- | -------- | ---------------------------------------- |
| file   | file | T        | 上传文件只能传一个(别问为啥小程序煞笔了) |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```









# 接口名称:逛逛文章发表

接口地址:/index/index/addgg

请求方式:POST

请求参数:   axios发送请求设置允许携带cookie

| 参数名                   | 类型   | 是否必须 | 说明                                                   |
| ------------------------ | ------ | -------- | ------------------------------------------------------ |
| content                  | string | T        | 评论内容                                               |
| title                    | string | T        | 发表标题                                               |
| commodity_info_id        | int    | T        | 商品ID                                                 |
| stroll_channel_son_id    | int    | F        | 话题ID                                                 |
| stroll_channel_parent_id | int    | T        | 频道ID                                                 |
| file_image               | array  | T        | 调用addggfile获取文件路径名称  存放为数组 存放图片数组 |
| file_video               | array  | T        | 调用addggfile获取文件路径名称  存放为数组 存放视频数组 |

成功返回内容

```
{"code":200,"data":true,"msg":"操作成功"}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:逛逛添加文章商品搜索

接口地址:/index/index/addggsearch

请求方式:get

请求参数:   axios发送请求设置允许携带cookie

| 参数名  | 类型   | 是否必须 | 说明                                        |
| ------- | ------ | -------- | ------------------------------------------- |
| content | string | T        | 长度为0获取最近购物商品  反之搜索关键字商品 |
| limit   | int    | F        | 取多少条数据 (默认10条)                     |
| offset  | int    | F        | 从多少条开始取                              |

成功返回内容

```
{
data: {look_sum: "225" //话题浏览次数, participation: 6//话题参与次数}
stroll_channel_son_id: 1//话题ID
stroll_channel_son_img: "/user_img/123.jpeg"  //话题图片
stroll_channel_son_info: "水电费水电费水电费胜多负少打发斯蒂芬水电费"  //话题简介
stroll_channel_son_title: "红烧豆腐"  //话题名称
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:逛逛获取所有话题

接口地址:/index/index/ggallhua

请求方式:get

请求参数:   axios发送请求设置允许携带cookie

成功返回内容

```
{
data: {look_sum: "225" //话题浏览次数, participation: 6//话题参与次数}
stroll_channel_son_id: 1//话题ID
stroll_channel_son_img: "/user_img/123.jpeg"  //话题图片
stroll_channel_son_info: "水电费水电费水电费胜多负少打发斯蒂芬水电费"  //话题简介
stroll_channel_son_title: "红烧豆腐"  //话题名称
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```







# 接口名称:我的逛逛主页

接口地址:/index/index/gguserindex

请求方式:get

请求参数:   axios发送请求设置允许携带cookie

| 参数名 | 类型 | 是否必须 | 说明                                           |
| ------ | ---- | -------- | ---------------------------------------------- |
| type   | int  | T        | 0=获取我的收藏  1=获取我的关注  2=获取我的评论 |

成功返回内容

```
type==0
{
headimg: "/user_img/123.jpeg"
look_sum: 88
my_id: 1
nickname: "杨醉波"
store_commodity_id: 1
stroll_channel_son_id: 1
stroll_channel_son_title: "红烧豆腐"
stroll_index_channel: "5"//频道ID
stroll_index_collect: 0
stroll_index_id: 1
stroll_index_img: (5) ["/commodity_info_img/Snipaste_2023-01-11_22-18-25.jpg"]
stroll_index_info: "手动阀手动阀"
stroll_index_like: 1
stroll_index_send_time: "2023-04-04 08:35:40"
stroll_index_title: "手动阀手动阀"
stroll_index_topic: 1  //话题ID
stroll_index_video: ["/commodity_info_img/eb3b7a743dba4f5b953ebad797f7b4f1.mp4"]
user_id: 5
}

type==1
{
count: 1  //总共发表文章
fensi: 1 //粉丝数
info: {nickname: "杨醉波", headimg: "/user_img/123.jpeg"}  //用户名,头像
target_id: 5 //关注用户ID
}
```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```





# 接口名称:获取别用户数据页

接口地址:/index/index/gglikeuserindex

请求方式:get

请求参数:   axios发送请求设置允许携带cookie

| 参数名  | 类型 | 是否必须 | 说明           |
| ------- | ---- | -------- | -------------- |
| user_id | int  | T        | 用户ID         |
| limit   | int  | F        | 取多少条数据   |
| offset  | int  | F        | 从第几条开始取 |

成功返回内容

```

```

失败返回内容

```
{"code":405,"data":false,"msg":"参数错误"}
```

