<?php
namespace app\index\logic;
use app\index\model\UserReginfo as mdUserReginfo;
use think\Session;
use think\Cookie;

class UserReginfo
{
    protected $_m = '';
    public function __construct(){
        $this->_m = new mdUserReginfo;
    }
    public function C_User($post){
        $data = [
            'UR_PHONE'=>     $post['phone'],
            'UR_PWD'=>       $post['pass']?$post['pass']:0,
            'UR_STATE'=>     $post['UR_STATE']?$post['UR_STATE']:0,
            'WEIXIN_TYPE'=>  $post['WEIXIN_TYPE']?$post['WEIXIN_TYPE']:0,
            'QQ_TYPE'=>      $post['QQ_TYPE']?$post['QQ_TYPE']:0,
            'SINA_TYPE'=>    $post['SINA_TYPE']?$post['SINA_TYPE']:0,
            'UR_REG_TIME'=>  date('Y-m-d H:i:s',time()),
            'UR_LAST_TIME'=> date('Y-m-d H:i:s',time())
        ];
        
        $urm = $this->_m;
        if(!$this->R_byPhone($data['UR_PHONE'])){
            $urm->data($data);
            //Session::set('ruid',$data['']);
            //过滤post数组中的非数据表字段数据
            Session::set('ruid',$urm->allowField(true)->save());
            return 1;
        }
        return 0;
    }
    
    public function R_byPhone($phone){
        return $this->_m->where('UR_PHONE',$phone)->value('UR_PHONE');
    }
    
    
    
    public function R_user($phone){
        return $this->_m->where('UR_PHONE',$phone)->find();
    }
    
    public static function logout(){
        Cookie::delete('ruid');
        Session::delete('ruid');
    }
    /**
     * 验证数据
     * @param array $data
     * @param array $rules
     * @param string $scene
     * @author 史坤强
     */
    public function validate($data,$rules = [], $scene = ''){
        /*$vali = new VUser();
         
        if(!$vali->check($data,$rules,$scene)){
            return  $vali->getError();
        }*/
    }
    
    public function login_check($phone,$code,$pass=''){
        //检查验证码是否有效
    
        $userinfo = $this->R_user($phone);
        if($pass){
            $pass = md5($pass);
            if($pass != $userinfo['UR_PWD']){
                return 0;
            }
        }
        if(!empty($userinfo)){
            Session::set('ruid',$userinfo['UR_ID']);
            return 1;
        }else{
            return 0;
        }
    }
}

