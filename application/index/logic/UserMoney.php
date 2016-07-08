<?php
namespace app\index\logic;
use app\index\model\UserMoney as mdUserMoney;
use think\Session;

class UserMoney
{

	/**
	 * @ action 通过 id 获取用户收入信息
	 * @ Parameter 参数
	 * @ return 返回
	 * @ author laowen
	 * @ date 16/07/07
	 */

	public function R_userMoney() {

		$ruid = Session::get('ruid')?Session::get('ruid'):0;

		if( $ruid == 0) {

			return "请先登录"; die();

		}

		$md_userMoney = new mdUserMoney;

		return $dt_userMoney = $md_userMoney->where( 'UR_ID',$ruid )->find();

	}




}