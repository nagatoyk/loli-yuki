<?php
/**
 * 后台主控
 */
class IndexController extends AuthController{
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db = K('Config');
	}
	// 后台首页
	public function index(){
		$this->display();
	}
	//站点相关信息
	public function info(){
	}
	// 网站配置
	public function config(){
		if(IS_POST){
			header('Content-Type:application/json;charset=utf-8');
			if($this->db->update_config()){
				$this->ajax(array('status' => 1, 'message' => '修改成功'));
			}
		}else{
			$this->config = $this->db->get_config();
			$this->display();
		}
	}
}
