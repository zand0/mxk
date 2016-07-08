<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Cookie;
use app\index\logic\api\Sms;
use app\index\logic\UserCode as lgUserCode;
use app\index\logic\UserReginfo as lgUserReginfo;
use app\index\logic\validate\UserReginfo as vUserReginfo;

class Regtel extends Controller
{
   
    public function reg($submit=''){
        //User::is_login();
		//获取整个post数据
    	$post = Request::instance()->post();
    	
    	if($submit){
    	    //dump($post);exit;
    	    //验证提交数据
	    	//$result = (new vUserReginfo)->check($post,[],'regtel');
	    	//$post['UR_PHONE'] = $post['UR_PHONE'];
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
	    	$ur_logic = new lgUserReginfo;
	    	try{
	    	    if($ur_logic->C_User($post)){
	    	        return json(['status'=>1,'msg'=>'注册成功','url'=>'/index.php/index/Reginfo/subinfo']);
	    	        //return $this->success('注册成功','/index.php/index/Reginfo/subinfo');
	    	    }else{
	    	        Session::delete('ruid');
	    	        Cookie::delete('ruid');
	    	        return json(['status'=>0,'msg'=>'注册失败','url'=>'']);
	    	        //return $this->error('注册失败');
	    	    }
	    	}catch (\Exception $e){
	    	    //dump($e->getCode());exit;
	    	    Session::delete('ruid');
	    	    Cookie::delete('ruid');
	    	    return json(['status'=>0,'msg'=>$e->getMessage(),'url'=>'/index.php/index/Logintel/login']);
	    	    //return $this->success($e->getMessage(),'/index.php/index/Logintel/login');
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
	        //验证手机号是否注册
	        if(!(new lgUserReginfo)->R_userByTel($phone)){
	            return ['status'=>0,'msg'=>'此手机号尚未注册，请先注册','url'=>'/index.php/index/Regtel/reg'];
	        }
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
