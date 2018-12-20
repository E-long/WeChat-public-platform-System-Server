<?php

namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
    protected $rule = [
        'user|用户名' => 'require|min:5|max:50',
        'password|密码' => 'require|min:5',
        'captcha|验证码' => 'require|captcha',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'user.require' => '必须填写用户名',
        'user.min' => '用户名最多不能少于5个字符',
        'user.max' => '用户名最多不能超过50个字符',
        'password.min' => '密码最多不能少于5个字符',
        'password.max' => '密码最多不能超过50个字符',
        'captcha.require' => '必须填写验证码',
        'captcha.captcha' => '验证码错误',

    ];
}
