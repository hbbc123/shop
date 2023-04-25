<?php
namespace app\app\controller;
class Sql
{
    public static  $str=<<<EOD
    SELECT a.teacher_name,c.name ,d.name ,a.teacher_id,e.politics_post_name
        FROM (
            SELECT f.teacher_name,f.teacher_id
            FROM teacher e LEFT  JOIN(
            SELECT teacher_id,teacher_name
            FROM teacher_info
            ) f ON  e.teacher_id=f.teacher_id
        ) a  LEFT JOIN (
            SELECT b.`name`,a.teacher_id
            FROM teacher a LEFT JOIN(
            SELECT id,`name`
            FROM department
            ) b ON  
            a.department_id=b.id

        )c  ON a.teacher_id=c.teacher_id LEFT JOIN (
                SELECT c.teacher_id ,d.name
                FROM teacher c LEFT JOIN(
                SELECT id,`name`
                FROM department_specialty
                ) d ON c.specialty_id=d.id 

        )d ON a.teacher_id=d.teacher_id LEFT JOIN (
                SELECT b.politics_post_name,a.teacher_id
                FROM politics_info a LEFT JOIN (
                SELECT politics_post_name,id
                FROM politics_post
                ) b ON a.politics_post=b.id
        )e ON a.teacher_id=e.teacher_id
        WHERE d.name='院团委办公室' AND e.politics_post_name  IS NULL
    EOD; 


}