<?php
/**
 * 登录控制
 */
class LoginController extends Controller{
	// 登录首页
	public function index(){
		if(session('username') && session('uid'))go('Index/index');
		$this->display();
	}
	// 登录验证
	public function login(){
		$db = M('user');
		$username = Q('username');
		$password = Q('password', '', 'strtolower,md5');
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
		$db->where(array('uid' => $user['uid']))->save($data);
		session('username', $user['username']);
		session('uid', $user['uid']);
		$this->success('登录成功!!', 'Index/index');
	}
	// 退出登录
	public function out(){
		session_unset();
		session_destroy();
		go('index');
	}
	// 验证码
	public function code(){
		$code = new Code();
		$code->show();
	}
	// 验证验证码
	public function checkcode(){
		$status = strtoupper($_POST['code']) == session('code') ? 1 : 0;
		$this->ajax($status);
	}
	// 验证用户名
	public function checkname(){
		$name = Q('username');
		$status = M('user')->where(array('username' => $name))->find();
		$this->ajax($status != '' ? 1 : 0);
	}
	// 验证密码
	public function checkpass(){
		$pass = Q('password', null, 'strtolower,md5');
		$status = M('user')->where(array('password' => $pass))->find();
		$this->ajax($status != '' ? 1 : 0);
	}
}