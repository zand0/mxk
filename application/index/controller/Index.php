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
	 * @ author laowen
	 * @ date 16/07/05
	 */
    public function index(){

    	// Session::set('userid', '1');

    		// 判断是否是登录状态

    	if ( Session::get('userid') == '' ) {

            $this->redirect('User/login'); die();

        }

        $this->redirect('User/get_userinfo'); die();

    }
    
   
    
}
