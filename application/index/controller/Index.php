<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return json([
            'code'=>200,
            'msg'=>'欢迎使用微信公众号管理系统'
        ]);
    }

}
