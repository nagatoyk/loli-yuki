<?php
/**
 * 登录控制
 */
class LoginController extends Controller{
	/**
	 * 初始化
	 */
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 登录首页
	 */
	public function index(){
		if(session(C('RBAC_USERNAME_FIELD')))go('Index/index');
		$this->display();
	}
	/**
	 * 登录验证
	 */
	public function login(){
		$db = M('user');
		$username = Q('username');
		$password = Q('password', '', 'md5');
		if(strtoupper($_POST['code']) != session('code')){
			$this->error('验证码错误!');
		}
		$user = $db->where(array('username' => $username))->find();
		if(!$user || $password != $user['password']){
			$this->error('用户名或密码错误');
		}
		$data = array(
			'loginip' => Ip::getClientIp(),
			'logintime' => time()
		);
		$db->where(array('id' => $user['id']))->save($data);
		session(C('RBAC_USERNAME_FIELD'), $user['username']);
		session(C('RBAC_AUTH_KEY'), $user['id']);
		$this->success('登录成功!!', 'Index/index');
	}
	/**
	 * 退出登录
	 */
	public function out(){
		session_unset();
		session_destroy();
		go('index');
	}
	/**
	 * 验证码展示
	 */
	public function code(){
		$code = new Code();
		$code->show();
	}
	/**
	 * 验证码验证
	 */
	public function checkcode(){
		$status = strtoupper($_POST['code']) == session('code') ? 1 : 0;
		$this->ajax($status);
	}
}