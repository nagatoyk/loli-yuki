<?php
/**
 * 登录检测
 */
class AuthController extends Controller{

	public function __construct(){
		if(!session(C('RBAC_USERNAME_FIELD')) && !session(C('RBAC_AUTH_KEY'))){
			go('Admin/Login/index');
		}
	}
}