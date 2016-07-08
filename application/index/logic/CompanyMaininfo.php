<?php
namespace app\index\logic;
use app\index\model\CompanyMaininfo as mdCompanyMaininfo;
use think\Session;


class CompanyMaininfo{

	/**
	 * @ action 获取公司信息 （名字）
	 * @ Parameter 公司 id
	 * @ return 公司 name
	 * @ author laowen
	 * @ date 16/07/07
	 */

	public function R_companyMaininfo_name( $cm ){

		$md_companyMaininfo = new mdCompanyMaininfo();

		return $dt_companyMaininfo = $md_companyMaininfo->where( 'CM_ID',$cm )->value('CM_NAME');

	}

}