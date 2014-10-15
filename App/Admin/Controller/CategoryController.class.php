<?php
/**
 * 栏目管理
 */
class CategoryController extends AuthController{
	private $db, $cate;
	public function __construct(){
		parent::__construct();
		$this->db = K('Category');
		$this->cate = F('category');
	}
	// 栏目列表
	public function index(){
		$this->category = $this->cate;
		$this->display();
	}
	// 添加处理
	public function add(){
		if(IS_POST){
			if($this->db->addcate()){
				$this->success('添加成功', 'index');
			}else{
				$this->error($this->db->error);
			}
		}else{
			$this->display();
		}
	}
	// 编辑栏目
	public function edit(){
		if(IS_POST){
			if($this->db->save()){
				$this->success('编辑成功', 'index');
			}else{
				$this->error($this->db->error);
			}
		}else{
			$category = $this->cate;
			$field = $this->db->find((int)$_GET['cid']);
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
			$this->category = $category;
			$this->field = $field;
			$this->display();
		}
	}
	// 删除栏目
	public function del(){
		if($this->db->delcate()){
			$this->success('删除成功', 'index');
		}else{
			$this->error($this->db->error);
		}
	}
	// 跟新排序
	public function sort(){
		if($this->db->upsort()){
			$this->success('更新排序成功!!', 'index');
		}else{
			$this->error($this->db->error);
		}
	}
	// 更新缓存
	public function upcache(){
		if($this->db->cachedata()){
			$return = array(
				'status' => 1,
				'message' => '更新缓存成功!!'
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