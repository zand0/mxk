<?php
namespace app\index\model;

use think\Model;
/*
 * model层的User类
 * 
 */
class UserReginfo extends Model
{
	// 指定表明

	protected $table = 'k_user_reginfo';

	// 指定主键

	protected $pk = 'UR_ID';

	// 关联 一对一 （ 用户信息表 ）

	public function k_user_info() {

        return $this->hasOne('userInfo','UR_ID','UR_ID',[''],'');

        // hasOne('关联模型名','外键名','主键名',['模型别名定义'],'join类型');
    }

    // 关联 一对一 （ 第三方的微信登录 ）

    public function k_user_wechat() {

    	return $this->hasOne('userWechat','UR_ID','UR_ID',[''],'');

    }
	
}
?>