<?php
namespace app\index\logic\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        
        'UI_NAME'  =>  'require',
        'UR_PHONE'  =>  'require|number',
        'UR_PWD'  =>  'require',
        'UI_EMAIL'  =>  'email|require',
        'UC_CODE'  =>  'number|require',
    ];
    
    protected $message = [
        'UI_NAME.require'  =>  '用户名必须',
        'UR_PWD.require' => '密码不能为空',
        'UI_EMAIL.email' =>  '邮箱格式错误',
        'UI_EMAIL.require' =>  '邮箱不能为空',
        'UR_PHONE.require' =>  '手机号不能为空',
        'UR_PHONE.number' =>  '手机号必须为数字',
        'UC_CODE.require' =>  '验证码不能为空',
        'UC_CODE.number' =>  '验证码必须为数字',
    ];
    
    protected $scene = [
        'loginpass'   =>  ['UR_PHONE','UR_PWD'],
        'add'  =>  ['email','uname','pass'],
        'logintel'   =>  ['UR_PHONE','pass'],
        'regtel'   =>  ['uname|email','pass'],
        'reginfo'   =>  ['uname|email','pass'],
        'regbindtel'   =>  ['uname|email','pass'],
    ];
}

