<?php
namespace app\root\controller;
class Sql
{
    public static $str1=<<<EOD
    SELECT *,a.student_id stid,a.id `key`
    FROM (
    SELECT *
    FROM student 
    WHERE class_grade_id= (
    SELECT class_grade_id
    FROM student
    WHERE student_id=?
    )) a LEFT JOIN (
    SELECT student_name,student_id,student_sex
    FROM student_info
    )b ON a.student_id=b.student_id LEFT JOIN student_class_post c
    ON a.student_id=c.student_id  LEFT JOIN student_post d ON c.student_post_id=d.id
    EOD;
}