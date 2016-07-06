<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Cookie;
use app\index\logic\UserInfo as lgUserInfo;
/*
 * 登录控制器demo
 * 
 * 
 */
class Reginfo extends Controller
{
   
    public function subinfo($submit=''){
        //User::is_login();
		//获取整个post数据
    	$post = Request::instance()->post();
    	//$user['uptime'] = time();
    	if($submit){
    		/*if(!$uname || !$pass){
    			return $this->error('用户名或密码不得为空！','/index.php/index/Login/login');
    		}*/
	    	//实例化logic层的User
	    	$ui_logic = new lgUserInfo;
	    	if($ui_logic->C_user($post)){
	    		return $this->success('注册成功','/index.php/index/Login/ucenter');
	    	}else{
	    		return $this->error('注册失败','/index.php/index/Register/reg');
	    	}
    	}
    	return $this->fetch('reg/regInfo');
    	
    }
	
}
