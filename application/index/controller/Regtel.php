<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\index\logic\api\Sms;
use app\index\logic\UserCode as lgUserCode;
use app\index\logic\UserReginfo as lgUserReginfo;

class Regtel extends Controller
{
   
    public function reg($submit='',$phone='',$code=''){
        //User::is_login();
		//获取整个post数据
    	$post = Request::instance()->post();
    	
    	if($submit){
    	    //验证提交数据
	    	/*$result = $user_logic->validate($post,[],'add');
	    	if(!empty($result)){
	    	    // 验证失败 输出错误信息
	    	    return $this->error($result);
	    	}*/
    	    $uc_logic = new lgUserCode;
    	    if(!$uc_logic->RU_checkcode($phone,$code)){
    	        return $this->error('验证码失效');
    	    }
	    	$ur_logic = new lgUserReginfo;
	    	if($ur_logic->C_User($post)){
	    		return $this->success('注册成功','/index.php/index/Login/ucenter');
	    	}else{
	    	    Session::delete('ruid');
	    		return $this->error('注册失败','/index.php/index/Register/reg');
	    	}
    	}
    	return $this->fetch('reg/regTel');
    	
    }
    
    public function sendsms($phone='',$msg=''){
	    if($phone){
	        $verify=mt_rand(1000,9999);
	        //Session::set('verify',$verify);
	        $sms=new Sms;
	        if(!$msg){
	            $msg = "欢迎注册秒小空,您的验证码是";
	        }
	        $data=$msg.$verify;
	        $res= $sms->SendData($phone,$data,$verify);
	        return json($res);
	    }
	    return json(['status'=>0, 'msg'=>'phone is empty']);
	}
    
    public function checkcode($phone,$code){
        $uc_logic = new lgUserCode;
        if($uc_logic->R_checkcode($phone,$code)){
            return json(['status'=>1]);
        }
    }
    
    public function test(){
        
    }
    
    
    
	
}
