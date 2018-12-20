<?php
namespace app\Admin\controller;


use think\Controller;



class Index extends Controller{
    public function index(){
        return  json([
            'code'=>200,
            'msg'=>'欢迎使用微信公众号管理系统'
        ]);
    }
}