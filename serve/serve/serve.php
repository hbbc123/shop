<?php

$ws = new Swoole\WebSocket\Server('0.0.0.0', 250);
require __DIR__ . '/../public/index.php';
//监听WebSocket连接打开事件
use app\controller\Index;
use Swoole\Coroutine;
use function Swoole\Coroutine\run;

function fn1($user_id,$shop_id,$fd=false){//商家添加fd并获取聊天内容
    return Index::add_fd($user_id,$shop_id,$fd);
};
function fn2($user_id,$shop_id,$type){//获取具体聊天内容
    return Index::list_look($user_id,$shop_id,$type);
};
function fn3($user_id,$fd=false){//获取客户的聊天列表 并添加fd
    return Index::user_add_fd($user_id,$fd);
}
function fn4($ws,$user_id){//修改客户的聊天列表ID
    $res=Index::getfid($user_id);
    if($res){
        $s=Index::user_add_fd($user_id);
        $ws->push($res,$s);
    }
    return false;
}


function fn5($ws,$shop_id){//更改店铺的聊天列表
    $res=Index::getshopfid($shop_id);//查询店铺连接的fid
    if(sizeOf($res)>0){
        foreach ($res as $key => $v) {
            $s=Index::add_fd(false,$shop_id,false);
            $ws->push($v['fid'],$s);
        }
    }
    return false;
}



$ws->on('Open', function ($ws, $request) {
    echo "新连接的fd为: {$request->fd}\n";
    $ws->push($request->fd, json_encode(['type'=>1],320));
});

//监听WebSocket消息事件
$ws->on('Message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $res=json_decode($frame->data,true);
    $data=json_encode(['type'=>-999,'data'=>[]],320);
    switch ($res['constructor']) {
        case 1: 
            $data=fn1($res['data']['user_id'],$res['data']['shop_id'],$frame->fd);
            break;
        case 2: 
            $data=fn2($res['data']['user_id'],$res['data']['shop_id'],$res['data']['type']);
            break;
        case 3: 
            $data=fn3($res['data']['user_id'],$frame->fd);
            break;
        case 4: 
            fn4($ws,$res['data']['user_id']);
            break;
        case 5: 
            fn5($ws,$res['data']['shop_id']);
            break;
        default:
            # code...
            break;
    }
    if($res['constructor']!=4||$res['constructor']!=5){
        $ws->push($frame->fd, $data,WEBSOCKET_OPCODE_TEXT);
    }
});

//监听WebSocket连接关闭事件
$ws->on('Close', function ($ws, $fd) {
    echo "关闭连接的fd为-{$fd} is closed\n";
    Index::del_fd($fd);
});




$ws->start();
