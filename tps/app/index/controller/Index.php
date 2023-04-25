<?php
declare(strict_types = 1)
;

namespace app\index\controller;
use think\facade\Db;
use app\index\controller\Sql;
class Index
{
public function index($begin=0,$limit=25){
    $data=Db::query(Sql::$str1,[$begin,$limit]);
    return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
}

public function hot_word($begin=false,$limit=false){
    if(!$begin||!$limit){
        $data=Db::table('category_son')->select();
    }else {
        $data=Db::query(Sql::$str2,[$begin,$limit]);
    }
    $data=Db::query(Sql::$str2,[$begin,$limit]);
    return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
}

public function broadside(){
    $data=Db::query(Sql::$str4);
    for ($i=0; $i <sizeOf($data); $i++) { 
        $data[$i]['data']=Db::query(Sql::$str3,[$data[$i]['category_parent_id']]);
        for($j=0;$j<sizeOf($data[$i]['data']);$j++){
            $data[$i]['data'][$j]['data']=Db::query(Sql::$str5,[$data[$i]['data'][$j]['category_son_son_id']]);
        }
    }
    return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
}

public function banner(){
   $data=Db::query(Sql::$str6);
   for ($i=0; $i <sizeOf($data) ; $i++) {
         switch ($data[$i]['type']){
        case 1:
            $data[$i]['data']=Db::query(Sql::$str7,[$data[$i]['chang_id']])[0];
            $data[$i]['data']['imgs']=[$data[$i]['data']['category_parent_img']];
            $data[$i]['msg']='平台频道';
            break;
        case 2:
            $data[$i]['data']=Db::query(Sql::$str8,[$data[$i]['chang_id']])[0];
            $data[$i]['data']['imgs']=[$data[$i]['data']['category_son_son_img']];
            $data[$i]['msg']='平台子频道';
            break;
        case 3:
            $data[$i]['data']=Db::query(Sql::$str10,[$data[$i]['chang_id']])[0];
            $data[$i]['data']['imgs']=[$data[$i]['data']['index_img']];
            $data[$i]['msg']='店铺首页';
            break;
        case 4:
            $data[$i]['data']=Db::query(Sql::$str9,[$data[$i]['chang_id']])[0];
        if($data[$i]['data']['imgs']){
            $data[$i]['data']['imgs']=json_decode($data[$i]['data']['imgs']);
        }
        if($data[$i]['data']['videos']){
            $data[$i]['data']['videos']=json_decode($data[$i]['data']['videos']);
        }
            $data[$i]['msg']='商品';
            break;
        case 5 :
            $data[$i]['data']=Db::query(Sql::$str11,[$data[$i]['chang_id']])[0];
            $data[$i]['data']['imgs']=[$data[$i]['data']['category_son_activity_img']];
            $data[$i]['msg']='平台子频道类别分类';
            break;
        default:;
        }
   }
   $arr=['banner'=>[],'banner_min'=>[],'list'=>[]];
   foreach ($data as $k => $v) {
   switch($v['app_home_weight']){
    case 0: array_push($arr['banner'],$v);  break;
    case 1: array_push($arr['banner_min'],$v); break;
    case 2: array_push($arr['list'],$v);  break;
   }
   }
   $big_son=[];
   $son=[];
   foreach ($arr['banner_min'] as $k => $v) {
        if($k%4==0&&$k!=0){
            array_push($big_son,$son);
            $son=[];
        }else {
            array_push($son,$v);
        }
        if(sizeOf($arr['banner_min'])%4!=0&&$k==sizeOf($arr['banner_min'])-1){
            $son=[];
            for ($i=0; $i <sizeOf($arr['banner_min'])%4; $i++) { 
                array_push($son,$arr['banner_min'][$k-$i]);
            }
            array_push($big_son,$son);
        }
    }
   $arr['banner_min']=$big_son;
   
   return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function seckill($limit=2){
    $data=Db::query(Sql::$str12,[$limit]);
    if(sizeOf($data)>0){
        foreach ($data as $k => $v) {
            $data[$k]['commodity_info_activity']=json_decode($data[$k]['commodity_info_activity']);
            $data[$k]['commodity_info_data']=json_decode($data[$k]['commodity_info_data']);
            $data[$k]['imgs']=json_decode($data[$k]['imgs']);
            $data[$k]['videos']=json_decode($data[$k]['videos']);
        }
        $big_son=[];
        $son=[];
        foreach ($data as $k => $v) {
             if($k%5==0&&$k!=0){
                 array_push($big_son,$son);
                 $son=[];
             }else {
                 array_push($son,$v);
             }
             if(sizeOf($data)%5!=0&&$k==sizeOf($data)-1){
                 $son=[];
                 for ($i=0; $i <sizeOf($data)%5; $i++) { 
                     array_push($son,$data[$k-$i]);
                 }
                 array_push($big_son,$son);
             }
         }
        $data=$big_son;
        return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
    }
}
public function plate($limit=4,$day=7){
    $data=[];
    $data['special']=Db::query(Sql::$str13,[$limit]);
    foreach ($data['special'] as $key => $value) {
        $data['special'][$key]['commodity_info_data']=json_decode($data['special'][$key]['commodity_info_data']);
        $data['special'][$key]['commodity_info_activity']=json_decode($data['special'][$key]['commodity_info_activity']);
        $data['special'][$key]['imgs']=json_decode($data['special'][$key]['imgs']);
    }
    $data['newproduct']=Db::query(Sql::$str14,[$day,$limit]);
    foreach ($data['newproduct'] as $key => $value) {
        $data['newproduct'][$key]['commodity_info_data']=json_decode($data['newproduct'][$key]['commodity_info_data']);
        if($data['newproduct'][$key]['commodity_info_activity']){
            $data['newproduct'][$key]['commodity_info_activity']=json_decode($data['newproduct'][$key]['commodity_info_activity']);
        }
        $data['newproduct'][$key]['imgs']=json_decode($data['newproduct'][$key]['imgs']);
    }
    $data['goodshoop']=Db::query(Sql::$str15,[$limit]);
    $arr=Db::query(Sql::$str16,[$limit]);
    if(sizeOf($arr)>0){
        foreach ($arr as $k => $v) {
            switch ($v['type']) {
                case 0:
                    $arr[$k]['msg']='全频道券';
                    $arr[$k]['img']=Db::query(Sql::$str17)[0]['category_son_img'];
                    break;
                case -1:
                    if($v['portion_tf']==0){
                        $arr[$k]['msg']='店铺通用券';
                    }else {
                        $arr[$k]['msg']='店铺部分商品券';
                    }
                    $son=json_decode(Db::query(Sql::$str18,[$v['shop_id']])[0]['imgs']);
                    $arr[$k]['img']=$son[0];
                    break;
                case -2:
                    $arr[$k]['msg']='运费券';
                    $arr[$k]['img']='自己找图片';
                    break;
                default:
                $son=Db::query(Sql::$str19,[$v['type']]);
                $arr[$k]['img']=$son[0]['category_son_img'];
                    break;
            }
        }
        $data['ticket']=$arr;
    }else {
        $data['ticket']=[];
    }
    return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
}

public function getchannels($limit=10){
    $res=Db::query(Sql::$str20,[$limit]);
    if(sizeOf($res)>0){
        foreach ($res as $k => $v) {
            $son=Db::query(Sql::$str21,[$v['category_parent_id']]);
            $res[$k]['son']=$son;
        }
    }
    return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
}



public function commodityinfo($id,$tf=true){//要改*   获取商品详情页数据
    $arr=[];
    $shop_p=[];
    if($tf!='false'||$tf===true){
        $shop_p=Db::query(Sql::$str22,[$id]);
    }else if($tf==false||$tf=='false'){
        $shop_p=Db::query(Sql::$qwer78945,[$id]);
    }
    if(sizeOf($shop_p)>0){
        foreach ($shop_p as $k => $v) {
            $shop_p[$k]['son']=Db::query(Sql::$str23,[$v['shop_category_title']]);
        }
        $arr['channel']=$shop_p;//存放店铺频道
    }
    if($tf!='false'||$tf===true){
        $shop_hard=Db::query(Sql::$str24,[$id]);
        if($shop_hard[0]['shop_hard']){
            $shop_hard=json_decode($shop_hard[0]['shop_hard']);
            $shop_hard_arr=[$shop_hard];
            if(sizeOf($shop_hard)>0){
                $son_arr=[];
                foreach ($shop_hard as $k => $v) {
                    $shop_hard_arr=Db::query(Sql::$str25,[$v]);
                    $shop_hard_arr[0]['imgs']=json_decode($shop_hard_arr[0]['imgs']);
                    array_push($son_arr,$shop_hard_arr[0]);
                }
                 $arr['shop_hard']=$son_arr; //存放店铺力推
            }
        }
    }else if($tf==false||$tf=='false'){
        $shop_hard=Db::query(Sql::$str2weqrssdfsdf,[$id]);
        if($shop_hard[0]['shop_hard']){
            $shop_hard=json_decode($shop_hard[0]['shop_hard']);
            $shop_hard_arr=[$shop_hard];
            if(sizeOf($shop_hard)>0){
                $son_arr=[];
                foreach ($shop_hard as $k => $v) {
                    $shop_hard_arr=Db::query(Sql::$str25,[$v]);
                    $shop_hard_arr[0]['imgs']=json_decode($shop_hard_arr[0]['imgs']);
                    array_push($son_arr,$shop_hard_arr[0]);
                }
                 $arr['shop_hard']=$son_arr; //存放店铺力推
            }
        }
    }
    if($tf!='false'||$tf===true){
        $shop_hot=Db::query(Sql::$str26,[$id]);
    $arr['shop_hot']=$shop_hot;  //存放店铺搜索热词
    }else if($tf==false||$tf=='false'){
        $shop_hot=Db::query(Sql::$gdfhfgj,[$id]);
        $arr['shop_hot']=$shop_hot;  //存放店铺搜索热词
    }



    if($tf!='false'||$tf===true){
        $arr['shop_id']=Db::query(Sql::$str52,[$id])[0]['shop_id'];  //存放店铺ID
    }else if($tf==false||$tf=='false'){
        $arr['shop_id']=$id;
    }
    if($tf!='false'||$tf===true){
        $arr['shop_img']=Db::query(Sql::$str53,[$id])[0]['shop_img'];  //存放店铺logo
    }else if($tf==false||$tf=='false'){
        $arr['shop_img']=Db::query(Sql::$sdfsdfdkfg,[$id])[0]['shop_img'];  //存放店铺logo
    }

    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function commoditychange($id){//获取商品改变需要的内容
  $shop_change=Db::query(Sql::$str33,[$id])[0];
  if($shop_change['imgs']){
    $shop_change['imgs']=json_decode($shop_change['imgs']);
  }
  if($shop_change['videos']){
    $shop_change['videos']=json_decode($shop_change['videos']);
  }
  if($shop_change['commodity_info_brief']){
    $shop_change['commodity_info_brief']=json_decode($shop_change['commodity_info_brief']);
  }
  if($shop_change['commodity_info_data']){
    $shop_change['commodity_info_data']=json_decode($shop_change['commodity_info_data']);
  }
  if($shop_change['commodity_info_activity']){
    $shop_change['commodity_info_activity']=json_decode($shop_change['commodity_info_activity']);
  }
  if($shop_change['commodity_info_img']){
    $shop_change['commodity_info_img']=json_decode($shop_change['commodity_info_img']);
  }
  return $shop_change;
}


public function candidate($value){ //获取搜索候选关键字
    $str='%'.$value.'%';
    $res_one=Db::query(Sql::$str38,[$str]);
    $res_two=Db::query(Sql::$str39,[$str]);
    $res_three=Db::query(Sql::$str40,[$str]);
    $res=array_merge_recursive($res_one,$res_two,$res_three);
    return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
}


public function getgoos($id,$user_id=-1){  //获取商品选专业banner数据
    $arr=[];
    $shop_commodity=Db::query(Sql::$str31,[$id])[0];
    if(cookie('u')){
        $user_id=base64_decode(cookie('u'));
    }
    if($shop_commodity['store_commodity_data']){
        $shop_commodity['store_commodity_data']=json_decode($shop_commodity['store_commodity_data'],true);
    }
    if($shop_commodity['store_commodity_data']){
        foreach ($shop_commodity['store_commodity_data']['data'] as $k=> $v) {
          $son=Db::query(Sql::$str32,[$v['commodity_info_id']])[0];
          $son['imgs']=json_decode($son['imgs']);
          $shop_commodity['store_commodity_data']['data'][$k]['img']=$son;
        }
         $arr['commodity']=$shop_commodity;//存放选择类型
    }else {
        $arr['commodity']=$shop_commodity;
    }
    $shop_p=Db::query(Sql::$str22,[$id]);
    if(sizeOf($shop_p)>0){
        foreach ($shop_p as $k => $v) {
            $shop_p[$k]['son']=Db::query(Sql::$str23,[$v['shop_category_title']]);
        }
        $arr['channel']=$shop_p;//存放店铺频道
    }

    $arr['site']=Db::query(Sql::$str41,[$id])[0];//存放商品所在频道路由
    $arr['site']['brand']=Db::query(Sql::$str42,[$id])[0]['brand'];
    $son_recommend=Db::query(Sql::$str43,[$id]);
    if(sizeOf($son_recommend)>0){
        foreach ($son_recommend as $key => $value) {
            if($son_recommend[$key]['imgs']){
                $son_recommend[$key]['imgs']=json_decode($son_recommend[$key]['imgs']);
            }
            if($son_recommend[$key]['commodity_info_data']){
                $son_recommend[$key]['commodity_info_data']=json_decode($son_recommend[$key]['commodity_info_data']);
            }
            if($son_recommend[$key]['commodity_info_activity']){
                $son_recommend[$key]['commodity_info_activity']=json_decode($son_recommend[$key]['commodity_info_activity']);
            }
        }
        $arr['recommend']=$son_recommend; //存放相似推荐
    }else {
        $arr['recommend']=[];
    }
    $arr['shop_info']=Db::query(Sql::$str37,[$id])[0];
    //存放商品优惠券
    $arr['discount']=[];
    $discount_one=Db::query(Sql::$str35,[$id]);
    if(sizeOf($discount_one)>0){
        foreach ($discount_one as $key => $value) {
        array_push($arr['discount'],$value);
        }
    }
    $discount_two=Db::query(Sql::$str36,[$id]);
    if(sizeOf($discount_two)>0){
        foreach ($discount_two as $key => $value) {
        array_push($arr['discount'],$value);
        }
    }
    $arr['commoditychange']=Index::commoditychange($id);//存放已选择类型的内容
    $arr['comment_number']=Db::query(Sql::$str34,[$id])[0]['comment_number'];//存放商品评论

    $shop_like=Db::query(Sql::$str27,[$user_id,$id]);
    $shop_like_change=[];
    if(sizeOf($shop_like)>0){
        $shop_like_change['shop_id']=$shop_like[0]['store_id'];
        $shop_like_change['shop_like']=true;
    }else {
        $shop_like_change['shop_id']=Db::query(Sql::$str28,[$id])[0]['shop_id'];
        $shop_like_change['shop_like']=false;
    }
    $arr['shop_like']=$shop_like_change; //存放用户是否关注该店铺

    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);

}

public function commoditynum($id,$present=false){
    $arr=[];

    if($present=='true'){
        $all=Db::query(Sql::$str45,[$id]);
        $arr=$all[0];
    }else {
        $all=Db::query(Sql::$str44,[$id]);
        $arr=$all[0];
    }
    
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function commoditytitle($id,$present='false',$order=0,$select=0,$limit=2,$offset=0,$user_id=-1){
    $arr=[];
    $str='';
    if(cookie('u')){
        $user_id=base64_decode(cookie('u'));
    }
    $str_order='ORDER BY commodity_comment_parent_send_time DESC LIMIT '.$offset.','.$limit ;
    $type=null;
    $str_present=' commodity_type_id=(SELECT commodity_type_id FROM commodity_info WHERE commodity_info_id=? )';
    if($order==0){
        $str_order='ORDER BY commodity_comment_parent_like DESC LIMIT '.$offset.','.$limit ;
    }
    if($present=='true'){
        $str_present=' commodity_info_id=? ';
    }
    switch ($select) {
        case  0: $type=0;
            break;
        case  1: $type=1; $str=' AND commodity_comment_parent_img IS NOT NULL ';
            break;
        case  2:$type=1;$str=' AND commodity_comment_parent_video IS NOT NULL ';
            break;
        case  3:$type=1;$str=' AND commodity_comment_parent_info_add_time IS NOT NULL ';
            break;
        case  4:$type=2; $str=[5,4];
            break;
        case  5:$type=2;$str=[4,3];
            break;
        case  6:$type=2;$str=[3,0];
            break;

        default:
            break;
    }
    function fnjson($data){
        if(sizeOf($data)>0){
            foreach ($data as $k=> $v) {
                $data[$k]['replysum']=Db::query(Sql::$str47,[$v['commodity_comment_parent_id']])[0]['sum'];
                if($v['commodity_comment_parent_img']){
                    $data[$k]['commodity_comment_parent_img']=json_decode($v['commodity_comment_parent_img']);
                }
                if($v['commodity_comment_parent_video']){
                    $data[$k]['commodity_comment_parent_video']=json_decode($v['commodity_comment_parent_video']);
                }
                if($v['commodity_comment_parent_info_add_img']){
                    $data[$k]['commodity_comment_parent_info_add_img']=json_decode($v['commodity_comment_parent_info_add_img']);
                }
                if($v['commodity_comment_parent_info_add_video']){
                    $data[$k]['commodity_comment_parent_info_add_video']=json_decode($v['commodity_comment_parent_info_add_video']);
                }
                if($v['type']){
                    $data[$k]['type']=json_decode($v['type']);
                }
            }
        }
           return $data;
    }
    $data=null;
    if($type==0){
        $str_change=Sql::$str46.$str_present.$str_order;
        $data=Db::query($str_change,[$id,$user_id,$id]);
        $data=fnjson($data);
        $arr=$data;
        
    }
    if($type==1){
        $str_change=Sql::$str46.$str_present.$str.$str_order;
        $data=Db::query($str_change,[$id,$user_id,$id]);
        $data=fnjson($data);
        $arr=$data;
    }
    if($type==2){
        $str_change=Sql::$str46.$str_present.' AND commodity_comment_parent_grader<='.$str[0].' AND commodity_comment_parent_grader>'.$str[1].' '.$str_order;
        $data=Db::query($str_change,[$id,$user_id,$id]);
        $data=fnjson($data);
        $arr=$data;
    }

    return json(['code'=>200,'user_id'=>$user_id,'data'=>$arr,'msg'=>'获取成功']);
}
 
public function getcomment($id,$order=1,$user_id=-1){
$str_order=' ORDER BY commodity_comment_son_send_time DESC';
if($order==0){
    $str_order=' ORDER BY commodity_comment_son_send_time ASC';
}
if(cookie('u')){
    $user_id=base64_decode(cookie('u'));
}
$str_change=Sql::$str48.$str_order;
$arr=Db::query($str_change,[$id,$id,$user_id,$id]);
function fnjson($data){
    if(sizeOf($data)>0){
        foreach ($data as $k=> $v) {
            $data[$k]['replysum']=Db::query(Sql::$str47,[$v['commodity_comment_parent_id']])[0]['sum'];
            if($v['commodity_comment_parent_img']){
                $data[$k]['commodity_comment_parent_img']=json_decode($v['commodity_comment_parent_img']);
            }
            if($v['commodity_comment_parent_video']){
                $data[$k]['commodity_comment_parent_video']=json_decode($v['commodity_comment_parent_video']);
            }
            if($v['commodity_comment_parent_info_add_img']){
                $data[$k]['commodity_comment_parent_info_add_img']=json_decode($v['commodity_comment_parent_info_add_img']);
            }
            if($v['commodity_comment_parent_info_add_video']){
                $data[$k]['commodity_comment_parent_info_add_video']=json_decode($v['commodity_comment_parent_info_add_video']);
            }
            if($v['type']){
                $data[$k]['type']=json_decode($v['type']);
            }
        }
    }
       return $data;
}

$res=Db::query(Sql::$str223,[$id]);
$res=fnjson($res);
$cmm=Db::query(Sql::$str75,[$res[0]['commodity_info_id']]);
if(sizeOf($cmm)>0){
    $cmm[0]['imgs']=json_decode($cmm[0]['imgs']);
}
return json(['code'=>200,'title'=>$res[0],'cmm'=>$cmm[0],'data'=>$arr,'msg'=>'获取成功']);

}

public function questions($id,$order=0,$limit=10,$offset=0,$user_id=-1){
    $str=' ORDER BY send_time  DESC LIMIT ?,?';
    if(cookie('u')){
        $user_id=base64_decode(cookie('u'));
    }
    if($order==1){
        $str=' ORDER BY  send_time  ASC LIMIT ?,?';
    }
    $str_change=Sql::$str49.$str;
    $arr=Db::query($str_change,[$id,$offset*1,$limit*1]);
    if(sizeOf($arr)>0){
        foreach ($arr as $k => $v) {
            $arr[$k]['children']=Db::query(Sql::$str50,[$id,$v['commodity_issue_id'],$user_id]);
        }
    }
    $sum=Db::query(Sql::$str51,[$id])[0]['sum'];
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功','sum'=>$sum]);
}

public function questionslike(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $commodity_issue_son_id=Index::i('commodity_issue_son_id');
        $type=Index::i('type');
        if($commodity_issue_son_id&&($type==1||$type=='1'||$type==0||$type=='0')){
            $type=intval($type);
            $commodity_issue_son_id=intval($commodity_issue_son_id);
            if($type==1){
                Db::table('user_commodity_issue_like')->where([
                    'user_id'=>$bank,
                    'tf_id' =>$commodity_issue_son_id,
                ])->delete();
                Db::table('commodity_issue_son')
                ->where('commodity_issue_son_id', $commodity_issue_son_id)
                ->dec('commodity_issue_son_like')
                ->update();
            }else if($type==0){
                $data = [
                    'user_id' =>$bank, 
                    'type' =>0, 
                    'tf_id' =>$commodity_issue_son_id, 
                    'send_time' => date('Y-m-d H:i:s'),
                ];
                Db::name('user_commodity_issue_like')->insert($data);
                Db::table('commodity_issue_son')
                ->where('commodity_issue_son_id', $commodity_issue_son_id)
                ->inc('commodity_issue_son_like')
                ->update();
            }
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'缺少参数']);
        }
    }else {
        return json(['code'=>406,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function shopindex_fu($v,$shop_id){
    $arr=[];
    if($v['type']==0){
        $res=Db::query(Sql::$str55,[$shop_id,$v['name']]);
            if(sizeOf($res)>0){
                $res= $res[0];
                if($res['shop_category_parent_brief']){
                    $res['shop_category_parent_brief']=json_decode($res['shop_category_parent_brief']);
                }
            $res['msg']='店铺大频道';
            $res['type']=0;
            array_push($arr,$res);
            }
       }
       if($v['type']==1){
        $res=Db::query(Sql::$str56,[$shop_id,$v['name']]);
        if(sizeOf($res)>0){
            $res=$res[0];
            if($res['shop_category_son_brief']){
                $res['shop_category_son_brief']=json_decode($res['shop_category_son_brief']);
            }
                $res['msg']='店铺子频道';
                $res['type']=1;
                array_push($arr,$res);
        }

       }
       if($v['type']==2){
        $res=Db::query(Sql::$str57,[$v['store_commodity_id']])[0];
        if($res['commodite_info_target']){
            $res['commodite_info_target']=json_decode($res['commodite_info_target']); 
        }
        if($res['commodity_info_data']){
            $res['commodity_info_data']=json_decode($res['commodity_info_data']); 
        }   
        if($res['commodity_info_activity']){
            $res['commodity_info_activity']=json_decode($res['commodity_info_activity']); 
        }
        if($res['imgs']){
            $res['imgs']=json_decode($res['imgs']); 
        }
        $res['msg']='店铺商品';
        array_push($arr,$res);
        }

        return $arr;
}
public function shopindex($shop_id,$user_id=0){
    $one=Db::query(Sql::$str54,[$shop_id])[0];
    if($one['banner']){
        $one['banner']=json_decode($one['banner'],true);
    }
    if($one['banner_min']){
        $one['banner_min']=json_decode($one['banner_min'],true);
    }
    if($one['banner_info']){
        $one['banner_info']=json_decode($one['banner_info'],true);
    }
    if($one['shop_hard']){
        $one['shop_hard']=json_decode($one['shop_hard'],true);
    }
    if(cookie('u')){
        $user_id=base64_decode(cookie('u'));
    }
    $arr['shop']=['shop_id'=>$shop_id,
    'data'=>Db::query(Sql::$str224,[$shop_id,$user_id])[0]
    ];
    if(sizeOf($one['banner'])>0){
        $arr['banner']=[];
        foreach ($one['banner'] as $k=> $v) {
            array_push($arr['banner'],Index::shopindex_fu($v,$shop_id)[0]);
        }
    }
    if(sizeOf($one['banner_min'])>0){
        $arr['banner_min']=[];
        foreach ($one['banner_min'] as $k=> $v) {
           array_push($arr['banner_min'],Index::shopindex_fu($v,$shop_id)[0]);
        }
    }

    if(sizeOf($one['banner_info'])>0){
        $arr['banner_info']=[];
        foreach ($one['banner_info'] as $k=> $v) {
           array_push($arr['banner_info'],Index::shopindex_fu($v,$shop_id)[0]);
        }
    }
    if($one['shop_hard']&&sizeOf($one['shop_hard'])>0){
        $shop_hard=[];
        foreach ($one['shop_hard'] as $k=> $v) {
            $res=Db::query(Sql::$str57,[$v]);
            if(sizeOf($res)>0){
                $res=$res[0];
                if($res['commodite_info_target']){
                    $res['commodite_info_target']=json_decode($res['commodite_info_target']); 
                }
                if($res['commodity_info_data']){
                    $res['commodity_info_data']=json_decode($res['commodity_info_data']); 
                }   
                if($res['commodity_info_activity']){
                    $res['commodity_info_activity']=json_decode($res['commodity_info_activity']); 
                }
                if($res['imgs']){
                    $res['imgs']=json_decode($res['imgs']); 
                }
                array_push($shop_hard,$res);
            }
        }
        $arr['shop_hard']=$shop_hard;
        
    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);

}

public function shopcate($id){
    $arr=[];
    $shop_p=Db::query(Sql::$str58,[$id]);
    if(sizeOf($shop_p)>0){
        foreach ($shop_p as $k => $v) {
            $res=Db::query(Sql::$str59,[$v['shop_category_title']]);
            $shop_p[$k]['son']=$res;
            if(sizeOf($shop_p[$k]['son'])>0){
                $shop_p[$k]['judge']=true;
            }else {
                $shop_p[$k]['judge']=false;
            }
        }
        $arr=$shop_p;
    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function shopcommodity($id){
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);

}

public function shopcminfo_fu($res){
    foreach ($res as $k => $v) {
        if($v['commodity_info_data']){
            $res[$k]['commodity_info_data']=json_decode($v['commodity_info_data']); 
        }   
        if($v['commodity_info_activity']){
            $res[$k]['commodity_info_activity']=json_decode($v['commodity_info_activity']); 
        }
        if($v['imgs']){
            $res[$k]['imgs']=json_decode($v['imgs']); 
        }
    }
    return $res;
}


public function shopcminfo($id,$type,$gory_id=0){
    $arr=[];
    if($type==-1){
       $res=Db::query(Sql::$str60,[$id,$id]);
       if(sizeOf($res)>0){
        $arr=Index::shopcminfo_fu($res);
       }
    }

    if($type==0){
        $res=Db::query(Sql::$str61,[$id,$id,$gory_id]);
        if(sizeOf($res)>0){
         $arr=Index::shopcminfo_fu($res);
        }
    }

    if($type==1){
        $res=Db::query(Sql::$str62,[$id,$id,$gory_id]);
        if(sizeOf($res)>0){
         $arr=Index::shopcminfo_fu($res);
        }
    }

    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function platformgoods($name,$time=-1,$brand=-1,$min_price=-1,$max_price=-1,$order=0,$limit=20,$offset=0){
    $tf=Db::query(Sql::$str63,[$name]);
    $arr=[];
    $sql_one=Sql::$str65;
    $sql_two=Sql::$str66;
    $sql_count_one=Sql::$str77;
    $cneter='';
    $money='';
    $ps_id=null;
    $order_str=' ORDER BY money ASC';
    $where=' WHERE ';
    $brank_str=Sql::$str79;
    $limit_str=' LIMIT '.$offset.' , '.$limit;
    if($min_price!=-1&&$max_price!=-1){
        $money=' money>='.$min_price.' AND money<='.$max_price.'  ';
    }else if($min_price!=-1){
        $money=' money>='.$min_price.'  ';
    }else if($max_price!=-1){
        $money=' money<='.$max_price.'  ';
    }else {
        $money=false;
    }
    if($time!=-1){
        $where=$where.' commodity_info_state_time>='."'".$time."'";
    }
    if($brand!=-1){
       if($time!=-1){
        $where=$where.' AND brand='."'".$brand."'";
       }else {
        $where=$where.' brand='."'".$brand."'";
       }
    }
    if($order==1){
        $order_str=' ORDER BY money DESC';
    }
    if(sizeOf($tf)>0){
        $tf=$tf[0];
        if($tf['lei']==0){
            $cneter=' WHERE category_parent_id=? ';
        }
        if($tf['lei']==1){
            $cneter=' WHERE category_son_lei=? ';
        }
        if($tf['lei']==2){
            $cneter=' WHERE category_son_id=? ';
        }
        $res=[];
        $cha=$sql_one.$cneter.$sql_two;
        $cha_xum=$sql_count_one.$cneter.$sql_two;
        $cha_brank=$brank_str.$cneter.$sql_two;
        if($time==-1&&$brand==-1){
            if($money){
                $cha=$cha.' WHERE '.$money.$order_str.$limit_str;
                $cha_xum=$cha_xum.' WHERE '.$money.$order_str.$limit_str;
                $cha_brank=$cha.' WHERE '.$money.' GROUP BY brand '.$order_str.$limit_str;
            }else{
                $cha=$cha.$order_str.$limit_str;
                $cha_xum=$cha_xum.$order_str.$limit_str;
                $cha_brank=$cha_brank.' GROUP BY brand '.$order_str.$limit_str;
            }
            $res=Db::query($cha,[$tf['lei_id']]);
            $res_xum=Db::query($cha_xum,[$tf['lei_id']]);
            $res_brank=Db::query($cha_brank,[$tf['lei_id']]);
        }else {
            if($money){
                $cha=$cha.$where.' AND '.$money.$order_str.$limit_str;
                $cha_brank=$cha_brank.$where.' AND '.$money.' GROUP BY brand '.$order_str.$limit_str;
                $cha_xum=$cha_xum.$where.' AND '.$money.$order_str.$limit_str;
            }else {
                $cha=$cha.$where.$order_str.$limit_str;
                $cha_xum=$cha_xum.$where.$order_str.$limit_str;
            }

            $res=Db::query($cha,[$tf['lei_id']]);
            $res_xum=Db::query($cha_xum,[$tf['lei_id']]);
            $res_brank=Db::query($cha_brank,[$tf['lei_id']]);

        }

        
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                if($v['imgs']){
                    $res[$k]['imgs']=json_decode($v['imgs']);
                }
            }
        }
        $arr['info']=$res; //存放商品信息
        if(sizeOf($res_xum)>0){
            $arr['sum']=$res_xum[0]['sum'];
        }else {
            $arr['sum']=0;
        }
        $arr['brank']=$res_brank;
    }else {
        $str='%'.$name.'%';
        $res=[];
        $res_xum=[];
        $res_brank=[];
        if($time==-1&&$brand==-1){
            if($money){
                $res=Db::query(Sql::$str69. ' WHERE '.$money.$order_str.$limit_str,[$str,$str]);
                $res_xum=Db::query(Sql::$str78. ' WHERE '.$money.$order_str.$limit_str,[$str,$str]);
                $res_brank=Db::query(Sql::$str80. ' WHERE '.$money.' GROUP BY a.brand '.$order_str.$limit_str,[$str,$str]);
            }else {
                $res=Db::query(Sql::$str69.$order_str.$limit_str,[$str,$str]);
                $res_xum=Db::query(Sql::$str78.$order_str.$limit_str,[$str,$str]);
                $res_brank=Db::query(Sql::$str80.' GROUP BY a.brand '.$order_str.$limit_str,[$str,$str]);

            }
        }else {
            if($money){
                $res=Db::query(Sql::$str69.$where.' AND '.$money.$order_str.$limit_str,[$str,$str]);
                $res_xum=Db::query(Sql::$str78.$where.' AND '.$money.$order_str.$limit_str,[$str,$str]);
                $res_brank=Db::query(Sql::$str80.$where.' AND '.$money.' GROUP BY a.brand '.$order_str.$limit_str,[$str,$str]);
            }else {
                $res=Db::query(Sql::$str69.$where.$order_str.$limit_str,[$str,$str]);
                $res_xum=Db::query(Sql::$str78.$where.$order_str.$limit_str,[$str,$str]);
                $res_brank=Db::query(Sql::$str80.$where.' GROUP BY a.brand '.$order_str.$limit_str,[$str,$str]);
            }
        }
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                if($v['imgs']){
                    $res[$k]['imgs']=json_decode($v['imgs']);
                }
            }
        }
        $arr['info']=$res; //存放商品信息
        if(sizeOf($res_xum)>0){
            $arr['sum']=$res_xum[0]['sum'];
        }
        $arr['brank']=$res_brank;

    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function platformgoodslogo($name){ //获取搜索商品品牌  页面路由
    $tf=Db::query(Sql::$str63,[$name]);
    $arr=[];
    if(sizeOf($tf)>0){
        $tf=$tf[0];
        $arr['router']=['name'=>$name];
        $l=[];
        $hot=[];
        if($tf['lei']==0){
            $cneter=' WHERE category_parent_id=? ';
            $l=Db::query(Sql::$str71,[$tf['lei_id']]);
            foreach ($l as $k => $v) {
                $l[$k]['child']=Db::query(Sql::$str72,[$v['category_son_son_id']]);
            }
            $min_hot=Db::query(Sql::$str76,[$tf['lei_id']]);
            $hot_arr=[];
            foreach ($min_hot as $k=> $v) {
                $ss=json_decode($v['shop_hot'],true);
                if(sizeOf($ss)>0){
                    foreach ($ss as $k => $v) {
                        $ss_s=Db::query(Sql::$str75,[$v])[0];
                        if($ss_s['imgs']){
                            $ss_s['imgs']=json_decode($ss_s['imgs']);
                        }
                      array_push($hot_arr,$ss_s);
                    }
                }
            }
            $hot=$hot_arr;
        }
        if($tf['lei']==1){
            $cneter=' WHERE category_son_lei=? ';
            $z=Db::query(Sql::$str72,[$tf['lei_id']]);
            $l=['name'=>$name,'child'=>$z];
            $min_hot=Db::query(Sql::$str74,[$tf['lei_id']]);
            $hot_arr=[];
            foreach ($min_hot as $k=> $v) {
                $ss=json_decode($v['shop_hot'],true);
                if(sizeOf($ss)>0){
                    foreach ($ss as $k => $v) {
                        $ss_s=Db::query(Sql::$str75,[$v])[0];
                        if($ss_s['imgs']){
                            $ss_s['imgs']=json_decode($ss_s['imgs']);
                        }
                      array_push($hot_arr,$ss_s);
                    }
                }
            }
            $hot=$hot_arr;
        }
        if($tf['lei']==2){
            $cneter=' WHERE category_son_id=? ';
            $l_l=Db::query(Sql::$str73,[$tf['lei_id']])[0]['category_son_lei'];
            $z=Db::query(Sql::$str72,[$l_l]);
            $l=['name'=>$name,'child'=>$z];

            $min_hot=Db::query(Sql::$str74,[$l_l]);
            $hot_arr=[];
            foreach ($min_hot as $k=> $v) {
                $ss=json_decode($v['shop_hot'],true);
                if(sizeOf($ss)>0){
                    foreach ($ss as $k => $v) {
                        $ss_s=Db::query(Sql::$str75,[$v])[0];
                        if($ss_s['imgs']){
                            $ss_s['imgs']=json_decode($ss_s['imgs']);
                        }
                      array_push($hot_arr,$ss_s);
                    }
                }
            }
            $hot=$hot_arr;
        }
        $arr['router']['child']=$l;
        $arr['hot']=$hot;
    }
    
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}

public function enter($bank,$password){
    $res=Db::query(Sql::$str81,[$bank]);
    if(sizeOf($res)>0){
        if($res[0]['password']==$password){
            cookie('u', base64_encode($bank),60*60*24);
            cookie('p', base64_encode($password),60*60*24);
            $res[0]['password']='~~~~';
            $res=$res[0];
            return json(['code'=>200,'data'=>$res,'msg'=>'登录成功']);
        }else {
            return json(['code'=>200,'data'=>[],'msg'=>'密码错误']);
        }
    }else {
        return json(['code'=>200,'data'=>[],'msg'=>'账号不存在']);
    }
}
public function judgeenter(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $res=Db::query(Sql::$str82,[$bank]);
        if(sizeOf($res)>0){
            $res[0]['password']='~~~~';
            return json(['code'=>200,'info'=>$res[0],'data'=>$res[0]['user_id'],'msg'=>'用户已登录']);
        }else {
            return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
        }
    }else {
        return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
    }
 
}

public function getcar(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $res=Db::query(Sql::$str83,[$bank]);
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                $res[$k]['imgs']=json_decode($v['imgs'])[0];
                $res[$k]['info']=json_decode($v['info'],true);
                foreach ($res[$k]['info']['data'] as $key => $value) {
                    if($value['name']==$v['type']){
                        $res[$k]['money']=$value['money'];
                        $res[$k]['num']=$value['num'];
                    }
                }
             $res[$k]['info']='~~~';
            }
        }

        return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
    }else {
        return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
    }
  
}
public function carinfo(){
        if(!cookie('u')) return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);;
        $bank=base64_decode(cookie('u'));
        $res=Db::query(Sql::$str84,[$bank]);
        $arr=[];
        $data_arr=[];
        $y_jian=0;
        $all_input=0;

        if(sizeOf($res)>0){
            $sum=0;//存放已选商品总价格
            foreach ($res as $k =>$v) {
                $res[$k]['imgs']=json_decode($v['imgs'])[0];
                $res[$k]['info']=json_decode($v['info'],true);
                foreach ($res[$k]['info']['data'] as $key => $value) {//查找已选商品类型的价格
                    if($value['name']==$v['type']){
                        $res[$k]['money']=$value['money'];
                        $res[$k]['num']=$value['num'];
                        if($res[$k]['num']>0){
                            $sum+=$value['money']*$v['sum'];
                        }
                    }
                }
               array_push($arr,['shop_id'=>$v['shop_id'],'data'=>[]]);
            }
            $arr=array_unique($arr,SORT_REGULAR ); //店铺ID去重

            foreach ($arr as $k => $v) {  //归类店铺商品
                foreach ($res as $key => $value) {
                    if($v['shop_id']==$value['shop_id']){
                        array_push($arr[$k]['data'],$value);
                    }
                }
            }
            foreach ($arr as $k => $v) { //设置店铺商品是否全选
                $c=0;//存放店铺已选商品的input数量
                if(sizeOf($v['data'])>0){
                    foreach ($v['data'] as $key => $value) {
                       if($value['input']==0){//判断商品是否选中
                        $c++;
                       }
                       if($value['sum']<=0){//如果商品没有库存则input=1
                        $v['data'][$key]['input']=1;
                       }
                    }
                    if(sizeOf($v['data'])==$c){//设置店铺商品是否全选
                        $arr[$k]['input']=0;
                    }else {
                        $arr[$k]['input']=1;
                    }
                }
              
            }
            foreach ($arr as $k => $v) {//添加店铺名称
                if(sizeOf($v)>0){
                    $arr[$k]['shop_name']=Db::query(Sql::$str86,[$v['shop_id']])[0]['shop_name'];
                    $arr[$k]['show']=false;
                }
            }
            $max=[];//存放所有优惠券去重合并结果
            foreach ($arr as $k => $v) {//添加优惠券
                if(sizeOf($v['data'])>0){
                    $min=[]; //存放店铺重复的优惠券
                    foreach ($v['data'] as $key => $value) {
                        $pd_id=Db::query(Sql::$str85,[$value['category_son_id_one']])[0]['category_parent_id'];
                        $pd_yhq=Db::query(Sql::$str87,[$pd_id]);//查询全/频道优惠券
                        $shop_yhq=Db::query(Sql::$str88,[$value['shop_id']]);//查询店铺优惠券
                        if(sizeOf($pd_yhq)>0){//添加全/频道优惠券
                            foreach ($pd_yhq as $y => $a) {
                                array_push($min,$a);
                                $a['change']=0;
                                array_push($max,$a);
                            }
                        }
                        if(sizeOf($shop_yhq)>0){//添加店铺优惠券
                            foreach ($shop_yhq as $y => $a) {
                                array_push($min,$a);
                                $a['change']=0;
                                array_push($max,$a);
                            }
                        }
                        

                        $x_yhq=Db::query(Sql::$str89,[$value['commodity_info_id']]);
                        if(sizeOf($x_yhq)>0){//添加店铺优惠券
                            foreach ($x_yhq as $y => $a) {
                                if($a['portion_tf']==0){//添加部分优惠券商品
                                    $a['chird']=Db::query(Sql::$str92,[$a['discount_id'],$value['commodity_info_id']]);
                                    if(sizeOf($a['chird'])>0){
                                        foreach ($a['chird'] as $e => $l) {
                                            $a['chird'][$e]['imgs']=json_decode($l['imgs'])[0];
                                            $a['chird'][$e]['info']='~~~';
                                        }
                                    }
                                }
                                array_push($min,$a);
                                $a['change']=0;
                                array_push($max,$a);
                            }
                        }

                    
                    }
                    if($key==sizeof($v['data'])-1){
                        $min=array_unique($min,SORT_REGULAR );//进行优惠券去重
                        if(sizeOf($min)>0){
                            foreach ($min as $key => $a) {
                                $tf=Db::query(Sql::$str90,[$a['discount_id'],$bank]);
                             
                                if(sizeOf($tf)>0){
                                    if($tf[0]['discount_state']==0){
                                        $min[$key]['tf']=0;
                                        $min[$key]['msg']='已领取优惠券';
                                    }else if($tf[0]['discount_state']==1){
                                        $min[$key]['tf']=1;
                                        $min[$key]['msg']='优惠券已使用';
                                    }else{
                                        $min[$key]['tf']=2;
                                        $min[$key]['msg']='优惠券已过期';
                                    }
                                }else {
                                    $min[$key]['tf']=-1;
                                    $min[$key]['msg']='未领取优惠券';
                                }
                            }
                        }
                    }
                }
                $arr[$k]['discount']=$min;
            }
            


            $max=array_unique($max,SORT_REGULAR );//所有优惠券合并去重
            if(sizeOf($max)>0){
                            foreach ($max as $key => $a) {
                                $tf=Db::query(Sql::$str90,[$a['discount_id'],$bank]);
                                if(sizeOf($tf)>0){
                                    if($tf[0]['discount_state']==0){
                                        $max[$key]['tf']=0;
                                        $max[$key]['msg']='已领取优惠券';
                                    }else if($tf[0]['discount_state']==1){
                                        $max[$key]['tf']=1;
                                        $max[$key]['msg']='优惠券已使用';
                                    }else{
                                        $max[$key]['tf']=2;
                                        $max[$key]['msg']='优惠券已过期';
                                    }
                                }else {
                                    $max[$key]['tf']=-1;
                                    $max[$key]['msg']='未领取优惠券';
                                }
                            }
                        }
                $y_sum=0;
                $y_b=0;
                $arr_y=[];
                foreach ($arr as $k => $v) {//计算优惠后价格
                    if($v['input']==0){
                        $all_input++;
                    }
                    if(sizeOf($v['data'])>0){//商品不为空
                        $min_sum=0;//存放店铺商品总价
                        $yc_item=0;//存放店铺原价商品价格
                        $yc_sum=0;//存放店铺原价商品价格总和
                        $vip=Db::query(Sql::$str93,[$bank]);
                        if(sizeOf($vip)>0){
                            $vip=true; 
                        }else {
                            $vip=false;
                        }
                        $arr_key_o=[];//存放已使用的优惠券
                        $arr_key_z=[];//存放已使用的优惠券
                        $arr_key_t=[];//存放已使用的优惠券
                        $arr_key=[];//存放已使用的优惠券
                        foreach ($v['data'] as $e => $l) {//对店铺商品进行遍历
                            $yc=$l['money']*$l['sum'];
                            $yc_item=$l['money']*$l['sum'];
                            if($vip&&$l['vip']){
                                $yc=$l['money']*$l['sum']*$l['vip'];
                                $yc_item=$l['money']*$l['sum']*$l['vip'];
                            }
                            if($l['input']==1){
                                $s=0;
                                $yc_item=0;
                                $yc=0;
                            }
                            $s=$yc;//存放最低价格
                            $z=$yc;
                            $o=$yc;
                            $x=$yc;
                        

                            if($l['input']==0){
                                $y_jian+=$l['sum'];
                            }
                            if(sizeOf($v['discount'])>0&&$l['input']==0){//优惠券不为空
                                $min_arr=[];//存放使用优惠券数组
                                $min_arr_g=[];//存放使用优惠券价格数组
                                $die=true;
                                foreach ($max as $key => $value) {//计算单个商品使用优惠券的最低价格
                                    if($max[$key]['change']==0&&$l['input']==0&&$value['tf']==0){//计算已经领取优惠券的价格
                                        if($value['type']==0&&$value['portion_tf']==1){//全频道优惠券
                                            if($z>=$value['man_money']){ //计算全频道无子类优惠券
                                                if($value['ze_kou']){
                                                    $z*=$value['ze_kou'];
                                                }else if($value['man_money']){
                                                    $z-=$value['jian_money'];
                                                }
                                                $max[$key]['change']=1;
                                                array_push($arr_key_o,$value);
                                            }
                                        }else if($value['type']==0&&$value['portion_tf']==0){
                                             //计算全频道子类优惠券
                                            if(isset($value['chird'])&&sizeOf($value['chird'])>0){
                                                foreach ($value['chird'] as $son_key => $son) {
                                                 if($son['discount_son_info']==$l['commodity_info_id']){
                                                     if($z>=$value['man_money']){
                                                         $z-=$value['jian_money'];
                                                     }else if($value['ze_kou']){
                                                         $z*=$value['ze_kou'];
                                                     }
                                                array_push($arr_key_o,$value);
                                                $max[$key]['change']=1;
                                                 }
                                                }
                                             }
                                        }
                                        $pd_id=Db::query(Sql::$str85,[$l['category_son_id_one']])[0]['category_parent_id'];
                                        if($value['type']==$pd_id&&$value['portion_tf']==1){
                                                if($o>=$value['man_money']){//计算频道无子类优惠券
                                                    if($value['ze_kou']){
                                                        $o*=$value['ze_kou'];
                                                    }else if($value['man_money']){
                                                        $o-=$value['jian_money'];
                                                    }
                                                array_push($arr_key_o,$value);
                                                $max[$key]['change']=1;
                                                }
                                        }else if($value['type']==$pd_id&&$value['portion_tf']==0){//计算频道子类优惠券
                                            if(isset($value['chird'])&&sizeOf($value['chird'])>0){
                                                foreach ($value['chird'] as $son_key => $son) {
                                                 if($son['discount_son_info']==$l['commodity_info_id']){
                                                     if($o>=$value['man_money']){
                                                        $o-=$value['jian_money'];
                                                     }else if($value['ze_kou']){
                                                        $o*=$value['ze_kou'];
                                                     }
                                                array_push($arr_key_o,$value);
                                                $max[$key]['change']=1;
                                                 }
                                                }
                                             }
                                        }
                                   
                                        if($value['shop_id']==$v['shop_id']&&$value['portion_tf']==1&&$value['type']==-1){
                                            if($x>=$value['man_money']){//计算店铺无子类优惠券
                                                if($value['ze_kou']){
                                                    $x*=$value['ze_kou'];
                                                }else if($value['man_money']){
                                                    $x-=$value['jian_money'];
                                                }
                                                array_push($arr_key_o,$value);
                                                $max[$key]['change']=1;
                                              
                                            }
                                        }else if($value['shop_id']==$v['shop_id']&&$value['portion_tf']==0&&$value['type']==-1){
                                            if(isset($value['chird'])&&sizeOf($value['chird'])>0){//计算店铺子类优惠券
                                               foreach ($value['chird'] as $son_key => $son) {
                                                if($son['discount_son_info']==$l['commodity_info_id']){
                                                    if($x>=$value['man_money']){
                                                        if($value['ze_kou']){
                                                            $x*=$value['ze_kou'];
                                                        }else {
                                                            $x-=$value['jian_money'];
                                                        }
                                                    }
                                                array_push($arr_key_o,$value);
                                                $max[$key]['change']=1;
                                                }
                                               }
                                            }
                                        }
                                        if($s>$o){
                                            $s=$o;
                                        }else if($s>$z){
                                            $s=$z;
                                        }else if($s>$x){
                                            $s=$x;
                                        }
                                    }
                                }
                            }
                            $min_sum+=$s;
                            $yc_sum+=$yc_item;
                            $s=round($s,2);
                            $arr[$k]['data'][$e]['sss']=$s;
                            $arr[$k]['data'][$e]['yuan']=$yc_item;
                        }
                        $arr_key=$arr_key_o;
                        $yc_sum_sum=$yc_sum;
                        $s_s=$min_sum;//得到第一次单个商品计算的总和价格
                        if(sizeOf($v['discount'])>0){//判断店铺有无优惠券
                            foreach ($max as $key => $value) {//查找店铺优惠券 与之比较
                                if($value['change']==0&&$l['input']==0&&$value['tf']==0){//判断优惠券是否领取使用 和 购买商品是否选择
                                    if($value['shop_id']==$l['shop_id']&&$value['portion_tf']==1&&$value['type']==-1){
                                        if($yc_sum>=$value['man_money']){//计算店铺无子类优惠券
                                            if($value['ze_kou']){
                                                $yc_sum*=$value['ze_kou'];
                                            }else if($value['man_money']){
                                                $yc_sum-=$value['jian_money'];
                                            }
                                            $max[$key]['change']=1;
                                            array_push($arr_key_z,$value);
                                            if($s_s>$yc_sum){
                                                $s_s=$yc_sum;
                                                $arr_key=$arr_key_z;
                                            }
                                          
                                        }
                                    }
                                }
                            }
                        }
                        if(sizeOf($v['discount'])>0){//判断店铺有无优惠券
                            foreach ($max as $key => $value) {//查找全频道优惠券 与之比较
                                if($value['change']==0&&$l['input']==0&&$value['tf']==0){//判断优惠券是否领取使用 和 购买商品是否选择
                                    if($value['type']==0&&$value['portion_tf']==1){
                                        if($yc_sum_sum>=$value['man_money']){//计算店铺无子类优惠券
                                            if($value['ze_kou']){
                                                $yc_sum_sum*=$value['ze_kou'];
                                            }else if($value['man_money']){
                                                $yc_sum_sum-=$value['jian_money'];
                                            }
                                            $max[$key]['change']=1;
                                            array_push($arr_key_t,$value);
                                            if($yc_sum_sum<$s_s){
                                                $s_s=$yc_sum_sum;
                                                $arr_key=$arr_key_t;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if(sizeOf($arr_key)>0){
                        foreach ($arr_key as $key => $value) {
                            array_push($arr_y,$value);
                        }
                    }
                    $y_b+=$yc_sum;
                    $y_sum+=$s_s;
                }
                if(sizeOf($arr)==$all_input){
                    $all_input=0;
                }else {
                    $all_input=1;
                }

            $beans=Db::query(Sql::$str101,[$bank])[0]['integral'];
        return json(['code'=>200,'data'=>$arr,'sum'=>Db::query(Sql::$str91,[$bank])[0]['sum'],'msg'=>'获取成功','rate'=>floor($y_sum*100)/100,'yx'=>$y_jian,'initial'=>$y_b,'all_input'=>$all_input,'already'=>$arr_y,'beans'=>$beans]);
        }else {
            return json(['code'=>200,'data'=>[],'sum'=>0,'msg'=>'获取成功']);
        }
}

public function drawdiscount(){
    if(isset($_POST['discount_id'])){
        if(cookie('u')){
            $res=Db::query(Sql::$str94,[cookie('u'),$_POST['discount_id']]);//判断用户是否已经领取且不能重复领取的优惠券
            if(sizeOf($res)==0){
                $info=Db::query(Sql::$str95,[$_POST['discount_id']]);
                if(sizeOf($info)>0){
                    $data = [
                    'discount_id' =>$_POST['discount_id'], 
                    'sent_time' =>$info[0]['sen_time'],
                    'end_time' =>$info[0]['end_time'],
                    'discount_state' =>0,
                    'user_id'=>base64_decode(cookie('u'))
                    ];
                    Db::name('user_discount')->insert($data);
                  return json(['code'=>200,'data'=>true,'msg'=>'添加成功']);
                }else {
                  return json(['code'=>200,'data'=>false,'msg'=>'该优惠券不存在或已过期']);
                }
            }else {
                return json(['code'=>200,'data'=>false,'msg'=>'添加失败']);
            }
        }else {
         return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
        }
    }else {
        return json(['code'=>200,'data'=>false,'msg'=>'参数错误']);
        
    }
}


public function changecar(){
    $type=null;
    $data=null;
    $info=null;
    if(isset($_POST['type'])){
        $type=$_POST['type'];
    }
    if(isset($_POST['data'])){
        $data=$_POST['data'];
    }
    if(isset($_POST['info'])){
        $info=$_POST['info'];
    }
    if(($type!=3&&$data)||($type==3&&$info)){
        if(!is_array($data)){
            $data=explode(',',$data);
            foreach ($data as $k => $v) {
                $data[$k]=intval($v);
            }
        }
        if(!is_int($type)){
            $type=intval($type);
        }
        if(cookie('u')){
            $bank=base64_decode(cookie('u'));
           if($type==0||$type==1){
                if(sizeOf($data)>0){
                    foreach ($data as $key => $value) {
                        $s=Db::name('commodity_collect')
                        ->where(['user_id'=>$bank,'commodity_collect_id'=>$value])
                        ->update(['input' =>$type]);
                    }
                }
           }else if($type==2){
                foreach ($data as $key => $value) {
                    Db::table('commodity_collect')->where(['user_id'=>$bank,'commodity_collect_id'=>$value])->delete();
                }
           }else if($type==3){
                if(sizeOf($data)==1){
                    Db::name('commodity_collect')
                    ->where(['user_id'=>$bank,'commodity_collect_id'=>$data[0]])
                    ->update(['sum' =>$info]);
                }else {
                     return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
                }
           }
            return json(['code'=>200,'data'=>true,'msg'=>'修改成功']);
        }else {
         return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'参数错误']);
    }
}

public function addcar(){
    $name=null;
    $sum=null;
    $commodity_info_id=null;
    if(isset($_POST['name'])){
        $name=$_POST['name'];
    }
    if(isset($_POST['sum'])){
        $sum=$_POST['sum'];
    }
    if(isset($_POST['commodity_info_id'])){
        $commodity_info_id=$_POST['commodity_info_id'];
    }
    if($sum&&$commodity_info_id||$name){
        if(cookie('u')){
            $bank=base64_decode(cookie('u'));
            $data = [
                'user_id' =>$bank, 
                'input' => 0,
                'sum'=>$sum,
                'commodity_id'=>$commodity_info_id
                ];
            if(!$name){
                    $min_name=Db::query(Sql::$str96,[$commodity_info_id]);
                    if(sizeOf($min_name)>0){
                        $name=$min_name[0]['name'];
                        $data['type']=substr($name,1,strlen($name)-2);
                    }else {
                        return json(['code'=>200,'data'=>false,'msg'=>'未知错误']);
                    }
            }else {
                $data['type']=$name;
            }
            $m=Db::query(Sql::$str97,[$bank,$commodity_info_id,$data['type']]);
            if(sizeOf($m)>0){
                Db::name('commodity_collect')
                ->where('commodity_collect_id',$m[0]['commodity_collect_id'] )
                ->update(['sum' =>$m[0]['sum']+$sum]);
            }else {
                Db::name('commodity_collect')->insert($data);
            }
            return json(['code'=>200,'data'=>true,'msg'=>'添加成功']);
        }else {
         return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
        }

    }else {
        return json(['code'=>402,'data'=>false,'msg'=>'参数错误']);
    }
}


public function countcar(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $res=Db::query(Sql::$str91,[$bank]);
        if(sizeOf($res)>0){
            return json(['code'=>200,'data'=>$res[0]['sum'],'msg'=>'获取成功']);
        }else {
            return json(['code'=>200,'data'=>false,'msg'=>'购物车为空']);
        }
    }else {
     return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function accounts(){
    if(cookie('u')){
        $arr=[];
        $bank=base64_decode(cookie('u'));
        $arr['site']=Db::query(Sql::$str98,[$bank]);
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
    }else {
     return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
    }
}

public static function i($name){
    $tf=null;
    if(isset($_POST[$name])){
        $tf=$_POST[$name];
    }
    return $tf;
}

public function changesite(){
    if(cookie('u')){
        $type=Index::i('type');
        $site_id=Index::i('site_id');
        $consignee=Index::i('consignee');
        $site_region=Index::i('site_region');
        $site_info=Index::i('site_info');
        $site_iphone=Index::i('site_iphone');
        $default_tf=Index::i('default_tf');
        $bank=base64_decode(cookie('u'));
        if($type==0&&$site_id){//设置默认地址
            $res=Db::query(Sql::$str99,[$bank]);
            if(sizeOf($res)>0){ 
                Db::name('site')
                ->where(['user_id'=>$bank,'site_id'=>$res[0]['site_id']])
                ->update(['default_tf' =>1]);//修改原来默认地址的数据

                Db::name('site')
                ->where(['user_id'=>$bank,'site_id'=>$site_id])
                ->update(['default_tf' =>0]);//设置默认地址
            }
            return json(['code'=>200,'data'=>true,'msg'=>'默认地址设置成功']);
        }
        if($type==2&&$site_id){
            $res=Db::query(Sql::$str100,[$bank,$site_id]);
            if(sizeOf($res)>0){
                $data=$res[0];
                if($consignee){
                    $data['consignee']=$consignee;
                }
                if($site_region){
                    $data['site_region']=$site_region;
                }
                if($site_info){
                    $data['site_info']=$site_info;
                }
                if($site_iphone){
                    $data['site_iphone']=$site_iphone;
                }
                if($default_tf==0){
                   if($default_tf==0){ //修改的同时可以设置默认地址
                    $min=Db::query(Sql::$str99,[$bank]);
                    if(sizeOf($min)>0){ 
                        Db::name('site')
                        ->where(['user_id'=>$bank,'site_id'=>$min[0]['site_id']])
                        ->update(['default_tf' =>1]);//修改原来默认地址
                    }
                   }
                }
                $data['default_tf']=$default_tf;
                Db::name('site')
                ->where(['user_id'=>$bank,'site_id'=>$site_id])
                ->update($data);//修改地址表中的数据
                return json(['code'=>200,'data'=>true,'msg'=>'地址修改成功']);
            }else {
                  return json(['code'=>200,'data'=>true,'msg'=>'地址ID错误']);
            }
        }

        if($type==3&&$bank){//添加地址
            $data=[];
            $data['consignee']=$consignee;
            $data['site_region']=$site_region;
            $data['site_info']=$site_info;
            $data['site_iphone']=$site_iphone;
            $data['default_tf']=$default_tf;
            $data['user_id']=$bank;
            if($default_tf==0){
                $min=Db::query(Sql::$str99,[$bank]);
                if(sizeOf($min)>0){ 
                    Db::name('site')
                    ->where(['user_id'=>$bank,'site_id'=>$min[0]['site_id']])
                    ->update(['default_tf' =>1]);//修改原来默认地址
                }
            }
            Db::name('site')->insert($data);
            return json(['code'=>200,'data'=>true,'msg'=>'地址添加成功']);
        }
        if($type==4&&$site_id){
            Db::table('site')->where('site_id',$site_id)->delete();
            return json(['code'=>200,'data'=>true,'msg'=>'地址删除成功']);
        }
    }else {
     return json(['code'=>200,'data'=>false,'msg'=>'用户未登录']);
    }
}



public function submitform(){
    if(cookie('u')){
        $character=Index::i('character');
        $site_id=Index::i('site_id');
        $discount_id=Index::i('discount_id');
        $integral=Index::i('integral');
        $bank=base64_decode(cookie('u'));
        if(!is_array($discount_id)){
            $discount_id=explode(',',$discount_id);
        }
        $sk=false;
        $index=new Index();
        $res=$index->carinfo();
        $res=json_decode($res->getContent(),true);//助手函数json转普通数组
        $rate=$res['rate'];
        if($character&&$site_id){
            $money=Db::query(Sql::$str102,[$bank])[0];
            if($money['small_money']>=$rate){//判断用户账户钱是否足够
                if($money['integral']>=$integral){//判断积分是否足够
                    $zfb=Db::query(Sql::$str103,[$bank,$character]);//判断支付密码是否正确
                    if(sizeOf($zfb)>0){
                       
                        // $sk=Db::query(Sql::$str104,[$bank]);
                        // if(sizeOf($sk)>0){ //获取下单商品是否为秒杀商品 (用于swoole连接)
                            
                        // }
                        foreach ($res['data'] as $key => $value) {
                            if(sizeOf($value['data'])>0){//循环获取商品的最终价格
                                $count=0;
                                foreach ($value['data'] as $k => $v) {
                                 if($v['input']==0){
                                           $count++;
                                 }
                                }
                                foreach ($value['data'] as $k => $v) {
                                    if($v['input']==0){
                                        $sk=Db::query(Sql::$str206,[$v['commodity_info_id']]);
                                        if(sizeOf($sk)>0){//是否是秒杀商品
                                            $sk=$sk[0];
                                            $oo=[];
                                            $oo['commodity_num_sheng']=$sk['commodity_num_sheng']+1;
                                            Db::name('seckill_time_info')
                                            ->where('seckill_time_info_id', $sk['seckill_time_info_id'])
                                            ->update(['commodity_num_sheng' => $sk['commodity_num_sheng']+1]);
                                        }
                                        //商品销量++
                                        $sum_s=Db::query(Sql::$str125,[$v['commodity_info_id']]);
                                        if(sizeOf($sum_s)>0){
                                            $newsum=$sum_s[0]['store_commodity_id']+1;
                                            Db::name('store_commodity')
                                            ->where('store_commodity_id', $sum_s[0]['store_commodity_id'])
                                            ->update(['store_commodity_sum' =>$newsum ]);
                                        }
                                        $m=Db::query(Sql::$str152,[$res['data'][$key]['shop_id']]);
                                        if(sizeOf($m)>0){
                                            //添加平台托管资金
                                            $sdf=$m[0]['money']+$v['sss'];
                                       
                                            if($integral){//判断是否使用了积分
                                                $s_jf=$m[0]['jf']+round($integral/$count,0);
                                                Db::name('app_money')
                                                ->where('shop_id', $res['data'][$key]['shop_id'])
                                                ->update(['money' =>$sdf,'jf'=>$s_jf]);
                                            }else {
                                                Db::name('app_money')
                                                ->where('shop_id', $res['data'][$key]['shop_id'])
                                                ->update(['money' =>$sdf]);
                                            }
                                        }else { //如果没有该店铺字段则添加一条数据存放托管资金
                                            $data = ['shop_id' => $res['data'][$key]['shop_id'], 'money' =>$v['sss']];
                                            Db::name('app_money')->insert($data);
                                        }

                                        $jie_j=Db::query(Sql::$str181,[$v['commodity_info_id']])[0];
                                       
                                        foreach ($v['info']['data'] as $e => $a) {
                                            if($v['info']['data'][$e]['name']==$v['type']){
                                                $v['info']['data'][$e]['num']-=$v['sum'];//更改库存
                                            }
                                        }
                                        $data_j=json_encode($v['info']);
                                        if($jie_j['activity_tf']==0){
                                            Db::name('commodity_info')
                                            ->where('commodity_info_id', $v['commodity_info_id'])
                                            ->update(['commodity_info_data' => $data_j]);
                                        }else {
                                            Db::name('commodity_info')
                                            ->where('commodity_info_id', $v['commodity_info_id'])
                                            ->update(['commodity_info_activity' => $data_j]);
                                        }
                                  
                                      


                                        $data=[];
                                        $data['indent_sum']=$v['sss'];//存放商品最终价格
                                        $data['user_id']=$bank;//存放用户ID
                                        $data['state']=0;//设置订单状态                         
                                        $data['sum']= $v['sum'];//存放商品总数量                           
                                        $data['vip_z']= $v['vip']?$v['money']*(1-$v['vip'])*$v['sum']:0;//存放vip优惠价格                           
                                        $data['cmm_id']=$v['commodity_info_id'];//存放商品ID       
                                        $data['pattern']=0;//设置支付方式
                                        $data['send_time']=date('Y-m-d H:i:s');
                                        $data['pay_time']=date('Y-m-d H:i:s');
                                        $data['promotion']=$v['yuan']-$v['sss'];//存放优惠的价格和
                                        $data['cash']=round($integral/$count,0);
                                        $data['freight']=0;
                                        $data['site_id']=$site_id;
                                        $data['evaluate_tf']=0;
                                        $j=Db::query(Sql::$str105,[$v['store_commodity_id']]);
                                        if(sizeOf($j)>0){
                                            if($j[0]['store_commodity_data']){
                                                $js=json_decode($j[0]['store_commodity_data'],true,320);
                                                foreach ($js['data'] as $e => $l) {
                                                    if($l['commodity_info_id']==$v['commodity_info_id']){
                                                        if(isset($l['name'][0])){
                                                            $data['type']=json_encode(['name'=>$l['name'],"son"=>['name'=>$v['type'],'moeny'=>$v['money']]],320);
                                                        }
                                                    }
                                                }
                                            }else {
                                                $data['type']=json_encode(['name'=>'',"son"=>['name'=>$v['type'],'moeny'=>$v['money']]],320);
                                            }
                                        }
                                        Db::name('indent')->insert($data);
                                    }
                                }
                            }
                        }
                       if(sizeOf($discount_id)>0){
                        foreach ($discount_id as $key => $value) {
                            Db::name('user_discount')
                            ->where(['discount_id'=>$value,'user_id'=>$bank])
                            ->update(['discount_state' =>1]);
                        }
                       }
                        Db::name('money')
                        ->where('user_id', $money['user_id'])
                        ->update(['small_money' =>$money['small_money']-$rate-round($integral,2),
                            'integral'=>$money['integral']-$integral
                        ] );
                        Db::table('commodity_collect')->where(['user_id'=>$bank,'input'=>0])->delete();

                        return json(['code'=>200,'data'=>true,'msg'=>'支付成功']);
                    }else {
                         return json(['code'=>205,'data'=>false,'msg'=>'支付密码不正确请重新输入']);
                    }
                }else {
                 return json(['code'=>204,'data'=>false,'msg'=>'账户积分不足']);
                }
            }else {
                 return json(['code'=>203,'data'=>false,'msg'=>'账户余额不足请充值']);
            }
        }else {
         return json(['code'=>202,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
     return json(['code'=>206,'data'=>false,'msg'=>'用户未登录']);

    }
}

public function replycomments(){
    $info=Index::i('info');
    $target_user_id=Index::i('target_user_id');
    $parent_id=Index::i('parent_id');
    if($target_user_id&&$target_user_id&&$parent_id&&$info){
        if(cookie('u')){
            $bank=base64_decode(cookie('u'));
                $data = [
                    'commodity_comment_parent_id' => $parent_id, 
                    'commodity_comment_son_user_id' => $bank ,
                    'commodity_comment_son_target_id' => $target_user_id,
                    'commodity_comment_son_title' => $info,
                    'commodity_comment_son_send_time'=>date('Y-m-d H:i:s')
                    ];
                Db::name('commodity_comment_son')->insert($data);
                return json(['code'=>200,'data'=>true,'msg'=>'回复成功']);
        }else {
                 return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
        }
    }else {
        return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
    }
}

public function replycommentslike(){
    $type=Index::i('type');
    $id=Index::i('id');
    $like=Index::i('like');
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        if($like==1){
            $old=Db::query(Sql::$str106,[$bank,$type,$id]);
            if(sizeOf($old)>0){
                Db::table('user_commodity_comment_like')->where('commodity_comment_like_id',$old[0]['commodity_comment_like_id'])->delete();
            }
            if($type==0){//为评论
                $min=Db::query(Sql::$str107,[$id]);
                if(sizeOf($min)>0){
                    Db::name('commodity_comment_parent')
                    ->where('commodity_comment_parent_id',$min[0]['commodity_comment_parent_id'] )
                    ->update(['commodity_comment_parent_like' => $min[0]['commodity_comment_parent_like']-1]);
                }
            }else {//为回复
                $min=Db::query(Sql::$str108,[$id]);
                if(sizeOf($min)>0){
                    Db::name('commodity_comment_son')
                    ->where('commodity_comment_son_id',$min[0]['commodity_comment_son_id'] )
                    ->update(['commodity_comment_son_like' => $min[0]['commodity_comment_son_like']-1]);
                }
            }
        }else {
            $data = [
                'user_id' => $bank, 
                'type' => 0,
                'son_tf' => $type,
                'tf_id' => $id,
                'send_time' =>date('Y-m-d H:i:s'),
            ];
            if($type==0){//为评论
                $min=Db::query(Sql::$str107,[$id]);
                if(sizeOf($min)>0){
                    Db::name('commodity_comment_parent')
                    ->where('commodity_comment_parent_id',$min[0]['commodity_comment_parent_id'] )
                    ->update(['commodity_comment_parent_like' => $min[0]['commodity_comment_parent_like']+1]);
                }
            }else {//为回复
                $min=Db::query(Sql::$str108,[$id]);
                if(sizeOf($min)>0){
                    Db::name('commodity_comment_son')
                    ->where('commodity_comment_son_id',$min[0]['commodity_comment_son_id'] )
                    ->update(['commodity_comment_son_like' => $min[0]['commodity_comment_son_like']+1]);
                }
            }
            Db::name('user_commodity_comment_like')->insert($data);
        }
        return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function userindex(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=[];
        $user_info=Db::query(Sql::$str109,[$bank,$bank,$bank]);//获取用户基本信息钱包
        $user_indent=Db::query(Sql::$str110,[$bank]);//获取最近两笔订单
        $user_indent_p_sum=Db::query(Sql::$str111,[$bank]);//获取未评价订单数量
        $dai_sum=Db::query(Sql::$str116,[$bank]);//获取待发货订单数量
        $yi_cmm_sum=Db::query(Sql::$str117,[$bank]);//获取已发货订单数量
        $tui_sum=Db::query(Sql::$str118,[$bank]);//获取退换货订单数量
        $user_cmm_info=Db::query(Sql::$str112,[$bank]);//获取常购商品
        $questions=Db::query(Sql::$str113,[$bank]);//获取问答邀请提问
        $vip_cmm=Db::query(Sql::$str114);//获取vip商品
        $dss_sum=Db::query(Sql::$str257,[$bank])[0]['guan'];//用户优惠券数量
        $shop_like_sum=Db::query(Sql::$str256,[$bank])[0]['guan'];//获取用户关注店铺数量
        $arr['shop_like_sum']=$shop_like_sum;
        if(sizeOf($user_indent)>0){
            foreach ($user_indent as $key => $value) {
                if($value['type']){
                    $user_indent[$key]['type']=json_decode($value['type']);
                }
                $user_indent[$key]['imgs']=json_decode($value['imgs'])[0];
            }
            $arr['user_indent']=$user_indent;
        }else {
            $arr['user_indent']=[];
        }
        if(sizeOf($user_indent_p_sum)>0){
            $arr['user_indent_p_sum']=$user_indent_p_sum[0]['user_indent_p_sum'];
        }else {
            $arr['user_indent_p_sum']=0;
        }
        if(sizeOf($dai_sum)>0){
            $arr['dai_sum']=$dai_sum[0]['dai_sum'];
        }else {
            $arr['dai_sum']=0;
        }
        if(sizeOf($yi_cmm_sum)>0){
            $arr['yi_cmm_sum']=$yi_cmm_sum[0]['dai_sum'];
        }else {
            $arr['yi_cmm_sum']=0;
        }
        if(sizeOf($tui_sum)>0){
            $arr['tui_sum']=$tui_sum[0]['dai_sum'];
        }else {
            $arr['tui_sum']=0;
        }
        if(sizeOf($user_cmm_info)>0){
            foreach ($user_cmm_info as $key => $value) {
                $user_cmm_info[$key]['imgs']=json_decode($value['imgs'])[0];
            }
            $arr['user_cmm_info']=$user_cmm_info;
        }else {
            $arr['user_cmm_info']=[];
        }
        if(sizeOf($questions)>0){
            foreach ($questions as $key => $value) {
                $questions[$key]['imgs']=json_decode($value['imgs'])[0];
            }
            $arr['questions']=$questions;
        }else {
            $arr['questions']=[];
        }
        if(sizeOf($vip_cmm)>0){
            foreach ($vip_cmm as $key => $value) {
                $vip_cmm[$key]['imgs']=json_decode($value['imgs'])[0];
            }
            $arr['vip_cmm']=$vip_cmm;
        }else {
            $arr['vip_cmm']=[];
        }
        $arr['user_info']=$user_info[0];
        $arr['user_info']['user_discount_count']=$dss_sum;

        return json(['code'=>200,'data'=>$arr,'msg'=>'操作成功']);

    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }

}


public function usermenu($time='2022-1-1 00:00:00'){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=Db::query(Sql::$str119,[$bank,$time]);
        if(sizeOf($arr)>0){
            foreach ($arr as $key => $value) {
                $arr[$key]['type']=json_decode($value['type']);
                $arr[$key]['imgs']=json_decode($value['imgs'])[0];
            }
        }
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function shippingcomment($id){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=Db::query(Sql::$str120,[$id]);
        if(sizeOf($arr)>0){
            $arr=$arr[0];
            $arr['imgs']=json_decode($arr['imgs'])[0];
            $arr['type']=json_decode($arr['type']);
            return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
        }else {
            return json(['code'=>202,'data'=>$arr,'msg'=>'订单不存在或者评论完成']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);

    }
}


public function makecomments(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $synthesis=Index::i('synthesis');
        $manner=Index::i('manner');
        $logistics=Index::i('logistics');
        $commodity=Index::i('commodity');
        $indent_id=Index::i('indent_id');
        $speech=Index::i('speech');
        //不打算改评分 因为没有相对应的字段
        if($synthesis&&$manner&&$logistics&&$logistics&&$commodity&&$indent_id&&$speech){
            $indent_info=Db::query(Sql::$str121,[$indent_id]);
            if(sizeOf($indent_info)>0){
                Db::name('indent')
                ->where('indent_id',$indent_id)
                ->update(['evaluate_tf' => 1]);//修改订单 是否已评论
                $indent_info=$indent_info[0];
                $data=[];
                $data['commodity_type_id']=$indent_info['commodity_type_id'];
                $data['indent_id']=$indent_info['indent_id'];
                $data['commodity_comment_parent_send_time']=date('Y-m-d H:i:s');
                $data['commodity_comment_parent_title']=$speech;
                $data['user_id']=$bank;
                $data['commodity_comment_parent_like']=0;
                $data['commodity_comment_parent_trample']=0;
                $data['commodity_info_id']=$indent_info['cmm_id'];
                $data['commodity_comment_parent_grader']=$commodity;
                
                $img_arr=[];
                $video_arr=[];
                $arr_type=['image/jpg','image/jpeg','image/gif','image/pjpeg','image/png'];
                $arr_type_o=['video/mp4'];

                $jf=Db::query(Sql::$str150,[$bank]);
                if(sizeOf($jf)>0){
                    $m=$jf[0]['integral']+50;
                Db::name('money')
                ->where('user_id', $bank)
                ->update(['integral' =>$m]);
                }
                $ss=Db::query(Sql::$str153,[$indent_id]);
                if(sizeOf($ss)>0){
                    $shop=Db::query(Sql::$str154,[$ss[0]['shop_id']]);
                   if(sizeOf($shop)>0){
                     $shop_jf=$shop[0]['shop_jf']-50;
                     Db::name('shop_info')
                     ->where('shop_id', $ss[0]['shop_id'])
                     ->update(['shop_jf' => $shop_jf]);
                   }
                }


                
                if(isset($_FILES['file'])){//判断文件是否存在
                    foreach ($_FILES['file']['name'] as $k => $value) {//循环上传文件
                        if(is_uploaded_file($_FILES['file']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                            $type=substr($_FILES['file']['name'][$k],strpos($_FILES['file']['name'][$k],'.'));
                            $fileName=time().rand().$type;//修改文件名称
                            if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/file/'.$fileName)){//move_uploaded_file更改文件的路径
                                if((in_array($_FILES['file']['type'][$k],$arr_type))){//为img时
                                    array_push($img_arr,'/file/'.$fileName);
                                }
                                if((in_array($_FILES['file']['type'][$k],$arr_type_o))){//为video时
                                    array_push($video_arr,'/file/'.$fileName);
                                }
                            }
                        }
                    }
                }
                $data['commodity_comment_parent_img']=json_encode($img_arr,320);
                $data['commodity_comment_parent_video']=json_encode($video_arr,320);
                Db::name('commodity_comment_parent')->insert($data);


             return json(['code'=>200,'data'=>$data,'msg'=>'发表成功']);
            }else {
             return json(['code'=>202,'data'=>false,'msg'=>'此订单不存在']);
            }
        }else {
        return json(['code'=>202,'data'=>false,'msg'=>'缺少参数']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function additionalreview(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=Db::query(Sql::$str122,[$bank,$bank]);
        if(sizeOf($arr)>0){
            foreach ($arr as $key => $value) {
                $arr[$key]['type']=json_decode($value['type']);
                $arr[$key]['imgs']=json_decode($value['imgs'])[0];
            }
        }
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function addmakecomments(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $indent_id=Index::i('indent_id');
        $speech=Index::i('speech');
        //不打算改评分 因为没有相对应的字段
        if($speech&&$indent_id){
                $img_arr=[];
                $video_arr=[];
                $data=[];
           
                $arr_type=['image/jpg','image/jpeg','image/gif','image/pjpeg','image/png'];
                $arr_type_o=['video/mp4'];
                if(isset($_FILES['file'])){//判断文件是否存在
                    foreach ($_FILES['file']['name'] as $k => $value) {//循环上传文件
                        if(is_uploaded_file($_FILES['file']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                            $type=substr($_FILES['file']['name'][$k],strpos($_FILES['file']['name'][$k],'.'));
                            $fileName=time().rand().$type;//修改文件名称
                            if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/file/'.$fileName)){//move_uploaded_file更改文件的路径
                                if((in_array($_FILES['file']['type'][$k],$arr_type))){//为img时
                                    array_push($img_arr,'/file/'.$fileName);
                                }
                                if((in_array($_FILES['file']['type'][$k],$arr_type_o))){//为video时
                                    array_push($video_arr,'/file/'.$fileName);
                                }
                            }
                        }
                    }
                }
                $data['commodity_comment_parent_info_add_img']=json_encode($img_arr,320);
                $data['commodity_comment_parent_info_add_video']=json_encode($video_arr,320);
                $data['commodity_comment_parent_info_add']=$speech;
                $data['commodity_comment_parent_info_add_time']=date('Y-m-d H:i:s');
                Db::name('commodity_comment_parent')
                ->where('indent_id', $indent_id)
                ->update($data);

                $ss=Db::query(Sql::$str153,[$indent_id]);
                if(sizeOf($ss)>0){
                    $shop=Db::query(Sql::$str154,[$ss[0]['shop_id']]);
                   if(sizeOf($shop)>0){
                     $shop_jf=$shop[0]['shop_jf']-30;
                     Db::name('shop_info')
                     ->where('shop_id', $ss[0]['shop_id'])
                     ->update(['shop_jf' => $shop_jf]);
                   }
                }


                $jf=Db::query(Sql::$str150,[$bank]);
                if(sizeOf($jf)>0){
                    $m=$jf[0]['integral']+30;
                    Db::name('money')
                    ->where('user_id', $bank)
                    ->update(['integral' =>$m]);
                }
             return json(['code'=>200,'data'=>$data,'msg'=>'发表成功']);
        }else {
        return json(['code'=>202,'data'=>false,'msg'=>'缺少参数']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function likeshop(){
    if(cookie('u')){
        $store_id=Index::i('store_id');
        if($store_id){
            $bank=base64_decode(cookie('u'));
            $arr=Db::query(Sql::$str123,[$bank,$store_id]);
            $sum=Db::query(Sql::$str128,[$store_id]);
            if(sizeOf($arr)>0){
                Db::table('user_store_attention_like')->where('store_attention_id',$arr[0]['store_attention_id'])->delete();
                Db::name('shop')
                ->where('shop_id', $sum[0]['shop_id'])
                ->update(['attention' => $sum[0]['attention']-1]);
            }else {
                $data = ['user_id' => $bank, 'store_id' => $store_id];
                Db::name('user_store_attention_like')->insert($data);
                Db::name('shop')
                ->where('shop_id', $sum[0]['shop_id'])
                ->update(['attention' => $sum[0]['attention']+1]);
            }
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function cmmaddquiz(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $id=Index::i('id');
        $speech=Index::i('speech');
        if($id&&$speech){
            $res=Db::query(Sql::$str124,[$id]);
            if(sizeOf($res)>0){
                $data = ['send_time'=>date('Y-m-d H:i:s'),'commodity_issue_title' =>$speech, 'user_id' => $bank,'store_commodity_id'=>$res[0]['commodity_type_id']];
                Db::name('commodity_issue_parent')->insert($data);
                return json(['code'=>200,'data'=>true,'msg'=>'提问成功']);
            }else {
                return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
            }
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function userlikeshop(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr_s=Db::query(Sql::$str127,[$bank]);
        $arr=[];
        $data=[];
        if(sizeOf($arr_s)>0){
            foreach ($arr_s as $k => $v) {
                $arr=Db::query(Sql::$str126,[$bank,$v['store_id']]);
                foreach ($arr as $key => $value) {
                    $arr[$key]['imgs']=json_decode($value['imgs'])[0];
                }
                $arr_s[$k]['data']=$arr;
                $arr_s[$k]['key']=0;
                $arr_s[$k]['dat_key']=1;
            }
            $data=$arr_s;
        }
        return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}



public function userdiscount(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));

        $data=Db::query(Sql::$str129,[$bank]);
        return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);

    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function appdiscount($category_parent_id=false){
    $bank=-1;
    $arr=[];
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
    }
    $str1=Sql::$str130;
    $jian='';
    if($category_parent_id){
        $jian=' AND `type`='.$category_parent_id.' ';
    }
    $str1=$str1.$jian.Sql::$str140;
    $data=Db::query($str1,[$bank]);
    if(sizeOf($data)>0){
        foreach ($data as $key => $value) {
            $img='';
            if($value['imgs']){
                $img=json_decode($value['imgs'])[0];
            }
            $value['img']=$img;
            $value['imgs']='';
           array_push($arr,$value);
        }
    }

    $str2=Sql::$str131;
    if($category_parent_id){
        $str2.=' AND `type`='.$category_parent_id;
    }
    $data_son=Db::query($str2,[$bank]);
    if(sizeOf($data_son)>0){
        foreach ($data_son as $key => $value) {
            $min_arr=Db::query(Sql::$str132,[$value['discount_id'],$bank]);
            $img='';
            if(sizeOf($min_arr)>0&&isset($min_arr[0]['imgs'])){
                $img=json_decode($min_arr[0]['imgs'])[0];
            }
            $data_son[$key]['img']=$img;
            array_push($arr,$data_son[$key]);
        }
    }

    $data_arr=Db::query(Sql::$str133,[$bank]);
    if(sizeOf($data_arr)>0){
        foreach ($data_arr as $key => $value) {
            array_push($arr,$value);
         }
    }

    $str3=Sql::$str134;
    $jian='';
    if($category_parent_id){
        $jian=' WHERE shop_type='.$category_parent_id.' ';
    }
    $str3=$str3.$jian.Sql::$str136;
    $data_son=Db::query($str3,[$bank]);
    if(sizeOf($data_son)>0){
        foreach ($data_son as $key => $value) {
            $min_arr=Db::query(Sql::$str135,[$value['shop_id']]);
            $img='';
            if(sizeOf($min_arr)>0&&isset($min_arr[0]['imgs'])){
                $img=json_decode($min_arr[0]['imgs'])[0];
            }
            $data_son[$key]['img']=$img;
            array_push($arr,$data_son[$key]);
        }
    }
    $cout=[];
    $cout_key=[];
    if(sizeOf($arr)>0){
        foreach ($arr as $key => $value) {
            if(in_array($value['discount_id'],$cout)){

            }else {
                array_push($cout,$value['discount_id']);
                array_push($cout_key,$value);
            }
        }
    }
    return json(['code'=>200,'data'=>$cout_key,'msg'=>'获取成功']);
}


public function answers($type){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=[];
        if($type==0){
            $arr=Db::query(Sql::$str142,[$bank]);
            if(sizeOf($arr)>0){
                foreach ($arr as $key => $value) {
                    $arr[$key]['show']=false;
                    $arr[$key]['img']=json_decode($value['imgs'])[0];
                    $arr[$key]['imgs']='';
                    $arr[$key]['childer']=Db::query(Sql::$str143,[$value['commodity_issue_id']]);
                }
            }
        }else if($type==1){
            $arr=Db::query(Sql::$str144,[$bank]);
            if(sizeOf($arr)>0){
                foreach ($arr as $key => $value) {
                    $arr[$key]['show']=false;
                    $arr[$key]['img']=json_decode($value['imgs'])[0];
                    $arr[$key]['imgs']='';
                    $arr[$key]['childer']=Db::query(Sql::$str143,[$value['commodity_issue_id']]);
                }
            }
        }else if($type==2){
            $arr=Db::query(Sql::$str145,[$bank,$bank]);
            if(sizeOf($arr)>0){
                foreach ($arr as $key => $value) {
                    $arr[$key]['show']=false;
                    $arr[$key]['img']=json_decode($value['imgs'])[0];
                    $arr[$key]['imgs']='';
                }
            }
        }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);

    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function replyquiz(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $commodity_issue_id=Index::i('commodity_issue_id');
        $target_user_id=Index::i('target_user_id');
        $speech=Index::i('speech');
        if($commodity_issue_id&&$target_user_id&&$speech){
            $data = [
                'commodity_issue_id' => $commodity_issue_id,
                 'target_id' => $target_user_id,
                 'user_id' => $bank,
                 'commodity_issue_son_info' => $speech,
                 'commodity_issue_son_like' =>0,
                 'commodity_issue_son_trample' =>0,
                 'send_time' =>date('Y-m-d H:i:s'),
                ];
            Db::name('commodity_issue_son')->insert($data);
            return json(['code'=>200,'data'=>true,'msg'=>'发表成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function remaining($time='2022-1-1 00:00:00'){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $jian=' ORDER BY  `time` DESC ';
        if($time!='false'){
            $jian=' WHERE `time`>=?  ORDER BY  `time` DESC';
        }
        $str=Sql::$str146.$jian;
        $arr=[];
        if($time!='false'||($time==false)){
            $arr=Db::query($str,[$bank,$bank,$time]);
        }else {
            $arr=Db::query($str,[$bank,$bank]);
        }
        $y=Db::query(Sql::$str147,[$bank]);
        return json(['code'=>200,'remaining'=>$y[0]['small_money'],'data'=>$arr,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function deldiscount(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $user_discount_id=Index::i('user_discount_id');
        if($user_discount_id){
            $res=Db::query(Sql::$str148,[$user_discount_id,$bank]);
            if(sizeOf($res)>0){
                Db::table('user_discount')->where('user_discount_id',$user_discount_id)->delete();
                return json(['code'=>200,'data'=>true,'msg'=>'删除成功']);
            }else {
                 return json(['code'=>405,'data'=>false,'msg'=>'该优惠券不是该用户的或者优惠券ID错误']);
            }
        }else {
        return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function userintegral($time=false){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=[];
        $jian=' ORDER BY `time` DESC ';
        if($time=='false'||($time==false)){//获取全部明细
            
        }else {
            $jian=' WHERE `time` >= "'.$time.'"  '.$jian;
        }
        $str=Sql::$str149.$jian;
        $arr=Db::query($str,[$bank,$bank,$bank,$bank,$bank]);
        $rework=0;//存放购物反回的积分
        $comment=0;//存放评论反回的积分
        $cmm_sum=0;//存放积分支付的订单数
        $jie_sum=0;//存放积分抵扣积分
        if(sizeOf($arr)>0){
            foreach ($arr as $k => $v) {
                if($v['msg']=='购买商品积分支出'){
                    $jie_sum+=$v['money'];
                    $cmm_sum++;
                }else if($v['msg']=='购买商品积分收入'){
                    $rework+=$v['money'];
                }else if($v['msg']=='评价商品积分收入'){
                    $comment+=$v['money'];
                }
            }
        }
        $money=Db::query(Sql::$str150,[$bank]);
        return json(['code'=>200,'my_integral'=>$money[0]['integral'],'data'=>$arr,'rework'=>$rework,'comment'=>$comment,'cmm_sum'=>$cmm_sum,'jie_sum'=>$jie_sum,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function receiving(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $indent_id=Index::i('indent_id');
        if($bank&&$indent_id){
            $res=Db::query(Sql::$str151,[$bank,$indent_id]);
            if(sizeOf($res)>0){
                $dd=round($res[0]['indent_sum'],0);//存放返回用户的积分
                Db::name('indent')
                ->where('indent_id', $indent_id)
                ->update(['state' => 2,'integral'=>$dd]); //修改订单为完成状态 积分

                $jf=Db::query(Sql::$str150,[$bank]);
                if(sizeOf($jf)>0){
                    $m=$jf[0]['integral']+$dd;
                Db::name('money')
                ->where('user_id', $bank)
                ->update(['integral' =>$m]);
                } //增加用户积分

                $shop=Db::query(Sql::$str153,[$indent_id]);//获取 订单使用的余额和积分
                

                $m=Db::query(Sql::$str152,[$shop[0]['shop_id']]);//获取平台托管该店铺的资金
                if(sizeOf($m)>0){
                    //减去该店铺平台托管资金
                    $sdf=$m[0]['money']-$shop[0]['indent_sum'];//得到更新的托管资金
                    $sdf_jf=$m[0]['jf']-$shop[0]['cash'];//得到更新的托管积分
                    Db::name('app_money')
                    ->where('shop_id', $shop[0]['shop_id'])
                    ->update(['money' =>$sdf,'jf'=>$sdf_jf]);
                    $s=Db::query(Sql::$str154,[$shop[0]['shop_id']]);//获取店铺的余额 积分
                    if(sizeOf($s)>0){//添加店铺余额和积分
                        $s_ye=$s[0]['shop_money']+$shop[0]['indent_sum'];
                        $s_jf=$s[0]['shop_jf']+$shop[0]['cash']-$dd;//把用户用积分支付的钱转到店铺  店铺返回金额10%的积分
                        Db::name('shop_info')
                        ->where('shop_id', $shop[0]['shop_id'])
                        ->update(['shop_money' =>$s_ye,'shop_jf'=>$s_jf]);
                    }
                }
                
             return json(['code'=>200,'data'=>true,'msg'=>'收货成功']);
            }else {
            return json(['code'=>406,'data'=>false,'msg'=>'该订单不存在或者不是该用户的订单']);
            }
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function  sales(){
 if(cookie('u')){
    $bank=base64_decode(cookie('u'));
    $time=date('Y-m-d H:i:s',time()-24*60*60*15);//获取前半个月时间
    $arr=Db::query(Sql::$str155,[$time,$bank]);
    if(sizeOf($arr)>0){
        foreach ($arr as $k => $v) {
            if(isset($v['imgs'])){
                $arr[$k]['imgs']=json_decode($v['imgs'])[0];
            }
        }
    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}else {
    return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
}
}

public function  salesinfo($indent_id){
    if(cookie('u')){
       $bank=base64_decode(cookie('u'));
       $arr=Db::query(Sql::$str156,[$bank,$indent_id]);
       if(sizeOf($arr)>0){
           foreach ($arr as $k => $v) {
               if(isset($v['imgs'])){
                   $arr[$k]['imgs']=json_decode($v['imgs'])[0];
               }
           }
            return json(['code'=>200,'data'=>$arr[0],'msg'=>'获取成功']);
       }
   }else {
       return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
   }
}

public function addsales(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $indent_id=Index::i('indent_id');
        $sale_money=Index::i('sale_money');
        $user_info=Index::i('user_info');
        $user_title=Index::i('user_title');
        $shop_id=Index::i('shop_id');
        $type=Index::i('type');
        $i=Db::query(Sql::$str157,[$indent_id,$bank]);
        if(sizeOf($i)>0){
            if($indent_id&&$sale_money&&$user_info&&$user_title&&$shop_id){
                $img_arr=[];
                $video_arr=[];
                $arr_type=['image/jpg','image/jpeg','image/gif','image/pjpeg','image/png'];
                $arr_type_o=['video/mp4'];
                if(isset($_FILES['file'])){//判断文件是否存在
                    if(is_array($_FILES['file']['name'])){
                        foreach ($_FILES['file']['name'] as $k => $value) {//循环上传文件
                            if(is_uploaded_file($_FILES['file']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                                $type=substr($_FILES['file']['name'][$k],strpos($_FILES['file']['name'][$k],'.'));
                                $fileName=time().rand().$type;//修改文件名称
                                if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/sale/'.$fileName)){//move_uploaded_file更改文件的路径
                                   
                                    if((in_array($_FILES['file']['type'][$k],$arr_type))){//为img时
                                        array_push($img_arr,'/sale/'.$fileName);
                                    }
    
                                    if((in_array($_FILES['file']['type'][$k],$arr_type_o))){//为video时
                                        array_push($video_arr,'/sale/'.$fileName);
                                    }
                                }
                            }
                        }
                    }else {
                        if(is_uploaded_file($_FILES['file']['tmp_name'])){//is_uploaded_file判断是否上传文件:临时文件
                            $type=substr($_FILES['file']['name'],strpos($_FILES['file']['name'],'.'));
                            $fileName=time().rand().$type;//修改文件名称
                            if(move_uploaded_file($_FILES['file']['tmp_name'],'/www/wwwroot/127.0.0.1/shop/filter/sale/'.$fileName)){//move_uploaded_file更改文件的路径
                                if((in_array($_FILES['file']['type'],$arr_type))){//为img时
                                    array_push($img_arr,'/sale/'.$fileName);
                                }
                                if((in_array($_FILES['file']['type'],$arr_type_o))){//为video时
                                    array_push($video_arr,'/sale/'.$fileName);
                                }
                            }
                        }
                    }
                }

                $data=[];
                $data['indent_id']=$indent_id;
                $data['sale_money']=$sale_money;
                $data['user_info']=$user_info;
                $data['user_title']=$user_title;
                $data['sale_img']=json_encode($img_arr,320);
                $data['sale_videl']=json_encode($video_arr,320);
                $data['send_time']=date('Y-m-d H:i:s');
                $id=Db::name('indet_sale')->insertGetId($data); //售后表添加数据
          
                if($type==0){
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => 3,'sale_id'=>$id]);
                }else {
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' =>8,'sale_id'=>$id]);
                }//更改订单表状态
                return json(['code'=>200,'data'=>true,'msg'=>'提交成功']);
            }else {
                return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
            }
        }else {
            return json(['code'=>406,'data'=>false,'msg'=>'订单ID错误 或者不是该用户的订单 或 订单状态不符合要求']);
        }
     
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function returnlist($time=false,$type=0){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $jian='  WHERE ';
        $i=1;
        if($time==false||$time=='false'){
            $i--;
        }else {
            $jian.=' a.send_time>="'.$time.'"  ';
        }
        if($type==0){
            if($i==0){
                $jian.=' a.state>2 AND user_id='.$bank.'  ';
            }else {
                $jian.=' AND a.state>2  AND user_id='.$bank.'  ';
            }
        }else if($type==2){
            if($i==0){
                $jian.=' a.state IN (3,5,6,8,9,10) AND user_id='.$bank.'  ';
            }else {
                $jian.=' AND a.state IN (3,5,6,8,9,10) AND user_id='.$bank.'  ';
            }
        }else if($type==1){
            if($i==0){
                $jian.=' a.state IN (4,9) AND user_id='.$bank.'  ';
            }else {
                $jian.=' AND a.state IN (4,9) AND user_id='.$bank.'  ';
            }
        }
        $jian.=' ORDER BY a.sale_id DESC';
        $str=Sql::$str158.$jian;
        $arr=Db::query($str,[]);
        if(sizeOf($arr)>0){
            foreach ($arr as $k => $v) {
                $arr[$k]['imgs']=json_decode($v['imgs'])[0];
            }
        }
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function returnlistinfo($indent_id){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=Db::query(Sql::$str159,[$indent_id]);
        if(sizeOf($arr)>0){
            if(isset($arr[0]['sale_img'])){
                $arr[0]['sale_img']=json_decode($arr[0]['sale_img']);
            }else {
                $arr[0]['sale_img']=[];
            }

            if(isset($arr[0]['sale_videl'])){
                $arr[0]['sale_videl']=json_decode($arr[0]['sale_videl']);

            }else {
                $arr[0]['sale_videl']=[];
            }
            if(isset($arr[0]['imgs'])){
                $arr[0]['imgs']=json_decode($arr[0]['imgs'])[0];
            }
            return json(['code'=>200,'data'=>$arr[0],'msg'=>'获取成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'没有查询到该订单退款/退货详情']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function delivergoods($indent_id){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $indent_id=Index::i('indent_id');
        $state=Index::i('state');
        if($indent_id&&$state){
            if($state==5){
                $arr=Db::query(Sql::$str160,[$indent_id]);
                if(sizeOf($arr)>0){
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => $state]);
                }else {
                    return json(['code'=>406,'data'=>false,'msg'=>'该订单没有申请退货或者订单状态不正确']);
                }
            }
            if($state==6){
                $arr=Db::query(Sql::$str161,[$indent_id]);
                if(sizeOf($arr)>0){
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => $state]);
                }else {
                    return json(['code'=>406,'data'=>false,'msg'=>'该订单申请退货 用户没有发货 商家不能收货']);
                }
            }
            if($state==4||$state==7){
                $arr=Db::query(Sql::$str162,[$indent_id]);
                if(sizeOf($arr)>0){
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => $state]);
                    $arr=$arr[0];
                    if($state==4){
                        //进行退款操作  减去商家的积分  余额
                        $um=Db::query(Sql::$str165,[$bank]);//获取用户钱包

                        if(sizeOf($um)>0){
                            $um=$um[0];
                            $um['small_money']+=$arr['sale_money'];//用户余额添加退款金额
                            $um['integral']+=$arr['cash'];//用户积分添加支付使用积分

                            $arr['shop_money']-=$arr['sale_money'];//商家余额减去退款金额
                            $arr['shop_jf']-=$arr['cash'];//商家积分减去退款积分
                            Db::name('money')
                            ->where('user_id',$bank)
                            ->update(['small_money' => $um['small_money'],'integral'=>$um['integral']]);//数据库更新用户钱包
                          
                            Db::name('shop_info')
                            ->where('shop_id',$arr['shop_id'])
                            ->update(['shop_money' => $arr['shop_money'],'shop_jf'=>$arr['shop_jf']]);//数据库更新商家钱包
                        }
                    }else {
                        //不进行操作
                    }
                }else {
                    return json(['code'=>406,'data'=>false,'msg'=>'该订单申请退货 商家没有收货 不能进行该操作']);
                }
            }
            if($state==9||$state==10){
                $arr=Db::query(Sql::$str163,[$indent_id]);
                if(sizeOf($arr)>0){
                    $arr=$arr[0];
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => $state]);
                    if($state==9){
                        //进行退款操作  减去商家的积分  余额
                        $um=Db::query(Sql::$str165,[$user_id]);//获取用户钱包

                        if(sizeOf($um)>0){
                            $um=$um[0];
                            $um['small_money']+=$arr['sale_money'];//用户余额添加退款金额
                            $um['integral']+=$arr['cash'];//用户积分添加支付使用积分

                            $arr['shop_money']-=$arr['sale_money'];//商家余额减去退款金额
                            $arr['shop_jf']-=$arr['cash'];//商家积分减去退款积分
                            Db::name('money')
                            ->where('user_id',$bank)
                            ->update(['small_money' => $um['small_money'],'integral'=>$um['integral']]);//数据库更新用户钱包
                          
                            Db::name('shop_info')
                            ->where('shop_id',$arr['shop_id'])
                            ->update(['shop_money' => $arr['shop_money'],'shop_jf'=>$arr['shop_jf']]);//数据库更新商家钱包
                        }
                    }else {
                      
                    }
                }else {
                    return json(['code'=>406,'data'=>false,'msg'=>'该订单没有申请退款 不能进行该操作']);
                }
            }
            if($state==1){
                $arr=Db::query(Sql::$str164sdfsdfsdf,[$indent_id]);
                if(sizeOf($arr)>0){
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => 1,'sale_id'=>null]);
                }else {
                    return json(['code'=>406,'data'=>false,'msg'=>'该订单没有申请售后 不能进行该操作']);
                }
            }

            if($state==-1){
                $arr=Db::query(Sql::$str164,[$indent_id]);
                if(sizeOf($arr)>0){
                    Db::name('indent')
                    ->where('indent_id', $indent_id)
                    ->update(['state' => 2,'sale_id'=>null]);//更改订单状态
                    Db::table('indet_sale')->where('indet_sale_id',$arr[0]['sale_id'])->delete();//删除售后单
                }else {
                    return json(['code'=>406,'data'=>false,'msg'=>'该订单没有申请售后 不能进行该操作']);
                }
            }
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'请传入订单ID']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function waybinfo($indent_id){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $arr=Db::query(Sql::$str166,[$bank,$indent_id]);
        if(sizeOf($arr)>0){
                $arr=$arr[0];
                $arr['type']=json_decode($arr['type']);
                $arr['imgs']=json_decode($arr['imgs'])[0];
                return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
        }else {
        return json(['code'=>405,'data'=>false,'msg'=>'该订单不属于该用户或者订单号错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function channelsale($category_parent_id=false,$offset=0,$limit=20){
    $arr=[];   
    if($category_parent_id==false||$category_parent_id=='false'){
        $arr=Db::query(Sql::$str168,[$offset,$limit]);
    }else {
        $arr=Db::query(Sql::$str167,[$category_parent_id,$offset,$limit]);
    }
    if(sizeOf($arr)>0){
        foreach ($arr as $k => $v) {
            $arr[$k]['imgs']=json_decode($v['imgs'])[0];
        }
    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}


public function newproduct($category_parent_id=false,$offset=0,$limit=20){
    $arr=[];
    $time=date('Y-m-d H:i:s',time()-24*60*60*30);
    if($category_parent_id==false||$category_parent_id=='false'){
        $arr=Db::query(Sql::$str169,[$time,$offset,$limit]);
    }else {
        $arr=Db::query(Sql::$str170,[$category_parent_id,$time,$offset,$limit]);
    }
    if(sizeOf($arr)>0){
        foreach ($arr as $k => $v) {
            $arr[$k]['imgs']=json_decode($v['imgs'])[0];
        }
    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}


public function shopadminenter($username,$password){
    $data=[];
    if($username&&$password){
    $arr=Db::query(Sql::$str171,[$username,$password,$username]);
        if(sizeOf($arr)>0){
            cookie('shop_id', base64_encode(($arr[0]['shop_id']).''),60*60*24);
            cookie('shop_root', base64_encode(($arr[0]['shop_post'].'')),60*60*24);
            if(!cookie('u')){
                cookie('u', base64_encode($username),60*60*24);
            } 
            if(!cookie('p')){
                cookie('p', base64_encode($password),60*60*24);
            } 
            $data['shop_id']=$arr[0]['shop_id'];
            $data['shop_root']=$arr[0]['shop_post'];
            return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'账号或密码错误 或该用户不是商家账号']);
        }
    }else {
        return json(['code'=>406,'data'=>false,'msg'=>'参数错误']);
    }
}

public function shopadminentercookie(){
    if(cookie('u')&&cookie('p')&&cookie('shop_id')&&cookie('shop_root')){
        $username=base64_decode(cookie('u'));
        $password=base64_decode(cookie('p')) ;
        $data=[];
        if($username&&$password){
        $arr=Db::query(Sql::$str180,[$username,$password,$username]);
            if(sizeOf($arr)>0){
                $shop_id=base64_decode(cookie('shop_id'));
                $root=base64_decode(cookie('shop_root'));
                $data=Db::query(Sql::$str201,[$shop_id,$root]);
                $shop_name=Db::query(Sql::$str213,[$shop_id])[0]['shop_name'];
                $nickname=Db::query(Sql::$str214,[$username])[0]['nickname'];
                return json(['code'=>200,
                'root'=>$root,
                'bank'=>$username,
                'data'=>$data,
                'shop_name'=>$shop_name,
                'user_name'=>$nickname,
                'shop_id'=>$shop_id,
                'msg'=>'登录成功']);
            }else {
                return json(['code'=>405,'data'=>false,'msg'=>'账号或密码错误 或该用户不是商家账号']);
            }
        }else {
            return json(['code'=>406,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>406,'data'=>false,'msg'=>'cookie丢失']);
    }
   
}


public function shopstatistics(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));  
        $arr=Db::query(Sql::$str172,[$shop_id,$shop_id,$shop_id,$shop_id,$shop_id,$shop_id]);
        return json(['code'=>200,'data'=>$arr[0],'msg'=>'登录成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function echartsshop($day=7){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $arr=[];
        $arr_x_zong=[];//存放销量总数
        $arr_x_sum=[];//存放销量金额
        $arr_t_zong=[];//存放退款总数
        $arr_t_sum=[];//存放退款金额
        for ($i=0; $i <$day ; $i++) { 
            $time_end=date('Y-m-d',time()-24*60*60*($day-$i-1)).' 23:59:59';
            $time_send=date('Y-m-d',time()-24*60*60*($day-$i-1)).' 00:00:00';
            $str=Sql::$str174;
            $str.=' AND send_time>="'.$time_send.'" AND   send_time<="'.$time_end.'"';
            $res=Db::query($str,[$shop_id]);
            array_push($arr_x_zong,$res[0]['zong']);
            if($res[0]['he']){
                array_push($arr_x_sum,$res[0]['he']);
            }else {
                array_push($arr_x_sum,0);
            }

            $str=Sql::$str175;
            $str.=' AND send_time>="'.$time_send.'"  AND send_time<="'.$time_end.'"';
            $res_change=Db::query($str,[$shop_id]);
            array_push($arr_t_zong,$res_change[0]['zong']);
            if($res_change[0]['he']){
                array_push($arr_t_sum,$res_change[0]['he']);
            }else {
                array_push($arr_t_sum,0);
            }
        }
        $arr['xzong']= $arr_x_zong;
        $arr['xsum']= $arr_x_sum;
        $arr['tzong']= $arr_t_zong;
        $arr['tsum']= $arr_t_sum;
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}



public function shopindentall($limit=20,$offset=0){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $arr=Db::query(Sql::$str176,[$shop_id,$offset,$limit]);
        $sum=Db::query(Sql::$str177,[$shop_id]);
        if(sizeOf($arr)>0){
            foreach ($arr as $k => $v) {
                if($v['type']){
                    $arr[$k]['type']=json_decode($v['type']);
                    $min=json_decode($v['type'],true);
                    $arr[$k]['typename']=$min['name'].'  '.$min['son']['name'];
                    $arr[$k]['yuanmoney']=$min['son']['moeny']*$v['sum'];
                }
            }
        }
        return json(['code'=>200,'data'=>$arr,'sum'=>$sum[0]['zong'],'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function shopcmm($limit=20,$offset=0){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $arr=Db::query(Sql::$str178,[$shop_id,$offset,$limit]);
        if(sizeOf($arr)>0){
            foreach ($arr as $k => $v) {
                    $arr[$k]['imgs']=json_decode($v['imgs']);
                    $arr[$k]['videos']=json_decode($v['videos']);
                    $arr[$k]['commodity_info_data']=json_decode($v['commodity_info_data']);
                    if($arr[$k]['commodity_info_activity']){
                        $arr[$k]['commodity_info_activity']=json_decode($v['commodity_info_activity']);
                    }
                    if($arr[$k]['commodity_info_brief']){
                    $arr[$k]['commodity_info_brief']=json_decode($v['commodity_info_brief']);
                    }
                    if($arr[$k]['commodite_info_target']){
                        $arr[$k]['commodite_info_target']=json_decode($v['commodite_info_target']);
                    }
                    if($arr[$k]['commodity_info_img']){
                        $arr[$k]['commodity_info_img']=json_decode($v['commodity_info_img']);
                    }
            }
        }
        $category=Db::query(Sql::$str182,[$shop_id]);
        if(sizeOf($category)>0){
            foreach ($category as $k => $v) {
                $category[$k]['children']=Db::query(Sql::$str183,[$shop_id,$v['label']]);
            }
        }
        $appcategory=Db::query(Sql::$str184);
        if(sizeOf($appcategory)>0){
            foreach ($appcategory as $key => $value) {
                $value['children']=Db::query(Sql::$str185,[$value['value']]);
                if(sizeOf($value['children'])>0){
                    foreach ($value['children'] as $k => $v) {
                        $v['children']=Db::query(Sql::$str186,[$v['value']]);
                        $value['children'][$k]=$v;
                    }
                } 
                $appcategory[$key]=$value;
            }
        }
        $sum=Db::query(Sql::$str179,[$shop_id]);
        return json(['code'=>200,'appcategory'=>$appcategory,'category'=>$category,'data'=>$arr,'sum'=>$sum[0]['sum'],'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function updateshopcmm(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $commodity_info_id=Index::i('commodity_info_id');
        $type=Index::i('type');
        if(($commodity_info_id&&$type=='0')||$type=='1'){
            $activity_title=Index::i('activity_title');
            $brand=Index::i('brand');
            $commodite_info_target=Index::i('commodite_info_target');
            $commodity_info_activity=Index::i('commodity_info_activity');
            $commodity_info_data=Index::i('commodity_info_data');
            $commodity_info_activity_sent_time=Index::i('commodity_info_activity_sent_time');
            $commodity_info_activity_end_time=Index::i('commodity_info_activity_end_time');
            $del_imgs=Index::i('del_imgs');
            $del_videos=Index::i('del_videos');
            $del_commodity_info_img=Index::i('del_commodity_info_img');
            $commodity_info_state=Index::i('commodity_info_state');
            $commodity_info_brief=Index::i('commodity_info_brief');
            $shop_channel_id=Index::i('shop_category_id');
            $category_son_id_one=Index::i('category_son_id');
            $commodity_info_title=Index::i('commodity_info_title');

         

            if($del_imgs){
                $del_imgs=json_decode($del_imgs);
            }
            if($del_videos){
                $del_videos=json_decode($del_videos);
            }
            if($del_commodity_info_img){
                $del_commodity_info_img=json_decode($del_commodity_info_img);
            }

            if($type==1){
                $commodity_info_id = Db::name('commodity_info')->insertGetId([
                    'commodity_info_brief'=>json_encode(['name'=>'','son'=>['name'=>'']],320),
                    'commodity_info_data'=>json_encode([],320),
                    'imgs'=>json_encode([],320),
                    'videos'=>json_encode([],320),
                    'commodity_info_img'=>json_encode([],320),
                    'commodity_info_activity'=>json_encode([],320),
                    'commodite_info_target'=>json_encode([],320),
                    'shop_id'=>$shop_id,
                    'commodity_info_state'=>0,
                    'commodity_info_state_time'=>date('Y-m-d H:i:s')

                ]);
            }

            $res=Db::query(Sql::$str187,[$commodity_info_id]);
            if(sizeOf($res)>0){
                $res=$res[0];
            }else {
                return ;
            }

            if($commodity_info_state||$commodity_info_state=='0'||$commodity_info_state==0){
                if($commodity_info_state=='0'||$commodity_info_state==0){
                    $commodity_info_state=0;
                }else if($commodity_info_state=='1'||$commodity_info_state==1){
                    $commodity_info_state=1;
                }
                $res['commodity_info_state']=$commodity_info_state;
            }
            if($commodity_info_title){
                $res['commodity_info_title']=$commodity_info_title;
            }else if($type==1){ //当新增没有该字段的时候则不执行
                return ;
            }
            if($activity_title){
                $res['activity_title']=$activity_title;
            }
            if($brand){
                $res['brand']=$brand;
            }else if($type==1){ //当新增没有该字段的时候则不执行
                return ;
            }
            if($commodite_info_target){
                $res['commodite_info_target']=$commodite_info_target;
            }
            if($commodity_info_activity){
                $res['commodity_info_activity']=$commodity_info_activity;
            }
            if($commodity_info_data){
                $res['commodity_info_data']=$commodity_info_data;
            }else if($type==1){ //当新增没有该字段的时候则不执行
                return ;
            }
            if($commodity_info_activity_sent_time){
                $res['commodity_info_activity_sent_time']=$commodity_info_activity_sent_time;
            }
            if($commodity_info_activity_end_time){
                $res['commodity_info_activity_end_time']=$commodity_info_activity_end_time;
            }
            if($commodity_info_brief){
                $res['commodity_info_brief']=$commodity_info_brief;
            }
            if($shop_channel_id){
                $res['shop_channel_id']=$shop_channel_id;
            }else if($type==1){ //当新增没有该字段的时候则不执行
                return ;
            }
            if($category_son_id_one){
                $res['category_son_id_one']=$category_son_id_one;
            }else if($type==1){ //当新增没有该字段的时候则不执行
                return ;
            }
            
            function d($arr){
                foreach ($arr as $key => $value) {
                    if(!$value){
                        unset($arr[$key]); 
                    }
                }
                $arr=array_values($arr);
                return $arr;
            }

            $imgs=json_decode($res['imgs']);
            if($del_imgs&&sizeOf($del_imgs)>0){
                foreach ($del_imgs as $key => $value) {
                    $imgs[$value]=false;
                }
                $imgs=d($imgs);
            }
            $videos=json_decode($res['videos']);
            if($del_videos&&sizeOf($del_videos)>0){
                foreach ($del_videos as $key => $value) {
                    $videos[$value]=false;
                }
                $videos=d($imgs);
            }
            $commodity_info_img=json_decode($res['commodity_info_img']);
            if($del_commodity_info_img&&sizeOf($del_commodity_info_img)>0){
                foreach ($del_commodity_info_img as $key => $value) {
                    $commodity_info_img[$value]=false;
                }
                $commodity_info_img=d($imgs);
            }


            $add_imgs=[];
            $add_videos=[];
            $add_commodity_info_img=[];
            if(isset($_FILES['add_imgs'])){//判断文件是否存在
                foreach ($_FILES['add_imgs']['name'] as $k => $value) {//循环上传文件
                    if(is_uploaded_file($_FILES['add_imgs']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['add_imgs']['name'][$k],strpos($_FILES['add_imgs']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['add_imgs']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/commodity_info_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            array_push($add_imgs,'/commodity_info_img/'.$fileName);
                        }
                    }
                }
            }
            $imgs=json_encode(array_merge($imgs,$add_imgs),320);



            if(isset($_FILES['add_videos'])){//判断文件是否存在
                foreach ($_FILES['add_videos']['name'] as $k => $value) {//循环上传文件
                    if(is_uploaded_file($_FILES['add_videos']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['add_videos']['name'][$k],strpos($_FILES['add_videos']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['add_videos']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/commodity_info_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            array_push($add_videos,'/commodity_info_img/'.$fileName);
                        }
                    }
                }
            }
            if($videos){
                $videos=json_encode(array_merge($videos,$add_videos),320);
            }else {
                $videos=json_encode($add_videos,320);
            }

            if(isset($_FILES['add_commodity_info_img'])){//判断文件是否存在
                foreach ($_FILES['add_commodity_info_img']['name'] as $k => $value) {//循环上传文件
                    if(is_uploaded_file($_FILES['add_commodity_info_img']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['add_commodity_info_img']['name'][$k],strpos($_FILES['add_commodity_info_img']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['add_commodity_info_img']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/commodity_info_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            array_push($add_commodity_info_img,'/commodity_info_img/'.$fileName);
                        }
                    }
                }
            }
            $commodity_info_img=json_encode(array_merge($commodity_info_img,$add_commodity_info_img),320);
           
            if($imgs){
                $res['imgs']=$imgs;
            }
            if($videos){
                $res['videos']=$videos;
            }
            if($commodity_info_img){
                $res['commodity_info_img']=$commodity_info_img;
            }
            Db::name('commodity_info')
            ->where('commodity_info_id', $res['commodity_info_id'])
            ->update($res);
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'未传递商品ID']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function  getstorecommodity($offset=0,$limit=20){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $res=Db::query(Sql::$str188,[$shop_id,$offset,$limit]);
        if(sizeOf($res)>0){
            foreach ($res as $key => $value) {
                if($value['store_commodity_data']){
                    $res[$key]['store_commodity_data']=json_decode($value['store_commodity_data']);
                    $min=Db::query(Sql::$str189,[$value['store_commodity_id']]);
                    $res[$key]['childer']=[];
                    if(sizeOf($min)>0){
                        foreach ($min as $k => $v) {
                            array_push($res[$key]['childer'],$v['commodity_info_id']);
                        }
                    }
                }
            }
            $s=Db::query(Sql::$str190,[$shop_id]);
            $category=Db::query(Sql::$str182,[$shop_id]);
            if(sizeOf($category)>0){
                foreach ($category as $k => $v) {
                    $category[$k]['children']=Db::query(Sql::$str183,[$shop_id,$v['label']]);
                }
            }
                return json(['code'=>200,'category'=>$category,'cmm_id'=>$s,'data'=>$res,'msg'=>'获取成功']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function upadstorecommodity(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $store_commodity_id=Index::i('store_commodity_id');
        $type=Index::i('type');
        if(($store_commodity_id&&$type=='0')||$type=='1'){
            $data=[];
            $vip=Index::i('vip');
            $ze=Index::i('ze');
            $store_commodity_data=Index::i('store_commodity_data');
            $store_channel_id=Index::i('store_channel_id');
            if(!$store_commodity_data||!$store_channel_id){
                return ;
            }
            if($type=='1'){
                $store_commodity_id = Db::name('store_commodity')->insertGetId([
                    'store_id'=>$shop_id,
                    'freight_money'=>0,
                    'good_store'=>1,
                    'store_commodity_grade'=>1
                ]);
            }
            $data=Db::query(Sql::$str191,[$store_commodity_id])[0];


            if($vip){
                $data['vip']=floatval($vip);
            }
            if($ze){
                $data['ze']=floatval($ze);
            }
            if($store_commodity_data){
                if(sizeOf($store_commodity_data['data'])>0){
                    foreach ($store_commodity_data['data'] as $key => $value) {
                        $store_commodity_data['data'][$key]['commodity_info_id']=intval($value['commodity_info_id']);
                        Db::name('commodity_info')
                        ->where('commodity_info_id', $store_commodity_data['data'][$key]['commodity_info_id'])
                        ->update(['commodity_type_id' =>$data['store_commodity_id'] ]);
                    }
                }
                $data['store_commodity_data']=json_encode($store_commodity_data,320);
            }
            if($store_channel_id){
                $data['store_channel_id']=floatval($store_channel_id);
            }
            Db::name('store_commodity')
            ->where('store_commodity_id', $store_commodity_id)
            ->update($data);

            return json(['code'=>200,'data'=>$data,'msg'=>'操作成功']);
        }
        return json(['code'=>444]);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function getcommodity($tf=1){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $category=Db::query(Sql::$str192,[$shop_id]);
        if(sizeOf($category)>0){
            foreach ($category as $k => $v) {
                $category[$k]['children']=Db::query(Sql::$str193,[$shop_id,$v['label']]);
                if($category[$k]['shop_category_parent_brief']){
                    $category[$k]['shop_category_parent_brief']=json_decode($category[$k]['shop_category_parent_brief']);
                }
                if(sizeOf($category[$k]['children'])>0){
                    foreach ($category[$k]['children'] as $key => $value) {
                        $category[$k]['children'][$key]['shop_category_son_brief']=json_decode($category[$k]['children'][$key]['shop_category_son_brief']);
                    }
                }
            }
        }
        if($tf==1){
            return json(['code'=>200,'data'=>$category,'msg'=>'操作成功']);
        }else {
            return $category;
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function upaddshopcheel(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $newindex=new Index();
        $type=Index::i('type');
        $value=Index::i('value');
        $big_name=Index::i('big_name');//大频道名称
        $big_target=Index::i('big_target');//大频道标签
        $old_son_name=Index::i('old_son_name');//子频道名称
        $old_son_name_index=Index::i('old_son_name_index');//子频道名称索引
        $old_son_target=Index::i('old_son_target');//子频道标签
        $update_img_index=Index::i('update_img_index');//子频道展示图片索引
        $update_img_activity_index=Index::i('update_img_activity_index');//子频道活动图片索引
        $add_name=Index::i('add_name');//添加频道名称
        $add_img_activity=Index::i('add_img_activity');//添加图片活动图片
        $add_img=Index::i('add_img');//添加频道的图片
        $add_brief=Index::i('add_brief');//添加频道标签
        $data=[];
        $add_id=false;
        if($type=='0'){
            $res=$newindex->getcommodity(0);
            foreach ($res as $k => $v) {
                if( $v['value']==$value){
                    $data=$v;
                }
            }
        }else {
            if($big_name&&$big_target&&$add_name&&$add_brief){
                $add_id= Db::name('shop_category')->insertGetId([
                    'shop_id'=>$shop_id,
                    'shop_category_title'=>$big_name,
                    'shop_category_parent_brief'=>$big_target,
                    'shop_category_son_brief'=>json_encode([],320),
                ]);
                $res=$newindex->getcommodity(0);
                foreach ($res as $k => $v) {
                    if( $v['label']==$big_name){
                        $data=$v;
                    }
                }
             
            }else {
                return ;
            }
        }

            if($big_target){//修改大频道标签
                $data['shop_category_parent_brief']=$big_target;
            }
    
            $add_big_imgs=[];
            if(isset($_FILES['bigimg'])){//判断文件是否存在  修改大频道活动图片
                foreach ($_FILES['bigimg']['name'] as $k => $value) {//循环上传文件
                    if(is_uploaded_file($_FILES['bigimg']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['bigimg']['name'][$k],strpos($_FILES['bigimg']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['bigimg']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/shop_category_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            array_push($add_big_imgs,'/shop_category_img/'.$fileName);
                        }
                    }
                }
            }
    
            $serve=[
                'shop_category_parent_brief'=>$data['shop_category_parent_brief'],//大频道标签
                'shop_category_activity_img'=>sizeOf($add_big_imgs)>0?$add_big_imgs[0]:$data['shop_category_activity_img'],//判断是否更改了大频道的活动图片
                'shop_category_title'=>$big_name?$big_name:$data['label'],//判断是否修改大频道名称
            ];
            if($big_name){
                $shop_info=Db::query(Sql::$str194,[$shop_id]);
                if(sizeOf($shop_info)>0&&$type=='0'){
                    $shop_info=$shop_info[0];
                    if($shop_info['banner']){
                        $shop_info['banner']=json_decode($shop_info['banner'],true);
                        if(sizeOf($shop_info['banner'])>0){
                            foreach ($shop_info['banner'] as $k => $v) {
                                if($v['type']==0&&$v['name']==$data['label']){
                                    $shop_info['banner'][$k]['name']=$big_name;
                                }
                            }
                        }
                    }
                    if($shop_info['banner_min']){
                        $shop_info['banner_min']=json_decode($shop_info['banner_min'],true);
                        if(sizeOf($shop_info['banner_min'])>0){
                            foreach ($shop_info['banner_min'] as $k => $v) {
                                if($v['type']==0&&$v['name']==$data['label']){
                                    $shop_info['banner_min'][$k]['name']=$big_name;
                                }
                            }
                        }
                    }
                    if($shop_info['banner_info']){
                        $shop_info['banner_info']=json_decode($shop_info['banner_info'],true);
                        if(sizeOf($shop_info['banner_info'])>0){
                            foreach ($shop_info['banner_info'] as $k => $v) {
                                if($v['type']==0&&$v['name']==$data['label']){
                                    $shop_info['banner_info'][$k]['name']=$big_name;
                                }
                            }
                        }
                    }
                    $shop_info['banner']=json_encode($shop_info['banner'],320);
                    $shop_info['banner_min']=json_encode($shop_info['banner_min'],320);
                    $shop_info['banner_info']=json_encode($shop_info['banner_info'],320);
                    Db::name('shop')
                    ->where('shop_id', $shop_id)
                    ->update($shop_info);
                }
            }
           
    
            Db::name('shop_category')
            ->where(['shop_category_title'=>$data['label'],'shop_id'=>$shop_id ])
            ->update($serve); 
            //以上为修改大频道


        if($old_son_name_index&&sizeOf($old_son_name_index)>0&&$type=='0'){
           foreach ($old_son_name_index as $k => $v) {//获取要修改的子频道ID
                $s=[];
                $ID=intval($v); //添加ID
                if($old_son_name){
                    if($old_son_name[$k]){
                        $s['shop_category_SON']=$old_son_name[$k];//判断是否更改子频道名称
                    }
                }
                if($old_son_target){
                    if($old_son_target[$k]){
                        $s['shop_category_son_brief']=$old_son_target[$k];
                    }
                }
                if($old_son_name){
                    $shop_info=Db::query(Sql::$str194,[$shop_id]);
                    $ID_son_name=Db::query(Sql::$str195,[$ID])[0]['shop_category_SON'];
                    if(sizeOf($shop_info)>0){
                        $shop_info=$shop_info[0];
                        if($shop_info['banner']){
                            $shop_info['banner']=json_decode($shop_info['banner'],true);
                            if(sizeOf($shop_info['banner'])>0){
                                foreach ($shop_info['banner'] as $ks => $vs) {
                                    if($vs['type']==1&&$vs['name']==$ID_son_name){
                                        $shop_info['banner'][$ks]['name']=$old_son_name[$k];
                                    }
                                }
                            }
                        }
                        if($shop_info['banner_min']){
                            $shop_info['banner_min']=json_decode($shop_info['banner_min'],true);
                            if(sizeOf($shop_info['banner_min'])>0){
                                foreach ($shop_info['banner_min'] as $ks => $vs) {
                                    if($vs['type']==1&&$vs['name']==$ID_son_name){
                                        $shop_info['banner_min'][$ks]['name']=$old_son_name[$k];
                                    }
                                }
                            }
                        }
                        if($shop_info['banner_info']){
                            $shop_info['banner_info']=json_decode($shop_info['banner_info'],true);
                            if(sizeOf($shop_info['banner_info'])>0){
                                foreach ($shop_info['banner_info'] as $ks => $vs) {
                                    if($vs['type']==1&&$vs['name']==$ID_son_name){
                                        $shop_info['banner_info'][$ks]['name']=$old_son_name[$k];
                                    }
                                }
                            }
                        }
                        $shop_info['banner']=json_encode($shop_info['banner'],320);
                        $shop_info['banner_min']=json_encode($shop_info['banner_min'],320);
                        $shop_info['banner_info']=json_encode($shop_info['banner_info'],320);
                        Db::name('shop')
                        ->where('shop_id', $shop_id)
                        ->update($shop_info);
                    }
                }


                Db::name('shop_category')
                ->where('shop_category_id',$ID)
                ->update($s); //只循环修改名称和标签  因为改变名字不一定会改变图片
           }
        }
        //以上只修改子频道名称和标签

        if($update_img_index&&sizeOf($update_img_index)>0&&$type=='0'){ //判断是否需要修改子频道展示图片
            foreach ($update_img_index as $k => $v) {
              $ID=intval($v);//里面存放的是需要修改图片的字段ID
              $strImg=null;
              $s=[];
                if(isset($_FILES['update_img']['name'][$k])){//判断文件是否存在  修改大频道活动图片
                    if(is_uploaded_file($_FILES['update_img']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['update_img']['name'][$k],strpos($_FILES['update_img']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['update_img']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/shop_category_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            $strImg='/shop_category_img/'.$fileName;
                        }
                    }
                }
                $s['shop_category_img']=$strImg;
                if($strImg){
                    Db::name('shop_category')
                    ->where('shop_category_id',$ID)
                    ->update($s);
                } //只修改子频道展示图片
            }
        }


        if($update_img_activity_index&&sizeOf($update_img_activity_index)>0&&$type=='0'){ //判断是否需要修改子频道活动图片
            foreach ($update_img_activity_index as $k => $v) {
              $ID=intval($v);//里面存放的是需要修改图片的字段ID
              $strImg=null;
              $s=[];
                if(isset($_FILES['update_img_activity']['name'][$k])){//判断文件是否存在  修改大频道活动图片
                    if(is_uploaded_file($_FILES['update_img_activity']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['update_img_activity']['name'][$k],strpos($_FILES['update_img_activity']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['update_img_activity']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/shop_category_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            $strImg='/shop_category_img/'.$fileName;
                        }
                    }
                }
                $s['shop_category_activity_img_son']=$strImg;
                if($strImg){
                    Db::name('shop_category')
                    ->where('shop_category_id',$ID)
                    ->update($s);
                }
            }
        }
        $res=$newindex->getcommodity(0);
        $data=[];
        if($type=='0'){
            foreach ($res as $k => $v) {
                if( $v['value']==$value){
                    $data=$v;
                }
            }
        }else {
            $res=$newindex->getcommodity(0);
            foreach ($res as $k => $v) {
                if( $v['label']==$big_name){
                    $data=$v;
                }
            }
        }
       
      
        if($add_name&&sizeOf($add_name)>0){
            foreach ($add_name as $k => $v) {
                $s=[];
                $strImg=false;
                $strImgA=false;
                if(isset($_FILES['add_img']['name'][$k])){//判断文件是否存在  添加子频道展示图片
                    if(is_uploaded_file($_FILES['add_img']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['add_img']['name'][$k],strpos($_FILES['add_img']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['add_img']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/shop_category_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            $strImg='/shop_category_img/'.$fileName;
                        }
                    }
                }
                if($strImg){
                    $s['shop_category_img']=$strImg;
                }
              

                if(isset($_FILES['add_img_activity']['name'][$k])){//判断文件是否存在  添加子频道展示图片
                    if(is_uploaded_file($_FILES['add_img_activity']['tmp_name'][$k])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['add_img_activity']['name'][$k],strpos($_FILES['add_img_activity']['name'][$k],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                        if(move_uploaded_file($_FILES['add_img_activity']['tmp_name'][$k],'/www/wwwroot/127.0.0.1/shop/filter/shop_category_img/'.$fileName)){//move_uploaded_file更改文件的路径
                            $strImgA='/shop_category_img/'.$fileName;
                        }
                    }
                }

                if($strImgA){
                    $s['shop_category_activity_img_son']=$strImgA;
                }
                $s['shop_id']=$shop_id;
                if($add_brief&&$add_brief[$k]){
                    $s['shop_category_son_brief']=$add_brief[$k];
                }
                $s['shop_category_title']=$data['label'];
                $s['shop_category_SON']=$v;
                $s['shop_category_activity_img']=$data['shop_category_activity_img'];
                $s['shop_category_parent_brief']=json_encode($data['shop_category_parent_brief'],320);
                Db::name('shop_category')->insert($s);
            }
            if($add_id){
                Db::table('shop_category')->where('shop_category_id',$add_id)->delete();
            }
        }
        return json(['code'=>200,'data'=>$add_id,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function getshophome($tf=true){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $data=[];
        $s=Db::query(Sql::$str190,[$shop_id]);//存放商品ID
        $par=Db::query(Sql::$str196,[$shop_id]);//存放大频道
        $son=Db::query(Sql::$str197,[$shop_id]);//存放大频道
        $channel=[
            ['value'=>0,'label'=>'大频道','children'=>$par],
            ['value'=>1,'label'=>'子频道','children'=>$son],
            ['value'=>2,'label'=>'商品','children'=>$s],
        ];
        $res=Db::query(Sql::$str198,[$shop_id]);


      
        if(sizeOf($res)>0){
            $res=$res[0];
            function fu($str,$res,$s,$par,$son){
                foreach ($res[$str] as $key => $value) {
                    if($value['type']==0){
                        foreach ($par as $k => $v) {
                            if($value['name']==$v['label']){
                                $res[$str][$key]['key']=[0,$v['value']];
                            }
                        }
                    }
                    if($value['type']==1){
                        foreach ($son as $k => $v) {
                            if($value['name']==$v['label']){
                                $res[$str][$key]['key']=[1,$v['value']];
                            }
                        }
                    }
                    if(isset($value['store_commodity_id'])){
                        $res[$str][$key]['key']=[2,$value['store_commodity_id']];
                    }
                }
                return $res;
            }
            if($res['banner']){
                $res['banner']=json_decode($res['banner'],true);
                $res=fu('banner',$res,$s,$par,$son);
            }
            if($res['banner_min']){
                $res['banner_min']=json_decode($res['banner_min'],true);
                $res=fu('banner_min',$res,$s,$par,$son);
            }
            if($res['banner_info']){
                $res['banner_info']=json_decode($res['banner_info'],true);
                $res=fu('banner_info',$res,$s,$par,$son);
            }
            if($res['shop_hard']){
              $res['shop_hard']=json_decode($res['shop_hard'],true);
            }
            if($tf){
                return json(['code'=>200,'channel'=>$channel,'commodity'=>$s,'data'=>[$res],'msg'=>'操作成功']);
            }else {
                return $channel;
            }

        }else {
            return json(['code'=>404,'data'=>false,'msg'=>'shop_id错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function setshophome(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $arr=Index::i('data');
        if($arr&&sizeOf($arr)==4){
            $newindex=new Index();
            $data=[[],[],[],[]];
            $res=$newindex->getshophome(false);
            foreach ($arr as $k => $v) {
                if(sizeOf($v)>0&&$k!=3){
                    foreach ($v as $mk => $mv) {//mv=[1,2]
                        foreach ($res as $key => $value) {
                            for ($i=0; $i <sizeOf($value['children']) ; $i++) { 
                                if($value['children'][$i]['value']==intval($mv[1])&&$value['value']==intval($mv[0])){
                                    if($value['value']==2){
                                        array_push($data[$k],['type'=>intval($value['value']),'store_commodity_id'=>intval($value['children'][$i]['label'])]);
                                    }else {
                                        array_push($data[$k],['type'=>intval($value['value']),'name'=>$value['children'][$i]['label']]);
                                    }
                                    break;
                                }
                            }
                        }
                    }
                }
                if($k==3){
                    foreach ($v as $ck => $cv) {
                      array_push($data[3],intval($cv));
                    }
                }
            }
            Db::name('shop')
            ->where('shop_id', $shop_id)
            ->update([
                'banner' =>json_encode($data[0],320),
                'banner_min' =>json_encode($data[1],320),
                'banner_info' =>json_encode($data[2],320),
                'shop_hard' =>json_encode($data[3],320),

            ]);
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'未传参数或参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function getshopdiscount(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $res=Db::query(Sql::$str199,[$shop_id]);
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                if($v['portion_tf']==0){
                    $res[$k]['son']=Db::query(Sql::$str200,[$v['discount_id']]);
                }
            }
        }
        $s=Db::query(Sql::$str190,[$shop_id]);//存放商品ID
        return json(['code'=>200,'commodity'=>$s,'data'=>$res,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function setshopdiscount(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $type=Index::i('type');
        $discount_info=Index::i('discount_info');
        $discount_title=Index::i('discount_title');
        $end_time=Index::i('end_time');
        $sen_time=Index::i('sen_time');
        $portion_tf=Index::i('portion_tf');
        $jian_money=Index::i('jian_money');
        $discount_id=Index::i('discount_id');
        $man_money=Index::i('man_money');
        $son=Index::i('son');
        $data=[];
        $min_data=[];
        if($type=='0'||$type=='1'){
            if($type=='1'){
                $s = ['repetition' =>1, 'superposition' =>0,'shop_id'=>$shop_id,'type'=>-1];
                $discount_id = Db::name('discount')->insertGetId($s);
            }
            if($discount_info){
                $data['discount_info']=$discount_info;
            }
            if($discount_title){
                $data['discount_title']=$discount_title;
            }
            if($man_money){
                $data['man_money']=$man_money;
            }
            if($end_time){
                $data['end_time']=$end_time;
            }
            if($sen_time){
                $data['sen_time']=$sen_time;
            }
            if($portion_tf=='0'||$portion_tf=='1'){
                $data['portion_tf']=$portion_tf;
                if($portion_tf=='0'&&$son&&$discount_id){
                    if(sizeOf($son)>0){
                        Db::table('discount_son')->where('discount_id',$discount_id)->delete();
                        foreach ($son as $k => $v) {//添加部分商品ID
                            $w = ['discount_son_info' =>intval($v), 'discount_id' => intval($discount_id)];
                            Db::name('discount_son')->insert($w );
                        }
                    }else {
                        return json(['code'=>406,'data'=>false,'msg'=>'当为部分商品时必传商品ID']);
                    }
                }else if($portion_tf=='1'){
                    Db::table('discount_son')->where('discount_id',$discount_id)->delete();
                }
            }
            if($jian_money){
                $jian_money=floatval($jian_money);
                if($jian_money>=1){
                    $data['jian_money']=$jian_money;
                    $data['ze_kou']=null;
                }else {
                    $data['ze_kou']=$jian_money;
                    $data['jian_money']=null;
                }
            }
            Db::name('discount')
            ->where('discount_id', $discount_id)
            ->update($data);
            return json(['code'=>200,'data'=>$discount_id,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'type参数未传']);
        }
       
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function getshoproot(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $res=Db::query(Sql::$str202,[$shop_id]);
        return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function setshoproot(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $shop_member_root_id=Index::i('shop_member_root_id');
        if($shop_member_root_id){
            $s_root=Index::i('s_root');
            $r_root=Index::i('r_root');
            $data=['shop_member_root_id'=>$shop_member_root_id];
            if($s_root){
                $data['s_root']=intval($s_root);
            }
            if($r_root){
                $data['r_root']=intval($r_root);
            }
            Db::name('shop_member_root')
            ->where([
                'shop_member_root_id'=>$shop_member_root_id,
                'shop_id'=>$shop_id
                ])
            ->update($data);
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'必须要传shop_member_root_id']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function getshopjue(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $res=Db::query(Sql::$str203,[$shop_id]);
        return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function setshopjue(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $type=Index::i('type');
        $shop_post=Index::i('shop_post');
        $user_id=Index::i('user_id');
        if($type=='0'||$type=='1'||$type=='2'){
            $data=[
                'shop_post'=>$shop_post,
                'shop_id'=>$shop_id,
                'user_id'=>$user_id,
            ];
            if($type=='0'&&$user_id&&$shop_post){//修改权限
                Db::name('shop_member')
                ->where(['shop_id'=>$shop_id,'user_id'=>$user_id])
                ->update($data);
            }else if($type=='1'&&$user_id){//删除成员
                Db::table('shop_member')->where(['shop_id'=>$shop_id,'user_id'=>$user_id])->delete();
            }else if($type=='2'&&$shop_post){//添加成员
                $s=Db::query(Sql::$str204,[$user_id]);
                if(sizeOf($s)>0){
                    $m=Db::query(Sql::$str205,[$user_id]);
                    if(sizeOf($m)==0){
                        Db::name('shop_member')->insert($data);
                    }else {
                     return json(['code'=>407,'data'=>false,'msg'=>'该ID已是客服不能添加']);
                    }
                }else {
                     return json(['code'=>406,'data'=>false,'msg'=>'该用户ID不存在']);
                }
            }
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);

        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'缺少参数']);
        }
       
        return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function getshopseckill(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $res=Db::query(Sql::$str207);
        $s=Db::query(Sql::$str190,[$shop_id]);//存放商品ID
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                $res[$k]['cmm']=Db::query(Sql::$str208,[$v['value'],$shop_id]);
            }
        }
        return json(['code'=>200,'data'=>$res,'commodity'=>$s,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}


public function setshopseckill(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $seckill_time_id=Index::i('seckill_time_id');
        $info=Index::i('info');
        if($seckill_time_id){
            $res=Db::query(Sql::$str208,[$seckill_time_id,$shop_id]);
            if(sizeOf($res)>0){
                foreach ($res as $k => $v) {
                    Db::table('seckill_time_info')->where([
                        'seckill_time_id'=>$seckill_time_id,
                        'commodity_info_id'=>$v['commodity_info_id']
                    ])->delete();
                }
            }
            if($info){
                foreach ($info as $k => $v) {
                    $sum=0;
                    $data = ['commodity_info_id' =>intval($v), 'seckill_time_id' => $seckill_time_id];
                    $s=Db::query(Sql::$str209,[intval($v)]);//获取库存
                    $fu=null;
                    if(sizeOf($s)>0){
                        $s=$s[0];
                        if($s['activity_tf']==1){
                            $fu=json_decode($s['commodity_info_activity'],true);
                        }else {
                            $fu=json_decode($s['commodity_info_data'],true);
                        }
                        if($fu['data']){
                            foreach ($fu['data'] as $k => $v) {
                                $sum+=$v['num'];
                            }
                        }
                    }
                    $data['commodity_num']=$sum;
                    $data['commodity_num_sheng']=0;
                    Db::name('seckill_time_info')->insert($data);
            }
               
            }
            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function getshopinfo(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $res=[];
        $res['shop_img']=Db::query(Sql::$str210,[$shop_id])[0]['shop_img'];
        $res['shop_type']=Db::query(Sql::$str210,[$shop_id])[0]['shop_type'];
        $res['site']=Db::query(Sql::$str211,[$shop_id])[0]['site'];
        $res['send_time']=Db::query(Sql::$str211,[$shop_id])[0]['send_time'];
        $channel=Db::query(Sql::$str212);
        return json(['code'=>200,'data'=>$res,'channel'=>$channel,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function setshopinfo(){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        $shop_type=Index::i('shop_type');
        $site=Index::i('site');
        if($shop_type){
            Db::name('shop')
            ->where('shop_id', $shop_id)
            ->update(['shop_type' => $shop_type]);
        }
        if($site){
            Db::name('shop_info')
            ->where('shop_id', $shop_id)
            ->update(['site' => $site]);
        }
        if(isset($_FILES['logo']['name'][0])){//判断文件是否存在
            if(is_uploaded_file($_FILES['logo']['tmp_name'][0])){//is_uploaded_file判断是否上传文件:临时文件
                $type=substr($_FILES['logo']['name'][0],strpos($_FILES['logo']['name'][0],'.'));
                $fileName=time().rand().$type;//修改文件名称
                if(move_uploaded_file($_FILES['logo']['tmp_name'][0],'/www/wwwroot/127.0.0.1/shop/filter/shop_category_img/'.$fileName)){//move_uploaded_file更改文件的路径
                    $strImgA='/shop_category_img/'.$fileName;
                    Db::name('shop')
                    ->where('shop_id', $shop_id)
                    ->update(['shop_img' => $strImgA]);
                }
            }
        }
        return json(['code'=>200,'data'=>true,'msg'=>'修改成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function setserveinfo(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $shop_id=Index::i('shop_id');
        $info=Index::i('info');
        $user_id=Index::i('user_id');
        $both=Index::i('both');
        $serve_id=Index::i('serve_id');
        
        if($shop_id){
            $data=[];
            if(true){
            
                $data['service_info']=$info;
                $data['shop_id']=$shop_id;
                $data['both']=intval($both);
                $data['user_id']=intval($user_id);
                $data['send_time']=date('Y-m-d H:i:s');
                $data['read_tf']=1;
                $ssss=null;
                if($both=='0'||$both==0){
                    $data['both']=0;
                    if($serve_id){
                        $data['service_id']=$serve_id;
                    }else {
                        return json(['code'=>406,'data'=>false,'msg'=>'客服ID 不能为空']);
                    }
                }else if($both=='1'||$both==1){
                    $data['both']=1;
                    $s=Db::query(Sql::$str215,[$shop_id]);
                    if(sizeOf($s)>0){
                        $data['service_id']=$s[0]['user_id'];
                        $ssss=$s[0]['user_id'];
                    }else {
                        $s=Db::query(Sql::$str216,[$shop_id]);
                        $data['service_id']=$s[0]['user_id'];
                        $ssss=$s[0]['user_id'];
                    }
                }
              

                if(isset($_FILES['file'])){//判断文件是否存在
                    $img_arr=[];
                    $video_arr=[];
                    $arr_type=['image/jpg','image/jpeg','image/gif','image/pjpeg','image/png'];
                    $arr_type_o=['video/mp4'];
                    if(is_uploaded_file($_FILES['file']['tmp_name'][0])){//is_uploaded_file判断是否上传文件:临时文件
                        $type=substr($_FILES['file']['name'][0],strpos($_FILES['file']['name'][0],'.'));
                        $fileName=time().rand().$type;//修改文件名称
                     
                        if(move_uploaded_file($_FILES['file']['tmp_name'][0],'/www/wwwroot/127.0.0.1/shop/filter/sale/'.$fileName)){//move_uploaded_file更改文件的路径
                            if((in_array($_FILES['file']['type'][0],$arr_type))){//为img时
                                $img_arr=['type'=>'img','url'=>'/sale/'.$fileName];
                                $data['fujian']=json_encode($img_arr,320);
                            }
                            if((in_array($_FILES['file']['type'][0],$arr_type_o))){//为video时
                                $video_arr=['type'=>'video','url'=>'/sale/'.$fileName];
                                $data['fujian']=json_encode($video_arr,320);
                            }
                        }
                    }
                }
                Db::name('service_info')->insert($data);
                $tf=false;
                if($both=='0'||$both==0){
                    $u=Db::query(Sql::$str217,[$user_id]);
                    if(sizeOf($u)>0){
                        $tf=true;
                    }
                  
                }else if($both=='1'||$both==1){
                    $u=Db::query(Sql::$str217,[$ssss]);
                    if(sizeOf($u)>0){
                        $tf=true;
                    }
                }
                return json(['code'=>200,'data'=>$tf,'msg'=>'发送成功']);
            }
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'店铺ID不能为空']);
        }

    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function inquireshop($shop_id){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        if($shop_id){
            $s=Db::query(Sql::$str218,[$shop_id,$bank]);
            if(sizeOf($s)>0){

            }else {
                $data=[];
                $data['service_info']='你好';
                $data['shop_id']=$shop_id;
                $data['both']=0;
                $data['user_id']=$bank;
                $data['send_time']=date('Y-m-d H:i:s');
                $data['read_tf']=1;
                $s=Db::query(Sql::$str215,[$shop_id]);
                if(sizeOf($s)>0){
                    $data['service_id']=$s[0]['user_id'];
                }else {
                    $s=Db::query(Sql::$str216,[$shop_id]);
                    $data['service_id']=$s[0]['user_id'];
                }
                Db::name('service_info')->insert($data);
            }

            return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'店铺ID不能为空']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function indexcmm($begin=0,$limit=10){
    $res=Db::query(Sql::$str219,[$begin,$limit]);
    if(sizeOf($res)>0){
        foreach ($res as $k => $v) {
            $res[$k]['imgs']=json_decode($v['imgs'])[0];
        }
    }
    return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);

}

public function wxcode($code){
    if($code){
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx553fb3fbef9809b3&secret=2cac2b1a2390fedfe204122fa2c1cedc&js_code=".$code."&grant_type=authorization_code";
        $data = json_decode(file_get_contents($url,true),true);
        return json(['code'=>200,'data'=>$data,'msg'=>'获取成功']);
    }
  
}

public function wxenter($openid){
    if($openid){
        $res=Db::query(Sql::$str220,[$openid]);
        if(sizeOf($res)>0){
            $p=Db::query(Sql::$str221,[$res[0]['user_id']]);
            cookie('u', base64_encode(strval($res[0]['user_id'])),60*60*24);
            cookie('p', base64_encode($p[0]['password']),60*60*24);
      
            return json(['code'=>200,'data'=>$res[0],'msg'=>'获取成功']);
        }else {
            return json(['code'=>400,'data'=>false,'msg'=>'该微信用户没有绑定']);
        }
    }
          
}

public function wxbind($iphone,$openid){
    if($iphone&&$openid){
        $res=Db::query(Sql::$str222,[$iphone]);
        if(sizeOf($res)>0){
            $p=Db::query(Sql::$str221,[$res[0]['user_id']]);
            cookie('u', base64_encode(strval($res[0]['user_id'])),60*60*24);
            cookie('p', base64_encode($p[0]['password']),60*60*24);
            Db::name('user')
            ->where('user_id', intval($res[0]['user_id']))
            ->update(['openid' =>$openid]);
            return json(['code'=>200,'data'=>$res[0],'msg'=>'获取成功']);
        }else {
            return json(['code'=>400,'data'=>false,'msg'=>'没有该手机号']);
        }
    }
}

public function ggindex($stroll_channel_parent_id=false,$order=0,$limit=10,$offset=0){
    $order_str=' ORDER BY stroll_index_send_time DESC ';
    $where_str=' where stroll_index_channel=? ';
    $limit_str=' limit ?,?';
    if($order==1){
        $order_str=' ORDER BY stroll_index_send_time ASC ';
    }
    $arr=[];
    if($stroll_channel_parent_id){
        $str=Sql::$str225.$where_str.$order_str.$limit_str;
        $arr=Db::query($str,[$stroll_channel_parent_id,$offset,$limit]);
    }else {
        $str=Sql::$str225.$order_str.$limit_str;
        $arr=Db::query($str,[$offset,$limit]);
    }
    if(sizeOf($arr)>0){
        foreach ($arr as $k => $v) {
           $arr[$k]['stroll_index_img']=json_decode($v['stroll_index_img']);
           $arr[$k]['stroll_index_video']=json_decode($v['stroll_index_video']);
        }
    }
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}


public function ggchannel(){
    $arr=Db::query(Sql::$str226,[]);
    return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
}
public function addggindex(){
    $stroll_index_id=Index::i('stroll_index_id');
    if($stroll_index_id){
        Db::table('stroll_index')
        ->where('stroll_index_id', $stroll_index_id)
        ->inc('look_sum')
        ->update();
        return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
    }else {
        return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
    }
}

public function ggindeinfo($stroll_index_id){
    $user_id=cookie('u');
    if(!$stroll_index_id){
        return json(['code'=>405,'data'=>$stroll_index_id,'msg'=>'参数错误']);
    }
    if($user_id){
        $user_id=base64_decode(cookie('u'));
    }else {
        $user_id=-1;
    }
    $arr=Db::query(Sql::$str227,[$stroll_index_id,$user_id,$user_id,$user_id]);
    if(sizeOf($arr)>0){
        $arr=$arr[0];
        $arr['childer']=Db::query(Sql::$str228,[$stroll_index_id,$user_id]);
        if(sizeOf($arr['childer'])>0){
            foreach ($arr['childer'] as $k => $v) {
                $arr['childer'][$k]['childer']=Db::query(Sql::$str229,[$v['stroll_comment_parent_id'],$user_id]);
            }
        }
        $arr['stroll_index_img']=json_decode($arr['stroll_index_img']);
        $arr['stroll_index_video']=json_decode($arr['stroll_index_video']);
        $arr['cmm']=Db::query(Sql::$str230,[$arr['store_commodity_id']])[0];
        $arr['cmm']['imgs']=json_decode($arr['cmm']['imgs']);
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
    }else {
        return json(['code'=>405,'data'=>false,'msg'=>'文章ID不存在']);
    }
    return json(['code'=>200,'data'=>true,'msg'=>'获取成功']);
}

public function changeggcollect(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $stroll_index_id=Index::i('stroll_index_id');
        if($stroll_index_id){
            $res=Db::query(Sql::$str231,[$bank,$stroll_index_id]);
            if(sizeOf($res)>0){
                Db::table('user_stroll_collect')->where('user_stroll_collect_id',$res[0]['user_stroll_collect_id'])->delete();
            }else {
                $data = ['user_id' =>$bank, 'stroll_index_id' =>$stroll_index_id];
                Db::name('user_stroll_collect')->insert($data);
                
            }
             return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
        }else {
          return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function changegguser(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $user_id=Index::i('user_id');
        if($user_id){
            $res=Db::query(Sql::$str232,[$bank,$user_id]);
            if(sizeOf($res)>0){
                Db::table('stroll_fans')->where('stroll_fans_id',$res[0]['stroll_fans_id'])->delete();
            }else {
                $data = ['user_id' =>$bank, 'target_id' =>$user_id];
                Db::name('stroll_fans')->insert($data);


            }
            return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
        }else {
            return json(['code'=>405,'data'=>false,'msg'=>'参数错误']);
        }
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function changegglike(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $type=Index::i('type');
        $stroll_index_id=Index::i('stroll_index_id');
        $change_id=Index::i('change_id');
        if($type==0&&$stroll_index_id){
            $res=Db::query(Sql::$str233,[$bank,$stroll_index_id]);
            if(sizeOf($res)>0){
                Db::table('user_stroll_like')->where('user_stroll_like_id',$res[0]['user_stroll_like_id'])->delete();
                Db::table('stroll_index')
                ->where('stroll_index_id', $stroll_index_id)
                ->dec('stroll_index_like')
                ->update();
            }else {
                $data = ['user_id' =>$bank, 'stroll_index_id' =>$stroll_index_id];
                Db::name('user_stroll_like')->insert($data);
                Db::table('stroll_index')
                ->where('stroll_index_id', $stroll_index_id)
                ->inc('stroll_index_like')
                ->update();
            }
        }else if($type==1&&$change_id){
            $res=Db::query(Sql::$str234,[$bank,$change_id]);
            if(sizeOf($res)>0){
                Db::table('user_stroll_comment_like')->where('user_stroll_comment_like_id',$res[0]['user_stroll_comment_like_id'])->delete();
                Db::table('stroll_comment_parent')
                ->where('stroll_comment_parent_id', $change_id)
                ->dec('stroll_comment_parent_like')
                ->update();
            }else {
                $data = ['user_id' =>$bank, 'change_id' =>$change_id,'type'=>0];
                Db::name('user_stroll_comment_like')->insert($data);
                Db::table('stroll_comment_parent')
                ->where('stroll_comment_parent_id', $change_id)
                ->inc('stroll_comment_parent_like')
                ->update();
            }
        }else if($type==2&&$change_id){
            $res=Db::query(Sql::$str235,[$bank,$change_id]);
            if(sizeOf($res)>0){
                Db::table('user_stroll_comment_like')->where('user_stroll_comment_like_id',$res[0]['user_stroll_comment_like_id'])->delete();
                Db::table('stroll_comment_son')
                ->where('stroll_comment_son_id', $change_id)
                ->dec('stroll_comment_son_like')
                ->update();
            }else {
                $data = ['user_id' =>$bank, 'change_id' =>$change_id,'type'=>1];
                Db::name('user_stroll_comment_like')->insert($data);
                Db::table('stroll_comment_son')
                ->where('stroll_comment_son_id', $change_id)
                ->inc('stroll_comment_son_like')
                ->update();
            }
        }else {
            return json(['code'=>200,'data'=>$res,'msg'=>'参数错误']);
        }
        return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function pggindex(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $type=Index::i('type');
        $stroll_index_id=Index::i('stroll_index_id');
        $change_id=Index::i('change_id');
        $content=Index::i('content');
        $data=[];
        if($type==0&&$stroll_index_id&&$content){
            $data = [
                'stroll_index_id' =>$stroll_index_id,
                'stroll_comment_parent_info' =>$content,
                'stroll_comment_parent_fujian' =>null,
                'stroll_comment_parent_like' =>0,
                'stroll_comment_parent_send_time' =>date('Y-m-d H:i:s'),
                'user_id' =>$bank,
                ];
            Db::name('stroll_comment_parent')->insert($data);
        }else if($type==1&&$content&&$change_id){
            $res=Db::query(Sql::$str236,[$change_id]);
            if(sizeOf($res)>0){
                $res=$res[0];
                $data = [
                    'stroll_comment_parent_id' =>$change_id,
                    'target_id' =>$res['user_id'],
                    'user_id' =>$bank,
                    'stroll_comment_son_like' =>0,
                    'stroll_comment_son_info'=>$content,
                    'stroll_comment_son_fujian' =>null,
                    'stroll_comment_son_send_time' =>date('Y-m-d H:i:s'),
                    ];
                Db::name('stroll_comment_son')->insert($data);
            }else {
                return json(['code'=>404,'data'=>false,'msg'=>'stroll_comment_parent_id 评论ID错误']);
            }
        }else if($type==2){
            $res=Db::query(Sql::$str237,[$change_id]);
            if(sizeOf($res)>0){
                $res=$res[0];
                $data = [
                    'stroll_comment_parent_id' =>$res['stroll_comment_parent_id'],
                    'target_id' =>$res['user_id'],
                    'user_id' =>$bank,
                    'stroll_comment_son_like' =>0,
                    'stroll_comment_son_info'=>$content,
                    'stroll_comment_son_fujian' =>null,
                    'stroll_comment_son_send_time' =>date('Y-m-d H:i:s'),
                    ];
                Db::name('stroll_comment_son')->insert($data);
            }else {
                return json(['code'=>404,'data'=>false,'msg'=>'stroll_comment_son_id  回复ID错误']);
            }
        }
        return json(['code'=>200,'data'=>$data,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function gghua($stroll_channel_son_id){
    if($stroll_channel_son_id){
        $res=Db::query(Sql::$str238,[$stroll_channel_son_id])[0];
        $res['data']=Db::query(Sql::$str240,[$stroll_channel_son_id])[0];
        return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'参数错误']);
    }
}

public function gghuainfo($stroll_channel_son_id,$offset=0,$limit=10,$order=0){
    $order_str=' ORDER BY stroll_index_like DESC ';
    $order=intval($order);
    $limit_str=' LIMIT ?,?';
    if(!$stroll_channel_son_id){
        return json(['code'=>404,'data'=>false,'msg'=>'参数错误']);
    }
    if($order!=0){
        $order_str=' ORDER BY stroll_index_send_time DESC';
    }
    $str=Sql::$str239.$order_str.$limit_str;
    $res=Db::query($str,[$stroll_channel_son_id,$offset,$limit]);
    if(sizeOf($res)>0){
        foreach ($res as $k => $v) {
           $res[$k]['stroll_index_img']=json_decode($v['stroll_index_img']);
           $res[$k]['stroll_index_video']=json_decode($v['stroll_index_video']);
        }
    }
    return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
}



public function addggfile(){
    $img_arr=[];
    $video_arr=[];
    $arr_type=['image/jpg','image/jpeg','image/gif','image/pjpeg','image/png'];
    $arr_type_o=['video/mp4'];
    $type='';
    if(isset($_FILES['file'])){//判断文件是否存在
        if(is_uploaded_file($_FILES['file']['tmp_name'])){//is_uploaded_file判断是否上传文件:临时文件
            $type=substr($_FILES['file']['name'],strpos($_FILES['file']['name'],'.'));
            $fileName=time().rand().$type;//修改文件名称
            if(move_uploaded_file($_FILES['file']['tmp_name'],'/www/wwwroot/127.0.0.1/shop/filter/file/'.$fileName)){//move_uploaded_file更改文件的路径
                if((in_array($_FILES['file']['type'],$arr_type))){//为img时
                     $type='image';
                }
                if((in_array($_FILES['file']['type'],$arr_type_o))){//为video时
                    $type='video';
                }
            }
        }
    }
    return json(['code'=>200,'data'=>'/file/'.$fileName,'type'=>$type,'msg'=>'操作成功']);
}


public function addgg(){
    if(cookie('u')){
        $bank=base64_decode(cookie('u'));
        $content=Index::i('content');
        $title=Index::i('title');
        $commodity_info_id=Index::i('commodity_info_id');
        $stroll_channel_son_id=Index::i('stroll_channel_son_id');
        $stroll_channel_parent_id=Index::i('stroll_channel_parent_id');
        $file_image=Index::i('file_image');
        $file_video=Index::i('file_video');
        if(!is_array($file_image)){
            $file_image=explode(',',$file_image);
        }
        if(!is_array($file_video)){
            $file_video=explode(',',$file_video);
        }
        $data=[
            'stroll_index_img'=>json_encode($file_image,320),
            'stroll_index_title'=>$title,
            'stroll_index_info'=>$content,
            'store_commodity_id'=>$commodity_info_id,
            'stroll_index_channel'=>$stroll_channel_parent_id,
            'stroll_index_send_time'=>date('Y-m-d H:i:s'),
            'stroll_index_like'=>0,
            'stroll_index_collect'=>0,
            'user_id'=>$bank,
            'stroll_index_video'=>json_encode($file_video,320),
            'stroll_index_topic'=>$stroll_channel_son_id,
            'look_sum'=>0
        ];
        Db::name('stroll_index')->insert($data);
        return json(['code'=>200,'data'=>true,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function addggsearch($content='',$user_id=0,$limit=10,$offset=0){
    if(cookie('u')){
        $user_id=base64_decode(cookie('u'));
    }
        $res=[];
        if(strlen($content)==0){
            $res=Db::query(Sql::$str242,[$user_id,$offset,$limit]);
        }else {
            $str='%'.$content.'%';
            $res=Db::query(Sql::$str241,[$str,$offset,$limit]);
        }
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                $res[$k]['imgs']=json_decode($v['imgs']);
            }
        }
        return json(['code'=>200,'s'=>$user_id,'data'=>$res,'msg'=>'获取成功']);

}

public function ggallhua(){
    $res=Db::query(Sql::$str243,[]);
    return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
}

public function gguserindex($type=0){
    if(cookie('u')){
        $user_id=base64_decode(cookie('u'));
       if($type==0){
        $arr=Db::query(Sql::$str244,[$user_id]);
        if(sizeOf($arr)>0){
            foreach ($arr as $k => $v) {
            $arr[$k]['stroll_index_img']=json_decode($v['stroll_index_img']);
            $arr[$k]['stroll_index_video']=json_decode($v['stroll_index_video']);
            }
        }
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
       }else if($type==1){
        $res=Db::query(Sql::$str245,[$user_id]);
        if(sizeOf($res)>0){
            foreach ($res as $k => $v) {
                $res[$k]['count']=Db::query(Sql::$str246,[$v['target_id']])[0]['indesum'];
                $res[$k]['fensi']=Db::query(Sql::$str247,[$v['target_id']])[0]['fenesi'];
                $res[$k]['info']=Db::query(Sql::$str249,[$v['target_id']])[0];
            }
        }
        return json(['code'=>200,'data'=>$res,'msg'=>'获取成功']);
       }else if($type==2){
        $arr=Db::query(Sql::$str248,[$user_id]);
        if(sizeOf($arr)>0){
            foreach ($arr as $k => $v) {
            $arr[$k]['stroll_index_img']=json_decode($v['stroll_index_img']);
            $arr[$k]['stroll_index_video']=json_decode($v['stroll_index_video']);
        
            }
        }
        return json(['code'=>200,'data'=>$arr,'msg'=>'获取成功']);
        }

    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}

public function gglikeuserindex($user_id,$bank=0,$limit=10,$offset=0){
    if($user_id){
        $res=[];
        if(cookie('u')){
            $bank=base64_decode(cookie('u'));
            $res['fensi']=Db::query(Sql::$str250,[$user_id])[0]['fensi'];
            $res['like']=Db::query(Sql::$str251,[$user_id])[0]['like'];
            $res['zan']=Db::query(Sql::$str252,[$user_id])[0]['zan'];
            $res['nickname']=Db::query(Sql::$str255,[$user_id])[0]['nickname'];
            $res['headimg']=Db::query(Sql::$str255,[$user_id])[0]['headimg'];
            $res['list']=Db::query(Sql::$str254,[$user_id,$offset,$limit]);
            if(sizeOf($res['list'])>0){
                foreach ($res['list'] as $k => $v) {
                    $res['list'] [$k]['stroll_index_img']=json_decode($v['stroll_index_img']);
                    $res['list'] [$k]['stroll_index_video']=json_decode($v['stroll_index_video']);
                }
            }
        }
        return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}




































public function cmmaddquizsss($time=false){
    if(cookie('u')&&cookie('shop_id')){
        $bank=base64_decode(cookie('u'));
        $shop_id=base64_decode(cookie('shop_id'));
        return json(['code'=>200,'data'=>$res,'msg'=>'操作成功']);
    }else {
        return json(['code'=>404,'data'=>false,'msg'=>'用户未登录']);
    }
}










}
