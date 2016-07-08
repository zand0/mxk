<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\index\logic\api\Sms;
use app\index\logic\UserInfo as lgUserInfo;
use app\index\logic\UserReginfo as lgUserReginfo;

class UserInfo extends Controller
{

    /**
     * @ action 修改 姓名
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 
     */

    public function userReviseName(){

        $lg_userInfo = new lgUserInfo;        

        if ( input('get.type')=='ok' ) {

            // 修改用户名            

            $dt_userInfo = $lg_userInfo->U_userName();

            return $dt_userInfo;

            die();
            
        }

        $name = input('get.name');

        $this->assign('name',$name); 

        return $this->fetch('userReviseName'); die();        

    }

    /**
     * @ action 修改 密码
     * @ Parameter 
     * @ return 
     * @ author laowen
     * @ date 
     */

    public function userRevisePwd(){

        return $this->fetch('userRevisePwd');

    }

    /**
     * @ action 修改 手机号
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userRevisePhone(){

        $lg_userReginfo = new lgUserReginfo; 

            // 修改手机号       

        if ( input('get.type')=='ok' ) {

            $dt_userReginfo = $lg_userReginfo->U_byPhone();

            if ( !$dt_userReginfo) { return "修改失败！请稍后重试！"; die(); };

            return $dt_userReginfo; die();
            
        }

            // 获取验证码

        if ( input('get.type')=='getcode' ) {

            $phone = input('post.phone');

            if ( !$phone ) { return false; die(); }

            if ( !preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/", $phone)) { return "手机号存在问题，请重试！";die(); };

                // 验证手机号是否已经被使用            

            $dt_userReginfo = $lg_userReginfo->R_byPhone($phone);

            if ( $dt_userReginfo == 'ok' ) {

                $verify=rand(10000,99999);

                Session::set( $phone.'verify', $verify);

                $sms=new Sms;

                $data= "您正在重新绑定手机号，确保是本人在操作，您本次的验证码是".$verify ;

                $res= $sms->SendData( $phone, $data);

                return json_encode($res); die();

            }

            return $dt_userReginfo;die();

        }

        $phone = input('get.phone');

        $this->assign('phone',$phone); 

        return $this->fetch('userRevisePhone'); die();

    }

    /**
     * @ action 操作 邮箱
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userReviseEmail() {

        return $this->fetch('userReviseEmail');
        
    }

    /**
     * @ action 简历-----列表
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userResumeDetail() {

        return $this->fetch('userResumeDetail');

    }

    /**
     * @ action 简历-----基本信息
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userInfo() {

        return $this->fetch('userInfo');
    }

    /**
     * @ action 简历-----工作经历
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userWorkInfo(){

        return $this->fetch('userWorkInfo');

    }

    /**
     * @ action 简历-----教育经历
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userEduInfo(){

        return $this->fetch('userEduInfo');

    }

    /**
     * @ action 简历-----期望工作
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userWantWork(){

        return $this->fetch('userWantWork');

    }

    /**
     * @ action 简历-----项目经验
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 日期
     */

    public function userProject(){

        return $this->fetch('userProject');

    }











}