<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class User extends Controller
{

	/**
	 * @ action 登录
	 * @ Parameter 
	 * @ return 
	 * @ author 
	 * @ date 
	 */

    public function login(){

        return "登录注册页面";

    }

    /**
     * @ action 获取用户信息
     * @ Parameter  获取到等路用户的id
     * @ return 返回
     * @ author laowen
     * @ date 16/07/05
     */

    public function get_userinfo (){

        return "获取用户信息";

    }
    
}
