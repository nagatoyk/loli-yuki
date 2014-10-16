<?php
/**
 * 文章管理
 */
class ArticleController extends AuthController{
	private $db, $rdb, $cate;
	public function __construct(){
		parent::__construct();
		// 文章处理模型
		$this->db = K('Article');
		// 文章关联模型
		$this->rdb = K('ArticleRelation');
		// 栏目缓存
		$this->cate = F('category');
	}
	// 文章列表
	public function index(){
		$field = array('aid', 'catid', 'uid', 'title', 'click', 'addtime');
		$total = $this->db->count();
		$page = new Page($total, 10, 5);
		$this->page = $page->show(2);
		$this->article = $this->rdb->field($field)->order('addtime DESC')->limit($page->limit())->select();
		$this->display();
		// echo $sql ="SELECT ".C('DB_PREFIX')."article.catid, ".C('DB_PREFIX')."category.cid from ".C('DB_PREFIX')."article INNER JOIN ".C('DB_PREFIX')."category ON (".C('DB_PREFIX')."article.catid=".C('DB_PREFIX')."category.cid)";
	}
	// 添加文章
	public function add(){
		if(IS_POST){
			// 模型添加文章
			if($this->db->addart()){
				$this->success('添加成功', 'index');
			}else{
				$this->error($this->db->error);
			}
		}else{
			$this->category = $this->cate;
			$this->display();
		}
	}
	// 编辑文章
	public function edit(){
		if(IS_POST){
			if(!Q('aid', null, 'intval'))$this->error('参数错误');
			// 模型编辑文章
			if($this->db->editart()){
				$this->success('编辑成功', 'index');
			}else{
				$this->error($this->db->error);
			}
		}else{
			$this->field = $this->db->find(Q('aid', 0, 'intval'));
			$this->category = $this->cate;
			$this->display();
		}
	}
	// 删除文章
	public function del(){
		if($this->db->delart()){
			$return = array(
				'status' => 1,
				'message' => '删除成功!!'
			);
		}else{
			$return = array(
				'status' => 0,
				'message' => $this->db->error
			);
		}
		$this->ajax($return);
	}
}