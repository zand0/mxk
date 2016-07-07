<?php
namespace app\index\controller;
use think\View;
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
class Regbindtel extends Controller
{
   
    public function bindtel($submit=''){
        $post = Request::instance()->post();
		if($submit){
			/*if(!$uname || !$pass){
				return $this->error('用户名或密码不得为空！','login');
			}*/
		    $validate = new vUserReginfo;
		    if(!$validate->check($post,[],'regtel')){
		        // 验证失败 输出错误信息
		        return $this->error($validate->getError());
		    }
		    $phone = $post['UR_PHONE'];
		    $code = $post['UC_CODE'];
	        $uc_logic = new lgUserCode;
	        if(!$uc_logic->RU_checkcode($phone,$code)){
	            return $this->error('验证码失效');
	        }
		    
		    
			//实例化logic层的User
			$ur_logic = new lgUserReginfo;
			//调用User的方法判断验证登录
			if($ur_logic->U_bindtel($phone)){
				return $this->success('绑定成功','/index.php/index/Login/ucenter');
			}else{
				return $this->error('绑定失败');
			}
		}
    	return $this->fetch('reg/bindTel');
    	
    }
	
}
