<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Cookie;

class Index extends Controller
{

	/**
	 * @ action 判断是否登录
	 * @ Parameter 
	 * @ return 
	 * @ author
	 * @ date 
	 */
    public function index(){

        //Session::set('ruid','1');

        $ruid = Session::get('ruid');

    		// 判断是否是登录状态

    	if ( $ruid == '' ) {

            $this->redirect('Loginpass/login'); die();

        }

        $this->redirect('User/userPage'); die();

    }
    
   
    
}
