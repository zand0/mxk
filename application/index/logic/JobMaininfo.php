<?php
namespace app\index\logic;
use app\index\model\JobMaininfo as mdJobMaininfo;
use think\Session;


class JobMaininfo{

	/**
	 * @ action 获取职位信息 （名字）
	 * @ Parameter  职位 id
	 * @ return 职位 name
	 * @ author laowen
	 * @ date 16/07/07
	 */

	public function R_jobMaininfo_name( $jm ){

		$md_jobMaininfo = new mdJobMaininfo();

		return $dt_jobMaininfo = $md_jobMaininfo->where( 'JM_ID',$jm )->value('JM_NAME');

	}

}