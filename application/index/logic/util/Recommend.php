<?
namespace app\index\logic\util;
use app\index\logic\UserInfo as lgUserInfo;
use app\index\logic\UserMessage as lgUserMessage;
use app\index\logic\JobMaininfo as lgJobMaininfo;
use app\index\logic\CompanyMaininfo as lgCompanyMaininfo;



	/**
	 * @ action  获取推荐信息 类
	 * @ Parameter 参数
	 * @ return 返回
	 * @ author laowen
	 * @ date 日期
	 */

class Recommend{

		// 应用于存放对应模型的属性

    protected $_UserInfo = '';
    
    protected $_UserMessage = '';
    
    protected $_JobMaininfo = '';
    
    protected $_CompanyMaininfo = '';

	    /**
	     * @ action 将本类对应模型实例化到本类属性 _m 方便使用
	     * @ Parameter 
	     * @ return
	     * @ author laowen
	     * @ date 16/07/08
	     */

    public function __construct(){

        $this->_UserInfo = new lgUserInfo;

        $this->_UserMessage = new lgUserMessage;
    
        $this->_JobMaininfo = new lgJobMaininfo;
    
        $this->_CompanyMaininfo = new lgCompanyMaininfo;
    
    }

		/**
		 * @ action 推荐我的信息
		 * @ Parameter 获取数据条数
		 * @ return 返回
		 * @ author laowen
		 * @ date 日期
		 */

	function recommendMe( $num=null ){

		$recommendMe = $this->_UserMessage->R_userMessage_recommendMe($num);

		if ( $num != '1' ) {

			foreach ($recommendMe as $key => $value) {

		        $recommendMe[$key]['recommendMe'] = $this->_UserInfo->R_userInfo_nameAndPhoto($recommendMe[$key]['UME_IDS']);

		        $recommendMe[$key]['companyName'] = $this->_CompanyMaininfo->R_companyMaininfo_name($recommendMe[$key]['CM_ID']);

		        $recommendMe[$key]['jobName'] = $this->_JobMaininfo->R_jobMaininfo_name($recommendMe[$key]['JM_ID']);

	    	}
			
		}

		return $recommendMe;		

	}

		/**
		 * @ action 我推荐的信息
		 * @ Parameter 获取条说
		 * @ return 返回
		 * @ author laowen
		 * @ date 日期
		 */

	function myRecommend( $num=null ){

		$myRecommend = $this->_UserMessage->R_userMessage_myRecommend($num);

		if ( $num != '1' ) {

			foreach ($myRecommend as $key => $value) {

		        $myRecommend[$key]['myRecommend'] = $this->_UserInfo->R_userInfo_nameAndPhoto($myRecommend[$key]['UME_IDS']);

		        $myRecommend[$key]['companyName'] = $this->_CompanyMaininfo->R_companyMaininfo_name($myRecommend[$key]['CM_ID']);

		        $myRecommend[$key]['jobName'] = $this->_JobMaininfo->R_jobMaininfo_name($myRecommend[$key]['JM_ID']);

	    	}
			
		}

		return $myRecommend;		

	}








}