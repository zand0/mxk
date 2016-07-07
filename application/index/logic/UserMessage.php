<?php
namespace app\index\logic;
use think\Session;
use app\index\model\UserMessage as mdUserMessage;
	
	/**
	 * @ action 推送消息类
	 * @ Parameter 
	 * @ return 
	 * @ author 
	 * @ date 
	 */

class UserMessage
{
	/**
	 * @ action 获取 最新一条系统消息
	 * @ Parameter 参数
	 * @ return 返回 数组array()
	 * @ author laowen
	 * @ date 16/07/06
	 */

	public function R_userMessage_oneSystem(){

		$md_userMessage = new mdUserMessage();

		$dt_userMessage = $md_userMessage->where( 'STATE','0' )->limit(1)->order('UME_CRE_TIME','desc')->find();

		return $dt_userMessage;

	}

	/**
	 * @ action 获取 推荐我的最新一条消息
	 * @ Parameter 参数
	 * @ return 返回 array（）
	 * @ author laowen
	 * @ date 
	 */

	public function R_userMessage_recommendMe(){

	}

	/**
	 * @ action 获取 我推荐最新三条消息
	 * @ Parameter 参数
	 * @ return 返回 array（）
	 * @ author laowen
	 * @ date 
	 */

	public function R_userMessage_myRecommend(){

	}

}