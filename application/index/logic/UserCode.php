<?php
namespace app\index\logic;
use app\index\model\UserCode as mdUserCode;

class UserCode
{
    protected $_m = '';
    public function __construct(){
        $this->_m = new mdUserCode;
    }
    public function CU_code($post){
        $data = [
            'UC_PHONE'=>$post['phone'],
            'UC_STATE'=>0,
            'UC_CODE'=>$post['code'],
            'UC_START_TIME'=>date('Y-m-d H:s:i',time())  
        ];
        $uc = $this->_m;
        if($uc->where('UC_PHONE',$data['UC_PHONE'])->value('UC_PHONE')){
            //此手机号存在便更新
            $uc->allowField(true)->save($data,['UC_PHONE' => $data['UC_PHONE']]);
            return 1;
        }else{
            //手机号不存在就添加
            return $uc->data($data)->save();
        }
        
    }
    
    public function R_checkcode($phone){
        $uc = $this->_m;
        $ustime = $uc->where('UC_PHONE',$phone)->value('UC_START_TIME');
        if( $ustime && $ustime<(time()+10*60) ){
            return 1;
        }else{
            return 0;
        }  
    }
    
    public function RU_checkcode($phone,$code){
        $uc = $this->_m;
        $ustime = $uc->where('UC_PHONE',$phone)->where('UC_CODE',$code)->value('UC_START_TIME');
        if( $ustime && strtotime($ustime)<(time()+10*60) ){
            return 1;
        }else{
            return 0;
        }
    }
}

