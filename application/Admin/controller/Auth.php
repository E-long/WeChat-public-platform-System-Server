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
            $arr=[
                'code'=>0,
                'msg'=>$result
            ];
            return json($arr);
        }


        $user=db('users')->where('user', $request_data['user'])->find();

        if($user==null){

            $arr=[
                'code'=>0,
                'msg'=>'找不到该用户'
            ];
            return json($arr); 
        }

        if (!password_verify($request_data['password'], $user['password'])) {
            $arr=[
                'code'=>0,
                'msg'=>'登录密码错误'
            ];
            return json($arr); 
        }
        $user=db('users')->where('user',$request_data['user'])->update(['last_login_time'=>date("Y-m-d H:i:s")]);
        $user=db('users')->where('user',$request_data['user'])->find();
        $user_type=db('user_type')->where('user_level',$user['user_level'])->find();
        $user['power']=$user_type['power'];
        unset($user['password']);
        unset($user['user_level']);
        $user['user_level']=$user_type['name'];
        
        if($user['avatar']!=null){
            $user['avatar']='http://api.long.com/uploads/'.$user['avatar'];
        }else{
            $user['avatar']='http://api.long.com/uploads/avatar/default.jpg';
        };
        $seesonInfo=db('users')->where('user',$request_data['user'])->field('user,real_name,user_level')->find();
        $seesonInfo['power']=$user['power'];
        Session::set('user',$seesonInfo);

        $arr=[
            'code'=>1,
            'msg'=>'登录成功',
            'url'=>'/admin/home',
            'data'=>$user

        ];

        return json($arr); 
       
    }

    public function logout(){
        $back=Session::delete('user');
        $arr=[
            'code'=>200,
            'msg'=>'退出成功',
            'url'=>'./'
        ];
        return json($arr);
    }
}
