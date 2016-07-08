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
        
        /*if($data['UWE_ACC']){
            $uw = model('UserWechat');
            if($uw->where('UR_ID',$data['UR_ID'])->find()){
                $uw->allowField(true)->save($data,['UR_ID'=>$data['UR_ID']]);
            }else{
                $uw->allowField(true)->save($data);
            }
            
        }*/
        if($uim->where('UR_ID',$data['UR_ID'])->find()){
            $uim->allowField(true)->save($data,['UR_ID'=>$data['UR_ID']]);
        }else{
            $uim->data($data)->allowField(true)->save();
        }
        
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





    /**
     * @ action 获取用户信息 （姓名，头像）
     * @ Parameter 参数
     * @ return 返回 数组array()
     * @ author laowen
     * @ date 16/07/06
     */

    public function R_userInfo_nameAndPhoto( $ruid=NULL ){

        if ( !$ruid ) {
            
            $ruid = Session::get('ruid')?Session::get('ruid'):0;

            if( $ruid == 0) {

                return "请先登录"; die();

            }

        }           

        $md_userInfo = new mdUserInfo();

        $dt_userInfo = $md_userInfo->where( 'UR_ID',$ruid )->column('UI_PHOTO','UI_NAME');

        $data = array();

        foreach ( $dt_userInfo as $key => $value) {

            $data['UI_NAME'] = $key;

            $data['UI_PHOTO'] = $value;
            
        }

        return $data;

    }

    /**
     * @ action 上传后修改用户头像地址
     * @ Parameter 
     * @ return 返回
     * @ author laowen
     * @ date 16/07/06
     */

    public function U_userInfo_photo($url){

        $ruid = Session::get('ruid')?Session::get('ruid'):0;

        if( $ruid == 0) {

            return "请先登录"; die();

        }       

        $md_userInfo = new mdUserInfo();

        return $md_userInfo->where('UR_ID', $ruid)->update( ['UI_PHOTO' => $url ] );

    }

    /**
     * @ action 修改 姓名
     * @ Parameter 
     * @ return true/false
     * @ author laowen
     * @ date 16/07/07
     */ 

    public function U_userName(){

        $ruid = Session::get('ruid')?Session::get('ruid'):0;

        if( $ruid == 0) {

            return "请先登录"; die();

        }

        $uiName = input('post.uname');

        $md_userInfo = new mdUserInfo();

        $dt_userInfo = $md_userInfo->where('UR_ID', $ruid)->update( ['UI_NAME' => $uiName ] );

        if ( !$dt_userInfo ) {

            return "姓名修改失败；请稍后修改！";
            
        }else{

            return "修改成功！";

        }
        

    }





















  
}