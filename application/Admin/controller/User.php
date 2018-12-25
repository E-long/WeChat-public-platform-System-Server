<?php
namespace app\Admin\controller;


use think\Controller;



class User extends Controller{
    public function user_level(){
        $arr=[
            'code'=>200,
            'msg'=>'获取成功',
            'data'=>[]
        ];
        $list=db('user_type')->select();
        $arr['data']=$list;
        
        return  json($arr);
    }
}