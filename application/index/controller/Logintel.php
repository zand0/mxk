<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\logic\UserReginfo as lgUserReginfo;
use app\index\logic\UserCode as lgUserCode;
use think\Cookie;
use app\index\logic\validate\UserReginfo as vUserReginfo;
/*
 * 登录控制器demo
 * 
 * 
 */
class Logintel extends Controller
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
		    if(!$validate->check($post,[],'regtel')){
		        // 验证失败 输出错误信息
		        return json(['status'=>0,'msg'=>$validate->getError(),'url'=>'']);
		        //return $this->error($validate->getError());
		    }
		    $phone = $post['UR_PHONE'];
		    $code = $post['UC_CODE'];
	        $uc_logic = new lgUserCode;
	        if(!$uc_logic->RU_checkcode($phone,$code)){
	            return json(['status'=>0,'msg'=>'验证码失效','url'=>'']);
	            //return $this->error('验证码失效');
	        }
		    
		    
			//实例化logic层的User
			$ur_logic = new lgUserReginfo;
			//调用User的方法判断验证登录
			if($ur_logic->login_check($phone)){
			    return json(['status'=>1,'msg'=>'登录成功','url'=>'/index.php']);
				//return $this->success('登录成功','/index.php');
			}else{
			    return json(['status'=>0,'msg'=>'登录失败','url'=>'']);
				//return $this->error('登录失败');
			}
		}
		return $this->fetch('login/loginTel');
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
