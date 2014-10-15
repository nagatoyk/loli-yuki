<?php
/**
 * 文章模型
 */
class ArticleModel extends Model{
	// 数据表名
	public $table = 'article';
	// 自动验证
	public $validate = array(
		array('title', 'nonull', '文章标题不能为空', 2, 3)
	);
	// 自动完成
	public $auto = array(
		// 文章发表时间(只在发表时作用)
		array('addtime', 'time', 'function', 2, 1),
		array('updatetime', 'time', 'function', 2, 3),
		array('uid', 'get_uid', 'method', 2, 3)
	);
	// 获取发布人ID
	public function get_uid(){
		return session('uid');
	}
	// 文章添加处理
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
	// 文章编辑处理
	public function editart(){
		if($this->create()){
			// 如果有上传封面
			if(!empty($_FILES['thumb']['name'])){
				$aid = Q('aid', 0, 'intval');
				// 文章封面上传处理
				$up = new Upload('Upload/article/'.date('Ymd'));
				$file = $up->upload();
				$this->data['thumb'] = $file[0]['path'];
				// 查找旧封面数据并删除
				$thumb = $this->where('aid='.$aid)->getField('thumb');
				is_file($thumb) and unlink($thumb);
			}
			return $this->save();
		}
	}
	// 删除文章处理
	public function delart(){
		$aid = Q('aid', 0, 'intval');
		if(!$this->find($aid))$this->error = '该文章记录不存在';
		$thumb = $this->where('aid='.$aid)->getField('thumb');
		is_file($thumb) and unlink($thumb);
		return $this->where('aid='.$aid)->delete();
	}
}