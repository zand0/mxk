<?php
namespace app\index\logic;
use app\index\model\UserInfo as mdUserInfo;
use think\Session;
use app\index\logic\util\Filter;

class UserInfo
{
    //用于存放对应模型的属性
    protected $_m = '';
    /**
     * 将本类对应模型实例化到本类属性 _m 方便使用
     * @author shikunqiang
     * date 2016-7-6
     */
    public function __construct(){
        $this->_m = new mdUserInfo;
    }
    
    /**
     * 插入完善信息表单的数据
     * @param unknown $post
     * @return bool
     * @author shikunqiang
     * date 2016-7-6
     */
    public function C_regInfo($post){
        $ur_id = Session::get('ruid');
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
            'UI_SEX' => 0  
        ];
        if($data['UR_PWD']){
            $data['UR_PWD'] = md5($data['UR_PWD']);
        }
        //过滤关键词
        if(Filter::keywords($data)){
            exception('存在敏感词！！',1);
        }
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
    
    /**
     * 检查用户是否完善过信息,返回true为以完善
     * 
     */
    public static function R_check_Info(){
        $ruid = Sesion::get('ruid');
        if(!empty($this->_m->where('UR_ID',$ruid)->find())){
            return true;
        }
    }
    
}

