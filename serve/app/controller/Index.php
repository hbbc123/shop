<?php
namespace app\controller;

use think\facade\Db;
use app\controller\Sql;
use think\response\Json;
class Index 
{
    public  function index(){
        return 456;
    }
    public  static function add_fd($user_id=false,$shop_id,$fd=false){//商家添加fd并获取聊天内容
        $res=Db::query(Sql::$str1,[$shop_id]);
        if($fd){
            Db::name('user_password')
            ->where('user_id', $user_id)
            ->update(['fid' => $fd]);
        }
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                $m=Db::query(Sql::$str8,[$shop_id,$v['user_id']]);
                if(sizeOf($m)>0){
                    $res[$k]['read_tf']=1;
                }else {
                    $res[$k]['read_tf']=false;
                }
            }
        }
        $data['type']=2;
        $data['data']=$res;
        return json_encode($data,320);
    }

    public static function del_fd($fd){//删除连接的fd
        Db::name('user_password')
        ->where('fid', $fd)
        ->update(['fid' => null]);
    }

    public static function list_look($user_id,$shop_id,$type){//查看具体的聊天内容
        $res=Db::query(Sql::$str2,[$shop_id,$user_id]);
        $s=Db::query(Sql::$str3,[$shop_id,$user_id]);
        $data['type']=3;
        $data['data']=$res;
        if(sizeOf($s)>0){
            foreach ($s as $k => $v) {
                $t=0;
                if($type==0||$type=='0'){
                    $t=1;
                }
                Db::name('service_info')
                ->where([
                    'service_info_id'=>$v['service_info_id'],
                    'both'=>$t
                ])
                ->update(['read_tf' =>0]);
            }
        }
        return json_encode($data,320);
    }

    public static function user_add_fd($user_id,$fd=false){//获取客户的聊天列表 并添加fd
        $res=Db::query(Sql::$str4,[$user_id]);
        if($fd){
            Db::name('user_password')
            ->where('user_id', $user_id)
            ->update(['fid' => $fd]);
        }
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                $m=Db::query(Sql::$str7,[$v['shop_id'],$user_id]);
                if(sizeOf($m)>0){
                    $res[$k]['read_tf']=1;
                }else {
                    $res[$k]['read_tf']=false;
                }
            }
        }
        $data['type']=4;
        $data['data']=$res;
        return json_encode($data,320);
    }

    public static function getfid($user_id){
        $res=Db::query(Sql::$str5,[$user_id]);
        if(sizeOf($res)>0){
            return $res[0]['fid'];
        }else {
            return false;
        }
    }

    public static function getshopfid($shop_id){
        $res=Db::query(Sql::$str6,[$shop_id]);
        return $res;
    }


   
}
