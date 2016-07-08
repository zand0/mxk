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
	 * @ action 获取今日还可推荐职位 的数量
	 * @ Parameter 参数
	 * @ return 
	 * @ author laowen
	 * @ date 16/07/07
	 */

	public function R_userMessage_dayNum(){

		$ruid = Session::get('ruid')?Session::get('ruid'):0;

		if( $ruid == 0) {

			return "请先登录"; die();

		}

		/*$date = date('Y-m-d 00:00:00 ', time());

		print_r($date);

		echo $date;exit;

		$md_userMessage = new mdUserMessage();*/




	}


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
	 * @ action 获取 推荐我的消息
	 * @ Parameter 参数
	 * @ return 返回 array（）
	 * @ author laowen
	 * @ date 
	 */

	public function R_userMessage_recommendMe ( $num = null ) {

		$ruid = Session::get('ruid')?Session::get('ruid'):0;

		if( $ruid == 0) {

			return "请先登录"; die();

		}

		$md_userMessage = new mdUserMessage();

		if ( !$num ) {

			$dt_userMessage = $md_userMessage->where( 'STATE','1' )->where( 'UME_IDN',$ruid)->order( 'UME_CRE_TIME','desc')->select();
			
		}else if ( $num == 1 ){

			$dt_userMessage = $md_userMessage->where( 'STATE','1' )->where( 'UME_IDN',$ruid)->order( 'UME_CRE_TIME','desc')->find();

		} else {

			$dt_userMessage = $md_userMessage->where( 'STATE','1' )->where('UME_IDN',$ruid)->limit($num)->order('UME_CRE_TIME','desc')->select();

		}

		return $dt_userMessage;

	}

	/**
	 * @ action 获取 我推荐最新三条消息
	 * @ Parameter 参数
	 * @ return 返回 array（）
	 * @ author laowen
	 * @ date 
	 */

	public function R_userMessage_myRecommend ( $num= null ) {

		$ruid = Session::get('ruid')?Session::get('ruid'):0;

		if( $ruid == 0) {

			return "请先登录"; die();

		};

		$md_userMessage = new mdUserMessage();

		if ( !$num ) {

			$dt_userMessage = $md_userMessage->where( 'STATE','1' )->where( 'UME_IDS',$ruid)->order( 'UME_CRE_TIME','desc')->select();
			
		}else if ( $num == 1 ){

			$dt_userMessage = $md_userMessage->where( 'STATE','1' )->where( 'UME_IDS',$ruid)->order( 'UME_CRE_TIME','desc')->find();

		} else {

			$dt_userMessage = $md_userMessage->where( 'STATE','1' )->where('UME_IDS',$ruid)->limit($num)->order('UME_CRE_TIME','desc')->select();

		};

		// $dt_userMessage = $md_userMessage->where( 'STATE','1' )->where('UME_IDS',$ruid)->limit(3)->order('UME_CRE_TIME','desc')->select();

		return $dt_userMessage;

	}

}