<?php
namespace app\index\model;

use think\Model;
/*
 * model层的User类
 * 
 */
class UserInfo extends Model
{
	//指定表明
	protected $table = 'k_user_info';
	//指定主键
	protected $pk = 'UR_ID';
	//关联UserReginfo模型
	/*public function UserReginfo()
	{
	    return $this->hasMany('UserReginfo');
	}*/
	
	//关联UserReginfo模型
	/*public function UserWechat()
	{
	    return $this->hasOne('UserWechat');
	}*/
	
}
?>