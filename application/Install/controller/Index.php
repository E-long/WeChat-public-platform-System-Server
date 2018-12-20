<?php

namespace app\install\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    // 初始化验证是否安装
    public function index()
    {
        $count=db('users')->count();
        $arr=[
            'code'=>200, 'msg'=>'系统已初始化'
        ];
        if($count==0){
            $arr=[
                'code'=>100, 'msg'=>'系统未初始化','url'=>'install'
            ];
        }
            
        return json($arr);


         
         
    }



       


}