<?php
/**
 * 文章模型
 */
class ArticleModel extends Model{
	/**
	 * 数据表名
	 */
	public $table = 'article';
	/**
	 * 自动完成
	 */
	public $auto = array(
		// 文章发表时间(只在发表时作用)
		array('addtime', 'time', 'function', 2, 1),
		array('updatetime', 'time', 'function', 2, 2),
		array('admin_id', 'get_adminid', 'method', 2, 3),
		array('author', 'get_author', 'method', 2, 3)
	);
	/**
	 * 获取管理员ID
	 */
	public function get_adminid(){
		return session(C('RBAC_AUTH_KEY'));
	}
	/**
	 * 获取发布人名称
	 */
	public function get_author(){
		return empty($_POST['author']) ? session('username') : $_POST['author'];
	}
	/**
	 * 添加处理
	 */
	public function addart(){
		if($this->create()){
			// 如果有上传封面
			if(!empty($_FILES['thumb']['name'])){
				// 文章封面上传处理
				$up = new Upload('Upload/article/'.date('Ymd'));
				$file = $up->upload();
				$this->data['thumb'] = $file[0]['path'];
			}
			return $this->add();
		}
	}
	/**
	 * 编辑处理
	 */
	public function editart(){
		if($this->create()){
			// 如果有上传封面
			if(!empty($_FILES['thumb']['name'])){
				// 文章封面上传处理
				$up = new Upload('Upload/article/'.date('Ymd'));
				$file = $up->upload();
				$this->data['thumb'] = $file[0]['path'];
				// 查找旧封面数据并删除
				$thumb = $this->where('aid='.(int)$_POST['aid'])->getField('thumb');
				is_file($thumb) and unlink($thumb);
			}
			return $this->save();
		}
	}
	/**
	 * 删除文章
	 */
	public function delart(){
		$aid = (int)$_GET['aid'];
		if(!$this->find($aid))$this->error = '该文章记录不存在';
		$thumb = $this->where('aid='.$aid)->getField('thumb');
		is_file($thumb) and unlink($thumb);
		return $this->where('aid='.$aid)->delete();
	}
}