<?php
namespace app\index\controller;
use think\View;
use think\Controller;
use think\Request;
use app\index\logic\UserReginfo as lgUserReginfo;
use think\Cookie;
use app\index\logic\validate\UserReginfo as vUserReginfo;
/*
 * 登录控制器demo
 * 
 * 
 */
class Loginpass extends Controller
{
    
	/*
	 * 登录方法,三个参数为绑定参数，自动获取同名get或post参数
	 * 
	 */
	public function login($submit=''){
	    //User::is_login();
	    $post = Request::instance()->post();
		if($submit){
			/*if(!$uname || !$pass){
				return $this->error('用户名或密码不得为空！','login');
			}*/
		    $validate = new vUserReginfo;
		    if(!$validate->check($post,[],'loginpass')){
		        // 验证失败 输出错误信息
		        return $this->error($validate->getError());
		    }
		    $phone = $post['UR_PHONE'];
		    $pass = $post['UR_PWD'];
			//实例化logic层的User
			$ur_logic = new lgUserReginfo;
			//调用User的方法判断验证登录
			if($ur_logic->login_check($phone,$pass)){
				return $this->success('登录成功','/index.php/index/Login/ucenter');
			}else{
				return $this->error('登录失败');
			}
		}
		return $this->fetch('login/loginPass');
	}
	
	
	public function is_login(){
	    $uname = Cookie::get('uname');
	    if($uname){
	        //实例化logic层的User
	        $user_logic = new User;
	        if(User::is_login($uname)){
	            
	            return $this->redirect('Login/ucenter');
	        }
	    }  
	}
	//模拟用户中心
	public function ucenter(){
	    //$this->is_login();
		return $this->fetch('login/demo');
	}
	
	public function logout(){
	    Cookie::delete('uname');
	    return $this->redirect('login/login');
	}
}
