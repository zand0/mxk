<?php
namespace app\index\logic;
use app\index\model\UserCode as mdUserCode;

class UserCode
{
    //用于存放对应模型的属性
    protected $_m = '';
    /**
     * 将本类对应模型实例化到本类属性 _m 方便使用
     * @author shikunqiang
     * date 2016-7-6
     */
    public function __construct(){
        $this->_m = new mdUserCode;
    }
    
    /**
     * 通过手机号插入或更新验证码
     * @param array $post
     * @author shikunqiang
     * date 2016-7-6
     */
    public function CU_code($post){
        $data = [
            'UC_PHONE'=>$post['phone'],
            'UC_STATE'=>0,
            'UC_CODE'=>$post['code'],
            'UC_START_TIME'=>date('Y-m-d H:i:s',time())  
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
    
    /**
     * 检查手机验证码的有效性
     * @param int $phone
     * @param int $code
     * @return bool
     * date 2016-7-6
     */
    public function RU_checkcode($phone,$code){
        //return 1;
        $uc = $this->_m;
        $ustime = $uc->where('UC_PHONE',$phone)->where('UC_CODE',$code)->value('UC_START_TIME');
        if( $ustime && strtotime($ustime)<(time()+10*60) ){
            return 1;
        }else{
            return 0;
        }
    }
}

