<?php

namespace app\index\controller;
class Sql {
 
public static $str1=<<<EOD
SELECT *
FROM category_parent a LEFT JOIN (
SELECT category_parent_id,category_son_img
FROM category_son
) b ON a.category_parent_id=b.category_parent_id
GROUP BY a.category_parent_id
LIMIT ?,?
EOD;

public static $str2=<<<EOD
SELECT *
FROM category_son
WHERE hot=1
LIMIT ?,?
EOD;




public static $str3=<<<EOD
SELECT *
FROM category_son_son
WHERE category_parent_id=?
EOD;

public static $str4=<<<EOD
SELECT *
FROM category_parent
EOD;

public static $str5=<<<EOD
SELECT *
FROM category_son
WHERE category_son_lei=?
EOD;

public static $str6=<<<EOD
SELECT *
FROM app_home
EOD;

public static $str7=<<<EOD
SELECT *,category_parent_id as id
FROM category_parent
WHERE category_parent_id=?
EOD;

public static $str8=<<<EOD
SELECT *,category_son_son_id as id
FROM category_son_son
WHERE category_son_son_id=?
EOD;

public static $str9=<<<EOD
SELECT imgs,videos,store_commodity_id as id
FROM (
SELECT *
FROM store_commodity
WHERE store_commodity_id=?
)a LEFT JOIN (
SELECT *
FROM commodity_info
) b ON a.store_commodity_id=b.commodity_type_id
LIMIT 0,1
EOD;

public static $str10=<<<EOD
SELECT index_img,shop_id as id,shop_name
FROM shop
WHERE shop_id=?
EOD;

public static $str11=<<<EOD
SELECT *,category_son_id as id
FROM category_son
WHERE category_son_id=?
EOD;


public static $str12=<<<EOD
SELECT a.send_time,a.commodity_num,a.commodity_num_sheng,end_time,b.commodity_info_title,b.commodity_info_data,b.commodity_info_activity
,b.imgs,b.videos,b.activity_title,b.commodity_info_id
FROM (
SELECT b.*,a.send_time,a.end_time
FROM (
SELECT *
FROM seckill_time
WHERE NOW()<=end_time AND NOW()>=send_time
ORDER BY send_time ASC
LIMIT 0,1
) a LEFT JOIN (
SELECT *
FROM seckill_time_info
) b ON a.seckill_time_id=b.seckill_time_id
)a LEFT JOIN commodity_info b ON a.commodity_info_id=b.commodity_info_id
WHERE b.commodity_info_state=0
ORDER BY commodity_num_sheng DESC,commodity_num-commodity_num_sheng DESC
limit 0,?
EOD;

public static $str13=<<<EOD
SELECT a.*,b.store_commodity_sum
FROM (
SELECT imgs,commodity_info_data,commodity_info_activity,commodity_info_title,commodity_info_id,commodity_type_id
FROM commodity_info
WHERE NOW()<=commodity_info_activity_end_time AND NOW()>=commodity_info_activity_sent_time
AND commodity_info_state=0
)a LEFT JOIN store_commodity b ON a.commodity_type_id=b.store_commodity_id
LIMIT 0,?
EOD;

public static $str14=<<<EOD
SELECT a.*,b.store_commodity_sum
FROM (
SELECT imgs,commodity_info_data,commodity_info_activity,commodity_info_title,commodity_type_id,commodity_info_id
FROM commodity_info
WHERE DATE_SUB(CURDATE(), INTERVAL ? DAY) <= DATE(commodity_info_state_time)
AND commodity_info_state=0
)a LEFT JOIN store_commodity b ON a.commodity_type_id=b.store_commodity_id
GROUP BY a.commodity_type_id
LIMIT 0,?
EOD;

public static $str15=<<<EOD
SELECT *
FROM (SELECT shop_id,index_img,attention,shop_type,shop_name
FROM shop
WHERE shop_state=0 AND shop_good=0 ) a LEFT JOIN category_parent b ON a.shop_type=b.category_parent_id
LIMIT 0,?
EOD;

public static $str16=<<<EOD
SELECT *
FROM discount
WHERE NOW()<=end_time AND NOW()>=sen_time
LIMIT 0,?
EOD;

public static $str17=<<<EOD
SELECT category_son_img
FROM category_son
LIMIT 0,1
EOD;

public static $str18=<<<EOD
SELECT *
FROM commodity_info
WHERE shop_id=?
LIMIT 0,1
EOD;


public static $str19=<<<EOD
SELECT category_son_img
FROM (
SELECT b.category_son_son_id
FROM (SELECT *
FROM category_parent  
WHERE category_parent_id=?) a LEFT JOIN category_son_son b 
ON a.category_parent_id=b.category_parent_id
LIMIT 0,1
)a LEFT JOIN category_son b ON a.category_son_son_id=b.category_son_lei
LIMIT 0,1
EOD;


public static $str20=<<<EOD
SELECT category_parent_id,category_parent_title,category_info_title
FROM category_parent
LIMIT 0,?
EOD;

public static $str21=<<<EOD
SELECT category_son_title,category_son_img
FROM category_son
WHERE category_parent_id=?
LIMIT 0,2
EOD;

public static $str22=<<<EOD
SELECT shop_category_title,shop_category_id,0 AS `type`,shop_id
FROM shop_category
WHERE shop_id =(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
)
GROUP BY shop_category_title
EOD;


public static $qwer78945=<<<EOD
SELECT shop_category_title,shop_category_id,0 AS `type`,shop_id
FROM shop_category
WHERE shop_id =?
GROUP BY shop_category_title
EOD;


public static $str23=<<<EOD
SELECT shop_category_SON AS shop_category_title,shop_category_id,1 AS `type`
FROM shop_category
WHERE shop_category_title=?
EOD;





public static $str24=<<<EOD
SELECT shop_hard
FROM shop
WHERE shop_id=(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;

public static $str2weqrssdfsdf=<<<EOD
SELECT shop_hard
FROM shop
WHERE shop_id=?
EOD;


public static $str25=<<<EOD
SELECT a.shop_category_SON,b.imgs,imgs,brand,commodity_info_id
FROM  shop_category a RIGHT JOIN (SELECT shop_channel_id,imgs,brand,commodity_info_id
FROM commodity_info
WHERE commodity_info_id=?) b ON a.shop_category_id=b.shop_channel_id
EOD;

public static $str26=<<<EOD
SELECT category_son_title,category_son_id
FROM category_son
WHERE category_parent_id=(
SELECT category_parent_id
FROM category_son
WHERE category_son_id=(
SELECT category_son_id_one
FROM commodity_info
WHERE commodity_info_id=?
)
)
Limit 0,8
EOD;

public static $gdfhfgj=<<<EOD
SELECT category_son_title,category_son_id
FROM category_son
WHERE category_parent_id=(
SELECT category_parent_id
FROM category_son
WHERE category_son_id=(
SELECT category_son_id_one
FROM commodity_info
WHERE shop_id=?
LIMIT 0,1
)
)
Limit 0,8
EOD;




public static $str27=<<<EOD
SELECT *
FROM user_store_attention_like
WHERE user_id=? AND store_id=(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;


public static $str28=<<<EOD
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
EOD;

public static $str29=<<<EOD
SELECT store_commodity_id,store_commodity_sum
FROM store_commodity
WHERE  store_id=(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
)
AND store_commodity_state=0
ORDER BY store_commodity_sum DESC
LIMIT 0,5
EOD;


public static $str30=<<<EOD
SELECT commodity_info_id,commodity_info_title,imgs
FROM commodity_info
WHERE commodity_type_id=? AND commodity_info_state=0
LIMIT 0,1
EOD;


public static $str31=<<<EOD
SELECT *
FROM store_commodity
WHERE store_commodity_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;


public static $str32=<<<EOD
SELECT imgs
FROM commodity_info
WHERE commodity_info_id=?
EOD;


public static $str33=<<<EOD
SELECT commodity_info_id,commodity_info_title,commodity_info_brief,commodity_info_data,commodity_info_activity,imgs,
shop_id,brand,activity_title,commodity_info_state_time,videos,commodity_info_activity_sent_time,commodity_info_activity_end_time,
commodity_info_img,
IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf
FROM commodity_info
WHERE commodity_info_id=?
EOD;


public static $str34=<<<EOD
SELECT COUNT(*) AS comment_number
FROM commodity_comment_parent
WHERE commodity_type_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;


public static $str35=<<<EOD
SELECT *
FROM discount 
WHERE discount_id IN (
SELECT discount_id
FROM discount_son
WHERE discount_son_info=?
) AND NOW()<=end_time AND NOW()>=sen_time
EOD;

public static $str36=<<<EOD
SELECT *
FROM discount
WHERE `type`=(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
) AND NOW()<=end_time AND NOW()>=sen_time
EOD;

public static $str37=<<<EOD
SELECT a.*,b.logistics_score,b.after_score,b.service_score
FROM (
SELECT shop_img,shop_name,shop_id
FROM shop
WHERE shop_id=(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
) 
) a LEFT JOIN shop_info b ON a.shop_id=b.shop_id
EOD;

public static $str38=<<<EOD
SELECT CONCAT(brand,shop_category_SON) AS title
FROM commodity_info a  RIGHT JOIN (
SELECT shop_id,shop_category_SON
FROM shop_category
WHERE shop_category_SON LIKE ?
) b  ON a.shop_id=b.shop_id
GROUP BY a.shop_id
EOD;

public static $str39=<<<EOD
SELECT LEFT(commodity_info_title,LOCATE(' ',commodity_info_title)) AS title
FROM commodity_info
WHERE commodity_info_title LIKE ?
GROUP BY commodity_type_id
EOD;

public static $str40=<<<EOD
SELECT shop_name AS title
FROM shop
WHERE shop_name LIKE ?
EOD;


public static $str41=<<<EOD
SELECT a.category_parent_title,b.category_son_son_title,c.category_son_title,c.category_son_id
FROM category_parent a LEFT JOIN category_son_son  b
ON a.category_parent_id=b.category_parent_id  LEFT JOIN category_son c ON  c.category_son_lei=b.category_son_son_id
WHERE c.category_son_id=(
SELECT category_son_id_one
FROM commodity_info
WHERE  commodity_info_id=?
)
EOD;


public static $str42=<<<EOD
SELECT brand 
FROM commodity_info
WHERE  commodity_info_id=?
EOD;


public static $str43=<<<EOD
SELECT commodity_info_title,imgs,commodity_info_data,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf,commodity_info_id,commodity_info_activity
FROM commodity_info
WHERE  category_son_id_one=(
SELECT category_son_id_one 
FROM commodity_info
WHERE  commodity_info_id=?
) AND commodity_info_state=0
LIMIT 0,10
EOD;



public static $str44=<<<EOD
SELECT COUNT(*) AS `all`,COUNT(commodity_comment_parent_img) AS img,COUNT(commodity_comment_parent_video) AS video,
COUNT(CASE WHEN commodity_comment_parent_grader = 5 THEN 1 END) AS good,
COUNT(CASE WHEN commodity_comment_parent_grader = 4 THEN 1 END) AS middle,
COUNT(CASE WHEN commodity_comment_parent_grader <4 THEN 1 END) AS difference,
COUNT(commodity_comment_parent_info_add_time) AS `add`
FROM commodity_comment_parent
WHERE commodity_type_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;

public static $str45=<<<EOD
SELECT COUNT(*) AS `all`,COUNT(commodity_comment_parent_img) AS img,COUNT(commodity_comment_parent_video) AS video,
COUNT(CASE WHEN commodity_comment_parent_grader = 5 THEN 1 END) AS good,
COUNT(CASE WHEN commodity_comment_parent_grader = 4 THEN 1 END) AS middle,
COUNT(CASE WHEN commodity_comment_parent_grader <4 THEN 1 END) AS difference,
COUNT(commodity_comment_parent_info_add_time) AS `add`
FROM commodity_comment_parent
WHERE commodity_info_id=?
EOD;


public static $str46=<<<EOD
SELECT *,IF(commodity_comment_like_id IS NOT NULL, TRUE, FALSE) AS user_like
FROM commodity_comment_parent a LEFT JOIN (
SELECT user_id,nickname,headimg,vip
FROM `user`
WHERE user_id IN (
SELECT user_id
FROM commodity_comment_parent
WHERE commodity_type_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
)
)
)b ON a.user_id=b.user_id LEFT JOIN (
SELECT `type`,indent_id
FROM indent
WHERE evaluate_tf=1
)c ON a.indent_id=c.indent_id LEFT JOIN (
SELECT user_id AS change_user_id,commodity_comment_like_id,tf_id
FROM user_commodity_comment_like
WHERE `type`=0 AND son_tf=0 AND user_id=?
) d ON a.commodity_comment_parent_id=d.tf_id
WHERE
EOD;


public static $str47=<<<EOD
SELECT COUNT(*) AS `sum`
FROM commodity_comment_son
WHERE commodity_comment_parent_id=?
EOD;


public static $str48=<<<EOD
SELECT *,IF(d.commodity_comment_like_id IS NOT NULL, TRUE, FALSE) AS user_like
FROM commodity_comment_son a LEFT JOIN (
SELECT a.user_id,a.headimg AS user_headimg ,a.nickname AS user_nickname
FROM `user` a RIGHT JOIN (
SELECT commodity_comment_son_user_id
FROM commodity_comment_son
WHERE commodity_comment_parent_id=?
) b ON a.user_id=b.commodity_comment_son_user_id
) b ON a.commodity_comment_son_user_id=b.user_id
LEFT JOIN (
SELECT a.user_id AS target_user_id ,a.headimg AS target_user_headimg,a.nickname AS target_user_nickname
FROM `user` a RIGHT JOIN (
SELECT commodity_comment_son_target_id
FROM commodity_comment_son
WHERE commodity_comment_parent_id=?
) b ON a.user_id=b.commodity_comment_son_target_id
) c ON a.commodity_comment_son_target_id=c.target_user_id  LEFT JOIN (
SELECT tf_id,commodity_comment_like_id
FROM user_commodity_comment_like
WHERE user_id=? AND `type`=0 AND son_tf=1
)d ON a.commodity_comment_son_id=d.tf_id
WHERE a.commodity_comment_parent_id=?
GROUP BY commodity_comment_son_id
EOD;

public static $str49=<<<EOD
SELECT *
FROM (SELECT *
FROM commodity_issue_parent
WHERE store_commodity_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
))a LEFT JOIN (
SELECT user_id AS i,nickname,headimg
FROM `user`
)b ON a.user_id=b.i
EOD;

public static $str50=<<<EOD
SELECT *
FROM (
SELECT *
FROM commodity_issue_son
WHERE commodity_issue_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
) AND commodity_issue_id=?
ORDER BY send_time DESC
)a LEFT JOIN (
SELECT user_id AS i,nickname,headimg
FROM `user`
)b ON a.user_id=b.i LEFT JOIN (
SELECT tf_id
FROM user_commodity_issue_like
WHERE user_id=?
)c ON a.commodity_issue_son_id=c.tf_id
EOD;

public static $str51=<<<EOD
SELECT COUNT(*) AS `sum`
FROM commodity_issue_parent
WHERE store_commodity_id=(
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;


public static $str52=<<<EOD
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
EOD;

public static $str53=<<<EOD
SELECT shop_img
FROM shop
WHERE shop_id=(
SELECT shop_id
FROM commodity_info
WHERE commodity_info_id=?
)
EOD;

public static $sdfsdfdkfg=<<<EOD
SELECT shop_img
FROM shop
WHERE shop_id=?
EOD;



public static $str54=<<<EOD
SELECT *
FROM shop
WHERE shop_id=?
EOD;

public static $str55=<<<EOD
SELECT shop_category_title,shop_category_activity_img,shop_category_parent_brief,shop_category_id
FROM shop_category
WHERE shop_id=? AND shop_category_title=?
EOD;


public static $str56=<<<EOD
SELECT shop_category_SON,shop_category_activity_img_son,shop_category_son_brief,shop_category_id
FROM shop_category
WHERE shop_id=? AND shop_category_SON=?
EOD;

public static $str57=<<<EOD
SELECT commodity_info_title,commodite_info_target,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf,commodity_info_data,commodity_info_activity,imgs,commodity_info_id
FROM commodity_info
WHERE commodity_info_id=? AND commodity_info_state=0
EOD;


public static $str58=<<<EOD
SELECT shop_category_title,shop_category_id,shop_id
FROM shop_category
WHERE shop_id =?
GROUP BY shop_category_title
EOD;


public static $str59=<<<EOD
SELECT shop_category_SON AS shop_category_title,shop_category_id,shop_category_img
FROM shop_category
WHERE shop_category_title=?
EOD;


public static $str60=<<<EOD
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf,commodity_info_data,commodity_info_activity,imgs,commodity_info_state_time,store_commodity_grade,
store_commodity_sum,0 AS `key`,COUNT(*) AS comment_num,a.shop_id
FROM commodity_info a LEFT JOIN (
SELECT store_commodity_grade,store_commodity_id,store_commodity_sum
FROM store_commodity a LEFT JOIN (
SELECT commodity_type_id AS change_id
FROM commodity_comment_parent
) b ON a.store_commodity_id=b.change_id
WHERE store_id=?
)b   ON a.commodity_type_id=b.store_commodity_id
WHERE shop_id=? AND commodity_info_state=0
GROUP BY commodity_info_id

EOD;

public static $str61=<<<EOD
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf,commodity_info_data,commodity_info_activity,imgs,commodity_info_state_time,store_commodity_grade,
store_commodity_sum,0 AS `key`,COUNT(*) AS comment_num,a.shop_id
FROM commodity_info a LEFT JOIN (
SELECT store_commodity_grade,store_commodity_id,store_commodity_sum
FROM store_commodity a LEFT JOIN (
SELECT commodity_type_id AS change_id
FROM commodity_comment_parent
) b ON a.store_commodity_id=b.change_id
WHERE store_id=?
)b   ON a.commodity_type_id=b.store_commodity_id
WHERE shop_id=? AND commodity_info_state=0 AND shop_channel_id IN (
 SELECT shop_category_id
FROM shop_category
WHERE shop_category_title=(
SELECT shop_category_title
FROM shop_category
WHERE shop_category_id=?
)
)
GROUP BY commodity_info_id
EOD;


public static $str62=<<<EOD
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf,commodity_info_data,commodity_info_activity,imgs,commodity_info_state_time,store_commodity_grade,
store_commodity_sum,0 AS `key`,COUNT(*) AS comment_num,a.shop_id
FROM commodity_info a LEFT JOIN (
SELECT store_commodity_grade,store_commodity_id,store_commodity_sum
FROM store_commodity a LEFT JOIN (
SELECT commodity_type_id AS change_id
FROM commodity_comment_parent
) b ON a.store_commodity_id=b.change_id
WHERE store_id=?
)b   ON a.commodity_type_id=b.store_commodity_id
WHERE shop_id=? AND commodity_info_state=0 AND shop_channel_id IN (
 SELECT shop_category_id
FROM shop_category
WHERE shop_category_SON=(
SELECT shop_category_SON
FROM shop_category
WHERE shop_category_id=?
)
)
GROUP BY commodity_info_id
EOD;

public static $str63=<<<EOD
SELECT *
FROM  (
SELECT category_parent_title AS `name`,category_parent_id AS lei_id, 0 AS lei
FROM category_parent
UNION 
SELECT category_son_son_title AS `name`,category_son_son_id AS lei_id, 1 AS lei
FROM category_son_son
UNION 
SELECT category_son_title AS `name`,category_son_id AS lei_id, 2 AS lei
FROM category_son
)a
WHERE `name`=?
EOD;

public static $str64=<<<EOD
SELECT *
FROM commodity_info
WHERE category_son_id_one IN (
SELECT category_son_id
FROM category_son
WHERE category_parent_id=1
) AND commodity_info_state=0
EOD;

public static $str65=<<<EOD
SELECT *
FROM (
SELECT commodity_info_id,commodity_info_id as commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE category_son_id_one IN (
SELECT category_son_id
FROM category_son 
EOD;

public static $str66=<<<EOD
) AND commodity_info_state=0
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
LEFT JOIN (
SELECT commodity_info_id,COUNT(commodity_info_id) AS  comment_sum
FROM commodity_comment_parent
)c ON a.commodity_info_id=c.commodity_info_id
LEFT JOIN (
    SELECT shop_name,shop_id AS sid
    FROM shop
    ) d ON a.shop_id=d.sid
EOD;


public static $str67=<<<EOD
SELECT *
FROM (
SELECT brand,commodity_type_id
FROM commodity_info
WHERE category_son_id_one IN (
SELECT category_son_id
FROM category_son 
EOD;

public static $str68=<<<EOD
) AND commodity_info_state=0
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
GROUP BY brand
LIMIT 0,100
EOD;



public static $str69=<<<EOD
SELECT *
FROM (
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand,commodity_info_id AS commodity_info_id_change
FROM commodity_info
WHERE commodity_info_title LIKE ? AND commodity_info_state=0  OR brand LIKE ?
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
LEFT JOIN (
    SELECT commodity_info_id,COUNT(commodity_info_id) AS  comment_sum
    FROM commodity_comment_parent
    )c ON a.commodity_info_id=c.commodity_info_id
    LEFT JOIN (
        SELECT shop_name,shop_id AS sid
    FROM shop
    ) d ON a.shop_id=d.sid 
EOD;

public static $str70=<<<EOD
SELECT *
FROM (
SELECT brand,commodity_type_id
FROM commodity_info
WHERE commodity_info_title LIKE ? AND commodity_info_state=0 OR brand LIKE ?
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
GROUP BY brand
LIMIT 0,100
EOD;


public static $str71=<<<EOD
SELECT category_son_son_id,category_son_son_title AS name
FROM category_son_son
WHERE category_parent_id=?
EOD;

public static $str72=<<<EOD
SELECT category_son_title AS name
FROM category_son
WHERE category_son_lei=?
EOD;

public static $str73=<<<EOD
SELECT category_son_lei
FROM category_son
WHERE category_son_id=?
EOD;

public static $str74=<<<EOD
SELECT *
FROM category_son
WHERE category_son_lei=?
EOD;


public static $str75=<<<EOD
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs
,commodity_info_state_time,brand,comment_sum
FROM commodity_info LEFT JOIN (
SELECT commodity_info_id AS change_id,COUNT(commodity_info_id) AS  comment_sum
FROM commodity_comment_parent
)c ON commodity_info_id=c.change_id
WHERE commodity_info_id=?
EOD;

public static $str76=<<<EOD
SELECT *
FROM category_son
WHERE category_parent_id=?
GROUP BY category_son_lei
EOD;

public static $str77=<<<EOD
SELECT COUNT(*) AS `sum`
FROM (
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE category_son_id_one IN (
SELECT category_son_id
FROM category_son 
EOD;

public static $str78=<<<EOD
SELECT COUNT(*) AS `sum`
FROM (
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand,commodity_info_id AS commodity_info_id_change
FROM commodity_info
WHERE commodity_info_title LIKE ? AND commodity_info_state=0  OR brand LIKE ?
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
LEFT JOIN (
    SELECT commodity_info_id,COUNT(commodity_info_id) AS  comment_sum
    FROM commodity_comment_parent
    )c ON a.commodity_info_id=c.commodity_info_id
    LEFT JOIN (
        SELECT shop_name,shop_id AS sid
    FROM shop
    ) d ON a.shop_id=d.sid 
EOD;



public static $str79=<<<EOD
SELECT brand
FROM (
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE category_son_id_one IN (
SELECT category_son_id
FROM category_son 
EOD;


public static $str80=<<<EOD
SELECT brand
FROM (
SELECT commodity_info_id,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand,commodity_info_id AS commodity_info_id_change
FROM commodity_info
WHERE commodity_info_title LIKE ? AND commodity_info_state=0  OR brand LIKE ?

)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
LEFT JOIN (
    SELECT commodity_info_id,COUNT(commodity_info_id) AS  comment_sum
    FROM commodity_comment_parent
    )c ON a.commodity_info_id=c.commodity_info_id
    LEFT JOIN (
        SELECT shop_name,shop_id AS sid
    FROM shop
    ) d ON a.shop_id=d.sid 

EOD;


public static $str81=<<<EOD
SELECT a.*,b.password
FROM `user` a LEFT JOIN user_password b ON a.user_id=b.user_id
WHERE a.user_id=?
EOD;

public static $str82=<<<EOD
SELECT a.*,b.password
FROM `user` a LEFT JOIN user_password b ON a.user_id=b.user_id
WHERE a.user_id=?
EOD;

public static $str83=<<<EOD
SELECT *
FROM commodity_collect a LEFT JOIN (
SELECT commodity_info_title,imgs,commodity_info_id,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity,
commodity_info.commodity_info_data
) AS info,commodity_info_state
FROM commodity_info
)  b ON a.commodity_id=b.commodity_info_id
WHERE user_id=?
EOD;

public static $str84=<<<EOD
SELECT *
FROM (
SELECT *
FROM commodity_collect a LEFT JOIN (
SELECT commodity_info_title,imgs,commodity_info_id,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity,
commodity_info.commodity_info_data
) AS info,commodity_info_state,shop_id,category_son_id_one,commodity_type_id
FROM commodity_info
)  b ON a.commodity_id=b.commodity_info_id
WHERE user_id=?
) a LEFT JOIN (
SELECT store_commodity_id,vip
FROM store_commodity
)b ON a.commodity_type_id=b.store_commodity_id
EOD;

public static $str85=<<<EOD
SELECT category_parent_id
FROM category_son
WHERE category_son_id=?
EOD;

public static $str86=<<<EOD
SELECT shop_name
FROM shop
WHERE shop_id=?
EOD;

public static $str87=<<<EOD
SELECT *
FROM discount 
WHERE `type` IN (0,?,-2) AND shop_id IS NULL
 AND portion_tf=1 AND NOW()<=end_time
EOD;

public static $str88=<<<EOD
SELECT *
FROM discount 
WHERE shop_id IS NOT NULL AND portion_tf=1 AND shop_id=? AND NOW()<=end_time 
EOD;

public static $str89=<<<EOD
SELECT *
FROM (SELECT *
FROM discount_son
WHERE discount_son_info=?) a LEFT JOIN discount b
ON a.discount_id=b.discount_id 
WHERE NOW()<=end_time
EOD;



public static $str90=<<<EOD
SELECT *
FROM user_discount
WHERE discount_id=? AND user_id=? 
EOD;

public static $str91=<<<EOD
SELECT SUM(`sum`) AS `sum`
FROM commodity_collect
WHERE user_id=?
EOD;


public static $str92=<<<EOD
SELECT *
FROM (
SELECT commodity_info_title,imgs,commodity_info_id,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity,
commodity_info.commodity_info_data
) AS info,commodity_info_state,shop_id,category_son_id_one
FROM commodity_info
) a RIGHT JOIN  discount_son b ON a.commodity_info_id=b.discount_son_info
WHERE discount_id=? AND discount_son_info=?
EOD;


public static $str93=<<<EOD
SELECT *
FROM vip
WHERE user_id=? AND NOW()<=vip_end_time
EOD;


public static $str94=<<<EOD
SELECT *
FROM (
SELECT *
FROM user_discount 
WHERE user_id=?
) a LEFT JOIN discount b ON a.discount_id=b.discount_id
WHERE a.discount_id=? AND repetition=0  AND NOW()<=b.end_time
EOD;


public static $str95=<<<EOD
SELECT *
FROM discount
WHERE discount_id=? AND NOW()<=end_time
EOD;


public static $str96=<<<EOD
SELECT commodity_info_data->'$.data[0].name' AS `name`
FROM commodity_info
WHERE commodity_info_id=?
EOD;

public static $str97=<<<EOD
SELECT *
FROM commodity_collect
WHERE user_id=? AND commodity_id=? AND `type`=?
EOD;

public static $str98=<<<EOD
SELECT *
FROM site
WHERE user_id=?
ORDER BY default_tf ASC
EOD;

public static $str99=<<<EOD
SELECT *
FROM site
WHERE user_id=? AND default_tf=0
ORDER BY default_tf ASC
EOD;

public static $str100=<<<EOD
SELECT *
FROM site
WHERE user_id=? AND site_id=?
ORDER BY default_tf ASC
EOD;


public static $str101=<<<EOD
SELECT integral
FROM money
WHERE user_id=?
EOD;

public static $str102=<<<EOD
SELECT *
FROM money
WHERE user_id=?
EOD;


public static $str103=<<<EOD
SELECT *
FROM user_password
WHERE user_id=? AND `character`=?
EOD;


public static $str104=<<<EOD
SELECT *
FROM (
SELECT *
FROM commodity_collect
WHERE user_id=? AND input=0
) a LEFT JOIN commodity_info
b ON a.commodity_id=b.commodity_info_id
WHERE NOW()<=commodity_info_activity_end_time AND NOW()>=commodity_info_activity_sent_time
EOD;

public static $str105=<<<EOD
SELECT store_commodity_data
FROM store_commodity
WHERE store_commodity_id=?
EOD;

public static $str106=<<<EOD
SELECT *
FROM user_commodity_comment_like
WHERE user_id=? AND son_tf=? AND tf_id=?
EOD;


public static $str107=<<<EOD
SELECT commodity_comment_parent_like,commodity_comment_parent_id
FROM commodity_comment_parent
WHERE commodity_comment_parent_id=?
EOD;


public static $str108=<<<EOD
SELECT commodity_comment_son_like,commodity_comment_son_id
FROM commodity_comment_son
WHERE commodity_comment_son_id=?
EOD;

public static $str109=<<<EOD
SELECT *
FROM (
SELECT *
FROM `user`
WHERE user_id=?
) a LEFT JOIN money b ON a.user_id=b.user_id
LEFT JOIN (
SELECT user_id AS change_user_id,COUNT(*) AS discount_sum
FROM user_discount
WHERE user_id=?
)c ON a.user_id=c.change_user_id LEFT JOIN (
SELECT COUNT(*) AS shop_like_sum,user_id AS change_change_user_id
FROM user_store_attention_like
WHERE user_id=?
) d ON a.user_id=d.change_change_user_id
EOD;


public static $str110=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent
WHERE user_id=?
ORDER BY send_time DESC
LIMIT 0,2
) a LEFT JOIN (
SELECT commodity_info_id,imgs,commodity_info_title
FROM commodity_info
) b ON a.cmm_id=b.commodity_info_id
EOD;

public static $str111=<<<EOD
SELECT COUNT(*) AS user_indent_p_sum
FROM indent
WHERE user_id=? AND evaluate_tf=0 AND state=2
EOD;

public static $str112=<<<EOD
SELECT *
FROM (
SELECT cmm_id
FROM indent
WHERE user_id=?
GROUP BY cmm_id 
)a LEFT JOIN (
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id
LIMIT 0,2
EOD;

public static $str113=<<<EOD
SELECT *
FROM (
SELECT cmm_id
FROM indent
WHERE user_id=?
GROUP BY cmm_id 
)a RIGHT JOIN commodity_issue_parent b
ON a.cmm_id=b.store_commodity_id LEFT JOIN (
SELECT commodity_info_id,imgs
FROM commodity_info
) c ON a.cmm_id=c.commodity_info_id LEFT JOIN (
SELECT nickname,user_id
FROM `user`
)d ON b.user_id=d.user_id LEFT JOIN (
SELECT COUNT(*) AS hui_sum,commodity_issue_id
FROM commodity_issue_son 
GROUP BY commodity_issue_id
)e ON  b.commodity_issue_id=e.commodity_issue_id
LIMIT 0,2
EOD;



public static $str114=<<<EOD
SELECT *
FROM (
SELECT store_commodity_id,vip
FROM store_commodity
WHERE vip IS NOT NULL
) a LEFT JOIN (
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
) b  ON a.store_commodity_id=b.commodity_type_id
LIMIT 0,12
EOD;



public static $str116=<<<EOD
SELECT COUNT(*) AS dai_sum
FROM indent
WHERE state<2 AND user_id=?
EOD;



public static $str117=<<<EOD
SELECT COUNT(*) AS dai_sum
FROM indent
WHERE state=1 AND user_id=?
EOD;

public static $str118=<<<EOD
SELECT COUNT(*) AS dai_sum
FROM indent
WHERE state IN (3,5,6,8) AND user_id=?
EOD;


public static $str119=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent
WHERE user_id=? AND send_time >=?
ORDER BY send_time DESC
) a LEFT  JOIN (
SELECT commodity_info_id,shop_id,imgs,commodity_info_title
FROM commodity_info
) b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_id,shop_name
FROM shop
)c ON b.shop_id=c.shop_id LEFT JOIN (
SELECT site_id,consignee
FROM site
)d ON a.site_id=d.site_id LEFT JOIN (
SELECT commodity_comment_parent_id,commodity_comment_parent_send_time,commodity_comment_parent_info_add_time,indent_id AS change_indent_id
FROM commodity_comment_parent
)e ON a.indent_id=e.change_indent_id
ORDER BY send_time DESC
EOD;


public static $str120=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent
WHERE indent_id=?
ORDER BY send_time DESC
) a LEFT  JOIN (
SELECT commodity_info_id,shop_id,imgs,commodity_info_title
FROM commodity_info
) b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_id,shop_name,shop_img
FROM shop
)c ON b.shop_id=c.shop_id  LEFT JOIN (
SELECT user_score,logistics_score,after_score,service_score,shop_id AS change_shop_id
FROM shop_info
) d ON c.shop_id=d.change_shop_id
EOD;

public static $str121=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent 
WHERE indent_id=?
) a LEFT JOIN commodity_info b ON a.cmm_id=b.commodity_info_id
EOD;


public static $str122=<<<EOD
SELECT *
FROM (
SELECT indent_id AS change_indent_id
FROM commodity_comment_parent
WHERE user_id=? AND commodity_comment_parent_info_add_time IS NULL
)a LEFT JOIN  (
SELECT *
FROM (
SELECT *
FROM indent
WHERE user_id=?
ORDER BY send_time DESC
) a LEFT  JOIN (
SELECT commodity_info_id,shop_id AS change_shop_id,imgs,commodity_info_title
FROM commodity_info
) b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_id,shop_name
FROM shop
)c ON b.change_shop_id=c.shop_id LEFT JOIN (
SELECT site_id AS change_site_id,consignee
FROM site
)d ON a.site_id=d.change_site_id
ORDER BY send_time DESC
)b ON a.change_indent_id=b.indent_id
EOD;

public static $str123=<<<EOD
SELECT *
FROM user_store_attention_like
WHERE user_id=? AND store_id=?
EOD;


public static $str124=<<<EOD
SELECT *
FROM commodity_info
WHERE commodity_info_id=?
EOD;


public static $str125=<<<EOD
SELECT *
FROM (
SELECT commodity_type_id
FROM commodity_info
WHERE commodity_info_id=?
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
)b ON a.commodity_type_id=b.store_commodity_id
EOD;

public static $str126=<<<EOD
SELECT *
FROM (
SELECT *
FROM user_store_attention_like
WHERE user_id=?
)a LEFT JOIN (
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE commodity_info_state=0 AND shop_id=?
) b ON a.store_id=b.shop_id LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
)c  ON b.commodity_type_id=c.store_commodity_id
WHERE imgs IS NOT NULL AND commodity_info_title IS NOT NULL
ORDER BY store_commodity_sum DESC
EOD;


public static $str127=<<<EOD
SELECT *
FROM (
SELECT *
FROM user_store_attention_like
WHERE user_id=? 
) a LEFT JOIN (
SELECT shop_id,shop_img,attention,shop_name
FROM shop
)b ON a.store_id=b.shop_id
EOD;



public static $str128=<<<EOD
SELECT attention,shop_id
FROM shop
WHERE shop_id=?
EOD;


public static $str129=<<<EOD
SELECT *
FROM (
SELECT discount_id,discount_state,user_discount_id
FROM user_discount
WHERE user_id=?
)a LEFT JOIN  discount b
ON a.discount_id=b.discount_id
EOD;


public static $str130=<<<EOD
SELECT *
FROM (
SELECT *
FROM discount a LEFT JOIN (
SELECT discount_id AS discount_id_change,TRUE AS tf,discount_state
FROM user_discount
WHERE user_id=?
)b ON a.discount_id=b.discount_id_change
WHERE sen_time<=NOW() AND end_time>NOW() AND portion_tf=1  AND shop_id IS NULL

EOD;

public static $str140=<<<EOD
)a LEFT JOIN (
    SELECT imgs,category_son_id_one,category_parent_id
    FROM commodity_info a LEFT JOIN (
    SELECT *
    FROM category_son
    )b ON a.category_son_id_one=b.category_son_id
    )b ON a.type=b.category_parent_id
    GROUP BY discount_id
EOD;



public static $str131=<<<EOD
SELECT *
FROM discount a LEFT JOIN (
SELECT discount_id AS discount_id_change,TRUE AS tf,discount_state
FROM user_discount
WHERE user_id=?
)b ON a.discount_id=b.discount_id_change
WHERE sen_time<=NOW() AND end_time>NOW() AND portion_tf=0
EOD;


public static $str132=<<<EOD
SELECT *
FROM (
SELECT *
FROM discount_son
WHERE discount_id=?
LIMIT 0,1
) a  LEFT JOIN commodity_info b
ON a.discount_son_info =b.commodity_info_id LEFT JOIN (
SELECT discount_id AS discount_id_change,TRUE AS tf,discount_state
FROM user_discount
WHERE user_id=?
) c ON a.discount_id=c.discount_id_change RIGHT JOIN (
SELECT *
FROM discount
WHERE sen_time<=NOW() AND end_time>NOW()
)d ON a.discount_id=d.discount_id
WHERE discount_son_id IS NOT NULL
EOD;


public static $str133=<<<EOD
SELECT *,'' AS img
FROM discount a LEFT JOIN (
SELECT discount_id AS discount_id_change,TRUE AS tf,discount_state
FROM user_discount
WHERE user_id=?
)b ON a.discount_id=b.discount_id_change
WHERE sen_time<=NOW() AND end_time>NOW() AND `type`=0 
EOD;


public static $str134=<<<EOD
SELECT *
FROM (
SELECT shop_type,shop_id
FROM shop
EOD;

public static $str136=<<<EOD
)a LEFT JOIN (
    SELECT *
    FROM discount a LEFT JOIN (
    SELECT discount_id AS discount_id_change,TRUE AS tf,discount_state
    FROM user_discount
    WHERE user_id=?
    )b ON a.discount_id=b.discount_id_change
    WHERE sen_time<=NOW() AND end_time>NOW()
    ) b ON a.shop_id=b.shop_id
EOD;


public static $str135=<<<EOD
SELECT *
FROM commodity_info
WHERE shop_id=?
Limit 0,1
EOD;


public static $str141=<<<EOD
SELECT *
FROM commodity_issue_parent
WHERE user_id=?
ORDER BY send_time DESC
EOD;

public static $str142=<<<EOD
SELECT *
FROM (
SELECT *
FROM commodity_issue_parent
WHERE user_id=?
)a LEFT JOIN (
SELECT user_id AS i,nickname
FROM `user`
)b ON a.user_id=b.i LEFT JOIN (
SELECT imgs,commodity_type_id
FROM commodity_info
) d ON a.store_commodity_id=d.commodity_type_id
GROUP BY commodity_issue_id
ORDER BY send_time DESC
EOD;

public static $str143=<<<EOD
SELECT *
FROM (
SELECT *
FROM commodity_issue_son
WHERE commodity_issue_id=?
ORDER BY send_time DESC
)a LEFT JOIN (
SELECT user_id AS i,nickname
FROM `user`
)b ON a.user_id=b.i
EOD;



public static $str144=<<<EOD
SELECT *
FROM (
SELECT *
FROM commodity_issue_parent
WHERE commodity_issue_id IN (
SELECT commodity_issue_id
FROM commodity_issue_son
WHERE user_id=?
)
)a LEFT JOIN (
SELECT user_id AS i,nickname
FROM `user`
)b ON a.user_id=b.i LEFT JOIN (
SELECT imgs,commodity_type_id
FROM commodity_info
) d ON a.store_commodity_id=d.commodity_type_id
GROUP BY commodity_issue_id
ORDER BY send_time DESC
EOD;



public static $str145=<<<EOD
SELECT *
FROM (
SELECT cmm_id
FROM indent
WHERE user_id=?
GROUP BY cmm_id 
)a RIGHT JOIN  (
    SELECT *,commodity_issue_id AS commodity_issue_id_change
    FROM commodity_issue_parent
    ) b 
ON a.cmm_id=b.store_commodity_id LEFT JOIN (
SELECT commodity_info_id,imgs
FROM commodity_info
) c ON a.cmm_id=c.commodity_info_id LEFT JOIN (
SELECT nickname,user_id
FROM `user`
)d ON b.user_id=d.user_id LEFT JOIN (
SELECT COUNT(*) AS hui_sum,commodity_issue_id
FROM commodity_issue_son 
GROUP BY commodity_issue_id
)e ON  b.commodity_issue_id=e.commodity_issue_id
WHERE b.user_id!=? AND hui_sum IS NULL
EOD;



public static $str146=<<<EOD
SELECT *
FROM (
SELECT indent_id AS id,indent_sum AS moeny,send_time AS `time`,1 AS tf,TRUE  AS`type`
FROM indent
WHERE pattern=0 AND user_id=? AND state IN(0,1,2)
UNION 
SELECT money_history_id AS id,money,sen_time AS `time`,tf,FALSE  AS`type`
FROM money_history
WHERE user_id=?
)a 
EOD;


public static $str147=<<<EOD
SELECT small_money
FROM money
WHERE user_id=?
EOD;



public static $str148=<<<EOD
SELECT *
FROM user_discount
WHERE user_discount_id=? AND user_id=?
EOD;



public static $str149=<<<EOD
SELECT *
FROM (
SELECT cash AS money,pay_time AS `time`,0 AS z,'购买商品积分支出' AS msg 
FROM indent
WHERE cash>1 AND user_id=?
UNION
SELECT integral AS money,pay_time AS `time`,1 AS z,'购买商品积分收入' AS msg
FROM indent
WHERE integral>1 AND user_id=? AND state=2
UNION
SELECT integral AS money,pay_time AS `time`,0 AS z,'退换货积分支出' AS msg
FROM indent
WHERE integral>1 AND user_id=? AND state IN (4,8,9,10)
UNION
SELECT 50 AS money, commodity_comment_parent_send_time AS `time`,1 AS z,'评价商品积分收入' AS msg
FROM commodity_comment_parent
WHERE user_id=? AND commodity_comment_parent_info_add_time IS NULL
UNION
SELECT 30 AS money, commodity_comment_parent_send_time AS `time`,1 AS z,'评价商品积分收入' AS msg
FROM commodity_comment_parent
WHERE user_id=? AND commodity_comment_parent_info_add_time IS NOT NULL
) a 
EOD;

public static $str150=<<<EOD
SELECT integral
FROM money
WHERE user_id=?
EOD;

public static $str151=<<<EOD
SELECT *
FROM indent
WHERE user_id=? AND indent_id=?
EOD;

public static $str152=<<<EOD
SELECT *
FROM app_money
WHERE shop_id=?
EOD;

public static $str153=<<<EOD
SELECT *
FROM (
SELECT cmm_id,indent_sum,cash
FROM indent
WHERE indent_id=?
)a LEFT JOIN (
SELECT shop_id,commodity_info_id
FROM commodity_info
) b ON a.cmm_id=b.commodity_info_id
EOD;

public static $str154=<<<EOD
SELECT shop_money,shop_jf
FROM shop_info
WHERE shop_id=?
EOD;


public static $str155=<<<EOD
SELECT *
FROM (
SELECT send_time,cmm_id,indent_id,state,`sum`
FROM indent
WHERE  send_time>=? AND   state IN (0,1,2)
AND user_id=?
)a LEFT JOIN (
SELECT commodity_info_id,shop_id,imgs,commodity_info_title
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_name,shop_id
FROM shop
)c ON b.shop_id=c.shop_id
ORDER BY send_time DESC
EOD;


public static $str156=<<<EOD
SELECT *
FROM (
SELECT send_time,cmm_id,indent_id,indent_sum,site_id,`sum`
FROM indent
WHERE user_id=? AND indent_id=?
)a LEFT JOIN (
SELECT commodity_info_id,shop_id,imgs,commodity_info_title
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id  LEFT JOIN 
site c ON a.site_id=c.site_id
EOD;

public static $str157=<<<EOD
SELECT *
FROM indent
WHERE indent_id=? AND user_id=? AND state IN (0,1,2)
EOD;


public static $str158=<<<EOD
SELECT *
FROM (
SELECT send_time,cmm_id,indent_id,state,sale_id,user_id
FROM indent
)a LEFT JOIN (
SELECT commodity_info_id,shop_id,commodity_info_title,imgs
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT send_time AS tui_send_time,sale_money,indet_sale_id
FROM indet_sale
) c ON a.sale_id=c.indet_sale_id
EOD;

public static $str159=<<<EOD
SELECT *
FROM (
SELECT send_time,cmm_id,indent_id,state,sale_id,indent_sum,`sum`
FROM indent
WHERE indent_id=? AND state>2
)a LEFT JOIN (
SELECT commodity_info_id,shop_id,commodity_info_title,imgs
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_id AS change_shop_id,shop_name
FROM shop
)c ON b.shop_id=c.change_shop_id LEFT JOIN (
SELECT *
FROM indet_sale
)e ON a.sale_id=e.indet_sale_id
EOD;

public static $str160=<<<EOD
SELECT *
FROM indent
WHERE indent_id=? AND state=3
EOD;

public static $str161=<<<EOD
SELECT *
FROM indent
WHERE indent_id=? AND state=5
EOD;


public static $str162=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent
WHERE indent_id=? AND state=6
)a LEFT JOIN (
SELECT commodity_info_id,shop_id
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_money,shop_jf,shop_id AS change_shop_id
FROM shop_info
)c ON b.shop_id=c.change_shop_id LEFT JOIN (
SELECT sale_money,indet_sale_id
FROM indet_sale
) d ON a.sale_id=d.indet_sale_id
EOD;

public static $str163=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent
WHERE indent_id=? AND state=5
)a LEFT JOIN (
SELECT commodity_info_id,shop_id
FROM commodity_info
)b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_money,shop_jf,shop_id AS change_shop_id
FROM shop_info
)c ON b.shop_id=c.change_shop_id LEFT JOIN (
SELECT sale_money,indet_sale_id
FROM indet_sale
) d ON a.sale_id=d.indet_sale_id
EOD;

public static $str164=<<<EOD
SELECT *
FROM indent
WHERE indent_id=? AND state>2
EOD;

public static $str164sdfsdfsdf=<<<EOD
SELECT *
FROM indent
WHERE indent_id=? AND state=0
EOD;


public static $str165=<<<EOD
SELECT *
FROM money
WHERE usre_id=?
EOD;

public static $str166=<<<EOD
SELECT *
FROM (
SELECT *
FROM indent
WHERE user_id=? AND indent_id=?
ORDER BY send_time DESC
) a LEFT  JOIN (
SELECT commodity_info_id,shop_id,imgs,commodity_info_title
FROM commodity_info
) b ON a.cmm_id=b.commodity_info_id LEFT JOIN (
SELECT shop_id,shop_name
FROM shop
)c ON b.shop_id=c.shop_id LEFT JOIN (
SELECT *
FROM site
)d ON a.site_id=d.site_id LEFT JOIN (
SELECT commodity_comment_parent_id,commodity_comment_parent_send_time,commodity_comment_parent_info_add_time,indent_id AS change_indent_id
FROM commodity_comment_parent
)e ON a.indent_id=e.change_indent_id
EOD;

public static $str167=<<<EOD
SELECT commodity_info_id,commodity_info_title,shop_id,
commodity_info_activity->'$.data[0].money' AS money,imgs
FROM commodity_info
WHERE category_son_id_one IN  (
SELECT category_son_id
FROM category_son
WHERE category_parent_id=?
) AND commodity_info_activity_sent_time< NOW() AND
commodity_info_activity_end_time>NOW() AND commodity_info_state=0
LIMIT ?,?
EOD;


public static $str168=<<<EOD
SELECT commodity_info_id,commodity_info_title,shop_id,
commodity_info_activity->'$.data[0].money' AS money,imgs
FROM commodity_info
WHERE  commodity_info_activity_sent_time< NOW() AND
commodity_info_activity_end_time>NOW() AND commodity_info_state=0
LIMIT ?,?
EOD;

public static $str169=<<<EOD
SELECT commodity_info_id,commodity_info_title,shop_id,
IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs
FROM commodity_info 
WHERE  commodity_info_state_time>? AND commodity_info_state=0
LIMIT ?,?
EOD;

public static $str170=<<<EOD
SELECT commodity_info_id,commodity_info_title,shop_id,
IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs
FROM commodity_info
WHERE category_son_id_one IN  (
SELECT category_son_id
FROM category_son
WHERE category_parent_id=?
) AND commodity_info_state<? AND commodity_info_state=0
LIMIT ?,?
EOD;


public static $str171=<<<EOD
SELECT *
FROM (
SELECT *
FROM shop_member
WHERE user_id=?
)a LEFT JOIN (
SELECT user_id AS change_user_id,`password`
FROM user_password
) b ON a.user_id=b.change_user_id
WHERE `password`=? AND user_id=?
EOD;

public static $str180=<<<EOD
SELECT *
FROM (
SELECT *
FROM shop_member
WHERE user_id=?
)a LEFT JOIN (
SELECT user_id AS change_user_id,`password`
FROM user_password
) b ON a.user_id=b.change_user_id
WHERE `password`=? AND user_id=?
EOD;

public static $str172=<<<EOD
SELECT *
FROM (
SELECT shop_id,attention
FROM shop
WHERE shop_id=?
)a LEFT JOIN (
SELECT user_score,logistics_score,after_score,service_score,shop_money,shop_jf,shop_id AS shop_id_change
FROM shop_info
)b ON a.shop_id=b.shop_id_change LEFT JOIN(
SELECT shop_id AS change_shop_id,money,jf
FROM app_money
)c ON a.shop_id=c.change_shop_id LEFT JOIN(
SELECT *
FROM (
SELECT COUNT(*) AS xiao_zong,SUM(indent_sum) xiao_sum,shop_id AS change_change_shop_id
FROM indent LEFT JOIN commodity_info ON indent.cmm_id=commodity_info.commodity_info_id
WHERE shop_id=? AND state<=2
)a
) d ON a.shop_id=d.change_change_shop_id LEFT JOIN (
SELECT shang_sum,a.s_id,xia_sum
FROM (
SELECT COUNT(*) AS shang_sum,shop_id AS s_id
FROM commodity_info
WHERE shop_id=?  AND commodity_info_state=0
)a LEFT JOIN (
SELECT COUNT(*) AS xia_sum,shop_id AS s_id
FROM commodity_info
WHERE shop_id=?  AND commodity_info_state=1
)b ON a.s_id=b.s_id
)e ON a.shop_id=e.s_id LEFT JOIN (
SELECT COUNT(*) AS tui_zong,SUM(indent_sum) AS tui_sum,shop_id AS change_change_shop_id_id
FROM indent LEFT JOIN commodity_info ON indent.cmm_id=commodity_info.commodity_info_id
WHERE shop_id=? AND state IN (4,10)
)f ON a.shop_id=f.change_change_shop_id_id LEFT JOIN (
SELECT COUNT(*) AS dai_zong,SUM(indent_sum) AS dai_sum,shop_id AS change_change_shop_id_id_id
FROM indent LEFT JOIN commodity_info ON indent.cmm_id=commodity_info.commodity_info_id
WHERE shop_id=? AND state IN (3,5,6,8)
)g ON a.shop_id=g.change_change_shop_id_id_id
EOD;



public static $str173=<<<EOD
SELECT *
FROM (
SELECT *
FROM shop_member
WHERE user_id=?
)a LEFT JOIN (
SELECT user_id AS change_user_id,`password`
FROM user_password
) b ON a.user_id=b.change_user_id
WHERE `password`=? AND user_id=?
EOD;



public static $str174=<<<EOD
SELECT COUNT(*) AS zong,SUM(indent_sum) AS he
FROM indent a LEFT JOIN (
SELECT shop_id,commodity_info_id
FROM commodity_info
) b ON  a.cmm_id=b.commodity_info_id
WHERE shop_id=? AND state  NOT IN (4,9)
EOD;


public static $str175=<<<EOD
SELECT COUNT(*) AS zong,SUM(indent_sum) AS he
FROM indent a LEFT JOIN (
SELECT shop_id,commodity_info_id
FROM commodity_info
) b ON  a.cmm_id=b.commodity_info_id
WHERE shop_id=? AND state   IN (4,9)
EOD;

public static $str176=<<<EOD
SELECT *,indent_id  AS `key`
FROM (
SELECT *
FROM indent a
WHERE cmm_id IN (
SELECT commodity_info_id
FROM commodity_info
WHERE shop_id=?
)
) a LEFT JOIN (
SELECT user_id,nickname
FROM `user`
) b ON a.user_id=b.user_id LEFT JOIN (
SELECT *
FROM site
) c ON a.site_id=c.site_id
ORDER BY send_time DESC
LIMIT ?,?
EOD;


public static $str177=<<<EOD
SELECT COUNT(*) AS zong
FROM (
SELECT *
FROM indent a
WHERE cmm_id IN (
SELECT commodity_info_id
FROM commodity_info
WHERE shop_id=?
)
) a LEFT JOIN (
SELECT user_id,nickname
FROM `user`
) b ON a.user_id=b.user_id
EOD;

public static $str178=<<<EOD
SELECT *,commodity_info_id AS `key`,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf
FROM commodity_info a LEFT JOIN (
SELECT shop_category_title,shop_category_SON,shop_category_id
FROM shop_category
) b ON a.shop_channel_id=b.shop_category_id
WHERE shop_id=?
ORDER BY commodity_info_state ASC
LIMIT ?,?
EOD;

public static $str179=<<<EOD
SELECT COUNT(*) AS `sum`
FROM commodity_info
WHERE shop_id=?
ORDER BY commodity_info_state ASC
EOD;




public static $str181=<<<EOD
SELECT IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf
FROM commodity_info
WHERE commodity_info_id=?
EOD;



public static $str182=<<<EOD
SELECT  shop_category_title AS label,shop_category_id AS `value`
FROM shop_category
WHERE shop_id=?
GROUP BY shop_category_title
EOD;

public static $str183=<<<EOD
SELECT  shop_category_SON AS label,shop_category_id AS `value`
FROM shop_category
WHERE shop_id=? AND shop_category_title=?
EOD;

public static $str184=<<<EOD
SELECT category_parent_title AS label,category_parent_id AS `value`
FROM category_parent
EOD;

public static $str185=<<<EOD
SELECT category_son_son_title AS label,category_son_son_id AS `value`
FROM category_son_son
WHERE category_parent_id=?
EOD;

public static $str186=<<<EOD
SELECT category_son_title AS label,category_son_id AS `value`
FROM category_son
WHERE category_son_lei=?
EOD;

public static $str187=<<<EOD
SELECT *
FROM commodity_info
WHERE commodity_info_id=?
EOD;

public static $str188=<<<EOD
SELECT *
FROM store_commodity
WHERE store_id=?
LIMIT ?,?
EOD;

public static $str189=<<<EOD
SELECT commodity_info_id
FROM commodity_info
WHERE commodity_type_id=?
EOD;


public static $str190=<<<EOD
SELECT commodity_info_id AS `value`,commodity_info_id AS `label`
FROM commodity_info
WHERE shop_id=?
EOD;

public static $str191=<<<EOD
SELECT *
FROM store_commodity
WHERE store_commodity_id=?
EOD;


public static $str192=<<<EOD
SELECT  shop_category_title AS label,shop_category_id AS `value`,shop_category_activity_img,shop_category_parent_brief
FROM shop_category
WHERE shop_id=?
GROUP BY shop_category_title
EOD;

public static $str193=<<<EOD
SELECT  shop_category_SON AS label,shop_category_id AS `value`,shop_category_img,shop_category_activity_img_son,shop_category_son_brief
FROM shop_category
WHERE shop_id=? AND shop_category_title=?
EOD;

public static $str194=<<<EOD
SELECT *
FROM shop
WHERE shop_id=?
EOD;


public static $str195=<<<EOD
SELECT shop_category_SON
FROM shop_category
WHERE shop_category_id=?
EOD;


public static $str196=<<<EOD
SELECT shop_category_title AS label,shop_category_id AS `value`
FROM shop_category
WHERE shop_id=?
GROUP BY shop_category_title
EOD;


public static $str197=<<<EOD
SELECT shop_category_SON AS label,shop_category_id AS `value`
FROM shop_category
WHERE shop_id=?
EOD;

public static $str198=<<<EOD
SELECT banner,banner_min,banner_info,shop_hard
FROM shop
WHERE shop_id=?
EOD;

public static $str199=<<<EOD
SELECT *
FROM discount
WHERE shop_id=?
ORDER BY sen_time DESC
EOD;

public static $str200=<<<EOD
SELECT discount_son_info AS `value`,discount_son_info AS label
FROM discount_son
WHERE discount_id=?
EOD;


public static $str201=<<<EOD
SELECT *
FROM shop_member_root
WHERE shop_id=? AND r_root>=?
EOD;

public static $str202=<<<EOD
SELECT *
FROM shop_member_root
WHERE shop_id=?
EOD;

public static $str203=<<<EOD
SELECT *
FROM (
SELECT *
FROM shop_member
WHERE shop_id=?
)a LEFT JOIN (
SELECT user_id AS user_id_change,nickname
FROM `user`
)b  ON a.user_id=b.user_id_change
ORDER BY shop_post ASC
EOD;


public static $str204=<<<EOD
SELECT *
FROM `user`
WHERE user_id=?
EOD;

public static $str205=<<<EOD
SELECT *
FROM shop_member
WHERE user_id=?
EOD;

//为提交订单中的秒杀数量
public static $str206=<<<EOD
SELECT *
FROM (
SELECT *
FROM seckill_time
WHERE NOW()>=send_time AND end_time>=NOW() 
)a LEFT JOIN seckill_time_info b ON a.seckill_time_id=b.seckill_time_id
WHERE commodity_info_id=?
EOD;

public static $str207=<<<EOD
SELECT  seckill_time_id AS `value`,CONCAT(send_time,'——',end_time) AS label,FALSE AS `show` 
FROM seckill_time
WHERE NOW()>=send_time AND end_time>=NOW()
ORDER BY send_time ASC
EOD;

public static $str208=<<<EOD
SELECT *
FROM (
SELECT *
FROM seckill_time_info
WHERE seckill_time_id=?
)a LEFT JOIN (
SELECT shop_id,commodity_info_id
FROM commodity_info
WHERE shop_id=?
)b ON a.commodity_info_id=b.commodity_info_id
EOD;

public static $str209=<<<EOD
SELECT commodity_info_data,commodity_info_activity,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,TRUE,FALSE) AS activity_tf
FROM commodity_info
WHERE commodity_info_id=?
EOD;

public static $str210=<<<EOD
SELECT shop_img,shop_type
FROM shop
WHERE shop_id=?
EOD;


public static $str211=<<<EOD
SELECT site,send_time
FROM shop_info
WHERE shop_id=?
EOD;



public static $str212=<<<EOD
SELECT category_parent_id AS `value`,category_parent_title AS label
FROM category_parent
EOD;


public static $str213=<<<EOD
SELECT shop_name
FROM shop
WHERE shop_id=?
EOD;

public static $str214=<<<EOD
SELECT nickname
FROM `user`
WHERE user_id=?
EOD;

public static $str215=<<<EOD
SELECT *
FROM (
SELECT *
FROM shop_member
WHERE shop_id=?
) a LEFT JOIN (
SELECT user_id AS user_id_change,fid
FROM user_password
) b ON a.user_id=b.user_id_change
WHERE fid IS NOT NULL 
EOD;

public static $str216=<<<EOD
SELECT *
FROM (
SELECT *
FROM shop_member
WHERE shop_id=?
) a LEFT JOIN (
SELECT user_id AS user_id_change,fid
FROM user_password
) b ON a.user_id=b.user_id_change
ORDER BY fid DESC
EOD;


public static $str217=<<<EOD
SELECT *
FROM user_password
WHERE user_id=? AND fid IS NOT NULL
EOD;

public static $str218=<<<EOD
SELECT *
FROM service_info
WHERE shop_id=? AND user_id=?
EOD;


public static $str219=<<<EOD
SELECT *
FROM (
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE category_son_id_one IN (
SELECT category_son_id
FROM category_son ) AND commodity_info_state=0
)a LEFT JOIN (
SELECT store_commodity_sum,store_commodity_id
FROM store_commodity
) b  ON a.commodity_type_id=b.store_commodity_id
LEFT JOIN (
SELECT commodity_info_id,COUNT(commodity_info_id) AS  comment_sum
FROM commodity_comment_parent
)c ON a.commodity_info_id=c.commodity_info_id
LEFT JOIN (
    SELECT shop_name,shop_id AS sid
    FROM shop
    ) d ON a.shop_id=d.sid
limit ?,?
EOD;

public static $str220=<<<EOD
SELECT user_id,nickname
FROM `user`
WHERE openid=?
EOD;


public static $str221=<<<EOD
SELECT `password`
FROM user_password
WHERE user_id=?
EOD;



public static $str222=<<<EOD
SELECT user_id,nickname
FROM `user`
WHERE iphone=?
EOD;


public static $str223=<<<EOD
SELECT *,IF(commodity_comment_like_id IS NOT NULL, TRUE, FALSE) AS user_like
FROM commodity_comment_parent a LEFT JOIN (
SELECT user_id,nickname,headimg,vip
FROM `user`
WHERE user_id IN (
SELECT user_id
FROM commodity_comment_parent
)
)b ON a.user_id=b.user_id LEFT JOIN (
SELECT `type`,indent_id
FROM indent
WHERE evaluate_tf=1
)c ON a.indent_id=c.indent_id LEFT JOIN (
SELECT user_id AS change_user_id,commodity_comment_like_id,tf_id
FROM user_commodity_comment_like
WHERE `type`=0 AND son_tf=0 AND user_id=1
) d ON a.commodity_comment_parent_id=d.tf_id
WHERE commodity_comment_parent_id=?
EOD;



public static $str224=<<<EOD
SELECT * 
FROM (SELECT attention,shop_id,shop_img,shop_name
FROM shop
WHERE shop_id=? )a
LEFT JOIN (
SELECT store_id,1 AS tf
FROM user_store_attention_like
WHERE user_id=?
)b ON a.shop_id=b.store_id
EOD;


public static $str225=<<<EOD
SELECT *
FROM stroll_index a LEFT JOIN (
SELECT user_id,nickname,headimg
FROM `user`
)b  ON a.user_id=b.user_id LEFT JOIN (
SELECT stroll_channel_son_id,stroll_channel_son_title
FROM stroll_channel_son
) c ON a.stroll_index_topic=c.stroll_channel_son_id
EOD;


public static $str226=<<<EOD
SELECT *
FROM stroll_channel_parent
EOD;

public static $str227=<<<EOD
SELECT *
FROM (
SELECT *
FROM stroll_index a LEFT JOIN (
SELECT user_id AS user_id_change,nickname,headimg
FROM `user`
)b  ON a.user_id=b.user_id_change LEFT JOIN (
SELECT *
FROM stroll_channel_son
) c ON a.stroll_index_topic=c.stroll_channel_son_id
WHERE stroll_index_id=?
) a LEFT JOIN (
SELECT user_id AS my_id,stroll_index_id AS my_collect
FROM user_stroll_collect
WHERE user_id=?
) b ON a.stroll_index_id=b.my_collect LEFT JOIN (
SELECT user_id AS my_my_id,stroll_index_id AS my_like
FROM user_stroll_like
WHERE user_id=?
) c ON  a.stroll_index_id=c.my_like LEFT JOIN(
SELECT *
FROM stroll_fans
WHERE  user_id=?
)d ON a.user_id=d.target_id
EOD;


public static $str228=<<<EOD
SELECT *
FROM (
SELECT *
FROM stroll_comment_parent
WHERE stroll_index_id=?
ORDER BY stroll_comment_parent_send_time DESC
) a LEFT JOIN (
SELECT user_id  AS change_user_id,nickname,headimg
FROM `user`
)b ON a.user_id=b.change_user_id LEFT JOIN (
SELECT *
FROM user_stroll_comment_like
WHERE user_id=? AND `type`=0
)c ON  a.stroll_comment_parent_id=c.change_id
EOD;

public static $str229=<<<EOD
SELECT *
FROM (
SELECT *
FROM stroll_comment_son
WHERE stroll_comment_parent_id=? 
ORDER BY stroll_comment_son_send_time DESC
) a LEFT JOIN (
SELECT user_id ,nickname,headimg
FROM `user`
)b ON a.user_id=b.user_id LEFT JOIN (
SELECT *
FROM user_stroll_comment_like
WHERE user_id=? AND `type`=1
)c ON  a.stroll_comment_son_id=c.change_id LEFT JOIN (
SELECT user_id AS taget_user_id,nickname AS target_nickname,headimg AS target_headimg
FROM `user` 
) d ON a.target_id=d.taget_user_id
EOD;

public static $str230=<<<EOD
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE commodity_info_state=0 AND commodity_info_id=?
EOD;

public static $str231=<<<EOD
SELECT *
FROM user_stroll_collect
WHERE user_id=? AND stroll_index_id=?
EOD;

public static $str232=<<<EOD
SELECT *
FROM stroll_fans
WHERE user_id=? AND target_id=?
EOD;

public static $str233=<<<EOD
SELECT *
FROM user_stroll_like
WHERE user_id=? AND stroll_index_id=?
EOD;

public static $str234=<<<EOD
SELECT *
FROM user_stroll_comment_like
WHERE user_id=? AND change_id=? AND `type`=0
EOD;


public static $str235=<<<EOD
SELECT *
FROM user_stroll_comment_like
WHERE user_id=? AND change_id=? AND `type`=1
EOD;

public static $str236=<<<EOD
SELECT *
FROM stroll_comment_parent
WHERE stroll_comment_parent_id=?
EOD;


public static $str237=<<<EOD
SELECT *
FROM stroll_comment_son
WHERE stroll_comment_son_id=?
EOD;

public static $str238=<<<EOD
SELECT *
FROM stroll_channel_son
WHERE stroll_channel_son_id=?
EOD;

public static $str239=<<<EOD
SELECT *
FROM stroll_index a LEFT JOIN (
SELECT user_id,nickname,headimg
FROM `user`
)b  ON a.user_id=b.user_id LEFT JOIN (
SELECT stroll_channel_son_id,stroll_channel_son_title
FROM stroll_channel_son
) c ON a.stroll_index_topic=c.stroll_channel_son_id
WHERE stroll_index_topic=?
EOD;

public static $str240=<<<EOD
SELECT SUM(look_sum) AS look_sum ,COUNT(*) AS participation
FROM stroll_index
WHERE stroll_index_topic=?
EOD;

public static $str241=<<<EOD
SELECT *
FROM (
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
WHERE commodity_info_title LIKE ?
) a LEFT JOIN (
SELECT shop_id,shop_name
FROM shop
) b ON a.shop_id=b.shop_id
LIMIT ?,?
EOD;

public static $str242=<<<EOD
SELECT *
FROM (
SELECT commodity_info_id,commodity_info_id AS commodity_info_id_change,commodity_type_id,commodity_info_title,IF (commodity_info_activity_sent_time< NOW()
AND NOW()<commodity_info_activity_end_time,commodity_info.commodity_info_activity ->'$.data[0].money',
commodity_info.commodity_info_data ->'$.data[0].money'
) AS money,imgs,shop_id
,commodity_info_state_time,brand
FROM commodity_info
) a LEFT JOIN (
SELECT shop_id,shop_name
FROM shop
) b ON a.shop_id=b.shop_id
WHERE commodity_info_id IN (
SELECT cmm_id
FROM indent 
WHERE user_id=?
GROUP BY cmm_id 
)
LIMIT ?,?
EOD;


public static $str243=<<<EOD
SELECT *
FROM stroll_channel_son
EOD;


public static $str244=<<<EOD
SELECT *
FROM (
SELECT user_id AS my_id,stroll_index_id
FROM user_stroll_collect
WHERE user_id=?
)a  LEFT JOIN (
SELECT *
FROM stroll_index
)b ON a.stroll_index_id=b.stroll_index_id  LEFT JOIN (
SELECT stroll_channel_son_id,stroll_channel_son_title
FROM stroll_channel_son
) c ON b.stroll_index_topic=c.stroll_channel_son_id  LEFT JOIN (
    SELECT nickname,user_id,headimg
    FROM `user`
    )d ON b.user_id=d.user_id
EOD;


public static $str245=<<<EOD
SELECT target_id
FROM stroll_fans
WHERE user_id=?
EOD;


public static $str246=<<<EOD
SELECT COUNT(*) AS indesum
FROM stroll_index
WHERE user_id=?
EOD;

public static $str247=<<<EOD
SELECT COUNT(*) AS fenesi
FROM stroll_fans
WHERE target_id=?
EOD;

public static $str248=<<<EOD
SELECT *
FROM (
SELECT *
FROM stroll_comment_parent
WHERE user_id=?
)a LEFT JOIN(
SELECT *
FROM stroll_index
)b ON a.stroll_index_id=b.stroll_index_id  LEFT JOIN (
    SELECT nickname,user_id,headimg
    FROM `user`
    )d ON b.user_id=d.user_id
EOD;

public static $str249=<<<EOD
SELECT nickname,headimg
FROM `user`
WHERE user_id=?
EOD;

public static $str250=<<<EOD
SELECT COUNT(*) AS fensi
FROM stroll_fans
WHERE target_id=?
EOD;


public static $str251=<<<EOD
SELECT COUNT(*) AS `like`
FROM stroll_fans
WHERE user_id=?
EOD;

public static $str252=<<<EOD
SELECT SUM(stroll_index_like)  AS zan
FROM stroll_index
WHERE user_id=?
EOD;


public static $str253=<<<EOD
SELECT SUM(stroll_index_like)  AS zan
FROM stroll_index
WHERE user_id=?
EOD;


public static $str254=<<<EOD
SELECT *
FROM (
select *
from stroll_index
where user_id=?

) a LEFT JOIN (
SELECT user_id,nickname,headimg
FROM `user`
)b  ON a.user_id=b.user_id LEFT JOIN (
SELECT stroll_channel_son_id,stroll_channel_son_title
FROM stroll_channel_son
) c ON a.stroll_index_topic=c.stroll_channel_son_id
LIMIT ?,?
EOD;

public static $str255=<<<EOD
SELECT nickname,headimg
FROM `user`
WHERE user_id=?
EOD;


public static $str256=<<<EOD
SELECT COUNT(*) AS guan
FROM user_store_attention_like
WHERE user_id=?
EOD;

public static $str257=<<<EOD
SELECT COUNT(*) AS guan
FROM user_discount
WHERE discount_state=0 AND sent_time<NOW() AND end_time>NOW() AND user_id=?
EOD;



}