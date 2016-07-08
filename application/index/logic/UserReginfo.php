<?php
namespace app\index\logic;
use app\index\model\UserReginfo as mdUserReginfo;
use think\Session;
use think\Cookie;
use app\index\logic\util\Filter;
use app\index\logic\validate\UserReginfo as vUserReginfo;


class UserReginfo
{
    //用于存放对应模型的属性
    protected $_m = '';
    /**
     * 将本类对应模型实例化到本类属性 _m 方便使用
     * @author shikunqiang
     * date 2016-7-6
     */
    public function __construct(){
        $this->_m = new mdUserReginfo;
    }
    /**
     * 插入一条用户信息到k_user_reginfo表
     * @param unknown $post
     * @author 史坤强
     * date 2016-7-6
     */
    public function C_User($post){
        $data = [
            'UR_PHONE'=>     $post['UR_PHONE'],
            'UR_PWD'=>       $post['UR_PWD']?$post['UR_PWD']:0,
            'UR_STATE'=>     $post['UR_STATE']?$post['UR_STATE']:0,
            'WEIXIN_TYPE'=>  $post['WEIXIN_TYPE']?$post['WEIXIN_TYPE']:0,
            'QQ_TYPE'=>      $post['QQ_TYPE']?$post['QQ_TYPE']:0,
            'SINA_TYPE'=>    $post['SINA_TYPE']?$post['SINA_TYPE']:0,
            'UR_REG_TIME'=>  date('Y-m-d H:i:s',time()),
            'UR_LAST_TIME'=> date('Y-m-d H:i:s',time())
        ];
        //数据验证
        /*$vali = new vUserReginfo;
        if(!$vali->check($data,[],'')){
            
        }*/
        if($data['UR_PWD']){
            $data['UR_PWD'] = md5($data['UR_PWD']);
        }
        //过滤关键词
        /*if(Filter::keywords($data)){
            exception('存在敏感词！！',1);
        }*/
        //判断手机号是否已经注册
        if($this->R_userByTel($data['UR_PHONE'])){
            //抛出异常
            exception('此手机号已注册，请登录！',1);
        }
        $urm = $this->_m;
        $urm->data($data);
        $ruid = $urm->allowField(true)->save();
        //将数据插入并将返回的数据id存入session
        Session::set('ruid',$ruid);
        Cookie::set('ruid',$ruid);
        return 1;
        
    }
    
    /**
     * 绑定手机号
     * @param unknown $phone
     * date 2016-7-6
     */
    public function U_bindtel($phone){
        $ruid = Session::get('ruid');
        $this->_m->save(['UR_PHONE'=>$phone],['UR_ID'=>$ruid]);
        return 1;
    }
    
    /**
     * 通过手机号获取注册表的用户信息
     * @param unknown $phone
     * @author shikunqiang
     * date 2016-7-6
     */
    public function R_userByTel($phone){
        return $this->_m->where('UR_PHONE',$phone)->find();
    }
    
    /**
     * 登出
     * @author shikunqiang
     * date 2016-7-6
     */
    public static function logout(){
        Cookie::delete('ruid');
        Session::delete('ruid');
    }
    
    /**
     * 登录操作
     * @param unknown $phone
     * @param string $pass
     * @return bool
     * @author shikunqiang
     * date 2016-7-6
     */
    public function login_check($phone,$pass=''){
		
        $userinfo = $this->R_userByTel($phone);
        if($pass){
            $pass = md5($pass);
            if($pass != $userinfo['UR_PWD']){
                return 0;
            }
        }
        if(!empty($userinfo)){
            Cookie::set('ruid',$userinfo['UR_ID']);
            Session::set('ruid',$userinfo['UR_ID']);
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * @ action 获取用户所有的信息
     * @ Parameter 参数
     * @ return 返回 数组array()
     * @ author laowen
     * @ date 16/07/06
     */

    public function R_userInfo_all(){

        $ruid = Session::get('ruid')?Session::get('ruid'):0;

        if( $ruid == 0) {

            return "请先登录"; die();

        }       

        $md_userReginfo = new mdUserReginfo();

        $dt_userReginfo = mdUserReginfo::find($ruid);

        $dt_userReginfo->k_user_info;

        $dt_userReginfo->k_user_wechat;

        // print_r($dt_userReginfo);exit;

        return $dt_userReginfo;

    }
    
    public static function isLogin(){
        $ruid = Cookie::get('ruid');
        if($ruid){
            if(Session::get('ruid')==$ruid){
                return true;
            }else {
                return false;
            }
        }else{
            return false;
        }
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



    /**
     * @ action 验证手机号是否已使用
     * @ Parameter 手机号
     * @ return 返回
     * @ author laowen
     * @ date 16/07/07
     */

    public function R_byPhone($phone){

        $data = $this->_m->where( 'UR_PHONE',$phone )->value('UR_PHONE');

        if ( !$data ) { return 'ok'; die(); };

        return "该手机号已被使用！请重新输入！"; die();

    }

    /**
     * @ action 修改手机号
     * @ Parameter 参数
     * @ return 返回 数组array()
     * @ author laowen
     * @ date 16/07/07
     */
    
    public function U_byPhone(){

        $phone = input('post.phone');

        if ( $phone=='' ) { return '手机号存在问题，请重试！'; die(); };

        if ( !preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/", $phone)) { return "手机号存在问题，请重试！";die(); }

        $verify = input('post.captaha');

        if ( $verify=='' ) { return '验证码有误'; die(); };

        $oldphone = input('post.oldphone');

        if ( $oldphone =='' ) { return '手机号存在问题，请重试！'; die(); };

        if ( !preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/", $oldphone)) { return "手机号存在问题，请重试！";die(); }

        $verify_o = Session::get( $phone.'verify');

        if ( $verify != $verify_o ) { return '验证码有误'; die(); };

            // 修改手机号

        return $this->_m->where( 'UR_PHONE',$oldphone)->update([ 'UR_PHONE'=>$phone ]);

    }












}