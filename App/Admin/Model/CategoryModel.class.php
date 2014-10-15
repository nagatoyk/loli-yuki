<?php
/**
 * 栏目模型
 */
class CategoryModel extends Model{
	// 数据表名
	public $table = 'category';
	// 自动验证
	public $validate = array(
		array('cname', 'nonull', '栏目名称不能留空', 2, 3)
	);
	// 栏目添加处理
	public function addcate(){
		if($this->create()){
			if($this->add()){
				return $this->cachedata();
			}
		}else{
			$this->error = '添加失败OAQ!!';
		}
	}
	// 栏目编辑处理
	public function editcate(){
		if($this->create()){
			if($this->save()){
				return $this->cachedata();
			}
		}else{
			$this->error = '编辑失败OAQ!!';
		}
	}
	// 栏目删除处理
	public function delcate(){
		$cid = (int)$_GET['cid'];
		if($this->where(array('pid' => $cid))->find()){
			$this->error = '请先删除子栏目OAQ!!';
		}else{
			if($this->del($cid)){
				return $this->cachedata();
			}
		}
	}
	// 更新排序处理
	public function upsort(){
		if(isset($_POST['sort'])){
			$upsort = false;
			foreach($_POST['sort'] as $k => $v){
				$upsort = $this->where('cid='.$k)->save(array('sort' => $v));
			}
			if($upsort){
				return $this->cachedata();
			}
		}else{
			$this->error = '更新失败';
		}
	}
	// 缓存栏目数据
	public function cachedata(){
		$catedata = Data::tree($this->order('sort ASC')->all(), 'cname');
		return F('category', $catedata);
	}
}