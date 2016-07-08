<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Cookie;
use app\index\logic\UserInfo as lgUserInfo;
use app\index\logic\validate\UserReginfo as vUserReginfo;
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
    	    /*$validate = new vUserReginfo;
    	    if(!$validate->check($post,[],'reginfo')){
    	        // 验证失败 输出错误信息
    	        return json(['status'=>0,'msg'=>$validate->getError(),'url'=>'']);
    	        //return $this->error($validate->getError());
    	    }*/
	    	//实例化logic层的User
	    	$ui_logic = new lgUserInfo;
	    	try {
	    	    if($ui_logic->C_regInfo($post)){
	    	        return json(['status'=>0,'msg'=>'保存成功','url'=>'/index.php']);
	    	        //return $this->success('保存成功','/index.php');
	    	    }else{
	    	        return json(['status'=>0,'msg'=>'保存失败','url'=>'']);
	    	        //return $this->error('保存失败');
	    	    }
	    	} catch (\Exception $e) {
	    	    return json(['status'=>0,'msg'=>$e->getMessage(),'url'=>'']);
	    	    //return $this->error($e->getMessage());
	    	}
	    	
    	}
    	return $this->fetch('reg/regInfo');
    	
    }
	
}
