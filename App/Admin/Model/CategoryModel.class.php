<?php
/**
 * 栏目模型
 */
class CategoryModel extends Model{
	/**
	 * 数据表名
	 */
	public $table = 'category';
	/**
	 * 自动验证
	 */
	public $validate = array(
		array('cname', 'nonull', '栏目名称不能留空', 2, 3)
	);
	/**
	 * 添加处理方法
	 */
	public function addcate(){
		if($this->create()){
			if($this->add()){
				return $this->cachedata();
			}
		}else{
			$this->error = '添加失败OAQ!!';
		}
	}
	/**
	 * 编辑处理方法
	 */
	public function editcate(){
		if($this->create()){
			if($this->save()){
				return $this->cachedata();
			}
		}else{
			$this->error = '编辑失败OAQ!!';
		}
	}
	/**
	 * 删除处理方法
	 */
	public function delcate(){
		$cid = Q('cid', 0, 'intval');
		if($this->where(array('pid' => $cid))->find()){
			$this->error = '请先删除子栏目OAQ!!';
		}else{
			if($this->del($cid)){
				return $this->cachedata();
			}
		}
	}
	/**
	 * 缓存栏目数据方法
	 */
	public function cachedata(){
		$catedata = Data::tree($this->all(), 'cname');
		return F('category', $catedata);
	}
}