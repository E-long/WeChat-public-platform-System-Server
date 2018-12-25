<?php

namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
    protected $rule = [
        'fid|父级'=>'require|number',
        'user_level|权限'=>'require',
        'name|名称'=>'require',
        'sid|ID'=>'require|number',
        'url|地址'=>'require'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'fid.number' => '父级必须大于0',
        'sid.number' => 'ID必须大于0',


    ];


    protected function Less($value,$rule,$data,$field){
        if($value>0){
            return true;
        }else{
            return $field.'不能为负数';
        }

    }
}
