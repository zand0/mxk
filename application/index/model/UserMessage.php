<?php
namespace app\index\model;

use think\Model;

	/**
	 * @ action 消息推送 模型
	 * @ Parameter 
	 * @ return 
	 * @ author 
	 * @ date 
	 */

class UserMessage extends Model
{
	
	// 指定表明

	protected $table = 'user_message';

	// 指定主键

	protected $pk = 'UME_ID';


}
?>