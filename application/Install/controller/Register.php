<?php

namespace app\install\controller;

use think\Controller;
use think\Request;
use think\facade\Session;


class Register extends Controller
{
    public function index(Request $request)
    {
        $request_data = $request->put();
        
        $arr=[
            'code'=>-1,
            'msg'=>'非法请求，信息已记录'
        ];
        if($request_data==null){
            return json($arr);
        }
        $count=db('users')->count();
        if($count==0){


            $result = $this->validate($request_data, 'app\Install\validate\Register');
     
            if(true !== $result){
                $arr['msg']=$result;
            }else{
                $request_data['user_type']=1;
                $data=[
                    'user'=>$request_data['user'],
                    'password'=>password_hash($request_data['password'], PASSWORD_DEFAULT),
                    'user_type'=>1,
                    'last_login_ip'=>$request->ip(),
                    'last_login_time'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s"),

                ];

                $user=db('users')->insert($data);
                if($user){


                    $user=db('users')->where('user',$request_data['user'])->find();
                    $power=db('user_type')->where('user_type',$data['user_type'])->find();
                    $user['power']=$power['power'];
                    unset($user['password']);

                    
                    $arr=[
                        'code'=>200,
                        'msg'=>'注册成功',
                        'url'=>'/admin/home',
                        'data'=>$user
                    ];


                    $seesonInfo=db('users')->where('user',$request_data['user'])->field('user,real_name,user_type')->find();

                    Session::set('user',$seesonInfo);

                }


            }


        }
        return json($arr);


    }

   
}
