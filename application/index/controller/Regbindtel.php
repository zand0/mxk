<?php
namespace app\index\controller;
use think\View;
use think\Controller;
use think\Request;
use app\index\logic\User;
use think\Cookie;
/*
 * 登录控制器demo
 * 
 * 
 */
class RegBindTel extends Controller
{
   
    public function reg($submit='',$uname='',$pass=''){
        User::is_login();
		//获取整个post数据
    	$user = Request::instance()->post();
    	$user['uptime'] = time();
    	if($submit){
    		if(!$uname || !$pass){
    			return $this->error('用户名或密码不得为空！','/index.php/index/Login/login');
    		}
	    	//实例化logic层的User
	    	$user_logic = new User;
	    	if($user_logic->addUser($user)){
	    		return $this->success('注册成功','/index.php/index/Login/ucenter');
	    	}else{
	    		return $this->error('注册失败','/index.php/index/Register/reg');
	    	}
    	}
    	return $this->fetch('login/reg');
    	
    }
	
}
