<?php
namespace app\admin\controller;


use think\Controller;
use think\facade\Session;
use think\Request;
use think\captcha\Captcha;


class Auth extends Controller
{
    public function getCaptcha()
    {

        $captcha = new Captcha();
        $captcha->codeSet = '0123456789'; 
        $captcha->fontSize = 30;
        $captcha->length   = 4;
        $captcha->useCurve = false;
        $captcha->useNoise = false;
        return $captcha->entry();
    }
    public function login(Request $request)
    {

        $request_data = $request->put();
        $result = $this->validate($request_data, 'app\admin\validate\Login');

        if($result !== true){
            $return_data=[
                'code'=>0,
                'msg'=>$result
            ];
            return json($return_data);
        }


        $user=db('users')->where('user', $request_data['user'])->find();

        if($user==null){

            $return_data=[
                'code'=>0,
                'msg'=>'找不到该用户'
            ];
            return json($return_data); 
        }

        if (!password_verify($request_data['password'], $user['password'])) {
            $return_data=[
                'code'=>0,
                'msg'=>'登录密码错误'
            ];
            return json($return_data); 
        }
        $user=db('users')->where('user',$request_data['user'])->update(['last_login_time'=>date("Y-m-d H:i:s")]);
        $user=db('users')->where('user',$request_data['user'])->find();
        $user_type=db('user_type')->where('user_type',$user['user_type'])->find();
        $user['power']=$user_type['power'];
        unset($user['password']);
        unset($user['user_type']);
        $user['user_type']=$user_type['name'];
        
        if($user['avatar']!=null){
            $user['avatar']='http://api.long.com/uploads/'.$user['avatar'];
        }else{
            $user['avatar']='http://api.long.com/uploads/default.jpg';
        }



        $seesonInfo=db('users')->where('user',$request_data['user'])->field('user,real_name,user_type')->find();
        Session::set('user',$seesonInfo);

        $return_data=[
            'code'=>1,
            'msg'=>'登录成功',
            'url'=>'/admin/home',
            'data'=>$user

        ];

        

        return json($return_data); 


       
    }
}
