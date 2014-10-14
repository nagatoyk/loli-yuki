<?php
/**
 * 栏目管理
 */
class CategoryController extends AuthController{
	private $db;
	/**
	 * 初始化
	 */
	public function __construct(){
		parent::__construct();
		$this->db = K('Category');
	}
	/**
	 * 首页
	 */
	public function index(){
		$list = $this->db->select();
		$this->list = Data::tree($list, 'cname');
		$this->display();
	}
	/**
	 * 添加处理
	 */
	public function add(){
		if(IS_POST){
			header('Content-Type:application/json;charset=utf-8');
			if($this->db->addcate()){
				$return = array(
					'status' => 1,
					'message' => '添加成功!!',
					'timeout' => 3
				);
			}else{
				$return = array(
					'status' => 0,
					'message' => $this->db->error,
					'timeout' => 3
				);
			}
			$this->ajax($return);
		}else{
			$this->display();
		}
	}
	public function edit(){
		if(IS_POST){
			header('Content-Type:application/json;charset=utf-8');
			if($this->db->save()){
				$return = array(
					'status' => 1,
					'message' => '编辑成功!!',
					'timeout' => 3
				);
			}else{
				$return = array(
					'status' => 0,
					'message' => $this->db->error,
					'timeout' => 3
				);
			}
			$this->ajax($return);
		}else{
			$category = $this->db->all();
			$category = Data::tree($category, 'cname');
			$field = $this->db->find(Q('cid', 0, 'intval'));
			foreach($category as $k => $v){
				// 父级栏目选中
				$v['selected'] = '';
				if($field['pid'] == $v['cid']){
					$v['selected'] = ' selected="selected" ';
				}
				// 将自身和子栏目添加禁止选中
				$v['disabled'] = '';
				if($field['cid'] == $v['cid']){
					$v['disabled'] = ' disabled="disabled" ';
				}
				// 子栏目禁止选中
				if(Data::isChild($category, $v['cid'], $field['cid'])){
					$v['disabled'] = ' disabled="disabled" ';
				}
				$category[$k] = $v;
			}
			$this->cate = $category;
			$this->field = $field;
			$this->display();
		}
	}
	public function del(){
		if($this->db->delcate()){
			$return = array(
				'status' => 1,
				'message' => '删除成功!!',
				'timeout' => 3
			);
		}else{
			$return = array(
				'status' => 0,
				'message' => $this->db->error,
				'timeout' => 3
			);
		}
		$this->ajax($return);
	}
}