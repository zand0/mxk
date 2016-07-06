<?php
namespace app\index\model;

use think\Model;
/*
 * model层的User类
 * 
 */
class UserCode extends Model
{
	//指定表明
	protected $table = 'k_user_code';
	//指定主键
	protected $pk = 'UC_ID';
	
}
?>