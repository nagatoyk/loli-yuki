<?php
/**
 * 登录检测
 */
class AuthController extends Controller{

	public function __construct(){
		parent::__construct();
		if(!session('username') && !session('uid')){
			go('Admin/Login/index');
		}
	}
}