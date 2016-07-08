<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use think\File;
use app\index\logic\util\Resizeimage;
use app\index\logic\util\CropAvatar;
use app\index\logic\UserInfo as lgUserInfo;
use app\index\logic\UserMoney as lgUserMoney;
use app\index\logic\UserReginfo as lgUserReginfo;
use app\index\logic\UserMessage as lgUserMessage;
use app\index\logic\JobMaininfo as lgJobMaininfo;
use app\index\logic\CompanyMaininfo as lgCompanyMaininfo;


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

            // 获取 登录用户信息

        $lg_userInfo = new lgUserInfo;

        $dt_userInfo_nameAndPhoto = $lg_userInfo->R_userInfo_nameAndPhoto();

        // print_r($dt_userInfo_nameAndPhoto);exit();

            // 获取用户的 推荐 信息

        $lg_userMoney = new lgUserMoney;

        $dt_userMoney = $lg_userMoney->R_userMoney();

        // print_r($dt_userMoney);exit;

        $lg_userMessage = new lgUserMessage;

            // 获取今日还可推荐职位数        

        /*$dt_userMessage_dayNum = $lg_userMessage->R_userMessage_dayNum();

        echo $dt_userMessage_dayNum;exit;*/

            // 获取 系统消息

        $dt_userMessage_oneSystem = $lg_userMessage->R_userMessage_oneSystem();

        // print_r($dt_userMessage_oneSystem);exit();

            // 获取 推荐我的最新一条消息

        $lg_companyMaininfo = new lgCompanyMaininfo;

        $lg_jobMaininfo = new lgJobMaininfo;

        $dt_userMessage_recommendMe = $lg_userMessage->R_userMessage_recommendMe(1);

        $dt_userMessage_recommendMe['recommendMe'] = $lg_userInfo->R_userInfo_nameAndPhoto($dt_userMessage_recommendMe['UME_IDS']);

        $dt_userMessage_recommendMe['companyName'] = $lg_companyMaininfo->R_companyMaininfo_name($dt_userMessage_recommendMe['CM_ID']);

        $dt_userMessage_recommendMe['jobName'] = $lg_jobMaininfo->R_jobMaininfo_name($dt_userMessage_recommendMe['JM_ID']);

        // print_r($dt_userMessage_recommendMe);exit();

            // 获取 我推荐的消息

        $dt_userMessage_myRecommend = $lg_userMessage->R_userMessage_myRecommend(3);

        foreach ($dt_userMessage_myRecommend as $key => $value) {

            $dt_userMessage_myRecommend[$key]['myRecommend'] = $lg_userInfo->R_userInfo_nameAndPhoto($dt_userMessage_myRecommend[$key]['UME_IDS']);

            $dt_userMessage_myRecommend[$key]['companyName'] = $lg_companyMaininfo->R_companyMaininfo_name($dt_userMessage_myRecommend[$key]['CM_ID']);

            $dt_userMessage_myRecommend[$key]['jobName'] = $lg_jobMaininfo->R_jobMaininfo_name($dt_userMessage_myRecommend[$key]['JM_ID']);
            
        }
        
        // print_r($dt_userMessage_myRecommend);exit();

        $this->assign( 'userInfo', $dt_userInfo_nameAndPhoto ); 

        $this->assign( 'userMoney', $dt_userMoney );

        $this->assign( 'system', $dt_userMessage_oneSystem );

        $this->assign( 'recommendMe', $dt_userMessage_recommendMe );

        $this->assign( 'myRecommend', $dt_userMessage_myRecommend ); 

        return $this->fetch( 'userPage' );

    }

    /**
     * @ action 我的佣金
     * @ Parameter 
     * @ return 
     * @ author laowen
     * @ date 16/07/06
     */

    public function userMoney(){

            // 获取姓名和头像 

        $lg_userInfo = new lgUserInfo;

        $dt_userInfo_nameAndPhoto = $lg_userInfo->R_userInfo_nameAndPhoto();

            // 获取佣金信息

        $lg_userMoney = new lgUserMoney;

        $dt_userMoney = $lg_userMoney->R_userMoney();

            // 获取推荐我的信息





        $this->assign( 'userInfo', $dt_userInfo_nameAndPhoto ); 

        $this->assign( 'userMoney', $dt_userMoney );

        return $this->fetch( 'userMoney');

    }

    /**
     * @ action 上传头像操作
     * @ Parameter 参数
     * @ return 返回
     * @ author laowen
     * @ date 16/07/06
     */

    public function upload_avatar(){

        $crop = new CropAvatar($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file']);
        
        $response = array(

            'state'  => 200,

            'message' => $crop -> getMsg(),

            'result' => '/'.$crop -> getResult()

        );

        if( $crop -> getResult()){

            $url = $crop -> getResult();

            $url_array = explode('/', $url);

            // echo $url_array[2];exit;

            $lg_userInfo = new lgUserInfo;

            $dt_userInfoPhoto = $lg_userInfo->U_userInfo_photo($url_array[2]);

            if ( !$dt_userInfoPhoto ) {

                $response = array(

                    'state'  => 500,

                    'message' => '头像上传失败',

                    'result' => '/'.$url

                );
                
            }
        
        }

        echo json_encode($response);      //获取头像
    }

    /**
     * @ action 账号设置
     * @ Parameter 
     * @ return 
     * @ author laowen
     * @ date 16/07/06
     */

    public function userAccount(){

        $lg_userReginfo = new lgUserReginfo;

        $dt_userReginfo_all = $lg_userReginfo->R_userInfo_all();

        // print_r($dt_userReginfo_all);exit;

        $this->assign( 'url', $dt_userReginfo_all['k_user_info']['UI_PHOTO']);

        $this->assign( 'userInfo', $dt_userReginfo_all); 

        return $this->fetch( 'userAccount');

    }

    
    /**
     * @ action 我的人脉
     * @ Parameter 
     * @ return 
     * @ author 
     * @ date 
     */


    public function useFriend(){

        return $this->fetch( 'useFriend');

    }


    














}