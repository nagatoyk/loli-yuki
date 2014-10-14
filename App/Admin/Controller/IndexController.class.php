<?php
/**
 * 后台主控
 */
class IndexController extends AuthController{
	/**
	 * 后台首页
	 */
	public function index(){
		$this->display();
	}
	/**
	 * 更新配置公用方法
	 */
	public function upconf(){
		if(!IS_POST)halt('页面不存在');
		if(F(Q('type'), $_POST, APP_CONFIG_PATH)){
			$this->success('设置成功');
		}
	}
	/**
	 * 数据库配置
	 */
	public function db(){
		$this->display();
	}
	/**
	 * 验证码配置
	 */
	public function code(){
		$this->display();
	}
	/**
	 * 编辑器配置
	 */
	public function editor(){
		$this->display();
	}
	/**
	 * 默认配置
	 */
	public function config(){
		if(IS_POST){
			p($_POST);
			$_data = '[';
			foreach($_POST['AUTO_LOAD_FILE'] as $k => $v){
				$_data .= '"'.$v.'",';
			}
			$_data = rtrim($_data, ',').']';
			$data = json_decode($_data);
			if(F('config', array('AUTO_LOAD_FILE' => $data), APP_CONFIG_PATH)){
				$this->success('设置成功');
			}
		}else{
			$this->display();
		}
	}
}
