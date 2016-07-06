<?php
namespace app\index\logic;
use app\index\model\UserInfo as mdUserInfo;
use think\Session;
class UserInfo
{
    protected $_m = '';
    public function __construct(){
        $this->_m = new mdUserInfo;
    }
    public function C_user($post){
        $ur_id = 3;//Session::get('ruid');
        if(!$ur_id){
            return 0;
        }
        $data = [
            'UR_ID' => $ur_id,
            'UI_NAME'=>       $post['UI_NAME'],
            'UI_EMAIL'=>      $post['UI_EMAIL']?$post['UI_EMAIL']:0,
            'UR_PWD'=>        $post['UR_PWD']?$post['UR_PWD']:0,
            'UWE_ACC'=>       $post['UWE_ACC']?$post['UWE_ACC']:0,
            'UI_CRE_TIME'=>   date('Y-m-d H:i:s',time()),
            'UI_AGE'=> 0,
            'UI_SEX' => 0,
            
        ];
        $data['UR_PWD'] = md5($data['UR_PWD']);
        $uim = $this->_m;
        if($data['UR_PWD']){
            model('UserReginfo')->allowField(true)->save($data,['UR_ID'=>$data['UR_ID']]);
        }
        
        if($data['UWE_ACC']){
            model('UserWechat')->allowField(true)->save($data);
        }
        //过滤post数组中的非数据表字段数据
        $uim->data($data)->allowField(true)->save();
        return 1;
       
        
    }
    
}

