<?php
namespace app\index\model;

use think\Model;
/*
 * model层的User类
 * 
 */
class UserReginfo extends Model
{
	//指定表明
	protected $table = 'k_user_reginfo';
	//指定主键
	protected $pk = 'UR_ID';
	
}
?>