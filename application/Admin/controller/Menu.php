<?php
namespace app\Admin\controller;


use think\Controller;
use think\facade\Session;
use think\Request;


class Menu extends Controller{
    
    public function index(){
        $user=Session::get('user');
        $level=level($user,$level=-1);

        $navList=db('admin_nav_list')->select();
        $arr=[
            'code'=>200,
            'msg'=>'获取成功',
        ];

        if($navList==null){
            $arr=[
                'code'=>100,
                'msg'=>'尚未设置导航',
                'url'=>'/admin/menu/setting'
            ];
            return json($arr);
        }

        $arr['data']=$navList;

        return json($arr);
    }
    public function get(){
        $user=Session::get('user');
        $level=level($user,$level=0);

        $navList=db('admin_nav_list')->select();

        $arr=[
            'code'=>200,
            'msg'=>'尚未设置导航'               
            
        ];

        if($navList==null){
            $data=[
                ['name'=>'顶级导航',
                    'sid'=>1,
                    'fid'=>0]
                ];
                $arr['data']=$data;
            return json($arr);
        };

        $arr['msg']='获取成功';
        $arr['data']=$navList;

        return json($arr);
    }

    public function add(Request $request){
        $user=Session::get('user');
        $level=level($user,$level=0);
        $request_data = $request->put();
        $result = $this->validate($request_data, 'app\admin\validate\Menu');
        $arr=[
            'code'=>200,
            'msg'=>'添加成功'
        ];

        if($result !== true){
            $arr=[
                'code'=>100,
                'msg'=>$result
            ];
            return json($arr);
        }
        dump($request_data);
        $back=db('admin_nav_list')->insert($request_data);

        return json($arr);
    }

}