<?php
/**
 * 文章模型
 */
class ArticleRelationModel extends RelationModel{
	// 数据表名
	public $table = 'article';
	// 关联设置
	public $join = array(
		'category' => array(
			'type' => 'BELONGS_TO',
			'foreign_key' => 'catid',
			'parent_key' => 'cid',
			'field' => 'cname'
		),
		'user' => array(
			'type' => 'BELONGS_TO',
			'foreign_key' => 'uid',
			'parent_key' => 'uid',
			'field' => 'username'
		)
	);
}