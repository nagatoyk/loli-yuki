<?php
/**
 * 文章管理
 */
class ArticleController extends AuthController{
	/**
	 * 文章私有属性
	 */
	private $db, $cate;
	/**
	 * 初始化
	 */
	public function __construct(){
		parent::__construct();
		/**
		 * 文章数据库模型
		 */
		$this->db = K('Article');
		/**
		 * 栏目缓存
		 */
		$this->cate = F('category');
	}
	/**
	 * 文章列表
	 */
	public function index(){
		$this->article = $this->db->all();
		$this->display();
	}
	/**
	 * 添加文章
	 */
	public function add(){
		if(IS_POST){}else{
			$this->category = $this->cate;
			$this->display();
		}
	}
}