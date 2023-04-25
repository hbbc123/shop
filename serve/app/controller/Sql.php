<?php
namespace app\controller;

class Sql{
public static $str1=<<<EOD
SELECT *
FROM (
SELECT a.user_id,c.read_tf
FROM (
SELECT user_id
FROM service_info
WHERE shop_id=?
GROUP BY user_id) a LEFT JOIN (
SELECT user_id AS user_id_change,nickname,headimg
FROM `user`
)b ON a.user_id=b.user_id_change LEFT JOIN (
SELECT user_id AS user_id_change_c,read_tf
FROM service_info
WHERE read_tf=1 AND `both`=1
)c ON a.user_id=c.user_id_change_c
GROUP BY a.user_id
) a LEFT JOIN (
SELECT user_id AS user_change_id,nickname,headimg
FROM `user`
) b ON a.user_id=b.user_change_id
ORDER BY read_tf DESC
EOD;

public static $str2=<<<EOD
SELECT *
FROM (
SELECT *
FROM service_info
WHERE shop_id=? AND user_id=?
ORDER BY send_time ASC
)a LEFT JOIN (
SELECT user_id AS service_user_id,nickname AS service_nickname, headimg AS service_headimg
FROM `user`
)b ON a.service_id=b.service_user_id
 LEFT JOIN (
SELECT user_id AS user_user_id,nickname AS user_nickname, headimg AS user_headimg
FROM `user`
)c ON a.user_id=c.user_user_id
ORDER BY send_time ASC
EOD;


public static $str3=<<<EOD
SELECT *
FROM (
SELECT *
FROM service_info
WHERE shop_id=? AND user_id=?
ORDER BY send_time ASC
)a LEFT JOIN (
SELECT user_id AS service_user_id,nickname AS service_nickname, headimg AS service_headimg
FROM `user`
)b ON a.service_id=b.service_user_id
WHERE read_tf=1
EOD;


public static $str4=<<<EOD
SELECT *
FROM (
SELECT a.user_id,c.read_tf,a.shop_id
FROM (
SELECT user_id,shop_id
FROM service_info
WHERE user_id=?
GROUP BY shop_id) a LEFT JOIN (
SELECT user_id AS user_id_change,nickname,headimg
FROM `user`
)b ON a.user_id=b.user_id_change LEFT JOIN (
SELECT user_id AS user_id_change_c,read_tf
FROM service_info
WHERE read_tf=1 AND `both`=0
)c ON a.user_id=c.user_id_change_c
GROUP BY a.shop_id
) a LEFT JOIN (
SELECT shop_img,shop_name,shop_id
FROM shop
) b  ON  a.shop_id=b.shop_id
EOD;



public static $str5=<<<EOD
SELECT fid
FROM user_password
WHERE user_id=? AND fid IS NOT NULL
EOD;

public static $str6=<<<EOD
SELECT fid
FROM (
SELECT *
FROM shop_member
WHERE shop_id=?
) a LEFT JOIN user_password b
ON a.user_id=b.user_id
WHERE fid IS NOT NULL
EOD;


public static $str7=<<<EOD
SELECT *
FROM service_info
WHERE shop_id=? AND user_id=? AND read_tf=1 AND `both`=0
EOD;

public static $str8=<<<EOD
SELECT *
FROM service_info
WHERE shop_id=? AND user_id=? AND read_tf=1 AND `both`=1
EOD;


}