<?php
namespace app\Admin\controller;


use think\Controller;
use think\facade\Session;


class Nav extends Controller{
    
    public function index(){
        $user=Session::get('user');
        $level=level($user,$level=-1);

        $navList=db('admin_nav_list')->find();

        if($navList==null){
            $arr=[
                'code'=>100,
                'msg'=>'尚未设置导航',
                'url'=>'/admin/menu/setting'
            ];
            return json($arr);
        }


        return json($navList);


        
    }

}