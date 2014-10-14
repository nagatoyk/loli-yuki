<?php
/**
 * 栏目管理
 */
class CategoryController extends AuthController{
	/**
	 * 初始化
	 */
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 首页
	 */
	public function index(){
		$this->display();
	}
}