<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\logic\UserInfo as lgUserInfo;
use app\index\logic\UserReginfo as lgUserReginfo;
use app\index\logic\UserMessage as lgUserMessage;

    /**
     * @ action 用户类
     * @ Parameter 
     * @ return 
     * @ author laowen
     * @ date 
     */

class User extends Controller
{

    /**
     * @ action 个人中心
     * @ Parameter  获取到等路用户的id
     * @ return 返回 姓名，头像 系统消息 推荐我消息 我推荐消息
     * @ author laowen
     * @ date 16/07/06
     */

    public function userPage () {

        $lg_userInfo = new lgUserInfo();

        $dt_userInfo_nameAndPhoto = $lg_userInfo->R_userInfo_nameAndPhoto();

        // print_r($dt_userInfo_nameAndPhoto);exit();

        $lg_userMessage = new lgUserMessage();

        $dt_userMessage_oneSystem = $lg_userMessage->R_userMessage_oneSystem();

        // print_r($dt_userMessage_oneSystem);exit();

        $dt_userMessage_recommendMe = $lg_userMessage->R_userMessage_recommendMe();

        // print_r($dt_userMessage_recommendMe);exit();

        $dt_userMessage_myRecommend = $lg_userMessage->R_userMessage_myRecommend();
        
        // print_r($dt_userMessage_myRecommend);exit();

        $this->assign('userInfo',$dt_userInfo_nameAndPhoto); 

        $this->assign('system',$dt_userMessage_oneSystem); 

        return $this->fetch('userPage');

    }

    /**
     * @ action 账号设置
     * @ Parameter 获取到当前登录的用户id
     * @ return 账号信息
     * @ author laowen
     * @ date 16/07/06
     */

    public function userAccount(){

        $lg_userReginfo = new lgUserReginfo();

        $dt_userReginfo_all = $lg_userReginfo->R_userInfo_all();

        // print_r($dt_userReginfo_all);exit;

        $this->assign('userInfo',$dt_userReginfo_all); 

        return $this->fetch('userAccount');

    }
    
}
